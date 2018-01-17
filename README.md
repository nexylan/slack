# Slack for PHP

A simple PHP package for sending messages to [Slack](https://slack.com)
with [incoming webhooks](https://my.slack.com/services/new/incoming-webhook),
focused on ease-of-use and elegant syntax.

[![Latest Stable Version](https://poser.pugx.org/nexylan/slack/v/stable)](https://packagist.org/packages/nexylan/slack)
[![Latest Unstable Version](https://poser.pugx.org/nexylan/slack/v/unstable)](https://packagist.org/packages/nexylan/slack)
[![License](https://poser.pugx.org/nexylan/slack/license)](https://packagist.org/packages/nexylan/slack)

[![Total Downloads](https://poser.pugx.org/nexylan/slack/downloads)](https://packagist.org/packages/nexylan/slack)
[![Monthly Downloads](https://poser.pugx.org/nexylan/slack/d/monthly)](https://packagist.org/packages/nexylan/slack)
[![Daily Downloads](https://poser.pugx.org/nexylan/slack/d/daily)](https://packagist.org/packages/nexylan/slack)

[![Build Status](https://travis-ci.org/nexylan/slack.svg?branch=master)](https://travis-ci.org/nexylan/slack)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nexylan/slack/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nexylan/slack/?branch=master)
[![Code Climate](https://codeclimate.com/github/nexylan/slack/badges/gpa.svg)](https://codeclimate.com/github/nexylan/slack)
[![Coverage Status](https://coveralls.io/repos/nexylan/slack/badge.svg?branch=master)](https://coveralls.io/r/nexylan/slack?branch=master)

* Symfony integration: [Slack bundle](https://github.com/nexylan/slack-bundle)

This repository started from a fork of the popular [maknz/slack](https://github.com/maknz/slack) library,
which [is not maintained anymore](https://github.com/maknz/slack/commit/89ff7b2).

The 1.x branch and all the related releases are an exact copy of the original repository
and are under the [BSD 2-clause "Simplified" License](https://github.com/maknz/slack/blob/master/LICENSE.md).

The next releases will be under the MIT license. See the current [LICENSE](LICENSE) file for more details.

## Requirements

* PHP 7.1+

## Installation

You can install the package using the [Composer](https://getcomposer.org/) package manager. You can install it by running this command in your project root:

```sh
composer require nexylan/slack
```

Then [create an incoming webhook](https://my.slack.com/services/new/incoming-webhook) on your Slack account for the package to use.
You'll need the webhook URL to instantiate the client (or for the configuration file if using Laravel).

## Basic Usage

### Instantiate the client

```php
// Instantiate without defaults
$client = new Nexy\Slack\Client('https://hooks.slack.com/...');

// Instantiate with defaults, so all messages created
// will be sent from 'Cyril' and to the #accounting channel
// by default. Any names like @regan or #channel will also be linked.
$settings = [
	'username' => 'Cyril',
	'channel' => '#accounting',
	'link_names' => true
];

$client = new Nexy\Slack\Client('https://hooks.slack.com/...', $settings);
```

#### Settings

The default settings are pretty good, but you may wish to set up default behaviour for your client to be used for all messages sent. **All settings are optional and you don't need to provide any**. Where not provided, we'll fallback to what is configured on the webhook integration, which are [managed at Slack](https://my.slack.com/apps/manage/custom-integrations), or our sensible defaults.

Field | Type | Description
----- | ---- | -----------
`channel` | string | The default channel that messages will be sent to
`username` | string | The default username for your bot
`icon` | string | The default icon that messages will be sent with, either `:emoji:` or a URL to an image
`link_names` | bool | Whether names like `@regan` or `#accounting` should be linked in the message (defaults to false)
`unfurl_links` | bool | Whether Slack should unfurl text-based URLs (defaults to false)
`unfurl_media` | bool | Whether Slack should unfurl media-based URLs, like tweets or Youtube videos (defaults to true)
`allow_markdown` | bool | Whether markdown should be parsed in messages, or left as plain text (defaults to true)
`markdown_in_attachments` | array | Which attachment fields should have markdown parsed (defaults to none)

### Sending messages

#### Sending a basic message ([preview](https://goo.gl/fY43nw))

```php
$client->send('Hello world!');
```

#### Sending a message to a non-default channel
```php
$client->to('#accounting')->send('Are we rich yet?');
```

#### Sending a message to a user
```php
$client->to('@regan')->send('Yo!');
```

#### Sending a message to a channel as a different bot name ([preview](https://goo.gl/xCeEfY))
```php
$client->from('Jake the Dog')->to('@FinnTheHuman')->send('Adventure time!');
```

#### Sending a message with a different icon ([preview](https://goo.gl/lff21l))
```php
// Either with a Slack emoji
$client->to('@regan')->withIcon(':ghost:')->send('Boo!');

// or a URL
$client->to('#accounting')->withIcon('http://example.com/accounting.png')->send('Some accounting notification');
```

#### Send an attachment ([preview](https://goo.gl/fp3iaY))

```php
$client->to('#operations')->attach((new \Nexy\Slack\Attachment())
    ->setFallback('Server health: good')
    ->setText('Server health: good')
    ->setColor('danger')
)->send('New alert from the monitoring system'); // no message, but can be provided if you'd like
```

#### Send an attachment with fields ([preview](https://goo.gl/264mhU))

```php
$client->to('#operations')->attach((new \Nexy\Slack\Attachment())
    ->setFallback('Current server stats')
    ->setText('Current server stats')
    ->setColor('danger')
    ->setFields([
        new \Nexy\Slack\AttachmentField(
            'Cpu usage',
            '90%',
            true // whether the field is short enough to sit side-by-side other fields, defaults to false
        ),
        new \Nexy\Slack\AttachmentField('RAM usage', '2.5GB of 4GB', true),
    ])
)->send('New alert from the monitoring system'); // no message, but can be provided if you'd like
```

#### Send an attachment with an author ([preview](https://goo.gl/CKd1zJ))

```php
$client->to('@regan')->attach((new \Nexy\Slack\Attachment())
    ->setFallback('Keep up the great work! I really love how the app works.')
    ->setText('Keep up the great work! I really love how the app works.')
    ->setAuthorName('Jan Appleseed')
    ->setAuthorLink('https://yourapp.com/feedback/5874601')
    ->setAuthorIcon('https://static.pexels.com/photos/61120/pexels-photo-61120-large.jpeg')
)->send('New user feedback');
```

## Advanced usage

### Markdown

By default, Markdown is enabled for message text, but disabled for attachment fields. This behaviour can be configured in settings, or on the fly:

#### Send a message enabling or disabling Markdown

```php
$client->to('#weird')->disableMarkdown()->send('Disable *markdown* just for this message');

$client->to('#general')->enableMarkdown()->send('Enable _markdown_ just for this message');
```

#### Send an attachment specifying which fields should have Markdown enabled

```php
$client->to('#operations')->attach((new \Nexy\Slack\Attachment())
    ->setFallback('It is all broken, man')
    ->setText('It is _all_ broken, man')
    ->setPretext('From user: *JimBob*')
    ->setColor('danger')
    ->setMarkdownFields(['pretext', 'text'])
)->send('New alert from the monitoring system');
```

### Explicit message creation

For convenience, message objects are created implicitly by calling message methods on the client. We can however do this explicitly to avoid hitting the magic method.

```php
// Implicitly
$client->to('@regan')->send('I am sending this implicitly');

// Explicitly
$message = $client->createMessage();

$message->to('@regan')->setText('I am sending this explicitly');

$message->send();
```

### Attachments

When using attachments, the easiest way is to provide an array of data as shown in the examples, which is actually converted to an Attachment object under the hood. You can also attach an Attachment object to the message:

```php
$attachment = (new Attachment())
    ->setFallback('Some fallback text')
    ->setText('The attachment text')
;

// Explicitly create a message from the client
// rather than using the magic passthrough methods
$message = $client->createMessage();

$message->attach($attachment);

// Explicitly set the message text rather than
// implicitly through the send method
$message->setText('Hello world')->send();
```

You can also set the attachments and fields directly if you have a whole lot of them:

```php
// implicitly create a message and set the attachments
$client->setAttachments($bigArrayOfAttachments);

// or explicitly
$client->createMessage()->setAttachments($bigArrayOfAttachments);
```

```php
$attachment = new Attachment();

$attachment->setFields($bigArrayOfFields);
```

## Contributing

If you're having problems, spot a bug, or have a feature suggestion, please log and issue on Github. If you'd like to have a crack yourself, fork the package and make a pull request. Please include tests for any added or changed functionality. If it's a bug, include a regression test.
