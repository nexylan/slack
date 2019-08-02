# UPGRADE FROM 2.X to 3.0

## API error exception

If the response match a Slack API error, a `Nexy\Slack\Exception\SlackApiException` will be thrown.

It can be BC break if you are alredy mannaging API exception with HTTPPlug.

## PSR-17 and PSR-18 migration

We got entirely rid of HTTP management thanks to PSR-17 and PSR-18.

You do not need to rely on HTTPlug anymore, but to any client matching the conventions.

## Client constructor

The `Nexy\Slack\Client` constructor parameters are changed:

Before:

```php
$client = new \Nexy\Slack\Client('https://hooks.slack.com/...', [
	'username' => 'Cyril',
	'channel' => '#accounting',
	'link_names' => true,
]);
```

After (Using [HTTPlug discovery component](https://packagist.org/packages/php-http/discovery)):

```php
$client = new \Nexy\Slack\Client(
    \Http\Discovery\Psr18ClientDiscovery::find(),
    \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory(),
    \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory(),
    'https://hooks.slack.com/...',
    [
        'username' => 'Cyril', // Default messages are sent from 'Cyril'
        'channel' => '#accounting', // Default messages are sent to '#accounting'
        'link_names' => true
    ]
);
```
