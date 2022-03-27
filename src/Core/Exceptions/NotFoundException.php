<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use Exception;

final class NotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Route Not Found');
    }
}
