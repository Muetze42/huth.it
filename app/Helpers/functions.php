<?php
if (!function_exists('errorImage')) {
    /**
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

if (!function_exists('jsonResponse')) {
    /**
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    function jsonResponse(string $message = 'Not found', int $status = 404): \Illuminate\Http\JsonResponse
    {
        if ($status >= 400) {
            return response()->json([
                'error'   => true,
                'message' => __($message),
                'time'    => now(),
            ], $status);
        }

        return response()->json([
            'message' => __($message),
            'time'    => now(),
        ], $status);
    }
}
