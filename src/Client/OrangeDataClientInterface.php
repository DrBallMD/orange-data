<?php declare(strict_types=1);
/**
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Client;

use OrangeData\Response\OrangeDataResponseInterface;

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

    /**
     * Признак расчета
     */
    public const TYPE_IN = 1; //приход
    public const TYPE_IN_RETURN = 2; //возврат прихода
    public const TYPE_OUT = 3; //Расход
    public const TYPE_OUT_RETURN = 4; //Возврат расхода

    /**
     * Система налогообложения
     */
    public const TAX_OSN = 0; //общая
    public const TAX_USN = 1; //упрощенная
    public const TAX_USN_MINUS = 2; //упрощенная минус расходы
    public const TAX_ENVD = 3; //енвд
    public const TAX_ESN = 4; //есн
    public const TAX_PATENT = 5; //патент

    /**
     * Ставка НДС
     */
    public const VAT_18 = 1; //18%
    public const VAT_10 = 2; //10%
    public const VAT_118 = 3; //18/118
    public const VAT_110 = 4; //10/110
    public const VAT_0 = 5; //0
    public const VAT_NO = 6; //без НДС

    /**
     * Признак способа расчета
     */
    public const PAYMENT_METHOD_PREPAY = 1; //Предоплата 100%
    public const PAYMENT_METHOD_PARTIAL_PREPAY = 2; //Частичная предоплата
    public const PAYMENT_METHOD_ADVANCE = 3; //Аванс
    public const PAYMENT_METHOD_FULL = 4; //Полный расчёт
    public const PAYMENT_METHOD_PARTIAL_AND_CREDIT = 5; //Частичный расчёт и кредит
    public const PAYMENT_METHOD_CREDIT_TRANSFER = 5; //Передача в кредит
    public const PAYMENT_METHOD_CREDIT_PAYMENT = 6; //Оплата кредита

    /**
     * Признак предмета расчета
     */
    public const PAYMENT_SUBJECT_PRODUCT = 1; //Товар
    public const PAYMENT_SUBJECT_EXCISABLE = 2; //Подакцизный товар
    public const PAYMENT_SUBJECT_JOB = 3; //Работа
    public const PAYMENT_SUBJECT_SERVICE = 4; //Услуга
    public const PAYMENT_SUBJECT_GAMBLING_BET = 5; //Ставка азартной игры
    public const PAYMENT_SUBJECT_GAMBLING_GAIN = 6; //Выигрыш азартной игры
    public const PAYMENT_SUBJECT_LOTTERY_TICKET = 7; //Лотерейный билет
    public const PAYMENT_SUBJECT_LOTTERY_WINNINGS = 8; //Выигрыш лотереи
    public const PAYMENT_SUBJECT_RID = 9; //Предоставление РИД
    public const PAYMENT_SUBJECT_PAYMENT = 10; //Платёж
    public const PAYMENT_SUBJECT_AGENT_COMMISION = 11; //Агентское вознаграждение
    public const PAYMENT_SUBJECT_COMPOSITE = 12; //Составной предмет расчета
    public const PAYMENT_SUBJECT_OTHER = 13; //Иной предмет расчета

    /**
     * Тип оплаты
     */
    public const PAYING_CASH = 1; //Cумма по чеку наличными
    public const PAYING_EMONEY = 2; //Сумма по чеку электронными
    public const PAYING_ADVANCE = 14; //Сумма по чеку предоплатой (зачетом аванса и (или) предыдущих платежей)
    public const PAYING_CREDIT = 3; //Сумма по чеку постоплатой (в кредит)
    public const PAYING_BSO = 4; //Сумма по чеку (БСО) встречным предоставлением

    public function createOrder(string $order): OrangeDataResponseInterface;

    public function getStatus(string $inn, string $orderId): OrangeDataResponseInterface;
}
