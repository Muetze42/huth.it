<?php

if (!function_exists('appLog')) {
    /**
     * Helper function for logging
     *
     * @param $message
     * @param string $level
     * @param string $channel
     * @param array $context
     */
    function appLog($message, string $level = 'debug', string $channel = 'daily', array $context = []): void
    {
        $levels = [
            'emergency',
            'alert',
            'critical',
            'error',
            'warning',
            'notice',
            'info',
            'debug',
        ];

        if (!in_array($level, $levels)) {
            $level = 'debug';
        }

        if (!is_string($message) && !is_numeric($message)) {
            $message = print_r($message, true);
        }

        \Illuminate\Support\Facades\Log::channel($channel)->{$level}($message, $context);
    }
}

if (!function_exists('errorLog')) {
    /**
     * Helper function to logging errors
     *
     * @param $message
     * @param array $context
     * @return void
     */
    function errorLog($message, array $context = []): void
    {
        appLog($message, 'error', 'daily', $context);
    }
}

if (!function_exists('errorImage')) {
    /**
     * Choose an error image
     *
     * @param int $errorCode
     * @return string
     */
    function errorImage(int $errorCode): string
    {
        $errorImages = [
            '401' => '403.svg',
            '403' => '403.svg',
            '404' => '404.svg',
            '500' => '503.svg',
        ];

        return $errorImages[$errorCode] ?? '404.svg';
    }
}
