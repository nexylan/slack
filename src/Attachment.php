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
final class Attachment implements AttachmentInterface
{
    /**
     * The fallback text to use for clients that don't support attachments.
     *
     * @var string
     */
    private $fallback = ' ';

    /**
     * Optional text that should appear within the attachment.
     *
     * @var string
     */
    private $text = ' ';

    /**
     * Optional image that should appear within the attachment.
     *
     * @var string|null
     */
    private $imageUrl;

    /**
     * Optional thumbnail that should appear within the attachment.
     *
     * @var string|null
     */
    private $thumbUrl;

    /**
     * Optional text that should appear above the formatted data.
     *
     * @var string|null
     */
    private $pretext;

    /**
     * Optional title for the attachment.
     *
     * @var string|null
     */
    private $title;

    /**
     * Optional title link for the attachment.
     *
     * @var string|null
     */
    private $titleLink;

    /**
     * Optional author name for the attachment.
     *
     * @var string|null
     */
    private $authorName;

    /**
     * Optional author link for the attachment.
     *
     * @var string|null
     */
    private $authorLink;

    /**
     * Optional author icon for the attachment.
     *
     * @var string|null
     */
    private $authorIcon;

    /**
     * The color to use for the attachment.
     *
     * @var string|null
     */
    private $color = 'good';

    /**
     * The text to use for the attachment footer.
     *
     * @var string|null
     */
    private $footer;

    /**
     * The icon to use for the attachment footer.
     *
     * @var string|null
     */
    private $footerIcon;

    /**
     * The timestamp to use for the attachment.
     *
     * @var \DateTime|null
     */
    private $timestamp;

    /**
     * The fields of the attachment.
     *
     * @var AttachmentFieldInterface[]
     */
    private $fields = [];

    /**
     * The fields of the attachment that Slack should interpret
     * with its Markdown-like language.
     *
     * @var array
     */
    private $markdownFields = [];

    /**
     * A collection of actions (buttons) to include in the attachment.
     * A maximum of 5 actions may be provided.
     *
     * @var AttachmentActionInterface[]
     */
    private $actions = [];

    /**
     * @return string
     */
    public function getFallback(): string
    {
        return $this->fallback;
    }

