<?php

declare(strict_types=1);

use App\Controller\SiteController;

return [
    [
        'method'  => 'GET',
        'path'    => '/',
        'handler' => SiteController::class . '/index'
    ],
    [
        'method'  => 'GET',
        'path'    => '/product/<id>',
        'handler' => SiteController::class . '/product'
    ]
];
