<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Site Settings
    |--------------------------------------------------------------------------
    |
    | Specific settings for this app
    |
    */
    'open-graph'   => [
        'fallback-image' => 'img/fallback.jpg',
    ],
    'count_delay'  => env('LINK_COUNT_DELAY', 240) > 10 ? env('LINK_COUNT_DELAY') : 10,
    'nova'         => [
        'external_link_class' => 'no-underline dim text-primary',
        'external_link_icon'  => 'fa-fw fal fa-external-link fa-xs',
        'menu-order'          => [
            'Webhooks'     => 10,
            'Customer API' => 20,
            'Dates'        => 30,
            'Bookmarks'    => 40,
        ],
    ],
    'error-report' => [
        'throttle' => 3600,
    ],
    'site-repo'    => [
        'url'    => env('SITE_GIT_URL', 'https://github.com/Muetze42/huth.it'),
        'branch' => env('SITE_GIT_BRANCH', 'main'),
    ],
    'menu-items'   => [
        [
            'route' => 'home',
            'text'  => 'Links',
        ],
        [
            'route' => 'contact.index',
            'text'  => 'Contact',
        ],
        [
            'route' => 'password-generator.index',
            'text'  => 'Password Generator',
        ],
        [
            'route' => 'string-formatter.index',
            'text'  => 'String Formatter',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | make:bundle command
    |--------------------------------------------------------------------------
    |
    | What should be generated without option?
    |
    */
    'make-bundle'  => [
        'nova-ressource' => true,
        'migration'      => true,
        'policy'         => false,
        'resource'       => false,
        'controller'     => false,
        'api-controller' => false,

        'namespaces' => [
            'controller'     => '',
            'api-controller' => 'Api/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | App Settings
    |--------------------------------------------------------------------------
    */
    'json-routes' => [
        'api',
        'ajax',
    ],
];
