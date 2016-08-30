<?php

return [
    'model' => \Codecasts\Domains\Users\User::class,
    'table' => 'oauth_identities',
    'providers' => [
        'github' => [
            'client_id' => trim(env('GITHUB_CLIENT_ID')),
            'client_secret' => trim(env('GITHUB_CLIENT_SECRET')),
            'redirect_uri' => env('GITHUB_CALLBACK_URL'),
            'scope' => ['user:email'],
        ],
        'facebook' => [
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'redirect_uri' => env('FACEBOOK_CALLBACK_URL'),
            'scope' => ['email'],
        ],
        'google' => [
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => env('GOOGLE_CALLBACK_URL'),
            'scope' => [],
        ],
    ],
];
