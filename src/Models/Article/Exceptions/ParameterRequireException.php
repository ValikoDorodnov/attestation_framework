<?php

declare(strict_types=1);

namespace App\Models\Article\Exceptions;

use Exception;

final class ParameterRequireException extends Exception
{
    public function __construct(string $param)
    {
        parent::__construct("Param $param is required!");
    }
}
