<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\DIContainer;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\StatusCode;
use App\Core\Exceptions\NotFoundException;
use App\Core\Exceptions\MethodNotAllowedException;

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
        $routeInfo = $this->parseRoute(
            method: $this->request->method(),
            uri: $this->request->requestedUri()
        );
        http_response_code($routeInfo['statusCode']);

        if ($routeInfo['statusCode'] === StatusCode::FOUND) {

            [$class, $method] = explode('/', $routeInfo['handler'], 2);
            $class = $this->container->getClassByName($class) ?? new $class();

            $response = $class->{$method}(...array_values($routeInfo['vars']));

            if ($response instanceof Response) {
                $response();
            }

        } else {
            echo $routeInfo['message'];
        }
    }

    private function parseRoute(string $method, string $uri): array
    {
        $routeInfo = [];

        try {
            $route = $this->collector->getRoute(method: $method, uri: $uri);
            $routeInfo['statusCode'] = StatusCode::FOUND;
            $routeInfo['handler'] = $route->getHandler();
            $routeInfo['vars'] = $route->getVars();
        } catch (\Exception $e) {
            $routeInfo['message'] = $e->getMessage();
            $routeInfo['statusCode'] = StatusCode::SERVER_ERROR;

            if ($e instanceof MethodNotAllowedException) {
                $routeInfo['statusCode'] = StatusCode::METHOD_NOT_ALLOWED;
            }
            if ($e instanceof NotFoundException) {
                $routeInfo['statusCode'] = StatusCode::NOT_FOUND;
            }
        }

        return $routeInfo;
    }
}
