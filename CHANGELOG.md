# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Changed
- The `Client::sendMessage()` method will now throw exceptions that match API errors

## [2.3.0]
### Added
- Add support for link buttons

## [2.2.0]
### Added
- Add `sticky_channel` option for dev/test environments

## [2.1.0] - 2019-02-01
### Added
- HTTPlug 2.0 support

## [2.0.0] - 2018-01-17
### Added
- Attachment actions (buttons) with confirmation support
- Optional footer attachment support
- PHP strict typing
- Options resolver usage for client options

### Changed
- Moved from Guzzle to PHP-HTTP
- Client::preparePayload is now private
- All classes are now final
- Nexylan namespace. It is now `Nexy\Slack`

### Fixed
- Bug where message wouldn't get returned on send
- URL for "Send an attachment" preview

### Removed
- PHP <7.1 support
- Array argument for any message and attachment object. Use chained calls instead.
- Possibility to change the endpoint. Use new instance instead.
