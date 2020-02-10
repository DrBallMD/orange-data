<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Model;

use JsonSerializable;
use function htmlspecialchars;
use function substr;

/**
 * Class Position
 * @package OrangeData\Model
 */
class Position implements JsonSerializable
{
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
    private $tax;

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
     *
     * @param string $text
     * @param float $quantity
     * @param float $price
     * @param int $tax
     * @param int $paymentMethodType
     * @param int $paymentSubjectType
     */
    public function __construct(string $text, float $quantity, float $price, int $tax, int $paymentMethodType, int $paymentSubjectType)
    {
        $this->text = htmlspecialchars(substr($text, 0, 128));
        $this->quantity = $quantity;
        $this->price = $price;
        $this->tax = $tax;
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
            'text' => $this->text,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'tax' => $this->tax,
            'paymentMethodType' => $this->paymentMethodType,
            'paymentSubjectType' => $this->paymentSubjectType,
            'agentType' => $this->agentType,
            'agentInfo' => $this->agentInfo,
            'supplierINN' => $this->supplierINN,
            'supplierInfo' => $this->supplierInfo,
        ];
    }
}
