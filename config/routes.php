<?php

declare(strict_types=1);

use App\Controller\SiteController;
use App\Controller\WebArticleController;
use App\Controller\Api\ArticleController;

return [
    [
        'method'  => 'GET',
        'path'    => '/',
        'handler' => SiteController::class . '/index'
    ],
    [
        'method'  => 'GET',
        'path'    => '/article',
        'handler' => WebArticleController::class . '/index'
    ],


    [
        'method'  => 'GET',
        'path'    => '/api/articles',
        'handler' => ArticleController::class . '/index'
    ],
    [
        'method'  => 'GET',
        'path'    => '/api/articles/<id>',
        'handler' => ArticleController::class . '/view'
    ],
    [
        'method'  => 'POST',
        'path'    => '/api/articles',
        'handler' => ArticleController::class . '/create'
    ],
    [
        'method'  => 'PUT',
        'path'    => '/api/articles/<id>',
        'handler' => ArticleController::class . '/update'
    ],
    [
        'method'  => 'DELETE',
        'path'    => '/api/articles/<id>',
        'handler' => ArticleController::class . '/delete'
    ],
];
