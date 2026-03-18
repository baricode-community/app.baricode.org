<?php

use Illuminate\View\DynamicComponent;

return [
    'paths' => [
        resource_path('views'),
    ],
    'compiled' => env('VIEW_COMPILED_PATH', realpath(storage_path('framework/views'))),
    'components' => [
        'aliases' => [
            'dynamic' => DynamicComponent::class,
        ],
        'paths' => [
            resource_path('views/components'),
        ],
    ],
];
