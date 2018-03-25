<?php declare(strict_types=1);

namespace Qlimix\Log\Logger\Request;

use Psr\Http\Message\RequestInterface;
use Qlimix\Log\Handler\Channel;
use Qlimix\Log\Handler\Level;
use Qlimix\Log\Handler\LogHandlerInterface;

final class PSRRequestLogger implements RequestLoggerInterface
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
    public function log(RequestInterface $request): void
    {
        try {
            $context = [
                'headers' => $request->getHeaders(),
                'body' => $request->getBody()->getContents(),
                'method' => $request->getMethod(),
                'uri' => $request->getUri(),
                'type' => 'request',
                'target' => $request->getRequestTarget()
            ];

            $message = 'Request : '.$request->getMethod(). ' '.$request->getUri();

            $this->logHandler->log(new Channel('http'), Level::createInfo(), $message, $context);
        } catch (\Throwable $exception) {
        }
    }
}
