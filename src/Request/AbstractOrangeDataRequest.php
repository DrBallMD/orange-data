<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Request;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use OrangeData\Response\OrangeDataResponseInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractOrangeDataRequest implements OrangeDataRequestInterface
{

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * OrderCreateRequest constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function request($method, $uri, array $options = []): OrangeDataResponseInterface
    {
        try {
            $r = $this->client->request($method, $uri, $options);
        } catch (ClientException $e) {
            if (!$e->hasResponse()) {
                throw $e;
            }
            $r = $e->getResponse();
        }

        return $this->createResponse($r);
    }

    abstract protected function createResponse(ResponseInterface $response): OrangeDataResponseInterface;
}
