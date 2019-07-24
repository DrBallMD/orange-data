<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Response;

interface OrangeDataResponseInterface
{

    public function getStatusCode(): int;

    public function toArray(): array;

    public function isSuccessful(): bool;
}
