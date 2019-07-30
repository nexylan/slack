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

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderAppendPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\Exception;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Nexy\Slack\Exception\SlackErrorException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Sullivan Senechal <soullivaneuh@gmail.com>
 */
final class Client
{
    const SLACK_POST_MESSAGE_URL = 'https://slack.com/api/chat.postMessage';

    /**
     * @var array
     */
    private $options;

    /**
     * @var HttpMethodsClient
     */
    private $httpClient;

    private $optionsResolver;

    /**
     * Instantiate a new Client.
     *
     * @param string          $endpoint
     * @param array           $options
     * @param HttpClient|null $httpClient
     */
    public function __construct(string $endpoint = self::SLACK_POST_MESSAGE_URL, array $options = [], HttpClient $httpClient = null)
    {
        $this->optionsResolver = (new OptionsResolver())
            ->setDefaults([
                'channel' => null,
                'sticky_channel' => false,
                'username' => null,
                'icon' => null,
                'link_names' => false,
                'unfurl_links' => false,
                'unfurl_media' => true,
                'allow_markdown' => true,
                'markdown_in_attachments' => [],
                'oauth_token' => null
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
            ->setAllowedTypes('oauth_token', ['string', 'null'])
        ;

        $this->setOptions($options, $endpoint, $httpClient);
    }

    public function setEndpoint($endpoint, HttpClient $httpClient = null): self
    {
        $plugins = [
            new BaseUriPlugin(
                UriFactoryDiscovery::find()->createUri($endpoint)
            ),
        ];

        if ($this->options['oauth_token']) {
            $plugins[] = new HeaderAppendPlugin([
                'Authorization' => 'Bearer ' . $this->options['oauth_token'],
                'Content-Type' => 'application/json'
            ]);
        }

        $this->httpClient = new HttpMethodsClient(
            new PluginClient(
                $httpClient ?: HttpClientDiscovery::find(),
                $plugins
            ),
            MessageFactoryDiscovery::find()
        );
        return $this;
    }

    public function setOptions(array $options, string $endpoint = self::SLACK_POST_MESSAGE_URL, HttpClient $httpClient = null): self
    {
        $this->options = $this->optionsResolver->resolve($options);
        $this->setEndpoint($endpoint, $httpClient);
        return $this;
    }

    /**
     * Pass any unhandled methods through to a new Message
     * instance.
     *
     * @param string $name      The name of the method
     * @param array  $arguments The method arguments
     *
     * @return \Nexy\Slack\Message
     */
    public function __call(string $name, array $arguments): Message
    {
        return \call_user_func_array([$this->createMessage(), $name], $arguments);
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Create a new message with defaults.
     *
     * @return \Nexy\Slack\Message
     */
    public function createMessage(): Message
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
     * @param \Nexy\Slack\Message $message
     *
     * @throws Exception
     */
    public function sendMessage(Message $message): void
    {
        // Ensure the message will always be sent to the default channel if asked for.
        if ($this->options['sticky_channel']) {
            $message->setChannel($this->options['channel']);
        }

        $payload = $this->preparePayload($message);

        $encoded = \json_encode($payload, JSON_UNESCAPED_UNICODE);

        if (false === $encoded) {
            throw new \RuntimeException(\sprintf('JSON encoding error %s: %s', \json_last_error(), \json_last_error_msg()));
        }

        $response = $this->httpClient->post('', [], $encoded);

        if ($this->isErrorResponse($response)) {
            throw new SlackErrorException($response);
        }
    }

    protected function isErrorResponse(ResponseInterface $response)
    {
        $data = json_decode($response->getBody()->getContents(), true);
        $response->getBody()->rewind();

        return $response->getStatusCode() !== 200 || !$data['ok'];
    }

    /**
     * Prepares the payload to be sent to the webhook.
     *
     * @param \Nexy\Slack\Message $message The message to send
     *
     * @return array
     */
    private function preparePayload(Message $message): array
    {
        $payload = [
            'text' => $message->getText(),
            'channel' => $message->getChannel(),
            'username' => $message->getUsername(),
            'link_names' => $this->options['link_names'] ? 1 : 0,
            'unfurl_links' => $this->options['unfurl_links'],
            'unfurl_media' => $this->options['unfurl_media'],
            'mrkdwn' => $this->options['allow_markdown'],
        ];

        if ($icon = $message->getIcon()) {
            $payload[$message->getIconType()] = $icon;
        }

        $payload['attachments'] = $this->getAttachmentsAsArrays($message);
        $payload['blocks'] = $this->getBlocksAsArrays($message);

        return $payload;
    }

    /**
     * Get the attachments in array form.
     *
     * @param \Nexy\Slack\Message $message
     *
     * @return array
     */
    private function getAttachmentsAsArrays(Message $message): array
    {
        $attachments = [];

        foreach ($message->getAttachments() as $attachment) {
            $attachments[] = $attachment->toArray();
        }

        return $attachments;
    }

    /**
     * Get the attachments in array form.
     *
     * @param \Nexy\Slack\Message $message
     *
     * @return array
     */
    private function getBlocksAsArrays(Message $message): array
    {
        $blocks = [];

        foreach ($message->getBlocks() as $block) {
            $blocks[] = $block->toArray();
        }

        return $blocks;
    }
}
