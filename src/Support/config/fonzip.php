<?php
return [
    'fonzip_default_routes' => env('FONZIP_DEFAULT_ROUTES', false),
    'application_key' => env('FONZIP_APPKEY', '****'),
    'base_url' => env('FONZIP_DOMAIN', 'https://fonzip.com/api/v1-1/'),
    'logging' => env('LOG_CHANNEL'),
    'error_log_channel' => env('FONZIP_ERROR_LOG_CHANNEL', 'cloudwatch_error_logs')
];
