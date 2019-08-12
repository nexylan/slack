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

/**
 * @author Sullivan Senechal <soullivaneuh@gmail.com>
 */
final class Message implements MessageInterface
{
    /**
     * Reference to the Slack client responsible for sending
     * the message.
     *
     * @var ClientInterface
     */
    private $client;

    /**
     * The text to send with the message.
     *
     * @var string|null
     */
    private $text;

    /**
     * The channel the message should be sent to.
     *
     * @var string|null
     */
    private $channel;

    /**
     * The username the message should be sent as.
     *
     * @var string|null
     */
    private $username;

    /**
     * The URL to the icon to use.
     *
     * @var string|null
     */
    private $icon;

    /**
     * The type of icon we are using.
     *
     * @var string|null
     */
    private $iconType;

    /**
     * Whether the message text should be interpreted in Slack's
     * Markdown-like language.
     *
     * @var bool
     */
    private $allowMarkdown = true;

    /**
     * The attachment fields which should be formatted with
     * Slack's Markdown-like language.
     *
     * @var AttachmentFieldInterface[]
     */
    private $markdownInAttachments = [];

    /**
     * An array of attachments to send.
     *
     * @var AttachmentInterface[]
     */
    private $attachments = [];

    /**
     * @var string
     */
    const ICON_TYPE_URL = 'icon_url';

    /**
     * @var string
     */
    const ICON_TYPE_EMOJI = 'icon_emoji';

    /**
     * Instantiate a new Message.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Set the message text.
     *
     * @param string|null $text
     *
     * @return MessageInterface
     */
    public function setText(?string $text): MessageInterface
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChannel(): ?string
    {
        return $this->channel;
    }

    /**
     * Set the channel we will post to.
     *
     * @param string|null $channel
     *
     * @return MessageInterface
     */
    public function setChannel(?string $channel): MessageInterface
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the username we will post as.
     *
     * @param string|null $username
     *
     * @return MessageInterface
     */
    public function setUsername(?string $username): MessageInterface
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * Set the icon (either URL or emoji) we will post as.
     *
     * @param string|null $icon
     *
     * @return MessageInterface
     */
    public function setIcon(?string $icon): MessageInterface
    {
        if (null === $icon) {
            $this->icon = $this->iconType = null;

            return $this;
        }

        if (':' === \mb_substr($icon, 0, 1) && ':' === \mb_substr($icon, \mb_strlen($icon) - 1, 1)) {
            $this->iconType = self::ICON_TYPE_EMOJI;
        } else {
            $this->iconType = self::ICON_TYPE_URL;
        }

        $this->icon = $icon;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIconType(): ?string
    {
        return $this->iconType;
    }

    /**
     * @return bool
     */
    public function getAllowMarkdown(): bool
    {
        return $this->allowMarkdown;
    }

    /**
     * Set whether message text should be formatted with
     * Slack's Markdown-like language.
     *
     * @param bool $value
     *
     * @return MessageInterface
     */
    public function setAllowMarkdown(bool $value): MessageInterface
    {
        $this->allowMarkdown = $value;

        return $this;
    }

    public function enableMarkdown(): MessageInterface
    {
        return $this->setAllowMarkdown(true);
    }

    public function disableMarkdown(): MessageInterface
    {
        return $this->setAllowMarkdown(false);
    }

    /**
     * @return AttachmentFieldInterface[]
     */
    public function getMarkdownInAttachments(): array
    {
        return $this->markdownInAttachments;
    }

    /**
     * Set the attachment fields which should be formatted
     * in Slack's Markdown-like language.
     *
     * @param AttachmentFieldInterface[] $fields
     *
     * @return MessageInterface
     */
    public function setMarkdownInAttachments(array $fields): MessageInterface
    {
        $this->markdownInAttachments = $fields;

        return $this;
    }

    /**
     * Change the name of the user the post will be made as.
     *
     * @param string $username
     *
     * @return MessageInterface
     */
    public function from(string $username): MessageInterface
    {
        return $this->setUsername($username);
    }

    /**
     * Change the channel the post will be made to.
     *
     * @param string $channel
     *
     * @return MessageInterface
     */
    public function to(string $channel): MessageInterface
    {
        return $this->setChannel($channel);
    }

    /**
     * Chainable method for setting the icon.
     *
     * @param string $icon
     *
     * @return MessageInterface
     */
    public function withIcon(string $icon): MessageInterface
    {
        return $this->setIcon($icon);
    }

    /**
     * Add an attachment to the message.
     *
     * @param AttachmentInterface $attachment
     *
     * @return MessageInterface
     */
    public function attach(AttachmentInterface $attachment): MessageInterface
    {
        $this->attachments[] = $attachment;

        return $this;
    }

    /**
     * @return AttachmentInterface[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * Set the attachments for the message.
     *
     * @param AttachmentInterface[] $attachments
     *
     * @return MessageInterface
     */
    public function setAttachments(array $attachments): MessageInterface
    {
        $this->clearAttachments();

        foreach ($attachments as $attachment) {
            $this->attach($attachment);
        }

        return $this;
    }

    /**
     * Remove all attachments for the message.
     *
     * @return MessageInterface
     */
    public function clearAttachments(): MessageInterface
    {
        $this->attachments = [];

        return $this;
    }

    /**
     * Send the message.
     *
     * @param string|null $text The text to send
     *
     * @return MessageInterface
     */
    public function send(?string $text = null): MessageInterface
    {
        if ($text) {
            $this->setText($text);
        }

        $this->client->sendMessage($this);

        return $this;
    }
}
