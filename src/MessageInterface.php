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

interface MessageInterface
{
    public function getText(): ?string;

    public function setText(?string $text): self;

    public function getChannel(): ?string;

    public function setChannel(?string $channel): self;

    public function getUsername(): ?string;

    public function setUsername(?string $username): self;

    public function getIcon(): ?string;

    public function setIcon(?string $icon): self;

    public function getIconType(): ?string;

    public function getAllowMarkdown(): bool;

    public function setAllowMarkdown(bool $value): self;

    public function enableMarkdown(): self;

    public function disableMarkdown(): self;

    public function getMarkdownInAttachments(): array;

    public function setMarkdownInAttachments(array $fields): self;

    public function from(string $username): self;

    public function to(string $channel): self;

    public function withIcon(string $icon): self;

    public function attach(Attachment $attachment): self;

    /** @return Attachment[] */
    public function getAttachments(): array;

    /**
     * @param Attachment[] $attachments
     */
    public function setAttachments(array $attachments): self;

    public function clearAttachments(): self;

    public function send(?string $text = null): self;
}
