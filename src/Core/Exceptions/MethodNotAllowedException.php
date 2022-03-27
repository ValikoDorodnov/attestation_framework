<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use App\Core\Http\StatusCode;
use Exception;

final class MethodNotAllowedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Method Not Allowed', StatusCode::METHOD_NOT_ALLOWED);
    }
}
