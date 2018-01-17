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
     * Confirmation field.
     *
     * @var ActionConfirmation|null
     */
    private $confirm;

    /**
     * @param string $name
     * @param string $text
     */
    public function __construct(string $name, string $text)
    {
        $this->name = $name;
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * @param string $style
     *
     * @return AttachmentAction
     */
    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return AttachmentAction
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return AttachmentAction
     */
    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return ActionConfirmation|null
     */
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
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'text' => $this->text,
            'style' => $this->style,
            'type' => $this->type,
            'value' => $this->value,
            'confirm' => $this->confirm ? $this->confirm->toArray() : null,
        ];
    }
}
