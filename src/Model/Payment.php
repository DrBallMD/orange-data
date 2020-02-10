<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Model;

use JsonSerializable;

/**
 * Class Payment
 * @package OrangeData\Model
 */
class Payment implements JsonSerializable
{
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
