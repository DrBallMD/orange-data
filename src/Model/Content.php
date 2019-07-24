<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Model;

use JsonSerializable;

/**
 * Class Content
 * @package OrangeData\Model
 */
class Content implements JsonSerializable
{

    /**
     * @var int
     */
    private $type;

    /**
     * @var string
     */
    private $customerContact;

    /**
     * @var array
     */
    private $positions;

    /**
     * @var CheckClose
     */
    private $checkClose;

    /**
     * Content constructor.
     *
     * @param int $type
     * @param string $customerContact
     * @param int $taxationSystem
     */
    public function __construct(int $type, string $customerContact, int $taxationSystem)
    {
        $this->type = $type;
        $this->customerContact = $customerContact;
        $this->positions = [];
        $this->checkClose = new CheckClose($taxationSystem);
    }


    public function addPosition(Position $position): void
    {
        $this->positions[] = $position;
    }

    public function addPayment(Payment $payment): void
    {
        $this->checkClose->addPayment($payment);
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function getPositions(): array
    {
        return $this->positions;
    }

    public function getPayments(): array
    {
        return $this->checkClose->getPayments();
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
            'type' => $this->type,
            'customerContact' => $this->customerContact,
            'positions' => $this->positions,
            'checkClose' => $this->checkClose,
        ];
    }
}
