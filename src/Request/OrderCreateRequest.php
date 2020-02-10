<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Request;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use OrangeData\Client\SignInterface;
use OrangeData\Response\OrangeDataResponseInterface;
use OrangeData\Response\OrderCreateResponse;

class OrderCreateRequest implements OrangeDataRequestInterface
{
    private const URI = '/api/v2/documents/';

    private const METHOD = 'POST';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var SignInterface
     */
    private $sign;

    /**
     * @var string
     */
    private $order;

    /**
     * OrderCreateRequest constructor.
     * @param ClientInterface $client
     * @param SignInterface $sign
     * @param string $order
     */
    public function __construct(ClientInterface $client, SignInterface $sign, string $order)
    {
        $this->client = $client;
        $this->sign = $sign;
        $this->order = $order;
    }

    public function request(): OrangeDataResponseInterface
    {
        try {
            $r = $this->client->request(self::METHOD, self::URI, [
                'headers' => [
                    'content-type' => 'application/json; charset=utf-8',
                    'X-Signature' => $this->sign->toString(),
                ],
                'body' => $this->order,
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
