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
class AttachmentField
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
    private $short = false;

    /**
     * Instantiate a new AttachmentField.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        if (isset($attributes['title'])) {
            $this->setTitle($attributes['title']);
        }

        if (isset($attributes['value'])) {
            $this->setValue($attributes['value']);
        }

        if (isset($attributes['short'])) {
            $this->setShort($attributes['short']);
        }
    }

    /**
     * Get the title of the field.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the title of the field.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of the field.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of the field.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get whether this field is short enough for displaying
     * side-by-side with other fields.
     *
     * @return bool
     */
    public function getShort()
    {
        return $this->short;
    }

    /**
     * Set whether this field is short enough for displaying
     * side-by-side with other fields.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setShort($value)
    {
        $this->short = (bool) $value;

        return $this;
    }

    /**
     * Get the array representation of this attachment field.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'title' => $this->getTitle(),
            'value' => $this->getValue(),
            'short' => $this->getShort(),
        ];
    }
}
