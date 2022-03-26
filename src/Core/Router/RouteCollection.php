<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Exceptions\NotFoundException;
use App\Core\Exceptions\MethodNotAllowedException;

final class RouteCollection
{
    /** @var Route[] */
    private array $routes;

    public function __construct(array $routes)
    {
        foreach ($routes as $route) {
            $this->addRoute(
                $route['method'],
                $route['path'],
                $route['handler'],
            );
        }
    }

    private function addRoute(string $method, string $path, string $handler): void
    {
        $this->routes[] = new Route(
            method: $method,
            path: $path,
            handler: $handler
        );
    }

    /**
     * @param string $method
     * @param string $uri
     * @return Route
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     */
    public function getRouteByMethodAndUri(string $method, string $uri): Route
    {
        foreach ($this->routes as $route) {
            $matched = $route->checkUri($uri);

            if ($matched) {
                $route->checkMethod($method);
                return $route;
            }
        }

        throw new NotFoundException();
    }
}
