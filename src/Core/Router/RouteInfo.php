<?php

declare(strict_types=1);

namespace App\Core\Router;

final class RouteInfo
{
    public string $handler;
    public array $vars;
    public string $message;
}
