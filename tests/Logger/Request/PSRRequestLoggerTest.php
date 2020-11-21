<?php declare(strict_types=1);

namespace Qlimix\Tests\Log\Logger\Request;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Qlimix\Log\Handler\LogHandlerInterface;
use Qlimix\Log\Logger\Request\PSRRequestLogger;

final class PSRRequestLoggerTest extends TestCase
{
    private MockObject $logger;
    private MockObject $request;
    private PSRRequestLogger $requestLogger;

    protected function setUp(): void
    {
        $this->logger = $this->createMock(LogHandlerInterface::class);
        $this->request = $this->createMock(ServerRequestInterface::class);
        $this->requestLogger = new PSRRequestLogger($this->logger);
    }

    public function testShouldLog(): void
    {
        $this->logger->expects($this->once())
            ->method('log');

        $stream = $this->createMock(StreamInterface::class);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('body');

        $this->request->expects($this->once())
            ->method('getHeaders');

        $this->request->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $this->request->expects($this->exactly(2))
            ->method('getMethod');

        $this->request->expects($this->exactly(2))
            ->method('getUri');

        $this->request->expects($this->once())
            ->method('getRequestTarget');

        $this->request->expects($this->once())
            ->method('getAttributes');

        $this->requestLogger->log($this->request);
    }

    public function testShouldNotThrowOnLogException(): void
    {
        $this->logger->expects($this->once())
            ->method('log')
            ->willThrowException(new Exception());

        $stream = $this->createMock(StreamInterface::class);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('body');

        $this->request->expects($this->once())
            ->method('getHeaders');

        $this->request->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $this->request->expects($this->exactly(2))
            ->method('getMethod');

        $this->request->expects($this->exactly(2))
            ->method('getUri');

        $this->request->expects($this->once())
            ->method('getRequestTarget');

        $this->request->expects($this->once())
            ->method('getAttributes');

        $this->requestLogger->log($this->request);
    }
}
