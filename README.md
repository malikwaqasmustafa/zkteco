# UnOfficial ZKTeco - Laravel Library #

[![Issues](https://img.shields.io/github/issues/sketchtechnologies1/zkteco?style=flat-square)](https://github.com/sketchtechnologies1/zkteco/issues)
[![Forks](https://img.shields.io/github/forks/sketchtechnologies1/zkteco?style=flat-square)](https://github.com/sketchtechnologies1/zkteco/network/members)
[![Stars](https://img.shields.io/github/stars/sketchtechnologies1/zkteco?style=flat-square)](https://github.com/sketchtechnologies1/zkteco/stargazers)
[![Total Downloads](https://img.shields.io/packagist/dt/maliklibs/zkteco?style=flat-square)](https://packagist.org/packages/maliklibs/zkteco)
[![License](https://poser.pugx.org/maliklibs/zkteco/license.svg)](https://packagist.org/packages/maliklibs/zkteco)
[![Laravel Version](https://img.shields.io/badge/Laravel-6.x%20%7C%208.x%20%7C%209.x%20%7C%2010.x%20%7C%2011.x-brightgreen.svg)](https://laravel.com)

The `maliklibs/zkteco` package provides easy to use functions to ZKTeco Device activities.

**Requires:**  **Laravel** >= **6.0** | **PHP** >= **7.4**

**Compatible with:** Laravel 6.x, 8.x, 9.x, 10.x, 11.x

**License:** MIT or later

## Installation

You can install the package via composer:

```bash
composer require maliklibs/zkteco
```

The package will automatically register itself.

### Configuration (Optional)

Publish the configuration file:

```bash
php artisan vendor:publish --provider="maliklibs\Zkteco\Providers\ZktecoServiceProvider" --tag="zkteco-config"
```

This will create a `config/zkteco.php` file where you can customize the default settings.

### Environment Variables

You can also set these environment variables in your `.env` file:

```env
ZKTECO_IP=192.168.1.201
ZKTECO_PORT=4370
ZKTECO_TIMEOUT=5
ZKTECO_DEBUG=false
```

## Usage

### Method 1: Using Facade (Recommended)

```php
use maliklibs\Zkteco\Facades\ZKTeco;

// Connect to device
ZKTeco::connect();

// Get device version
$version = ZKTeco::version();

// Get users
$users = ZKTeco::getUser();

// Get attendance
$attendance = ZKTeco::getAttendance();

// Disconnect
ZKTeco::disconnect();
```

### Method 2: Using Dependency Injection

```php
use maliklibs\Zkteco\Lib\ZKTeco;

class AttendanceController extends Controller
{
    public function index(ZKTeco $zk)
    {
        $zk->connect();
        $attendance = $zk->getAttendance();
        $zk->disconnect();
        
        return response()->json($attendance);
    }
}
```

### Method 3: Manual Instantiation

```php
use maliklibs\Zkteco\Lib\ZKTeco;

// 1st parameter is string $ip Device IP Address
// 2nd parameter is integer $port Default: 4370
// 3rd parameter is integer seconds (socket default read timeout)
$zk = new ZKTeco('192.168.1.201', 4370, 5);

// Connect
$zk->connect();

// Use device methods
$version = $zk->version();
$users = $zk->getUser();

// Disconnect
$zk->disconnect();
```

## Available Methods

### Connection Management

* __Connect__ 
```php
// Connect to device
// Returns bool
$zk->connect();   
```

* __Disconnect__ 
```php
// Disconnect from device
// Returns bool
$zk->disconnect();   
```

### Device Control

* __Enable Device__ 
```php
// Enable device
// Returns bool/mixed
$zk->enableDevice();   
```
> **NOTE**: You have to call after read/write any info of Device.

* __Disable Device__ 
```php
// Disable device
// Returns bool/mixed
$zk->disableDevice(); 
```
> **NOTE**: You have to call before read/write any info of Device.

* __Power Off__ 
```php
// Turn off the device
// Returns bool/mixed
$zk->shutdown(); 
```

* __Restart__ 
```php
// Restart the device
// Returns bool/mixed
$zk->restart(); 
```

* __Sleep__ 
```php
// Sleep the device
// Returns bool/mixed
$zk->sleep(); 
```

* __Resume__ 
```php
// Resume the device from sleep
// Returns bool/mixed
$zk->resume(); 
```

### Device Information

* __Device Version__ 
```php
// Get device version
// Returns bool/mixed
$zk->version(); 
```

* __Device OS Version__ 
```php
// Get device OS version
// Returns bool/mixed
$zk->osVersion(); 
```

* __Platform__ 
```php
// Get platform
// Returns bool/mixed
$zk->platform(); 
```

* __Firmware Version__ 
```php
// Get firmware version
// Returns bool/mixed
$zk->fmVersion(); 
```

* __Serial Number__ 
```php
// Get device serial number
// Returns bool/mixed
$zk->serialNumber(); 
```

* __Device Name__ 
```php
// Get device name
// Returns bool/mixed
$zk->deviceName(); 
```

* __Work Code__ 
```php
// Get work code
// Returns bool/mixed
$zk->workCode(); 
```

* __SSR__ 
```php
// Get SSR
// Returns bool/mixed
$zk->ssr(); 
```

* __Pin Width__ 
```php
// Get Pin Width
// Returns bool/mixed
$zk->pinWidth(); 
```

### Time Management

* __Get Device Time__ 
```php
// Get device time
// Returns bool/mixed Format: "Y-m-d H:i:s"
$zk->getTime(); 
```

* __Set Device Time__ 
```php
// Set device time
// Parameter string $t Format: "Y-m-d H:i:s"
// Returns bool/mixed
$zk->setTime('2024-01-01 12:00:00'); 
```

### User Management

* __Get Users__ 
```php
// Get all users
// Returns array[]
$zk->getUser(); 
```

* __Set Users__ 
```php
// Set user
// 1st parameter int $uid Unique ID (max 65535)
// 2nd parameter int|string $userid ID in DB (max length = 9, only numbers)
// 3rd parameter string $name (max length = 24)
// 4th parameter int|string $password (max length = 8, only numbers)
// 5th parameter int $role Default 0
// 6th parameter int $cardno Default 0 (max length = 10, only numbers)
// Returns bool|mixed
$zk->setUser(1, '001', 'John Doe', '1234', 0, 0); 
```

* __Remove A User__ 
```php
// Remove a user by $uid
// Parameter integer $uid
// Returns bool|mixed
$zk->removeUser(1); 
```

* __Clear All Users__ 
```php
// Remove all users
// Returns bool|mixed
$zk->clearUsers(); 
```

* __Clear All Admin__ 
```php
// Remove all admin
// Returns bool|mixed
$zk->clearAdmin(); 
```

### Fingerprint Management

* __Get Fingerprint__ 
```php
// Get fingerprint data for user
// Parameter integer $uid
// Returns array[]
$zk->getFingerprint(1); 
```

* __Set Fingerprint__ 
```php
// Set fingerprint data for user
// 1st parameter integer $uid
// 2nd parameter array $data
// Returns bool|mixed
$zk->setFingerprint(1, $fingerprintData); 
```

* __Remove Fingerprint__ 
```php
// Remove fingerprint data for user
// 1st parameter integer $uid
// 2nd parameter array $data
// Returns bool|mixed
$zk->removeFingerprint(1, $fingerprintData); 
```

### Attendance Management

* __Get Attendance Log__ 
```php
// Get attendance log
// Returns array[]
// Format: [
//     [
//         "uid" => 1,           // Serial number of the attendance
//         "id" => "1",          // User ID of the application
//         "state" => 1,         // Authentication type (1=Fingerprint, 4=RF Card, etc.)
//         "timestamp" => "2020-05-27 21:21:06", // Time of attendance
//         "type" => 255         // Attendance type (check-in, check-out, etc.)
//     ]
// ]
$zk->getAttendance(); 
```

* __Clear Attendance Log__ 
```php
// Clear attendance log
// Returns bool/mixed
$zk->clearAttendance(); 
```

### Device Features

* __Voice Test__ 
```php
// Voice test of the device "Thank you"
// Returns bool/mixed
$zk->testVoice(); 
```

* __Face Function On__ 
```php
// Enable face function
// Returns bool|mixed
$zk->faceFunctionOn(); 
```

* __Clear LCD__ 
```php
// Clear LCD display
// Returns bool|mixed
$zk->clearLCD(); 
```

* __Write LCD__ 
```php
// Write to LCD display
// 1st parameter int $rank Line number of text
// 2nd parameter string $text Text to display
// Returns bool|mixed
$zk->writeLCD(1, 'Hello World'); 
```

## Testing

Run the tests:

```bash
composer test
```

## Requirements

- PHP >= 7.4
- Laravel >= 6.0
- PHP Socket extension enabled

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email malik.waqas.09@hotmail.com instead of using the issue tracker.

## Credits

- [Malik Waqas](https://github.com/sketchtechnologies1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
