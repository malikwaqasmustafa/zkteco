# UnOfficial ZKTeco - Laravel Library #

[![Issues](https://img.shields.io/github/issues/sketchtechnologies1/zkteco?style=flat-square)](https://github.com/sketchtechnologies1/zkteco/issues)
[![Forks](https://img.shields.io/github/forks/sketchtechnologies1/zkteco?style=flat-square)](https://github.com/sketchtechnologies1/zkteco/network/members)
[![Stars](https://img.shields.io/github/stars/sketchtechnologies1/zkteco?style=flat-square)](https://github.com/sketchtechnologies1/zkteco/stargazers)
[![Total Downloads](https://img.shields.io/packagist/dt/maliklibs/zkteco?style=flat-square)](https://packagist.org/packages/maliklibs/zkteco)
[![License](https://poser.pugx.org/maliklibs/zkteco/license.svg)](https://packagist.org/packages/maliklibs/zkteco)
[![Laravel Version](https://img.shields.io/badge/Laravel-6.x%20%7C%208.x%20%7C%209.x%20%7C%2010.x-brightgreen.svg)](https://laravel.com)

The `maliklibs/zkteco` package provides easy to use functions to ZKTeco Device activities.

**Requires:**  **Laravel** >= **6.0** | **PHP** >= **7.4**

**Compatible with:** Laravel 6.x, 8.x, 9.x, 10.x

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
```