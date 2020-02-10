<?php

declare(strict_types=1);
/**
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Structure;

use JsonSerializable;

/**
 * Class Order
 * @package OrangeData\Structure
 */
class Order implements JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $inn;

    /**
     * @var Content
     */
    private $content;

    /**
     * @var string|null
     */
    private $group;

    /**
     * @var string
     */
    private $key;

    /**
     * @var null|string
     */
    private $callbackUrl;

    /**
     * Order constructor.
     * @param string $id
     * @param string $inn
     * @param string $key
     * @param Content $content
     * @param string|null $group
     * @param string|null $callbackUrl
     */
    public function __construct(
        string $id,
        string $inn,
        string $key,
        Content $content,
        string $group = null,
        string $callbackUrl = null
    ) {
        $this->id = $id;
        $this->inn = $inn;
        $this->group = $group;
        $this->key = $key;
        $this->content = $content;
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * @return string
     */
    public function getId(): string
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

    public function getGroup(): ?string
    {
        return $this->group;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'inn' => $this->inn,
            'key' => $this->key,
            'group' => $this->group,
            'content' => $this->content,
            'callbackUrl' => $this->callbackUrl,
        ];
    }
}
