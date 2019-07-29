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
final class DividerBlock extends Block
{
    public function __construct()
    {
        parent::__construct('divider');
    }
}
