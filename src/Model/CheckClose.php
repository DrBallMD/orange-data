<?php declare(strict_types=1);
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
     * @var array
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

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'payments' => $this->payments,
            'taxationSystem' => $this->taxationSystem,
        ];
    }
}
