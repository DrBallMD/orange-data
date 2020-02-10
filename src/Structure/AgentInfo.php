<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <dm.anikeev@gmail.com>
 */

namespace OrangeData\Structure;

use JsonSerializable;

/**
 * Class AgentInfo
 * @package OrangeData\Structure
 */
class AgentInfo implements JsonSerializable
{
    /**
     * Признак агента
     */
    public const AGENT_TYPE_BANK_AGENT = 1; //Банковский платежный агент
    public const AGENT_TYPE_BANK_SUB_AGENT = 2; //Банковский платежный субагент
    public const AGENT_TYPE_PAYING_AGENT = 3; //Платежный агент
    public const AGENT_TYPE_PAYING_SUB_AGENT = 4; //Платежный субагент
    public const AGENT_TYPE_ATTORNEY = 5; //Поверенный
    public const AGENT_TYPE_COMISSIONER = 6; //Комиссионер
    public const AGENT_TYPE_OTHER = 7; //Иной агент

    /**
     * @var array|string[]
     */
    private $paymentTransferOperatorPhoneNumbers;

    /**
     * @var null|string
     */
    private $paymentAgentOperation;

    /**
     * @var array|string[]
     */
    private $paymentAgentPhoneNumbers;

    /**
     * @var array|string[]
     */
    private $paymentOperatorPhoneNumbers;

    /**
     * @var null|string
     */
    private $paymentOperatorName;

    /**
     * @var null|string
     */
    private $paymentOperatorAddress;

    /**
     * @var null|string
     */
    private $paymentOperatorINN;

    public function jsonSerialize()
    {
        return [
            'paymentTransferOperatorPhoneNumbers' => $this->paymentTransferOperatorPhoneNumbers,
            'paymentAgentOperation' => $this->paymentAgentOperation,
            'paymentAgentPhoneNumbers' => $this->paymentAgentPhoneNumbers,
            'paymentOperatorPhoneNumbers' => $this->paymentOperatorPhoneNumbers,
            'paymentOperatorName' => $this->paymentOperatorName,
            'paymentOperatorAddress' => $this->paymentOperatorAddress,
            'paymentOperatorINN' => $this->paymentOperatorINN,
        ];
    }
}
