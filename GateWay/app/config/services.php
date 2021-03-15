<?php

return [
    'users' => [
        'base_uri' => "This should return something",
    ],
    'todos' => [
        'base_uri' => env('TODOS_SERVICE_BASE_URL'),
    ]
];