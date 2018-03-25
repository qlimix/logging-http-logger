<?php declare(strict_types=1);

namespace Qlimix\Log\Logger\Response;

use Psr\Http\Message\ResponseInterface;
use Qlimix\Log\Handler\Channel;
use Qlimix\Log\Handler\Level;
use Qlimix\Log\Handler\LogHandlerInterface;

final class PSRResponseLogger implements ResponseLoggerInterface
{
    /** @var LogHandlerInterface */
    private $logHandler;

    /**
     * @param LogHandlerInterface $logHandler
     */
    public function __construct(LogHandlerInterface $logHandler)
    {
        $this->logHandler = $logHandler;
    }

    /**
     * @inheritDoc
     */
    public function log(ResponseInterface $response): void
    {
        try {
            $context = [
                'headers' => $response->getHeaders(),
                'body' => $response->getBody()->getContents(),
                'statusCode' => $response->getStatusCode(),
                'type' => 'response',
            ];

            $message = 'Response : '.$response->getStatusCode();

            $this->logHandler->log(new Channel('http'), Level::createInfo(), $message, $context);
        } catch (\Throwable $exception) {
        }
    }
}
