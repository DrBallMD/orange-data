<?php declare(strict_types=1);
/**
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Client;

use OrangeData\Response\OrangeDataResponseInterface;

interface OrangeDataClientInterface
{

    /**
     * Признак расчета
     */
    public const TYPE_IN = 1; //приход
    public const TYPE_IN_RETURN = 2; //возврат прихода

    /**
     * Система налогообложения
     */
    public const TAX_USN = 1; //упрощенная
    public const TAX_USN_MINUS = 2; //упрощенная минус расходы

    /**
     * Ставка НДС
     */
    public const VAT_NO = 6;

    /**
     * Признак способа расчета
     */
    public const PAYMENT_METHOD_FULL = 4;

    /**
     * Признак предмета расчета
     */
    public const PAYMENT_SUBJECT_SERVICE = 4;

    /**
     * Тип оплаты
     */
    public const PAYING_CASH = 1;

    public function createOrder(string $order): OrangeDataResponseInterface;

    public function getStatus(string $inn, string $orderId): OrangeDataResponseInterface;
}
