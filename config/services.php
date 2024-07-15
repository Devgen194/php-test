<?php

return [

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],


    'Pokedex_api' => [
        'Api' => env('API_BASE_URL', 'https://pokeapi.co/api/v2'),
    ],

];
