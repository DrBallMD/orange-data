<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Model;

use JsonSerializable;

/**
 * Class CheckClose
 * @package OrangeData\Model
 */
class CheckClose implements JsonSerializable
{
    /**
     * @var array|Payment[]
     */
    private $payments;

    /**
     * @var int
     */
    private $taxationSystem;

    /**
     * CheckClose constructor.
     *
     * @param int $taxationSystem
     */
    public function __construct(int $taxationSystem)
    {
        $this->taxationSystem = $taxationSystem;
        $this->payments = [];
    }

    public function addPayment(Payment $payment): void
    {
        $this->payments[] = $payment;
    }

    /**
     * @return array
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    public function jsonSerialize()
    {
        return [
            'payments' => $this->payments,
            'taxationSystem' => $this->taxationSystem,
        ];
    }
}
