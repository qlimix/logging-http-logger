<?php declare(strict_types=1);

namespace Qlimix\Log\Logger\Response;

use Psr\Http\Message\ResponseInterface;

interface ResponseLoggerInterface
{
    public function log(ResponseInterface $response): void;
}
