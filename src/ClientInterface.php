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
interface ClientInterface
{
    /**
     * Pass any unhandled methods through to a new Message
     * instance.
     *
     * @param string $name      The name of the method
     * @param array  $arguments The method arguments
     *
     * @return MessageInterface
     */
    public function __call(string $name, array $arguments): MessageInterface;

    /**
     * @return array
     */
    public function getOptions(): array;

    /**
     * Create a new message with defaults.
     *
     * @return MessageInterface
     */
    public function createMessage(): MessageInterface;

    /**
     * Send a message.
     *
     * @param MessageInterface $message
     */
    public function sendMessage(MessageInterface $message): void;
}
