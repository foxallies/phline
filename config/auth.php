<?php
return [
    'web' => [
        'model' => \App\Models\User::class,
        'key' => 'token'
    ],
    'api' => [
        'model' => \App\Models\User::class,
        'header' => 'Authorization',
        'key' => 'token'
    ]
];
