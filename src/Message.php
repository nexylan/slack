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

use InvalidArgumentException;

class Message
{
    /**
     * Reference to the Slack client responsible for sending
     * the message.
     *
     * @var \Nexy\Slack\Client
     */
    private $client;

    /**
     * The text to send with the message.
     *
     * @var string
     */
    private $text;

    /**
     * The channel the message should be sent to.
     *
     * @var string
     */
    private $channel;

    /**
     * The username the message should be sent as.
     *
     * @var string
     */
    private $username;

    /**
     * The URL to the icon to use.
     *
     * @var string
     */
    private $icon;

    /**
     * The type of icon we are using.
     *
     * @var enum
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
     * @var array
     */
    private $markdownInAttachments = [];

    /**
     * An array of attachments to send.
     *
     * @var array
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
     * @param \Nexy\Slack\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get the message text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the message text.
     *
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the channel we will post to.
     *
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set the channel we will post to.
     *
     * @param string $channel
     *
     * @return $this
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get the username we will post as.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the username we will post as.
     *
     * @param string $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the icon (either URL or emoji) we will post as.
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the icon (either URL or emoji) we will post as.
     *
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon($icon)
    {
        if (null === $icon) {
            $this->icon = $this->iconType = null;

            return;
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
     * Get the icon type being used, if an icon is set.
     *
     * @return string
     */
    public function getIconType()
    {
        return $this->iconType;
    }

    /**
     * Get whether message text should be formatted with
     * Slack's Markdown-like language.
     *
     * @return bool
     */
    public function getAllowMarkdown()
    {
        return $this->allowMarkdown;
    }

    /**
     * Set whether message text should be formatted with
     * Slack's Markdown-like language.
     *
     * @param bool $value
     */
    public function setAllowMarkdown($value)
    {
        $this->allowMarkdown = (bool) $value;

        return $this;
    }

    /**
     * Enable Markdown formatting for the message.
     */
    public function enableMarkdown()
    {
        $this->setAllowMarkdown(true);

        return $this;
    }

    /**
     * Disable Markdown formatting for the message.
     */
    public function disableMarkdown()
    {
        $this->setAllowMarkdown(false);

        return $this;
    }

    /**
     * Get the attachment fields which should be formatted
     * in Slack's Markdown-like language.
     *
     * @return array
     */
    public function getMarkdownInAttachments()
    {
        return $this->markdownInAttachments;
    }

    /**
     * Set the attachment fields which should be formatted
     * in Slack's Markdown-like language.
     *
     * @param array $fields
     */
    public function setMarkdownInAttachments(array $fields)
    {
        $this->markdownInAttachments = $fields;

        return $this;
    }

    /**
     * Change the name of the user the post will be made as.
     *
     * @param string $username
     *
     * @return $this
     */
    public function from($username)
    {
        $this->setUsername($username);

        return $this;
    }

    /**
     * Change the channel the post will be made to.
     *
     * @param string $channel
     *
     * @return $this
     */
    public function to($channel)
    {
        $this->setChannel($channel);

        return $this;
    }

    /**
     * Chainable method for setting the icon.
     *
     * @param string $icon
     *
     * @return $this
     */
    public function withIcon($icon)
    {
        $this->setIcon($icon);

        return $this;
    }

    /**
     * Add an attachment to the message.
     *
     * @param mixed $attachment
     *
     * @return $this
     */
    public function attach($attachment)
    {
        if ($attachment instanceof Attachment) {
            $this->attachments[] = $attachment;

            return $this;
        } elseif (\is_array($attachment)) {
            $attachmentObject = new Attachment($attachment);

            if (!isset($attachment['mrkdwn_in'])) {
                $attachmentObject->setMarkdownFields($this->getMarkdownInAttachments());
            }

            $this->attachments[] = $attachmentObject;

            return $this;
        }

        throw new InvalidArgumentException('Attachment must be an instance of Maknz\\Slack\\Attachment or a keyed array');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Set the attachments for the message.
     *
     * @param array $attachments
     *
     * @return $this
     */
    public function setAttachments(array $attachments)
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
     * @return $this
     */
    public function clearAttachments()
    {
        $this->attachments = [];

        return $this;
    }

    /**
     * Send the message.
     *
     * @param string $text The text to send
     */
    public function send($text = null)
    {
        if ($text) {
            $this->setText($text);
        }

        $this->client->sendMessage($this);

        return $this;
    }
}
