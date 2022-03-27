<?php

declare(strict_types=1);

use App\Core\Http\Request;
use App\Models\EntityManager;
use App\Models\Article\ArticleValidator;
use App\Controller\Api\ArticleController;
use App\Models\Article\ArticleRepository;

return [
    ArticleController::class => [
        ArticleRepository::class,
        ArticleValidator::class,
        EntityManager::class,
        Request::class
    ]
];
