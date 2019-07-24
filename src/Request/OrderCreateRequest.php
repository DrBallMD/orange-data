<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Request;

use OrangeData\Response\OrangeDataResponseInterface;
use OrangeData\Response\OrderCreateResponse;
use Psr\Http\Message\ResponseInterface;

class OrderCreateRequest extends AbstractOrangeDataRequest
{

    protected function createResponse(ResponseInterface $response): OrangeDataResponseInterface
    {
        return new OrderCreateResponse($response);
    }
}
