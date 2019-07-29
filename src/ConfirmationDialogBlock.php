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
final class ConfirmationDialogBlock extends Block
{
    /**
     * @var TextBlock
     */
    protected $title;

    /**
     * @var TextBlock
     */
    protected $text;

    /**
     * @var TextBlock
     */
    protected $confirm;

    /**
     * @var TextBlock
     */
    protected $deny;

    public function __construct()
    {
        parent::__construct(null);
    }

    /**
     * @param TextBlock $text
     */
    public function setText(TextBlock $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return TextBlock
     */
    public function getText(): TextBlock
    {
        return $this->text;
    }

    /**
     * @param TextBlock $confirm
     */
    public function setConfirm(TextBlock $confirm): self
    {
        $this->confirm = $confirm;

        return $this;
    }

    /**
     * @return TextBlock
     */
    public function getConfirm(): TextBlock
    {
        return $this->confirm;
    }

    /**
     * @param TextBlock $deny
     */
    public function setDeny(TextBlock $deny): self
    {
        $this->deny = $deny;

        return $this;
    }

    /**
     * @return TextBlock
     */
    public function getDeny(): TextBlock
    {
        return $this->deny;
    }

    /**
     * @param TextBlock $title
     */
    public function setTitle(TextBlock $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return TextBlock
     */
    public function getTitle(): TextBlock
    {
        return $this->title;
    }

    /**
     * Convert this block to its array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'title' => $this->title->toArray(),
            'text' => $this->text->toArray(),
            'confirm' => $this->confirm->toArray(),
            'deny' => $this->deny->toArray(),
        ];

        return array_merge(parent::toArray(), $this->removeNulls($data));
    }
}
