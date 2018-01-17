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
use Http\Client\Common\PluginClient;
use Http\Client\Exception;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Sullivan Senechal <soullivaneuh@gmail.com>
 */
final class Client
{
    /**
     * @var array
     */
    private $options;

    /**
     * @var HttpMethodsClient
     */
    private $httpClient;

    /**
     * Instantiate a new Client.
     *
     * @param string          $endpoint
     * @param array           $options
     * @param HttpClient|null $httpClient
     */
    public function __construct(string $endpoint, array $options = [], HttpClient $httpClient = null)
    {
        $resolver = (new OptionsResolver())
            ->setDefaults([
                'channel' => null,
                'username' => null,
                'icon' => null,
                'link_names' => false,
                'unfurl_links' => false,
                'unfurl_media' => true,
                'allow_markdown' => true,
                'markdown_in_attachments' => [],
            ])
            ->setAllowedTypes('channel', ['string', 'null'])
            ->setAllowedTypes('username', ['string', 'null'])
            ->setAllowedTypes('icon', ['string', 'null'])
            ->setAllowedTypes('link_names', 'bool')
            ->setAllowedTypes('unfurl_links', 'bool')
            ->setAllowedTypes('unfurl_media', 'bool')
            ->setAllowedTypes('allow_markdown', 'bool')
            ->setAllowedTypes('markdown_in_attachments', 'array')
        ;
        $this->options = $resolver->resolve($options);

        $this->httpClient = new HttpMethodsClient(
            new PluginClient(
                $httpClient ?: HttpClientDiscovery::find(),
                [
                    new BaseUriPlugin(
                        UriFactoryDiscovery::find()->createUri($endpoint)
                    ),
                ]
            ),
            MessageFactoryDiscovery::find()
        );
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
        $payload = $this->preparePayload($message);

        $encoded = \json_encode($payload, JSON_UNESCAPED_UNICODE);

        if (false === $encoded) {
            throw new \RuntimeException(\sprintf('JSON encoding error %s: %s', \json_last_error(), \json_last_error_msg()));
        }

        $this->httpClient->post('', [], $encoded);
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
}
