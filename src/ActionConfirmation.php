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
final class ActionConfirmation
{
    /**
     * The required title for the pop up window.
     *
     * @var string
     */
    private $title;

    /**
     * The required description.
     *
     * @var string
     */
    private $text;

    /**
     * The text label for the OK button.
     *
     * @var string|null
     */
    private $okText;

    /**
     * The text label for the Cancel button.
     *
     * @var string|null
     */
    private $dismissText;

    /**
     * @param string $title
     * @param string $text
     */
    public function __construct(string $title, string $text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string|null
     */
    public function getOkText(): ?string
    {
        return $this->okText;
    }

    /**
     * @param string|null $okText
     *
     * @return ActionConfirmation
     */
    public function setOkText(?string $okText): self
    {
        $this->okText = $okText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDismissText(): ?string
    {
        return $this->dismissText;
    }

    /**
     * @param string|null $dismissText
     *
     * @return ActionConfirmation
     */
    public function setDismissText(?string $dismissText): self
    {
        $this->dismissText = $dismissText;

        return $this;
    }

    /**
     * Get the array representation of this action confirmation.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'text' => $this->text,
            'ok_text' => $this->okText,
            'dismiss_text' => $this->dismissText,
        ];
    }
}
