<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Structure;

use JsonSerializable;

/**
 * Class Content
 * @package OrangeData\Structure
 */
class Content implements JsonSerializable
{
    /**
     * Признак расчета
     */
    public const TYPE_IN = 1; //приход
    public const TYPE_IN_RETURN = 2; //возврат прихода
    public const TYPE_OUT = 3; //Расход
    public const TYPE_OUT_RETURN = 4; //Возврат расхода

    /**
     * @var int
     */
    private $type;

    /**
     * @var string
     */
    private $customerContact;

    /**
     * @var array|Position[]
     */
    private $positions;

    /**
     * @var CheckClose
     */
    private $checkClose;

    /**
     * Content constructor.
     * @param int $type
     * @param string $customerContact
     * @param array $positions
     * @param CheckClose $checkClose
     */
    public function __construct(int $type, string $customerContact, array $positions, CheckClose $checkClose)
    {
        $this->type = $type;
        $this->customerContact = $customerContact;
        $this->positions = $positions;
        $this->checkClose = $checkClose;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCustomerContact(): string
    {
        return $this->customerContact;
    }

    /**
     * @return CheckClose
     */
    public function getCheckClose(): CheckClose
    {
        return $this->checkClose;
    }

    public function getPositions(): array
    {
        return $this->positions;
    }

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
