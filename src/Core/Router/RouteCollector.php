<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Exceptions\NotFoundException;
use App\Core\Exceptions\MethodNotAllowedException;
use App\Core\Exceptions\RouteAlreadyDefinedException;

final class RouteCollector
{
    /** @var Route[] */
    private array $routes;

    private array $routesByPathAndMethod;

    /**
     * @param array $routes
     * @throws RouteAlreadyDefinedException
     */
    public function __construct(array $routes)
    {
        foreach ($routes as $route) {
            $this->addRoute(
                method: $route['method'],
                path: $route['path'],
                handler: $route['handler'],
            );
        }
    }

    /**
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     */
    public function getRoute(string $method, string $uri): Route
    {
        foreach ($this->routes as $route) {
            $isValidPath = $route->validateRouteByPath($uri);

            if ($isValidPath) {
                $validRoute = $this->getRouteByPathAndMethod($route->getPath(), $method);
                $validRoute->prepareVars($uri);
                return $validRoute;
            }
        }
        throw new NotFoundException();
    }

    /**
     * @param string $method
     * @param string $path
     * @param string $handler
     * @return void
     * @throws RouteAlreadyDefinedException
     */
    private function addRoute(string $method, string $path, string $handler): void
    {
        if (isset($this->routesByPathAndMethod[$path][$method])) {
            throw new RouteAlreadyDefinedException("$path -> $method");
        }

        $route = new Route(path: $path, handler: $handler);

        $this->routesByPathAndMethod[$path][$method] = $route;
        $this->routes[] = $route;
    }

    /**
     * @param string $path
     * @param string $method
     * @return Route
     * @throws MethodNotAllowedException
     */
    private function getRouteByPathAndMethod(string $path, string $method): Route
    {
        if (isset($this->routesByPathAndMethod[$path][$method])) {
            return $this->routesByPathAndMethod[$path][$method];
        }
        throw new MethodNotAllowedException();
    }
}
