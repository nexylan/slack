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

use Zakirullin\Mess\MessInterface;

interface ClientInterface
{
    public function createMessage(): MessageInterface;

    public function sendMessage(MessageInterface $message): MessInterface;
}
