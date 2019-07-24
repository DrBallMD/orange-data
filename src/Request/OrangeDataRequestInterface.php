<?php declare(strict_types=1);
/**
 * @author Anikeev Dmitry <anikeev.dmitry@outlook.com>
 */

namespace OrangeData\Request;

use OrangeData\Response\OrangeDataResponseInterface;

interface OrangeDataRequestInterface
{

    public function request($method, $uri, array $options = []): OrangeDataResponseInterface;
}
