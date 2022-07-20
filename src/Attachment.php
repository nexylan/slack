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
     */
    private string $fallback = ' ';

    /**
     * Optional text that should appear within the attachment.
     */
    private string $text = ' ';

    /**
     * Optional image that should appear within the attachment.
     */
    private ?string $imageUrl = null;

    /**
     * Optional thumbnail that should appear within the attachment.
     */
    private ?string $thumbUrl = null;

    /**
     * Optional text that should appear above the formatted data.
     */
    private ?string $pretext = null;

    /**
     * Optional title for the attachment.
     */
    private ?string $title = null;

    /**
     * Optional title link for the attachment.
     */
    private ?string $titleLink = null;

    /**
     * Optional author name for the attachment.
     */
    private ?string $authorName = null;

    /**
     * Optional author link for the attachment.
     */
    private ?string $authorLink = null;

    /**
     * Optional author icon for the attachment.
     */
    private ?string $authorIcon = null;

    /**
     * The color to use for the attachment.
     */
    private ?string $color = 'good';

    /**
     * The text to use for the attachment footer.
     */
    private ?string $footer = null;

    /**
     * The icon to use for the attachment footer.
     */
    private ?string $footerIcon = null;

    /**
     * The timestamp to use for the attachment.
     */
    private ?\DateTime $timestamp = null;

    /**
     * The fields of the attachment.
     */
    private array $fields = [];

    /**
     * The fields of the attachment that Slack should interpret
     * with its Markdown-like language.
     */
    private array $markdownFields = [];

    /**
     * A collection of actions (buttons) to include in the attachment.
     * A maximum of 5 actions may be provided.
     */
    private array $actions = [];

    public function getFallback(): string
    {
        return $this->fallback;
    }

    /**
     * Set the fallback text.
     *
     * @return $this
     */
    public function setFallback(string $fallback): self
    {
        $this->fallback = $fallback;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set the optional text to appear within the attachment.
     *
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * Set the optional image to appear within the attachment.
     *
     * @return $this
     */
    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getThumbUrl(): ?string
    {
        return $this->thumbUrl;
    }

    /**
     * Set the optional thumbnail to appear within the attachment.
     *
     * @return $this
     */
    public function setThumbUrl(?string $thumbUrl): self
    {
        $this->thumbUrl = $thumbUrl;

        return $this;
    }

    public function getPretext(): ?string
    {
        return $this->pretext;
    }

    /**
     * Set the text that should appear above the formatted data.
     *
     * @return $this
     */
    public function setPretext(?string $pretext): self
    {
        $this->pretext = $pretext;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * Set the color to use for the attachment.
     *
     * @return $this
     */
    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getFooter(): ?string
    {
        return $this->footer;
    }

    /**
     * Set the footer text to use for the attachment.
     *
     * @return $this
     */
    public function setFooter(?string $footer): self
    {
        $this->footer = $footer;

        return $this;
    }

    public function getFooterIcon(): ?string
    {
        return $this->footerIcon;
    }

    /**
     * Set the footer icon to use for the attachment.
     *
     * @return $this
     */
    public function setFooterIcon(?string $footerIcon): self
    {
        $this->footerIcon = $footerIcon;

        return $this;
    }

    public function getTimestamp(): ?\DateTime
    {
        return $this->timestamp;
    }

    /**
     * Set the timestamp to use for the attachment.
     *
     * @return $this
     */
    public function setTimestamp(?\DateTime $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the title to use for the attachment.
     *
     * @return $this
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitleLink(): ?string
    {
        return $this->titleLink;
    }

    /**
     * Set the title link to use for the attachment.
     *
     * @return $this
     */
    public function setTitleLink(?string $titleLink): self
    {
        $this->titleLink = $titleLink;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    /**
     * Set the author name to use for the attachment.
     *
     * @return $this
     */
    public function setAuthorName(?string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function getAuthorLink(): ?string
    {
        return $this->authorLink;
    }

    /**
     * Set the author link to use for the attachment.
     *
     * @return $this
     */
    public function setAuthorLink(?string $authorLink): self
    {
        $this->authorLink = $authorLink;

        return $this;
    }

    public function getAuthorIcon(): ?string
    {
        return $this->authorIcon;
    }

    /**
     * Set the author icon to use for the attachment.
     *
     * @return $this
     */
    public function setAuthorIcon(?string $authorIcon): self
    {
        $this->authorIcon = $authorIcon;

        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Set the fields for the attachment.
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

    public function getMarkdownFields(): array
    {
        return $this->markdownFields;
    }

    /**
     * Set the fields Slack should interpret in its
     * Markdown-like language.
     *
     * @return $this
     */
    public function setMarkdownFields(array $fields): self
    {
        $this->markdownFields = $fields;

        return $this;
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * Set the collection of actions (buttons) to include in the attachment.
     *
     * @param array $actions
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
     */
    public function toArray(): array
    {
        $data = [
            'fallback'    => $this->fallback,
            'text'        => $this->text,
            'pretext'     => $this->pretext,
            'color'       => $this->color,
            'footer'      => $this->footer,
            'footer_icon' => $this->footerIcon,
            'ts'          => $this->timestamp !== null ? $this->timestamp->getTimestamp() : null,
            'mrkdwn_in'   => $this->markdownFields,
            'image_url'   => $this->imageUrl,
            'thumb_url'   => $this->thumbUrl,
            'title'       => $this->title,
            'title_link'  => $this->titleLink,
            'author_name' => $this->authorName,
            'author_link' => $this->authorLink,
            'author_icon' => $this->authorIcon,
        ];

        $data['fields']  = $this->getFieldsAsArrays();
        $data['actions'] = $this->getActionsAsArrays();

        return $data;
    }

    /**
     * Iterates over all fields in this attachment and returns
     * them in their array form.
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
