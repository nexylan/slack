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
 * @author Mikey McLellan <mikey@mclellan.org.nz>
 */
final class ButtonBlock extends SectionBlock
{
    const STYLE_PRIMARY = 'primary';
    const STYLE_DANGER = 'danger';

    /** @var string */
    private $url;

    /** @var string */
    private $value;

    /** @var string */
    private $actionId;

    /** @var string */
    private $style;

    public function __construct()
    {
        parent::__construct('button');
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param string $actionId
     */
    public function setActionId(string $actionId): self
    {
        $this->actionId = $actionId;

        return $this;
    }

    /**
     * @return string
     */
    public function getActionId(): string
    {
        return $this->actionId;
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
     */
    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function setMarkdown(string $string): SectionBlock
    {
        throw new \InvalidArgumentException('ButtonBlock must use plain_text');
    }

    /**
     * Convert this block to its array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'url' => $this->url,
            'value' => $this->value,
            'action_id' => $this->actionId,
            'style' => $this->style
        ];

        return array_merge(parent::toArray(), $this->removeNulls($data));
    }
}
