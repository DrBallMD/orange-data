<?php

declare(strict_types=1);
/**
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Client;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use OrangeData\Request\OrderCreateRequest;
use OrangeData\Request\OrderStatusRequest;
use OrangeData\Response\OrangeDataResponseInterface;

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
        return (new OrderCreateRequest($this->client, new Sign($order, $this->signKey), $order))->request();
    }

    public function getStatus(string $inn, string $orderId): OrangeDataResponseInterface
    {
        return (new OrderStatusRequest($this->client, $inn, $orderId))->request();
    }
}
