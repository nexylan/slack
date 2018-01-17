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
final class Attachment
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
     * @var array
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
     * @var array
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
     * @return $this
     */
    public function setFallback(string $fallback): self
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
     * @return $this
     */
    public function setText(string $text): self
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
     * @return $this
     */
    public function setImageUrl(?string $imageUrl): self
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
    public function setThumbUrl(?string $thumbUrl): self
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
     * @return $this
     */
    public function setPretext(?string $pretext): self
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
     * @return $this
     */
    public function setColor(?string $color): self
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
     * @return $this
     */
    public function setFooter(?string $footer): self
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
     * @return $this
     */
    public function setFooterIcon(?string $footerIcon): self
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
     * @return $this
     */
    public function setTimestamp(?\DateTime $timestamp): self
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
     * @return $this
     */
    public function setTitle(?string $title): self
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
     * @return $this
     */
    public function setTitleLink(?string $titleLink): self
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
     * @return $this
     */
    public function setAuthorName(?string $authorName): self
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
     * @return $this
     */
    public function setAuthorLink(?string $authorLink): self
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
     * @return $this
     */
    public function setAuthorIcon(?string $authorIcon): self
    {
        $this->authorIcon = $authorIcon;

        return $this;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Set the fields for the attachment.
     *
     * @param array $fields
     *
     * @return $this
     */
    public function setFields(array $fields): self
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
     * @param AttachmentField $field
     *
     * @return $this
     */
    public function addField(AttachmentField $field): self
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * Clear the fields for the attachment.
     *
     * @return $this
     */
    public function clearFields(): self
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
     * @return $this
     */
    public function setMarkdownFields(array $fields): self
    {
        $this->markdownFields = $fields;

        return $this;
    }

    /**
     * @return array
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
     * @return Attachment
     */
    public function setActions($actions): self
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
     * @param AttachmentAction $action
     *
     * @return $this
     */
    public function addAction(AttachmentAction $action): self
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * Clear the actions for the attachment.
     *
     * @return $this
     */
    public function clearActions(): self
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
