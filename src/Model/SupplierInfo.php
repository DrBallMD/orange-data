<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <dm.anikeev@gmail.com>
 */

namespace OrangeData\Model;

use JsonSerializable;

class SupplierInfo implements JsonSerializable
{

    /**
     * @var null|string[]
     */
    private $phoneNumbers;

    /**
     * @var null|string
     */
    private $name;

    public function jsonSerialize()
    {
        return [
            'phoneNumbers' => $this->phoneNumbers,
            'name' => $this->name,
        ];
    }
}