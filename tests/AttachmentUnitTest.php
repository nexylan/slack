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

use Nexy\Slack\ActionConfirmation;
use Nexy\Slack\Attachment;
use Nexy\Slack\AttachmentAction;
use Nexy\Slack\AttachmentField;

class AttachmentUnitTest extends PHPUnit\Framework\TestCase
{
    public function testAttachmentCreationFromArray(): void
    {
        $now = new DateTime();

        $a = (new Attachment())
            ->setFallback('Fallback')
            ->setText('Text')
            ->setPretext('Pretext')
            ->setColor('bad')
            ->setFooter('Footer')
            ->setFooterIcon('https://platform.slack-edge.com/img/default_application_icon.png')
            ->setTimestamp($now)
            ->setMarkdownFields(['pretext', 'text', 'fields'])
        ;

        $this->assertSame('Fallback', $a->getFallback());

        $this->assertSame('Text', $a->getText());

        $this->assertSame('Pretext', $a->getPretext());

        $this->assertSame('bad', $a->getColor());

        $this->assertSame([], $a->getFields());

        $this->assertSame(['pretext', 'text', 'fields'], $a->getMarkdownFields());

        $this->assertSame('Footer', $a->getFooter());

        $this->assertSame('https://platform.slack-edge.com/img/default_application_icon.png', $a->getFooterIcon());

        $this->assertSame($now, $a->getTimestamp());
    }

    public function testAttachmentCreationFromArrayWithFields(): void
    {
        $a = (new Attachment())
            ->setFallback('Fallback')
            ->setText('Text')
            ->setFields([
                new AttachmentField('Title 1', 'Value 1'),
                new AttachmentField('Title 2', 'Value 1'),
            ])
        ;

        $fields = $a->getFields();

        $this->assertSame('Title 1', $fields[0]->getTitle());

        $this->assertSame('Title 2', $fields[1]->getTitle());
    }

    public function testAttachmentToArray(): void
    {
        $now = new DateTime();

        $a = (new Attachment())
            ->setFallback('Fallback')
            ->setText('Text')
            ->setPretext('Pretext')
            ->setColor('bad')
            ->setFooter('Footer')
            ->setFooterIcon('https://platform.slack-edge.com/img/default_application_icon.png')
            ->setTimestamp($now)
            ->setMarkdownFields(['pretext', 'text'])
            ->setImageUrl('http://fake.host/image.png')
            ->setThumbUrl('http://fake.host/image.png')
            ->setTitle('A title')
            ->setTitleLink('http://fake.host/')
            ->setAuthorName('Joe Bloggs')
            ->setAuthorLink('http://fake.host/')
            ->setAuthorIcon('http://fake.host/image.png')
            ->setFields(
                [
                    new AttachmentField('Title 1', 'Value 1'),
                    new AttachmentField('Title 2', 'Value 1'),
                ]
            )
            ->setActions(
                [
                    (new AttachmentAction('Name 1', 'Text 1'))
                        ->setStyle('default')
                        ->setType('button')
                        ->setValue('Value 1')
                        ->setConfirm((new ActionConfirmation('Title 1', 'Text 1'))
                            ->setOkText('OK Text 1')
                            ->setDismissText('Dismiss Text 1')
                        ),
                    (new AttachmentAction('Name 2', 'Text 2'))
                        ->setStyle('default')
                        ->setType('button')
                        ->setValue('Value 2')
                        ->setConfirm((new ActionConfirmation('Title 2', 'Text 2'))
                            ->setOkText('OK Text 2')
                            ->setDismissText('Dismiss Text 2')
                        ),
                ]
            )
        ;

        // Sublte difference with timestamp
        $out = [
            'fallback' => 'Fallback',
            'text' => 'Text',
            'pretext' => 'Pretext',
            'color' => 'bad',
            'footer' => 'Footer',
            'footer_icon' => 'https://platform.slack-edge.com/img/default_application_icon.png',
            'ts' => $now->getTimestamp(),
            'mrkdwn_in' => ['pretext', 'text'],
            'image_url' => 'http://fake.host/image.png',
            'thumb_url' => 'http://fake.host/image.png',
            'title' => 'A title',
            'title_link' => 'http://fake.host/',
            'author_name' => 'Joe Bloggs',
            'author_link' => 'http://fake.host/',
            'author_icon' => 'http://fake.host/image.png',
            'fields' => [
              [
                'title' => 'Title 1',
                'value' => 'Value 1',
                'short' => false,
              ],
              [
                'title' => 'Title 2',
                'value' => 'Value 1',
                'short' => false,
              ],
            ],
            'actions' => [
                [
                    'name' => 'Name 1',
                    'text' => 'Text 1',
                    'style' => 'default',
                    'type' => 'button',
                    'value' => 'Value 1',
                    'confirm' => [
                        'title' => 'Title 1',
                        'text' => 'Text 1',
                        'ok_text' => 'OK Text 1',
                        'dismiss_text' => 'Dismiss Text 1',
                    ],
                ],
                [
                    'name' => 'Name 2',
                    'text' => 'Text 2',
                    'style' => 'default',
                    'type' => 'button',
                    'value' => 'Value 2',
                    'confirm' => [
                        'title' => 'Title 2',
                        'text' => 'Text 2',
                        'ok_text' => 'OK Text 2',
                        'dismiss_text' => 'Dismiss Text 2',
                    ],
                ],
            ],
        ];

        $this->assertSame($out, $a->toArray());
    }

    public function testAddActionAsObject(): void
    {
        $a = (new Attachment())
            ->setFallback('Fallback')
            ->setText('Text')
        ;

        $a->addAction((new AttachmentAction('Name 1', 'Text 1'))
            ->setStyle('default')
            ->setValue('Value 1')
            ->setConfirm((new ActionConfirmation('Title 1', 'Text 1'))
                ->setOkText('OK Text 1')
                ->setDismissText('Dismiss Text 1')
            )
        );

        $actions = $a->getActions();

        $this->assertSame(1, \count($actions));

        $this->assertSame('Text 1', $actions[0]->getText());
    }

    public function testAddFieldAsObject(): void
    {
        $a = (new Attachment())
            ->setFallback('Fallback')
            ->setText('Text')
        ;

        $f = new AttachmentField('Title 1', 'Value 1', true);

        $a->addField($f);

        $fields = $a->getFields();

        $this->assertSame(1, \count($fields));

        $this->assertSame($f, $fields[0]);
    }

    public function testSetFields(): void
    {
        $a = (new Attachment())
            ->setFallback('Fallback')
            ->setText('Text')
        ;

        $a
            ->addField(new AttachmentField('Title 1', 'Value 1', true))
            ->addField(new AttachmentField('Title 2', 'Value 2', true))
        ;

        $this->assertSame(2, \count($a->getFields()));

        $a->setFields([]);

        $this->assertSame(0, \count($a->getFields()));
    }
}
