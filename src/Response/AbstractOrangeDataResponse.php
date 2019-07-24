<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Response;

use Psr\Http\Message\ResponseInterface;
use function json_decode;

abstract class AbstractOrangeDataResponse implements OrangeDataResponseInterface
{

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var array
     */
    private $data;

    public function __construct(ResponseInterface $response)
    {
        $this->statusCode = $response->getStatusCode();
        $this->response = $response;
        $this->data = $this->asArray();
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    private function asArray(): array
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

    public function toArray(): array
    {
        return $this->data;
    }
}
