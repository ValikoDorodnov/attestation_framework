<?php

declare(strict_types=1);

namespace App\Models\Article\Exceptions;

use Exception;
use App\Core\Http\StatusCode;

final class ArticleNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Article Not Found', StatusCode::NOT_FOUND);
    }
}
