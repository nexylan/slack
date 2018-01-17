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
    /**
     * The required title field of the field.
     *
     * @var string
     */
    private $title;

    /**
     * The required value of the field.
     *
     * @var string
     */
    private $value;

    /**
     * Whether the value is short enough to fit side by side with
     * other values.
     *
     * @var bool
     */
    private $short;

    /**
     * @param string $title
     * @param string $value
     * @param bool   $short
     */
    public function __construct(string $title, string $value, bool $short = false)
    {
        $this->title = $title;
        $this->value = $value;
        $this->short = $short;
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
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isShort(): bool
    {
        return $this->short;
    }

    /**
     * Get the array representation of this attachment field.
     *
     * @return array
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
