<?php declare(strict_types=1);

namespace Qlimix\Log\Logger\Request;

use Psr\Http\Message\ServerRequestInterface;
use Qlimix\Log\Handler\Channel;
use Qlimix\Log\Handler\Level;
use Qlimix\Log\Handler\LogHandlerInterface;
use Throwable;

final class PSRRequestLogger implements RequestLoggerInterface
{
    private LogHandlerInterface $logHandler;

    public function __construct(LogHandlerInterface $logHandler)
    {
        $this->logHandler = $logHandler;
    }

    /**
     * @inheritDoc
     * @SuppressWarnings(PHPMD.EmptyCatchBlock)
     */
    public function log(ServerRequestInterface $request): void
    {
        try {
            $context = [
                'headers' => $request->getHeaders(),
                'body' => $request->getBody()->getContents(),
                'method' => $request->getMethod(),
                'uri' => $request->getUri(),
                'type' => 'request',
                'target' => $request->getRequestTarget(),
                'attributes' => $request->getAttributes(),
            ];

            $message = 'Request : '.$request->getMethod().' '.$request->getUri();

            $this->logHandler->log(new Channel('http'), Level::createInfo(), $message, $context);
        } catch (Throwable $exception) {
        }
    }
}
