<?php

namespace App\Http\Controllers\app;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StringFormatterController extends Controller
{
    /**
     * @return array
     */
    public function indexData(): array
    {
        $string = request()->input('string');
        $language = request()->input('language');
        $method = request()->input('method');

        $language = in_array($language, ['en', 'de', 'bg']) ? $language : 'en';
        $output = '';

        if ($string && $language && $method) {
            $output = match ($method) {
                'StudlyCase' => Str::studly($string),
                'ASCII' => Str::ascii($string, $language),
                default => Str::slug($string, '-', $language),
            };

            Log::debug($output);
        }

        return [
            'serverSideOutput' => $output,
        ];
    }
}
