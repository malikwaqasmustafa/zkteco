# Upgrade Guide

This guide will help you upgrade from the old ZKTeco package to the new Laravel 8, 9, 10+ compatible version.

## Breaking Changes

### Version 2.0.1

**No breaking changes** - This version includes compatibility fixes and improvements.

### Version 2.0.0

The new version introduces several improvements and modern Laravel patterns. Here are the key changes:

## Installation

### Old Way (Laravel 6.x only)
```bash
composer require maliklibs/zkteco
```

### New Way (Laravel 6.x, 8.x, 9.x, 10.x, 11.x)
```bash
composer require maliklibs/zkteco
```

The package now automatically detects your Laravel version and provides the appropriate compatibility.

## Usage Changes

### Old Way
```php
use maliklibs\Zkteco\Lib\ZKTeco;

$zk = new ZKTeco('192.168.1.201', 4370, 5);
$zk->connect();
// ... your code
$zk->disconnect();
```

### New Way - Method 1: Facade (Recommended)
```php
use maliklibs\Zkteco\Facades\ZKTeco;

ZKTeco::connect();
// ... your code
ZKTeco::disconnect();
```

### New Way - Method 2: Dependency Injection
```php
use maliklibs\Zkteco\Lib\ZKTeco;

class AttendanceController extends Controller
{
    public function index(ZKTeco $zk)
    {
        $zk->connect();
        // ... your code
        $zk->disconnect();
    }
}
```

### New Way - Method 3: Manual Instantiation (Same as before)
```php
use maliklibs\Zkteco\Lib\ZKTeco;

$zk = new ZKTeco('192.168.1.201', 4370, 5);
$zk->connect();
// ... your code
$zk->disconnect();
```

## Configuration

### New Feature: Configuration File

You can now publish a configuration file:

```bash
php artisan vendor:publish --provider="maliklibs\Zkteco\Providers\ZktecoServiceProvider" --tag="zkteco-config"
```

This creates `config/zkteco.php` with default settings.

### Environment Variables

Add these to your `.env` file:

```env
ZKTECO_IP=192.168.1.201
ZKTECO_PORT=4370
ZKTECO_TIMEOUT=5
ZKTECO_DEBUG=false
```

## Important Notes

### PHP Extensions Required

The package now requires these PHP extensions:
- `ext-mbstring` - For proper UTF-8 encoding support
- `ext-sockets` - For device communication

### writeLCD Method

The `writeLCD()` method signature has been corrected:
```php
// Correct usage
$zk->writeLCD(1, 'Hello World'); // rank, text

// Old incorrect usage (if you were using it)
// $zk->writeLCD(1, 1, 'Hello World'); // This was wrong
```

## Migration Steps

1. **Update Composer**
   ```bash
   composer update maliklibs/zkteco
   ```

2. **Clear Cache**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

3. **Publish Configuration (Optional)**
   ```bash
   php artisan vendor:publish --provider="maliklibs\Zkteco\Providers\ZktecoServiceProvider" --tag="zkteco-config"
   ```

4. **Update Your Code**
   - Replace manual instantiation with Facade usage where appropriate
   - Use dependency injection in controllers
   - Update any hardcoded IP addresses to use environment variables
   - Fix any `writeLCD()` calls to use correct parameters

## Backward Compatibility

The package maintains **100% backward compatibility** with the old API. Your existing code will continue to work without changes, but you can gradually migrate to the new patterns.

## Testing

Run the test suite to ensure everything works:

```bash
composer test
```

## Support

If you encounter any issues during the upgrade, please:

1. Check the [CHANGELOG](CHANGELOG.md) for detailed changes
2. Review the [README](README.md) for new features
3. Open an issue on GitHub with your Laravel version and error details 