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
final class AttachmentAction
{
    const TYPE_BUTTON = 'button';

    const STYLE_DEFAULT = 'default';
    const STYLE_PRIMARY = 'primary';
    const STYLE_DANGER = 'danger';

    /**
     * The required name field of the action. The name will be returned to your Action URL.
     *
     * @var string
     */
    private $name;

    /**
     * The required label for the action.
     *
     * @var string
     */
    private $text;

    /**
     * Button style.
     *
     * @var string
     */
    private $style = self::STYLE_DEFAULT;

    /**
     * The required type of the action.
     *
     * @var string
     */
    private $type = self::TYPE_BUTTON;

    /**
     * Optional value. It will be sent to your Action URL.
     *
     * @var string|null
     */
    private $value;

    /**
     * Optional value. It can be used to create link buttons.
     *
     * @var string|null
     */
    private $url;

    /**
     * Confirmation field.
     *
     * @var ActionConfirmation|null
     */
    private $confirm;

    public function __construct(string $name, string $text)
    {
        $this->name = $name;
        $this->text = $text;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * @return AttachmentAction
     */
    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return AttachmentAction
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @return AttachmentAction
     */
    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return AttachmentAction
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getConfirm(): ?ActionConfirmation
    {
        return $this->confirm;
    }

    /**
     * @param ActionConfirmation $confirm
     *
     * @return AttachmentAction
     */
    public function setConfirm(?ActionConfirmation $confirm): self
    {
        $this->confirm = $confirm;

        return $this;
    }

    /**
     * Get the array representation of this attachment action.
     */
    public function toArray(): array
    {
        $array = [
            'text' => $this->text,
            'style' => $this->style,
            'type' => $this->type,
        ];

        // Link buttons do not require "name", "value" and "confirm" attributes.
        // @see https://api.slack.com/docs/message-attachments#link_buttons
        if (null !== $this->url) {
            $array['url'] = $this->url;
        } else {
            $array['name'] = $this->name;
            $array['value'] = $this->value;
            $array['confirm'] = $this->confirm ? $this->confirm->toArray() : null;
        }

        return $array;
    }
}
