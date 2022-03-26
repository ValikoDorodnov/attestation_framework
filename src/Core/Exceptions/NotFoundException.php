<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use Throwable;
use Exception;

final class NotFoundException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Route Not Found', $code, $previous);
    }
}
