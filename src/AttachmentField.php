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
final class AttachmentField
{
    public function __construct(
        /**
         * The required title field of the field.
         */
        private readonly string $title,
        /**
         * The required value of the field.
         */
        private readonly string $value,
        /**
         * Whether the value is short enough to fit side by side with
         * other values.
         */
        private readonly bool $short = false
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isShort(): bool
    {
        return $this->short;
    }

    /**
     * Get the array representation of this attachment field.
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'value' => $this->value,
            'short' => $this->short,
        ];
    }
}
