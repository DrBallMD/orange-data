<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Structure;

use JsonSerializable;

/**
 * Class Payment
 * @package OrangeData\Structure
 */
class Payment implements JsonSerializable
{
    /**
     * Тип оплаты
     */
    public const PAYING_CASH = 1; //Cумма по чеку наличными
    public const PAYING_EMONEY = 2; //Сумма по чеку электронными
    public const PAYING_ADVANCE = 14; //Сумма по чеку предоплатой (зачетом аванса и (или) предыдущих платежей)
    public const PAYING_CREDIT = 3; //Сумма по чеку постоплатой (в кредит)
    public const PAYING_BSO = 4; //Сумма по чеку (БСО) встречным предоставлением

    /**
     * @var int
     */
    private $type;

    /**
     * @var float
     */
    private $amount;

    /**
     * Payment constructor.
     *
     * @param int $type
     * @param float $amount
     */
    public function __construct(int $type, float $amount)
    {
        $this->type = $type;
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    public function jsonSerialize()
    {
        return [
            'type' => $this->type,
            'amount' => $this->amount,
        ];
    }
}
