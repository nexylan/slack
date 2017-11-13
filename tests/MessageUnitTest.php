<?php

use Nexy\Slack\Attachment;
use Nexy\Slack\Message;

class MessageUnitTest extends PHPUnit\Framework\TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf('Nexy\Slack\Message', $this->getMessage());
    }

    public function testSetText()
    {
        $message = $this->getMessage();

        $message->setText('Hello world');

        $this->assertSame('Hello world', $message->getText());
    }

    public function testSetChannelWithTo()
    {
        $message = $this->getMessage();

        $message->to('#php');

        $this->assertSame('#php', $message->getChannel());
    }

    public function testSetChannelWithSetter()
    {
        $message = $this->getMessage();

        $message->setChannel('#php');

        $this->assertSame('#php', $message->getChannel());
    }

    public function testSetUsernameWithFrom()
    {
        $message = $this->getMessage();

        $message->from('Archer');

        $this->assertSame('Archer', $message->getUsername());
    }

    public function testSetUsernameWithSetter()
    {
        $message = $this->getMessage();

        $message->setUsername('Archer');

        $this->assertSame('Archer', $message->getUsername());
    }

    public function testAttachWithArray()
    {
        $message = $this->getMessage();

        $attachmentArray = [
            'fallback' => 'Fallback text for IRC',
            'text' => 'Attachment text',
            'pretext' => 'Attachment pretext',
            'color' => 'bad',
            'fields' => [],
        ];

        $message->attach($attachmentArray);

        $attachments = $message->getAttachments();

        $this->assertSame(1, \count($attachments));

        $obj = $attachments[0];

        $this->assertSame($attachmentArray['fallback'], $obj->getFallback());

        $this->assertSame($attachmentArray['text'], $obj->getText());

        $this->assertSame($attachmentArray['pretext'], $obj->getPretext());

        $this->assertSame($attachmentArray['color'], $obj->getColor());
    }

    public function testAttachWithObject()
    {
        $message = $this->getMessage();

        $obj = new Attachment([
            'fallback' => 'Fallback text for IRC',
            'text' => 'Text',
        ]);

        $message->attach($obj);

        $attachments = $message->getAttachments();

        $this->assertSame(1, \count($attachments));

        $remoteObj = $attachments[0];

        $this->assertSame($obj, $remoteObj);
    }

    public function testMultipleAttachments()
    {
        $message = $this->getMessage();

        $obj1 = new Attachment([
            'fallback' => 'Fallback text for IRC',
            'text' => 'Text',
        ]);

        $obj2 = new Attachment([
            'fallback' => 'Fallback text for IRC',
            'text' => 'Text',
        ]);

        $message->attach($obj1)->attach($obj2);

        $attachments = $message->getAttachments();

        $this->assertSame(2, \count($attachments));

        $remote1 = $attachments[0];

        $remote2 = $attachments[1];

        $this->assertSame($obj1, $remote1);

        $this->assertSame($obj2, $remote2);
    }

    public function testSetAttachmentsWipesExistingAttachments()
    {
        $message = $this->getMessage();

        $obj1 = new Attachment([
            'fallback' => 'Fallback text for IRC',
            'text' => 'Text',
        ]);

        $obj2 = new Attachment([
            'fallback' => 'Fallback text for IRC',
            'text' => 'Text',
        ]);

        $message->attach($obj1)->attach($obj2);

        $this->assertSame(2, \count($message->getAttachments()));

        $message->setAttachments([['fallback' => 'a', 'text' => 'b']]);

        $this->assertSame(1, \count($message->getAttachments()));

        $this->assertSame('a', $message->getAttachments()[0]->getFallback());
    }

    public function testSetIconToEmoji()
    {
        $message = $this->getMessage();

        $message->setIcon(':ghost:');

        $this->assertSame(Message::ICON_TYPE_EMOJI, $message->getIconType());

        $this->assertSame(':ghost:', $message->getIcon());
    }

    public function testSetIconToUrl()
    {
        $message = $this->getMessage();

        $message->setIcon('http://www.fake.com/someimage.png');

        $this->assertSame(Message::ICON_TYPE_URL, $message->getIconType());

        $this->assertSame('http://www.fake.com/someimage.png', $message->getIcon());
    }

    protected function getMessage()
    {
        return new Message(Mockery::mock('Nexy\Slack\Client'));
    }
}
