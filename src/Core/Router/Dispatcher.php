<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Http\StatusCode;
use App\Core\Exceptions\NotFoundException;
use App\Core\Exceptions\MethodNotAllowedException;

final class Dispatcher
{
    public function __construct(private RouteCollection $routeCollection)
    {
    }

    public function dispatch(): void
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $this->getUri();

        $routeInfo = $this->parseRoute($httpMethod, $uri);
        http_response_code($routeInfo['statusCode']);

        if ($routeInfo['statusCode'] === StatusCode::FOUND) {
            [$class, $method] = explode('/', $routeInfo['handler'], 2);
            $controller = new $class();
            $response = $controller->{$method}(...array_values($routeInfo['vars']));
            $response();
        } else {
            echo $routeInfo['message'];
        }
    }

    private function parseRoute(string $method, string $uri): array
    {
        $routeInfo = [];

        try {
            $route = $this->routeCollection->getRouteByMethodAndUri(method: $method, uri: $uri);
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

    public function getUri(): string
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        return rawurldecode($uri);
    }
}
