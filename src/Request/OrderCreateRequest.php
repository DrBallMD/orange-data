<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Request;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use OrangeData\Body\BodyInterface;
use OrangeData\Response\OrangeDataResponseInterface;
use OrangeData\Response\OrderCreateResponse;
use OrangeData\Sign\SignInterface;

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
     * @var BodyInterface
     */
    private $body;

    /**
     * OrderCreateRequest constructor.
     *
     * @param ClientInterface $client
     * @param SignInterface $sign
     * @param BodyInterface $body
     */
    public function __construct(ClientInterface $client, SignInterface $sign, BodyInterface $body)
    {
        $this->client = $client;
        $this->sign = $sign;
        $this->body = $body;
    }

    public function request(): OrangeDataResponseInterface
    {
        try {
            $r = $this->client->request(self::METHOD, self::URI, [
                'headers' => [
                    'content-type' => 'application/json; charset=utf-8',
                    'X-Signature' => $this->sign->asString(),
                ],
                'body' => $this->body->asString(),
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
