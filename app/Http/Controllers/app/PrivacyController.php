<?php

namespace App\Http\Controllers\app;


use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    protected function indexData(Request $request): array
    {
        return [
            'de' => trim(file_get_contents(base_path('settings/privacy/de.html'))),
            'en' => trim(file_get_contents(base_path('settings/privacy/en.html'))),
        ];
    }
}
