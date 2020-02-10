<?php

declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Response;

interface OrangeDataResponseInterface
{
    public function statusCode(): int;

    public function asArray(): array;

    public function isSuccessful(): bool;
}
