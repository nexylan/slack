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
final class DatePickerBlock extends Block
{
    /**
     * @var string
     */
    private $actionId;

    /**
     * @var string
     */
    private $initialDate;

    /**
     * @var TextBlock
     */
    private $placeholder;

    /**
     * @var ConfirmationDialogBlock
     */
    private $confirm;

    public function __construct()
    {
        parent::__construct('datepicker');
    }

    /**
     * @param string $actionId
     */
    public function setActionId(string $actionId): ButtonBlock
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
     * @param string $initialDate
     */
    public function setInitialDate(string $initialDate): self
    {
        $this->initialDate = $initialDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getInitialDate(): string
    {
        return $this->initialDate;
    }

    /**
     * @param ConfirmationDialogBlock $confirm
     */
    public function setConfirm(ConfirmationDialogBlock $confirm): self
    {
        $this->confirm = $confirm;

        return $this;
    }

    /**
     * @return ConfirmationDialogBlock
     */
    public function getConfirm(): ConfirmationDialogBlock
    {
        return $this->confirm;
    }

    /**
     * @return array
     */
    public function getPlaceholder(): TextBlock
    {
        return $this->placeholder;
    }

    /**
     * @param array $placeholder
     */
    public function setPlaceholder(TextBlock $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Convert this block to its array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'image_url' => $this->imageUrl,
            'alt_text' => $this->altText
        ];

        return array_merge(parent::toArray(), $this->removeNulls($data));
    }
}
