<?php

declare(strict_types=1);
/**
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Body;

use OrangeData\Structure\Order;

class OrderCreateBody implements BodyInterface
{
    /**
     * @var Order
     */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function asString(): string
    {
        return json_encode($this->order, JSON_PRESERVE_ZERO_FRACTION);
    }
}
