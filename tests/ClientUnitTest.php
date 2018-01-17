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

use Nexy\Slack\Client;

class ClientUnitTest extends PHPUnit\Framework\TestCase
{
    public function testInstantiationWithNoDefaults(): void
    {
        $client = new Client('http://fake.endpoint', [], new \Http\Mock\Client());

        $this->assertInstanceOf('Nexy\Slack\Client', $client);
    }

    public function testInstantiationWithDefaults(): void
    {
        $defaults = [
            'channel' => '#random',
            'username' => 'Archer',
            'icon' => ':ghost:',
            'link_names' => true,
            'unfurl_links' => true,
            'unfurl_media' => false,
            'allow_markdown' => false,
            'markdown_in_attachments' => ['text'],
        ];

        $client = new Client('http://fake.endpoint', $defaults, new \Http\Mock\Client());

        $this->assertAttributeSame($defaults, 'options', $client);
    }

    public function testCreateMessage(): void
    {
        $defaults = [
            'channel' => '#random',
            'username' => 'Archer',
            'icon' => ':ghost:',
            'link_names' => false,
            'unfurl_links' => false,
            'unfurl_media' => true,
            'allow_markdown' => true,
            'markdown_in_attachments' => [],
        ];

        $client = new Client('http://fake.endpoint', $defaults, new \Http\Mock\Client());

        $message = $client->createMessage();

        $this->assertInstanceOf('Nexy\Slack\Message', $message);

        $this->assertAttributeSame($defaults, 'options', $client);
    }

    public function testWildcardCallToMessage(): void
    {
        $client = new Client('http://fake.endpoint', [], new \Http\Mock\Client());

        $message = $client->to('@regan');

        $this->assertInstanceOf('Nexy\Slack\Message', $message);

        $this->assertSame('@regan', $message->getChannel());
    }
}
