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
interface AttachmentInterface extends Arrayable
{
    /**
     * @return string
     */
    public function getFallback(): string;

    /**
     * Set the fallback text.
     *
     * @param string $fallback
     *
     * @return AttachmentInterface
     */
    public function setFallback(string $fallback): self;

    /**
     * @return string
     */
    public function getText(): string;

    /**
     * Set the optional text to appear within the attachment.
     *
     * @param string $text
     *
     * @return AttachmentInterface
     */
    public function setText(string $text): self;

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string;

    /**
     * Set the optional image to appear within the attachment.
     *
     * @param string|null $imageUrl
     *
     * @return AttachmentInterface
     */
    public function setImageUrl(?string $imageUrl): self;

    /**
     * @return string|null
     */
    public function getThumbUrl(): ?string;

    /**
     * Set the optional thumbnail to appear within the attachment.
     *
     * @param string|null $thumbUrl
     *
     * @return AttachmentInterface
     */
    public function setThumbUrl(?string $thumbUrl): self;

    /**
     * @return string|null
     */
    public function getPretext(): ?string;

    /**
     * Set the text that should appear above the formatted data.
     *
     * @param string|null $pretext
     *
     * @return AttachmentInterface
     */
    public function setPretext(?string $pretext): self;

    /**
     * @return string|null
     */
    public function getColor(): ?string;

    /**
     * Set the color to use for the attachment.
     *
     * @param string|null $color
     *
     * @return AttachmentInterface
     */
    public function setColor(?string $color): self;

    /**
     * @return string|null
     */
    public function getFooter(): ?string;

    /**
     * Set the footer text to use for the attachment.
     *
     * @param string|null $footer
     *
     * @return AttachmentInterface
     */
    public function setFooter(?string $footer): self;

    /**
     * @return string|null
     */
    public function getFooterIcon(): ?string;

    /**
     * Set the footer icon to use for the attachment.
     *
     * @param string|null $footerIcon
     *
     * @return AttachmentInterface
     */
    public function setFooterIcon(?string $footerIcon): self;

    /**
     * @return \DateTime|null
     */
    public function getTimestamp(): ?\DateTime;

    /**
     * Set the timestamp to use for the attachment.
     *
     * @param \DateTime|null $timestamp
     *
     * @return AttachmentInterface
     */
    public function setTimestamp(?\DateTime $timestamp): self;

    /**
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * Set the title to use for the attachment.
     *
     * @param string|null $title
     *
     * @return AttachmentInterface
     */
    public function setTitle(?string $title): self;

    /**
     * @return string|null
     */
    public function getTitleLink(): ?string;

    /**
     * Set the title link to use for the attachment.
     *
     * @param string|null $titleLink
     *
     * @return AttachmentInterface
     */
    public function setTitleLink(?string $titleLink): self;

    /**
     * @return string|null
     */
    public function getAuthorName(): ?string;

    /**
     * Set the author name to use for the attachment.
     *
     * @param string|null $authorName
     *
     * @return AttachmentInterface
     */
    public function setAuthorName(?string $authorName): self;

    /**
     * @return string|null
     */
    public function getAuthorLink(): ?string;

    /**
     * Set the author link to use for the attachment.
     *
     * @param string|null $authorLink
     *
     * @return AttachmentInterface
     */
    public function setAuthorLink(?string $authorLink): self;

    /**
     * @return string|null
     */
    public function getAuthorIcon(): ?string;

    /**
     * Set the author icon to use for the attachment.
     *
     * @param string|null $authorIcon
     *
     * @return AttachmentInterface
     */
    public function setAuthorIcon(?string $authorIcon): self;

    /**
     * @return AttachmentFieldInterface[]
     */
    public function getFields(): array;

    /**
     * Set the fields for the attachment.
     *
     * @param AttachmentFieldInterface[] $fields
     *
     * @return AttachmentInterface
     */
    public function setFields(array $fields): self;

    /**
     * Add a field to the attachment.
     *
     * @param AttachmentFieldInterface $field
     *
     * @return AttachmentInterface
     */
    public function addField(AttachmentFieldInterface $field): self;

    /**
     * Clear the fields for the attachment.
     *
     * @return AttachmentInterface
     */
    public function clearFields(): self;

    /**
     * @return array
     */
    public function getMarkdownFields(): array;

    /**
     * Set the fields Slack should interpret in its
     * Markdown-like language.
     *
     * @param array $fields
     *
     * @return AttachmentInterface
     */
    public function setMarkdownFields(array $fields): self;

    /**
     * @return AttachmentActionInterface[]
     */
    public function getActions(): array;

    /**
     * Set the collection of actions (buttons) to include in the attachment.
     *
     * @param AttachmentActionInterface[] $actions
     *
     * @return AttachmentInterface
     */
    public function setActions($actions): self;

    /**
     * Add an action to the attachment.
     *
     * @param AttachmentActionInterface $action
     *
     * @return AttachmentInterface
     */
    public function addAction(AttachmentActionInterface $action): self;

    /**
     * Clear the actions for the attachment.
     *
     * @return AttachmentInterface
     */
    public function clearActions();
}
