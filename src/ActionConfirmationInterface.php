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
interface ActionConfirmationInterface extends Arrayable
{
    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return string
     */
    public function getText(): string;

    /**
     * @return string|null
     */
    public function getOkText(): ?string;

    /**
     * @param string|null $okText
     *
     * @return ActionConfirmationInterface
     */
    public function setOkText(?string $okText): self;

    /**
     * @return string|null
     */
    public function getDismissText(): ?string;

    /**
     * @param string|null $dismissText
     *
     * @return ActionConfirmationInterface
     */
    public function setDismissText(?string $dismissText): self;
}
