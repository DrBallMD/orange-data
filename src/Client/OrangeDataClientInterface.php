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
    /**
     * Признак агента
     */
    public const AGENT_TYPE_BANK_AGENT = 1; //Банковский платежный агент
    public const AGENT_TYPE_BANK_SUB_AGENT = 2; //Банковский платежный субагент
    public const AGENT_TYPE_PAYING_AGENT = 3; //Платежный агент
    public const AGENT_TYPE_PAYING_SUB_AGENT = 4; //Платежный субагент
    public const AGENT_TYPE_ATTORNEY = 5; //Поверенный
    public const AGENT_TYPE_COMISSIONER = 6; //Комиссионер
    public const AGENT_TYPE_OTHER = 7; //Иной агент


    public function createFiscalCheck(Order $order): OrangeDataResponseInterface;

    public function getStatus(string $inn, string $orderId): OrangeDataResponseInterface;
}
