<?php declare(strict_types=1);
/**
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Client;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use OrangeData\Request\OrderCreateRequest;
use OrangeData\Request\OrderStatusRequest;
use OrangeData\Response\OrangeDataResponseInterface;
use phpseclib\Crypt\RSA;
use function base64_encode;
use function sprintf;

class OrangeDataClient implements OrangeDataClientInterface
{

    /**
     * @var GuzzleClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $signKey;

    /**
     * OrangeClient constructor.
     *
     * @param GuzzleClientInterface $client
     * @param string $signKey
     */
    public function __construct(GuzzleClientInterface $client, string $signKey)
    {
        $this->client = $client;
        $this->signKey = $signKey;
    }

    public function createOrder(string $order): OrangeDataResponseInterface
    {
        $sign = $this->sign($order);

        return (new OrderCreateRequest($this->client))->request('POST', '/api/v2/documents/', [
            'headers' => [
                'content-type' => 'application/json; charset=utf-8',
                'X-Signature' => $sign,
            ],
            'body' => $order,
        ]);
    }

    public function getStatus(string $inn, string $orderId): OrangeDataResponseInterface
    {
        return (new OrderStatusRequest($this->client))->request('GET',
            sprintf('/api/v2/documents/%s/status/%s', $inn, $orderId), [
                'headers' => [
                    'content-type' => 'application/json; charset=utf-8',
                ],
            ]);
    }

    private function sign(string $data): string
    {
        $rsa = new RSA();
        $rsa->setPrivateKey($this->signKey);
        $rsa->setPrivateKeyFormat(RSA::PRIVATE_FORMAT_XML);
        $rsa->setHash('sha256');
        $rsa->setMGFHash('sha256');
        $rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);

        return base64_encode($rsa->sign($data));
    }
}
