<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use Exception;
use App\Core\Http\StatusCode;

final class NotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Route Not Found', StatusCode::NOT_FOUND);
    }
}
