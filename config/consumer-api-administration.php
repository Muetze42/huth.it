<?php

return [
    'client' => [
        'User-Agent'  => 'Huth Service API',
        'headers'     => [], # Not Authorization & User-Agent
        'form_params' => [], # Not case & argument
        'route'       => '/api/huth-api/{client}',
    ],
    'nova' => [
        'base-resource' => \App\Nova\Resources\Resource::class,
    ],
];
