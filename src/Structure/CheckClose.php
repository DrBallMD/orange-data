<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Structure;

use JsonSerializable;

/**
 * Class CheckClose
 * @package OrangeData\Structure
 */
class CheckClose implements JsonSerializable
{
    /**
     * Система налогообложения
     */
    public const TAX_OSN = 0; //общая
    public const TAX_USN = 1; //упрощенная
    public const TAX_USN_MINUS = 2; //упрощенная минус расходы
    public const TAX_ENVD = 3; //енвд
    public const TAX_ESN = 4; //есн
    public const TAX_PATENT = 5; //патент

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
     * @param array $payments
     */
    public function __construct(int $taxationSystem, array $payments)
    {
        $this->taxationSystem = $taxationSystem;
        $this->payments = $payments;
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
