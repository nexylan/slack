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

namespace Nexy\Slack;

use Nexy\Slack\Exception\ActionProhibitedException;
use Nexy\Slack\Exception\ChannelIsArchivedException;
use Nexy\Slack\Exception\ChannelNotFoundException;
use Nexy\Slack\Exception\InvalidPayloadException;
use Nexy\Slack\Exception\RollupErrorException;
use Nexy\Slack\Exception\SlackApiException;
use Nexy\Slack\Exception\UserNotFoundException;
use Psr\Http\Message\ResponseInterface;

class ErrorResponseHandler
{
    /**
     * @see https://api.slack.com/changelog/2016-05-17-changes-to-errors-for-incoming-webhooks
     */
    private const ERROR_TO_EXCEPTION_MAPPING = [
        400 => [
            'Bad Request' => [
                'invalid_payload' => InvalidPayloadException::class,
                'user_not_found' => UserNotFoundException::class,
            ],
        ],
        403 => [
            'Forbidden' => [
                'action_prohibited' => ActionProhibitedException::class,
            ],
        ],
        404 => [
            'Not Found' => [
                'channel_not_found' => ChannelNotFoundException::class,
            ],
        ],
        410 => [
            'Gone' => [
                'channel_is_archived' => ChannelIsArchivedException::class,
            ],
        ],
        500 => [
            'Server Error' => [
                'rollup_error' => RollupErrorException::class,
            ],
        ],
    ];

    /**
     * Throw exception if there is an API error, do nothing otherwise
     *
     * @throws SlackApiException
     */
    public function handleResponse(ResponseInterface $response): void
    {
        $code = $response->getStatusCode();
        $phrase = $response->getReasonPhrase();
        $body = $response->getBody()->__toString();

        if (isset(self::ERROR_TO_EXCEPTION_MAPPING[$code][$phrase][$body])) {
            $exceptionClass = self::ERROR_TO_EXCEPTION_MAPPING[$code][$phrase][$body];
            throw new $exceptionClass($body, $code);
        }
    }
}
