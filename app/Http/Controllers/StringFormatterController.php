<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StringFormatterController extends Controller
{
    public function store(Request $request)
    {
        $string = $request->input('string');
        $language = $request->input('language');
        $method = $request->input('method');

        $language = in_array($language, ['en', 'de', 'bg']) ? $language : 'en';

        return match ($method) {
            'StudlyCase' => Str::studly($string),
            'ASCII' => Str::ascii($string, $language),
            default => Str::slug($string, '-', $language),
        };
    }
}
