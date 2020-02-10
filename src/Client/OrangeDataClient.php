<?php

declare(strict_types=1);
/**
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Client;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use OrangeData\Body\OrderCreateBody;
use OrangeData\Request\OrderCreateRequest;
use OrangeData\Request\OrderStatusRequest;
use OrangeData\Response\OrangeDataResponseInterface;
use OrangeData\Sign\Base64EncodedRsa256;
use OrangeData\Structure\Order;

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

    public function createFiscalCheck(Order $order): OrangeDataResponseInterface
    {
        $body = new OrderCreateBody($order);
        return (new OrderCreateRequest(
            $this->client,
            new Base64EncodedRsa256($body, $this->signKey),
            $body
        )
        )->request();
    }

    public function getStatus(string $inn, string $orderId): OrangeDataResponseInterface
    {
        return (new OrderStatusRequest($this->client, $inn, $orderId))->request();
    }
}
