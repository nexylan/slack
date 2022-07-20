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

use Http\Client\Exception;
use Nexy\Slack\Exception\SlackApiException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Sullivan Senechal <soullivaneuh@gmail.com>
 */
final class Client implements ClientInterface
{
    private readonly ErrorResponseHandler $errorResponseHandler;

    private readonly array $options;

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly StreamFactoryInterface $streamFactory,
        private readonly string $endpoint,
        array $options = []
    ) {
        $resolver = (new OptionsResolver())
            ->setDefaults([
                'channel'                 => null,
                'sticky_channel'          => false,
                'username'                => null,
                'icon'                    => null,
                'link_names'              => false,
                'unfurl_links'            => false,
                'unfurl_media'            => true,
                'allow_markdown'          => true,
                'markdown_in_attachments' => [],
            ])
            ->setAllowedTypes('channel', ['string', 'null'])
            ->setAllowedTypes('sticky_channel', ['bool'])
            ->setAllowedTypes('username', ['string', 'null'])
            ->setAllowedTypes('icon', ['string', 'null'])
            ->setAllowedTypes('link_names', 'bool')
            ->setAllowedTypes('unfurl_links', 'bool')
            ->setAllowedTypes('unfurl_media', 'bool')
            ->setAllowedTypes('allow_markdown', 'bool')
            ->setAllowedTypes('markdown_in_attachments', 'array')
        ;
        $this->options = $resolver->resolve($options);

        $this->errorResponseHandler = new ErrorResponseHandler();
    }

    /**
     * Pass any unhandled methods through to a new Message
     * instance.
     *
     * @param string $name      The name of the method
     * @param array  $arguments The method arguments
     *
     * @return MessageInterface
     */
    public function __call(string $name, array $arguments): MessageInterface
    {
        return \call_user_func_array([$this->createMessage(), $name], $arguments);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Create a new message with defaults.
     */
    public function createMessage(): MessageInterface
    {
        return (new Message($this))
            ->setChannel($this->options['channel'])
            ->setUsername($this->options['username'])
            ->setIcon($this->options['icon'])
            ->setAllowMarkdown($this->options['allow_markdown'])
            ->setMarkdownInAttachments($this->options['markdown_in_attachments'])
        ;
    }

    /**
     * Send a message.
     *
     *
     * @throws \RuntimeException
     * @throws SlackApiException
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function sendMessage(MessageInterface $message): void
    {
        // Ensure the message will always be sent to the default channel if asked for.
        if ($this->options['sticky_channel']) {
            $message->setChannel($this->options['channel']);
        }

        $payload = $this->preparePayload($message);

        $encoded = \json_encode($payload, \JSON_UNESCAPED_UNICODE);

        if (false === $encoded) {
            throw new \RuntimeException(\sprintf('JSON encoding error %s: %s', \json_last_error(), \json_last_error_msg()));
        }

        $response = $this->httpClient->sendRequest(
            $this->requestFactory->createRequest('POST', $this->endpoint)->withBody(
                $this->streamFactory->createStream($encoded)
            )
        );

        $this->errorResponseHandler->handleResponse($response);
    }

    /**
     * Prepares the payload to be sent to the webhook.
     *
     * @param MessageInterface $message The message to send
     */
    private function preparePayload(MessageInterface $message): array
    {
        $payload = [
            'text'         => $message->getText(),
            'channel'      => $message->getChannel(),
            'username'     => $message->getUsername(),
            'link_names'   => $this->options['link_names'] ? 1 : 0,
            'unfurl_links' => $this->options['unfurl_links'],
            'unfurl_media' => $this->options['unfurl_media'],
            'mrkdwn'       => $this->options['allow_markdown'],
        ];

        if (!empty($icon = $message->getIcon()) && !empty($iconType = $message->getIconType())) {
            $payload[$iconType] = $icon;
        }

        $payload['attachments'] = $this->getAttachmentsAsArrays($message);

        return $payload;
    }

    /**
     * Get the attachments in array form.
     */
    private function getAttachmentsAsArrays(MessageInterface $message): array
    {
        $attachments = [];

        foreach ($message->getAttachments() as $attachment) {
            $attachments[] = $attachment->toArray();
        }

        return $attachments;
    }
}
