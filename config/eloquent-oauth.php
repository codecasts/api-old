<?php

return [
    'model' => \Codecasts\Domains\Users\User::class,
    'table' => 'oauth_identities',
    'providers' => [
        'github' => [
            'client_id' => trim(env('GITHUB_CLIENT_ID')),
            'client_secret' => trim(env('GITHUB_CLIENT_SECRET')),
            'redirect_uri' => '',
            'scope' => ['user:email'],
        ],
        'facebook' => [
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'redirect_uri' => (env('APP_SECURE', false) ? 'https://': 'http://').env('APP_DOMAIN').'/auth/callback/facebook',
            'scope' => ['email'],
        ],
        'google' => [
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => (env('APP_SECURE', false) ? 'https://': 'http://').env('APP_DOMAIN').'/auth/callback/google',
            'scope' => [],
        ],
    ],
];
