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

use Nexy\Slack\Attachment;
use Nexy\Slack\Client;
use Nexy\Slack\Message;

class MessageUnitTest extends PHPUnit\Framework\TestCase
{
    public function testInstantiation(): void
    {
        $this->assertInstanceOf('Nexy\Slack\Message', $this->getMessage());
    }

    public function testSetText(): void
    {
        $message = $this->getMessage();

        $message->setText('Hello world');

        $this->assertSame('Hello world', $message->getText());
    }

    public function testSetChannelWithTo(): void
    {
        $message = $this->getMessage();

        $message->to('#php');

        $this->assertSame('#php', $message->getChannel());
    }

    public function testSetChannelWithSetter(): void
    {
        $message = $this->getMessage();

        $message->setChannel('#php');

        $this->assertSame('#php', $message->getChannel());
    }

    public function testSetUsernameWithFrom(): void
    {
        $message = $this->getMessage();

        $message->from('Archer');

        $this->assertSame('Archer', $message->getUsername());
    }

    public function testSetUsernameWithSetter(): void
    {
        $message = $this->getMessage();

        $message->setUsername('Archer');

        $this->assertSame('Archer', $message->getUsername());
    }

    public function testAttachWithObject(): void
    {
        $message = $this->getMessage();

        $obj = (new Attachment())
            ->setFallback('Fallback text for IRC')
            ->setText('Attachment text')
            ->setPretext('Attachment pretext')
            ->setColor('bad')
        ;

        $message->attach($obj);

        $attachments = $message->getAttachments();

        $this->assertSame(1, \count($attachments));

        $remoteObj = $attachments[0];

        $this->assertSame($obj, $remoteObj);
    }

    public function testMultipleAttachments(): void
    {
        $message = $this->getMessage();

        $obj1 = (new Attachment())
            ->setFallback('Fallback text for IRC')
            ->setText('Text')
        ;

        $obj2 = (new Attachment())
            ->setFallback('Fallback text for IRC')
            ->setText('Text')
        ;

        $message->attach($obj1)->attach($obj2);

        $attachments = $message->getAttachments();

        $this->assertSame(2, \count($attachments));

        $remote1 = $attachments[0];

        $remote2 = $attachments[1];

        $this->assertSame($obj1, $remote1);

        $this->assertSame($obj2, $remote2);
    }

    public function testSetAttachmentsWipesExistingAttachments(): void
    {
        $message = $this->getMessage();

        $obj1 = (new Attachment())
            ->setFallback('Fallback text for IRC')
            ->setText('Text')
        ;

        $obj2 = (new Attachment())
            ->setFallback('Fallback text for IRC')
            ->setText('Text')
        ;

        $message->attach($obj1)->attach($obj2);

        $this->assertSame(2, \count($message->getAttachments()));

        $message->setAttachments([(new Attachment())
            ->setFallback('a')
            ->setText('b'),
        ]);

        $this->assertSame(1, \count($message->getAttachments()));

        $this->assertSame('a', $message->getAttachments()[0]->getFallback());
    }

    public function testSetIconToEmoji(): void
    {
        $message = $this->getMessage();

        $message->setIcon(':ghost:');

        $this->assertSame(Message::ICON_TYPE_EMOJI, $message->getIconType());

        $this->assertSame(':ghost:', $message->getIcon());
    }

    public function testSetIconToUrl(): void
    {
        $message = $this->getMessage();

        $message->setIcon('http://www.fake.com/someimage.png');

        $this->assertSame(Message::ICON_TYPE_URL, $message->getIconType());

        $this->assertSame('http://www.fake.com/someimage.png', $message->getIcon());
    }

    protected function getMessage()
    {
        return new Message(new Client('http://fake.com', [], new \Http\Mock\Client()));
    }
}
