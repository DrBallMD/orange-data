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
            'paymentTransferOperatorPhoneNumbers' => $this->paymentOperatorPhoneNumbers,
            'paymentAgentOperation' => $this->paymentAgentOperation,
            'paymentAgentPhoneNumbers' => $this->paymentAgentPhoneNumbers,
            'paymentOperatorPhoneNumbers' => $this->paymentOperatorPhoneNumbers,
            'paymentOperatorName' => $this->paymentOperatorName,
            'paymentOperatorAddress' => $this->paymentOperatorAddress,
            'paymentOperatorINN' => $this->paymentOperatorINN,
        ];
    }
}
