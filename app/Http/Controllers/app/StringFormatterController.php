<?php

namespace App\Http\Controllers\app;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StringFormatterController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function indexData(Request $request): array
    {
        $string = $request->input('string');
        $language = $request->input('language');
        $method = $request->input('method');

        $language = in_array($language, ['en', 'de', 'bg']) ? $language : 'en';
        $output = '';

        if ($string && $language && $method) {
            $output = match ($method) {
                'StudlyCase' => Str::studly($string),
                'ASCII' => Str::ascii($string, $language),
                default => Str::slug($string, '-', $language),
            };
        }

        return [
            'serverSideOutput' => $output,
        ];
    }
}