    /**
     * Set the fallback text.
     *
     * @param string $fallback
     *
     * @return AttachmentInterface
     */
    public function setFallback(string $fallback): AttachmentInterface
    {
        $this->fallback = $fallback;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set the optional text to appear within the attachment.
     *
     * @param string $text
     *
     * @return AttachmentInterface
     */
    public function setText(string $text): AttachmentInterface
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * Set the optional image to appear within the attachment.
     *
     * @param string|null $imageUrl
     *
     * @return AttachmentInterface
     */
    public function setImageUrl(?string $imageUrl): AttachmentInterface
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getThumbUrl(): ?string
    {
        return $this->thumbUrl;
    }

    /**
     * Set the optional thumbnail to appear within the attachment.
     *
     * @param string|null $thumbUrl
     *
     * @return $this
     */
    public function setThumbUrl(?string $thumbUrl): AttachmentInterface
    {
        $this->thumbUrl = $thumbUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPretext(): ?string
    {
        return $this->pretext;
    }

    /**
     * Set the text that should appear above the formatted data.
     *
     * @param string|null $pretext
     *
     * @return AttachmentInterface
     */
    public function setPretext(?string $pretext): AttachmentInterface
    {
        $this->pretext = $pretext;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * Set the color to use for the attachment.
     *
     * @param string|null $color
     *
     * @return AttachmentInterface
     */
    public function setColor(?string $color): AttachmentInterface
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFooter(): ?string
    {
        return $this->footer;
    }

    /**
     * Set the footer text to use for the attachment.
     *
     * @param string|null $footer
     *
     * @return AttachmentInterface
     */
    public function setFooter(?string $footer): AttachmentInterface
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFooterIcon(): ?string
    {
        return $this->footerIcon;
    }

    /**
     * Set the footer icon to use for the attachment.
     *
     * @param string|null $footerIcon
     *
     * @return AttachmentInterface
     */
    public function setFooterIcon(?string $footerIcon): AttachmentInterface
    {
        $this->footerIcon = $footerIcon;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getTimestamp(): ?\DateTime
    {
        return $this->timestamp;
    }

    /**
     * Set the timestamp to use for the attachment.
     *
     * @param \DateTime|null $timestamp
     *
     * @return AttachmentInterface
     */
    public function setTimestamp(?\DateTime $timestamp): AttachmentInterface
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the title to use for the attachment.
     *
     * @param string|null $title
     *
     * @return AttachmentInterface
     */
    public function setTitle(?string $title): AttachmentInterface
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitleLink(): ?string
    {
        return $this->titleLink;
    }

    /**
     * Set the title link to use for the attachment.
     *
     * @param string|null $titleLink
     *
     * @return AttachmentInterface
     */
    public function setTitleLink(?string $titleLink): AttachmentInterface
    {
        $this->titleLink = $titleLink;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    /**
     * Set the author name to use for the attachment.
     *
     * @param string|null $authorName
     *
     * @return AttachmentInterface
     */
    public function setAuthorName(?string $authorName): AttachmentInterface
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthorLink(): ?string
    {
        return $this->authorLink;
    }

    /**
     * Set the author link to use for the attachment.
     *
     * @param string|null $authorLink
     *
     * @return AttachmentInterface
     */
    public function setAuthorLink(?string $authorLink): AttachmentInterface
    {
        $this->authorLink = $authorLink;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthorIcon(): ?string
    {
        return $this->authorIcon;
    }

    /**
     * Set the author icon to use for the attachment.
     *
     * @param string|null $authorIcon
     *
     * @return AttachmentInterface
     */
    public function setAuthorIcon(?string $authorIcon): AttachmentInterface
    {
        $this->authorIcon = $authorIcon;

        return $this;
    }

    /**
     * @return AttachmentFieldInterface[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Set the fields for the attachment.
     *
     * @param AttachmentFieldInterface[] $fields
     *
     * @return AttachmentInterface
     */
    public function setFields(array $fields): AttachmentInterface
    {
        $this->clearFields();

        foreach ($fields as $field) {
            $this->addField($field);
        }

        return $this;
    }

    /**
     * Add a field to the attachment.
     *
     * @param AttachmentFieldInterface $field
     *
     * @return AttachmentInterface
     */
    public function addField(AttachmentFieldInterface $field): AttachmentInterface
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * Clear the fields for the attachment.
     *
     * @return AttachmentInterface
     */
    public function clearFields(): AttachmentInterface
    {
        $this->fields = [];

        return $this;
    }

    /**
     * @return array
     */
    public function getMarkdownFields(): array
    {
        return $this->markdownFields;
    }

    /**
     * Set the fields Slack should interpret in its
     * Markdown-like language.
     *
     * @param array $fields
     *
     * @return AttachmentInterface
     */
    public function setMarkdownFields(array $fields): AttachmentInterface
    {
        $this->markdownFields = $fields;

        return $this;
    }

    /**
     * @return AttachmentActionInterface[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * Set the collection of actions (buttons) to include in the attachment.
     *
     * @param array $actions
     *
     * @return AttachmentInterface
     */
    public function setActions($actions): AttachmentInterface
    {
        $this->clearActions();

        foreach ($actions as $action) {
            $this->addAction($action);
        }

        return $this;
    }

    /**
     * Add an action to the attachment.
     *
     * @param AttachmentActionInterface $action
     *
     * @return AttachmentInterface
     */
    public function addAction(AttachmentActionInterface $action): AttachmentInterface
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * Clear the actions for the attachment.
     *
     * @return AttachmentInterface
     */
    public function clearActions(): AttachmentInterface
    {
        $this->actions = [];

        return $this;
    }

    /**
     * Convert this attachment to its array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'fallback' => $this->fallback,
            'text' => $this->text,
            'pretext' => $this->pretext,
            'color' => $this->color,
            'footer' => $this->footer,
            'footer_icon' => $this->footerIcon,
            'ts' => $this->timestamp ? $this->timestamp->getTimestamp() : null,
            'mrkdwn_in' => $this->markdownFields,
            'image_url' => $this->imageUrl,
            'thumb_url' => $this->thumbUrl,
            'title' => $this->title,
            'title_link' => $this->titleLink,
            'author_name' => $this->authorName,
            'author_link' => $this->authorLink,
            'author_icon' => $this->authorIcon,
        ];

        $data['fields'] = $this->getFieldsAsArrays();
        $data['actions'] = $this->getActionsAsArrays();

        return $data;
    }

    /**
     * Iterates over all fields in this attachment and returns
     * them in their array form.
     *
     * @return array
     */
    private function getFieldsAsArrays(): array
    {
        $fields = [];

        foreach ($this->fields as $field) {
            $fields[] = $field->toArray();
        }

        return $fields;
    }

    /**
     * Iterates over all actions in this attachment and returns
     * them in their array form.
     *
     * @return array
     */
    private function getActionsAsArrays(): array
    {
        $actions = [];

        foreach ($this->actions as $action) {
            $actions[] = $action->toArray();
        }

        return $actions;
    }
}
