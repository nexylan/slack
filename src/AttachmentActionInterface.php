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
interface AttachmentActionInterface extends Arrayable
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getText(): string;

    /**
     * @return string
     */
    public function getStyle(): string;

    /**
     * @param string $style
     *
     * @return AttachmentActionInterface
     */
    public function setStyle(string $style): self;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     *
     * @return AttachmentActionInterface
     */
    public function setType(string $type): self;

    /**
     * @return string|null
     */
    public function getValue(): ?string;

    /**
     * @param string|null $value
     *
     * @return AttachmentActionInterface
     */
    public function setValue(?string $value): self;

    /**
     * @return string|null
     */
    public function getUrl(): ?string;

    /**
     * @param string|null $url
     *
     * @return AttachmentActionInterface
     */
    public function setUrl(?string $url): self;

    /**
     * @return ActionConfirmationInterface|null
     */
    public function getConfirm(): ?ActionConfirmationInterface;

    /**
     * @param ActionConfirmationInterface|null $confirm
     *
     * @return AttachmentActionInterface
     */
    public function setConfirm(?ActionConfirmationInterface $confirm): self;
}
