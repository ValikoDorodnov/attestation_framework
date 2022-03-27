<?php

declare(strict_types=1);

namespace App\Models\Article\Exceptions;

use Exception;
use App\Core\Http\StatusCode;

final class ArticleAlreadyExistException extends Exception
{
    public function __construct(string $id)
    {
        parent::__construct("Article with id $id already exist", StatusCode::CONFLICT);
    }
}
