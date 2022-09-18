<?php

namespace App\Http\Controllers\app;


class PrivacyController extends Controller
{
    /**
     * @return array
     */
    protected function indexData(): array
    {
        return [
            'de' => trim(file_get_contents(base_path('settings/privacy/de.html'))),
            'en' => trim(file_get_contents(base_path('settings/privacy/en.html'))),
        ];
    }
}
