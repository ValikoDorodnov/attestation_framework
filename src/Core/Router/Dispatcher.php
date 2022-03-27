<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\DIContainer;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\StatusCode;

final class Dispatcher
{
    public function __construct(
        private RouteCollector $collector,
        private DIContainer    $container,
        private Request        $request
    )
    {
    }

    public function dispatch(): void
    {
        $statusCode = StatusCode::FOUND;
        $message = '';

        try {
            $routeInfo = $this->parseRoute(
                method: $this->request->method(),
                uri: $this->request->requestedUri()
            );

            [$class, $method] = explode('/', $routeInfo->handler, 2);
            $class = $this->container->getDependencyByName($class) ?? new $class();

            $response = $class->{$method}(...array_values($routeInfo->vars));

            if ($response instanceof Response) {
                $statusCode = $response->getStatusCode();
                $response();
            }

        } catch (\Exception $e) {
            $statusCode = $e->getCode();
            $message = $e->getMessage();
            if ($statusCode === 0) {
                $statusCode = StatusCode::SERVER_ERROR;
            }
        }

        http_response_code($statusCode);
        if ($message) {
            echo $message;
        }
    }

    private function parseRoute(string $method, string $uri): RouteInfo
    {
        $routeInfo = new RouteInfo();

        $route = $this->collector->getRoute(method: $method, uri: $uri);
        $routeInfo->handler = $route->getHandler();
        $routeInfo->vars = $route->getVars();

        return $routeInfo;
    }
}
