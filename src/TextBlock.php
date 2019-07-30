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
class TextBlock extends Block
{
    const PLAIN_TEXT = 'plain_text';
    const MARKDOWN = 'mrkdwn';

    /**
     * @var string
     */
    protected $text;

    /** @var boolean */
    protected $emoji = false;

    /** @var bool */
    protected $verbatim = false;

    public function __construct($type = self::MARKDOWN)
    {
        parent::__construct($type);
    }

    /**
     * @param string $text
     */
    public function setText(string $text): self
    {
        $this->text = $text;

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
     * Convert this block to its array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'text' => $this->text,
            'type' => $this->type];

        if ($this->type === self::MARKDOWN) {
            $data['verbatim'] = $this->verbatim;
        }
        if ($this->type === self::PLAIN_TEXT) {
            $data['emoji'] = $this->emoji;
        }
        return $data;
    }
}
