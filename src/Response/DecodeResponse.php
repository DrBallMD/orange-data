<?php

declare(strict_types=1);


namespace OrangeData\Response;

use Psr\Http\Message\ResponseInterface;

class DecodeResponse
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * DecodeResponse constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function decode(): array
    {
        $datum = (array)json_decode(
            $this->response
                ->getBody()
                ->getContents(),
            true
        );

        $datum['headers'] = $this->response->getHeaders();

        return $datum;
    }
}
