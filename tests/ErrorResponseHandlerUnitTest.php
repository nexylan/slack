<?php

declare(strict_types=1);

/*
 * This file is part of the Nexylan packages.
 *
 * (c) Nexylan SAS <contact@nexylan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Nexy\Slack\ErrorResponseHandler;
use Nexy\Slack\Exception\ActionProhibitedException;
use Nexy\Slack\Exception\ChannelIsArchivedException;
use Nexy\Slack\Exception\ChannelNotFoundException;
use Nexy\Slack\Exception\InvalidPayloadException;
use Nexy\Slack\Exception\RollupErrorException;
use Nexy\Slack\Exception\UserNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ErrorResponseHandlerUnitTest extends PHPUnit\Framework\TestCase
{
    private function getResponseMock(int $code, string $phrase, string $body): ResponseInterface
    {
        $responseMock = Mockery::mock(ResponseInterface::class);

        $responseMock->shouldReceive('getStatusCode')
            ->once()
            ->andReturn($code);

        $responseMock->shouldReceive('getReasonPhrase')
            ->once()
            ->andReturn($phrase);

        $streamMock = Mockery::mock(StreamInterface::class);
        $streamMock->shouldReceive('__toString')
            ->once()
            ->andReturn($body);

        $responseMock->shouldReceive('getBody')
            ->once()
            ->andReturn($streamMock);

        return $responseMock;
    }

    public function testInstantiation(): ErrorResponseHandler
    {
        $handler = new ErrorResponseHandler();

        $this->assertInstanceOf('Nexy\Slack\ErrorResponseHandler', $handler);

        return $handler;
    }

    /**
     * @depends testInstantiation
     */
    public function testDoesNotThrowWithGoodResponse(ErrorResponseHandler $handler): void
    {
        $this->expectNotToPerformAssertions();

        $responseMock = $this->getResponseMock(200, 'OK', '');

        $handler->handleResponse($responseMock);
    }

    /**
     * @depends testInstantiation
     */
    public function testThrowsInvalidPayloadException(ErrorResponseHandler $handler): void
    {
        $this->expectException(InvalidPayloadException::class);

        $responseMock = $this->getResponseMock(400, 'Bad Request', 'invalid_payload');

        $handler->handleResponse($responseMock);
    }

    /**
     * @depends testInstantiation
     */
    public function testThrowsUserNotFoundException(ErrorResponseHandler $handler): void
    {
        $this->expectException(UserNotFoundException::class);

        $responseMock = $this->getResponseMock(400, 'Bad Request', 'user_not_found');

        $handler->handleResponse($responseMock);
    }

    /**
     * @depends testInstantiation
     */
    public function testThrowsActionProhibitedException(ErrorResponseHandler $handler): void
    {
        $this->expectException(ActionProhibitedException::class);

        $responseMock = $this->getResponseMock(403, 'Forbidden', 'action_prohibited');

        $handler->handleResponse($responseMock);
    }

    /**
     * @depends testInstantiation
     */
    public function testThrowsChannelNotFoundException(ErrorResponseHandler $handler): void
    {
        $this->expectException(ChannelNotFoundException::class);

        $responseMock = $this->getResponseMock(404, 'Not Found', 'channel_not_found');

        $handler->handleResponse($responseMock);
    }

    /**
     * @depends testInstantiation
     */
    public function testThrowsChannelIsArchivedException(ErrorResponseHandler $handler): void
    {
        $this->expectException(ChannelIsArchivedException::class);

        $responseMock = $this->getResponseMock(410, 'Gone', 'channel_is_archived');

        $handler->handleResponse($responseMock);
    }

    /**
     * @depends testInstantiation
     */
    public function testThrowsRollupErrorException(ErrorResponseHandler $handler): void
    {
        $this->expectException(RollupErrorException::class);

        $responseMock = $this->getResponseMock(500, 'Server Error', 'rollup_error');

        $handler->handleResponse($responseMock);
    }
}
