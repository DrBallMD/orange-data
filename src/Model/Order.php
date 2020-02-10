<?php

declare(strict_types=1);
/**
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Model;

use Exception;
use JsonSerializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Order
 * @package OrangeData\Model
 */
class Order implements JsonSerializable
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $inn;

    /**
     * @var string
     */
    private $group;

    /**
     * @var null|string
     */
    private $callbackUrl;

    /**
     * @var Content
     */
    private $content;

    /**
     * Order constructor.
     *
     * @param string $inn
     * @param string $group
     * @param int $type
     * @param string $customerContact
     * @param int $taxationSystem
     *
     * @throws Exception
     */
    public function __construct(
        string $inn,
        string $group,
        int $type,
        string $customerContact,
        int $taxationSystem
    ) {
        $this->id = Uuid::uuid4();
        $this->inn = $inn;
        $this->group = $group;
        $this->content = new Content($type, $customerContact, $taxationSystem);
    }

    public function __clone()
    {
        $this->id = Uuid::uuid4();
    }

    public function setType(int $type): Order
    {
        $this->content->setType($type);

        return $this;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->inn;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * @return null|string
     */
    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    /**
     * @param null|string $callbackUrl
     *
     * @return Order
     */
    public function setCallbackUrl(string $callbackUrl = null): Order
    {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    public function addPosition(Position $position): Order
    {
        $this->content->addPosition($position);

        return $this;
    }

    public function addPayment(Payment $payment): Order
    {
        $this->content->addPayment($payment);

        return $this;
    }

    public function getPayments(): array
    {
        return $this->content->getPayments();
    }

    public function getPositions(): array
    {
        return $this->content->getPositions();
    }

    public function jsonSerialize()
    {
        return [
            'id' => (string)$this->id,
            'inn' => $this->inn,
            'key' => $this->inn,
            'group' => $this->group,
            'content' => $this->content,
            'callbackUrl' => $this->callbackUrl,
        ];
    }
}
