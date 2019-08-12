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
interface MessageInterface
{
    /**
     * @return string|null
     */
    public function getText(): ?string;

    /**
     * Set the message text.
     *
     * @param string|null $text
     *
     * @return MessageInterface
     */
    public function setText(?string $text): self;

    /**
     * @return string|null
     */
    public function getChannel(): ?string;

    /**
     * Set the channel we will post to.
     *
     * @param string|null $channel
     *
     * @return MessageInterface
     */
    public function setChannel(?string $channel): self;

    /**
     * @return string|null
     */
    public function getUsername(): ?string;

    /**
     * Set the username we will post as.
     *
     * @param string|null $username
     *
     * @return MessageInterface
     */
    public function setUsername(?string $username): self;

    /**
     * @return string|null
     */
    public function getIcon(): ?string;

    /**
     * Set the icon (either URL or emoji) we will post as.
     *
     * @param string|null $icon
     *
     * @return MessageInterface
     */
    public function setIcon(?string $icon): self;

    /**
     * @return string|null
     */
    public function getIconType(): ?string;

    /**
     * @return bool
     */
    public function getAllowMarkdown(): bool;

    /**
     * Set whether message text should be formatted with
     * Slack's Markdown-like language.
     *
     * @param bool $value
     *
     * @return MessageInterface
     */
    public function setAllowMarkdown(bool $value): self;

    /**
     * Indicate that the message text should be formatted
     * with Slack's Markdown-like language.
     *
     * @return MessageInterface
     */
    public function enableMarkdown(): self;

    /**
     * Indicate that the message text should not be formatted
     * with Slack's Markdown-like language.
     *
     * @return MessageInterface
     */
    public function disableMarkdown(): self;

    /**
     * @return AttachmentFieldInterface[]
     */
    public function getMarkdownInAttachments(): array;

    /**
     * Set the attachment fields which should be formatted
     * in Slack's Markdown-like language.
     *
     * @param AttachmentFieldInterface[] $fields
     *
     * @return MessageInterface
     */
    public function setMarkdownInAttachments(array $fields): self;

    /**
     * Change the name of the user the post will be made as.
     *
     * @param string $username
     *
     * @return MessageInterface
     */
    public function from(string $username): self;

    /**
     * Change the channel the post will be made to.
     *
     * @param string $channel
     *
     * @return MessageInterface
     */
    public function to(string $channel): self;

    /**
     * Chainable method for setting the icon.
     *
     * @param string $icon
     *
     * @return MessageInterface
     */
    public function withIcon(string $icon): self;

    /**
     * Add an attachment to the message.
     *
     * @param AttachmentInterface $attachment
     *
     * @return MessageInterface
     */
    public function attach(AttachmentInterface $attachment): self;

    /**
     * @return AttachmentInterface[]
     */
    public function getAttachments(): array;

    /**
     * Set the attachments for the message.
     *
     * @param AttachmentInterface[] $attachments
     *
     * @return MessageInterface
     */
    public function setAttachments(array $attachments): self;

    /**
     * Remove all attachments for the message.
     *
     * @return MessageInterface
     */
    public function clearAttachments(): self;

    /**
     * Send the message.
     *
     * @param string|null $text The text to send
     *
     * @return MessageInterface
     */
    public function send(?string $text = null): self;
}
