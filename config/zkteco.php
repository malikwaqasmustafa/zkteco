<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ZKTeco Default Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the default configuration for the ZKTeco package.
    | You can publish this configuration file to customize the settings.
    |
    */

    // Default device IP address
    'default_ip' => env('ZKTECO_IP', '192.168.1.201'),

    // Default device port
    'default_port' => env('ZKTECO_PORT', 4370),

    // Default socket timeout in seconds
    'timeout' => env('ZKTECO_TIMEOUT', 5),

    // Enable debug mode
    'debug' => env('ZKTECO_DEBUG', false),

    // Default user role
    'default_user_role' => 0,

    // Maximum user ID length
    'max_user_id_length' => 9,

    // Maximum user name length
    'max_user_name_length' => 24,

    // Maximum password length
    'max_password_length' => 8,

    // Maximum card number length
    'max_card_number_length' => 10,
]; 