<?php

declare(strict_types=1);

namespace Nexy\Slack;

interface MessageInterface
{
    public function getText(): ?string;
    public function setText(?string $text): MessageInterface;
    public function getChannel(): ?string;
    public function setChannel(?string $channel): MessageInterface;
    public function getUsername(): ?string;
    public function setUsername(?string $username): MessageInterface;
    public function getIcon(): ?string;
    public function setIcon(?string $icon): MessageInterface;
    public function getIconType(): ?string;
    public function getAllowMarkdown(): bool;
    public function setAllowMarkdown(bool $value): MessageInterface;
    public function enableMarkdown(): MessageInterface;
    public function disableMarkdown(): MessageInterface;
    public function getMarkdownInAttachments(): array;
    public function setMarkdownInAttachments(array $fields): MessageInterface;
    public function from(string $username): MessageInterface;
    public function to(string $channel): MessageInterface;
    public function withIcon(string $icon): MessageInterface;
    public function attach(Attachment $attachment): MessageInterface;
    /** @return Attachment[] */
    public function getAttachments(): array;
    /**
     * @param Attachment[] $attachments
     * @return MessageInterface
     */
    public function setAttachments(array $attachments): MessageInterface;
    public function clearAttachments(): MessageInterface;
    public function send(?string $text = null): MessageInterface;
}
