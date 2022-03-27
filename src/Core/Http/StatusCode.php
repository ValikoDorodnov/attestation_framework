<?php

declare(strict_types=1);

namespace App\Core\Http;

final class StatusCode
{
    public const FOUND = 200;
    public const CREATED = 201;
    public const BAD_REQUEST = 400;
    public const NOT_FOUND = 404;
    public const CONFLICT = 409;
    public const METHOD_NOT_ALLOWED = 405;
    public const SERVER_ERROR = 500;
}
