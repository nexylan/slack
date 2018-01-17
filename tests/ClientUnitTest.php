<?php

declare(strict_types=1);
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

        $this->assertSame($defaults['channel'], $client->getDefaultChannel());

        $this->assertSame($defaults['username'], $client->getDefaultUsername());

        $this->assertSame($defaults['icon'], $client->getDefaultIcon());

        $this->assertTrue($client->getLinkNames());

        $this->assertTrue($client->getUnfurlLinks());

        $this->assertFalse($client->getUnfurlMedia());

        $this->assertSame($defaults['allow_markdown'], $client->getAllowMarkdown());

        $this->assertSame($defaults['markdown_in_attachments'], $client->getMarkdownInAttachments());
    }

    public function testCreateMessage(): void
    {
        $defaults = [
            'channel' => '#random',
            'username' => 'Archer',
            'icon' => ':ghost:',
        ];

        $client = new Client('http://fake.endpoint', $defaults, new \Http\Mock\Client());

        $message = $client->createMessage();

        $this->assertInstanceOf('Nexy\Slack\Message', $message);

        $this->assertSame($client->getDefaultChannel(), $message->getChannel());

        $this->assertSame($client->getDefaultUsername(), $message->getUsername());

        $this->assertSame($client->getDefaultIcon(), $message->getIcon());
    }

    public function testWildcardCallToMessage(): void
    {
        $client = new Client('http://fake.endpoint', [], new \Http\Mock\Client());

        $message = $client->to('@regan');

        $this->assertInstanceOf('Nexy\Slack\Message', $message);

        $this->assertSame('@regan', $message->getChannel());
    }
}
