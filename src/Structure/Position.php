<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Structure;

use JsonSerializable;
use function htmlspecialchars;
use function substr;

/**
 * Class Position
 * @package OrangeData\Structure
 */
class Position implements JsonSerializable
{
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
     * @var string
     */
    private $text;

    /**
     * @var float
     */
    private $quantity;

    /**
     * @var float
     */
    private $price;

    /**
     * @var int
     */
    private $vat;

    /**
     * @var int
     */
    private $paymentMethodType;

    /**
     * @var int
     */
    private $paymentSubjectType;

    /**
     * @var null|int
     */
    private $agentType;

    /**
     * @var AgentInfo
     */
    private $agentInfo;

    /**
     * @var null|string
     */
    private $supplierINN;

    /**
     * @var null|SupplierInfo
     */
    private $supplierInfo;

    /**
     * Position constructor.
     * @param float $quantity
     * @param float $price
     * @param int $vat
     * @param string $text
     * @param int $paymentMethodType
     * @param int $paymentSubjectType
     */
    public function __construct(float $quantity, float $price, int $vat, string $text, int $paymentMethodType, int $paymentSubjectType)
    {
        $this->text = $text;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->vat = $vat;
        $this->paymentMethodType = $paymentMethodType;
        $this->paymentSubjectType = $paymentSubjectType;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return null|string
     */
    public function getSupplierINN(): ?string
    {
        return $this->supplierINN;
    }

    /**
     * @return null|SupplierInfo
     */
    public function getSupplierInfo(): ?SupplierInfo
    {
        return $this->supplierInfo;
    }

    /**
     * @param null|string $supplierInn
     * @param null|SupplierInfo $supplierInfo
     *
     * @return Position
     */
    public function setSupplier(string $supplierInn = null, SupplierInfo $supplierInfo = null): Position
    {
        $this->supplierINN = $supplierInn;
        $this->supplierInfo = $supplierInfo;

        return $this;
    }

    /**
     * @param int|null $agentType
     * @param AgentInfo|null $agentInfo
     *
     * @return Position
     */
    public function setAgent(int $agentType = null, AgentInfo $agentInfo = null): Position
    {
        $this->agentType = $agentType;
        $this->agentInfo = $agentInfo;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'text' => htmlspecialchars(substr($this->text, 0, 128)),
            'quantity' => $this->quantity,
            'price' => $this->price,
            'tax' => $this->vat,
            'paymentMethodType' => $this->paymentMethodType,
            'paymentSubjectType' => $this->paymentSubjectType,
            'agentType' => $this->agentType,
            'agentInfo' => $this->agentInfo,
            'supplierINN' => $this->supplierINN,
            'supplierInfo' => $this->supplierInfo,
        ];
    }
}
