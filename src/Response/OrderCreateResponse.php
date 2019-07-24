<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Response;

class OrderCreateResponse extends AbstractOrangeDataResponse
{

    public function isSuccessful(): bool
    {
        return $this->getStatusCode() === 201;
    }
}
