<?php

declare(strict_types=1);
/**
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Client;

use OrangeData\Response\OrangeDataResponseInterface;
use OrangeData\Structure\Order;

interface OrangeDataClientInterface
{
    public function createOrder(Order $order): OrangeDataResponseInterface;

    public function getStatus(string $inn, string $orderId): OrangeDataResponseInterface;
}
