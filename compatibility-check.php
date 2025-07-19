<?php

/**
 * ZKTeco Package Compatibility Checker
 * 
 * Run this script to check if your environment is compatible with the ZKTeco package.
 * Usage: php compatibility-check.php
 */

echo "🔍 ZKTeco Package Compatibility Checker\n";
echo "=====================================\n\n";

$errors = [];
$warnings = [];

// Check PHP version
echo "📋 Checking PHP version...\n";
$phpVersion = PHP_VERSION;
$requiredPhp = '7.4.0';

if (version_compare($phpVersion, $requiredPhp, '>=')) {
    echo "✅ PHP version: {$phpVersion} (>= {$requiredPhp})\n";
} else {
    $errors[] = "❌ PHP version {$phpVersion} is below required {$requiredPhp}";
    echo "❌ PHP version: {$phpVersion} (required >= {$requiredPhp})\n";
}

// Check required extensions
echo "\n📋 Checking PHP extensions...\n";

$requiredExtensions = [
    'mbstring' => 'For UTF-8 encoding support',
    'sockets' => 'For device communication',
];

foreach ($requiredExtensions as $extension => $description) {
    if (extension_loaded($extension)) {
        echo "✅ {$extension}: {$description}\n";
    } else {
        $errors[] = "❌ Missing required extension: {$extension}";
        echo "❌ {$extension}: {$description} (MISSING)\n";
    }
}

// Check Laravel version (if available)
echo "\n📋 Checking Laravel version...\n";
if (class_exists('Illuminate\Foundation\Application')) {
    $laravelVersion = app()->version();
    echo "✅ Laravel version: {$laravelVersion}\n";
    
    // Check if it's a supported version
    $supportedVersions = ['6.0', '8.0', '9.0', '10.0', '11.0'];
    $majorVersion = explode('.', $laravelVersion)[0];
    
    if (in_array($majorVersion, ['6', '8', '9', '10', '11'])) {
        echo "✅ Laravel version is supported\n";
    } else {
        $warnings[] = "⚠️ Laravel version {$laravelVersion} may not be fully tested";
        echo "⚠️ Laravel version {$laravelVersion} (may not be fully tested)\n";
    }
} else {
    echo "ℹ️ Laravel not detected (running standalone)\n";
}

// Check if package is installed
echo "\n📋 Checking package installation...\n";
if (class_exists('maliklibs\Zkteco\Lib\ZKTeco')) {
    echo "✅ ZKTeco package is installed\n";
} else {
    echo "ℹ️ ZKTeco package not detected (may not be installed)\n";
}

// Summary
echo "\n📊 Summary\n";
echo "==========\n";

if (empty($errors) && empty($warnings)) {
    echo "🎉 All checks passed! Your environment is fully compatible.\n";
    exit(0);
}

if (!empty($errors)) {
    echo "\n❌ Errors found:\n";
    foreach ($errors as $error) {
        echo "  {$error}\n";
    }
}

if (!empty($warnings)) {
    echo "\n⚠️ Warnings:\n";
    foreach ($warnings as $warning) {
        echo "  {$warning}\n";
    }
}

if (!empty($errors)) {
    echo "\n💡 To fix errors:\n";
    echo "  - Update PHP to version 7.4 or higher\n";
    echo "  - Install missing PHP extensions\n";
    echo "  - Contact your hosting provider if you can't install extensions\n";
    exit(1);
} else {
    echo "\n✅ Environment is compatible with warnings.\n";
    exit(0);
} 