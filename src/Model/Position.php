<?php declare(strict_types=1);
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
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'text' => $this->text,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'tax' => $this->tax,
            'paymentMethodType' => $this->paymentMethodType,
            'paymentSubjectType' => $this->paymentSubjectType,
        ];
    }
}
