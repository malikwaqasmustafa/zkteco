# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.1] - 2024-01-19

### Fixed
- Fixed deprecated `utf8_encode()` function usage (replaced with `mb_convert_encoding()`)
- Fixed `writeLCD()` method signature mismatch between facade and implementation
- Added proper PHP extension requirements (`ext-mbstring`, `ext-sockets`)
- Updated documentation to reflect correct method signatures

### Changed
- Updated README with correct `writeLCD()` parameter documentation
- Enhanced backward compatibility with PHP 7.4+ and Laravel 6+

## [2.0.0] - 2024-01-19

### Added
- Laravel 8.x, 9.x, 10.x, and 11.x compatibility
- PHP 7.4+ and 8.x support
- Facade support for easier usage (`maliklibs\Zkteco\Facades\ZKTeco`)
- Configuration file support with `config/zkteco.php`
- Environment variable support for device settings
- Dependency injection support
- Service provider auto-registration
- Comprehensive test suite
- Modern package structure with proper autoloading

### Changed
- Updated `composer.json` with proper Laravel version constraints
- Improved service provider with modern Laravel patterns
- Enhanced README with multiple usage methods and better documentation
- Added proper package metadata and keywords
- Updated minimum PHP version to 7.4
- Changed minimum stability to "stable"

### Removed
- Legacy Laravel 6.x specific code patterns

## [1.0.0] - 2020-XX-XX

### Added
- Initial release
- Laravel 6.x compatibility
- Basic ZKTeco device communication
- User management
- Attendance management
- Device control features
- Fingerprint management
