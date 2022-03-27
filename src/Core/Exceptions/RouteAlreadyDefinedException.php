<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use Exception;

final class RouteAlreadyDefinedException extends Exception
{
    public function __construct(string $route)
    {
        parent::__construct("Route $route already defined");
    }
}
