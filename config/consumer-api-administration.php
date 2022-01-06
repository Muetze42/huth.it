<?php

return [
    'client' => [
        'User-Agent'  => 'Huth Service API',
        'headers'     => [], # Not Authorization & User-Agent
        'form_params' => [], # Not case & argument
        'route'       => '/api/huth-api/{client}',
    ],
    'routeing' => [
        'target' => '/api/huth-api/{client}',
        'name-prefix' => 'consumer-api',
    ],
];
