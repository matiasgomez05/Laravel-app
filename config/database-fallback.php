<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Database Fallback Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration handles fallback behavior when the database is
    | unavailable. It defines which services should fallback to alternative
    | storage methods.
    |
    */

    'session' => [
        'fallback_driver' => env('SESSION_FALLBACK_DRIVER', 'file'),
        'auto_fallback' => env('SESSION_AUTO_FALLBACK', true),
    ],

    'cache' => [
        'fallback_driver' => env('CACHE_FALLBACK_DRIVER', 'file'),
        'auto_fallback' => env('CACHE_AUTO_FALLBACK', true),
    ],

    'queue' => [
        'fallback_driver' => env('QUEUE_FALLBACK_DRIVER', 'sync'),
        'auto_fallback' => env('QUEUE_AUTO_FALLBACK', true),
    ],
];
