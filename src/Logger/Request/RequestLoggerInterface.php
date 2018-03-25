<?php declare(strict_types=1);

namespace Qlimix\Log\Logger\Request;

use Psr\Http\Message\RequestInterface;

interface RequestLoggerInterface
{
    /**
     * @param RequestInterface $request
     */
    public function log(RequestInterface $request): void;
}
