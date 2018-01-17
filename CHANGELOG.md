# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

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
