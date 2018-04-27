<?php declare(strict_types=1);

namespace Qlimix\Log\Logger\Request;

use Psr\Http\Message\ServerRequestInterface;

interface RequestLoggerInterface
{
    /**
     * @param ServerRequestInterface $request
     */
    public function log(ServerRequestInterface $request): void;
}
