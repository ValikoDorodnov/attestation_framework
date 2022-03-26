<?php

declare(strict_types=1);

namespace App\Core\Http;

final class StatusCode
{
    public const FOUND = 200;
    public const NOT_FOUND = 404;
    public const METHOD_NOT_ALLOWED = 403;
    public const SERVER_ERROR = 500;
}
