<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Response;

use Psr\Http\Message\ResponseInterface;
use function json_decode;

abstract class AbstractOrangeDataResponse implements OrangeDataResponseInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function statusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function asArray(): array
    {
        return (new DecodeResponse($this->response))->decode();
    }
}
