<?php declare(strict_types=1);

namespace Qlimix\Tests\Log\Logger\Response;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Qlimix\Log\Handler\LogHandlerInterface;
use Qlimix\Log\Logger\Response\PSRResponseLogger;

final class PSRResponseLoggerTest extends TestCase
{
    private MockObject $logger;
    private MockObject $response;
    private PSRResponseLogger $responseLogger;

    protected function setUp(): void
    {
        $this->logger = $this->createMock(LogHandlerInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->responseLogger = new PSRResponseLogger($this->logger);
    }

    public function testShouldLog(): void
    {
        $this->logger->expects($this->once())
            ->method('log');

        $stream = $this->createMock(StreamInterface::class);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('body');

        $this->response->expects($this->once())
            ->method('getHeaders');

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $this->response->expects($this->exactly(2))
            ->method('getStatusCode')
            ->willReturn(200);

        $this->responseLogger->log($this->response);
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

        $this->response->expects($this->once())
            ->method('getHeaders');

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $this->response->expects($this->exactly(2))
            ->method('getStatusCode')
            ->willReturn(200);

        $this->responseLogger->log($this->response);
    }
}
