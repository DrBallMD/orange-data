<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Request;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use OrangeData\Response\OrangeDataResponseInterface;
use OrangeData\Response\OrderCreateResponse;
use function sprintf;

class OrderStatusRequest implements OrangeDataRequestInterface
{
    private const URI = '/api/v2/documents/%s/status/%s';

    private const METHOD = 'GET';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $inn;

    /**
     * @var string
     */
    private $orderId;

    public function __construct(ClientInterface $client, string $inn, string $orderId)
    {
        $this->client = $client;
        $this->inn = $inn;
        $this->orderId = $orderId;
    }

    public function request(): OrangeDataResponseInterface
    {
        try {
            $r = $this->client->request(self::METHOD, sprintf(self::URI, $this->inn, $this->orderId), [
                'headers' => [
                    'content-type' => 'application/json; charset=utf-8',
                ]
            ]);
        } catch (RequestException $e) {
            if (!$e->hasResponse()) {
                throw $e;
            }
            $r = $e->getResponse();
        }

        return new OrderCreateResponse($r);
    }
}
