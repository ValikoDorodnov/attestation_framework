<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Exceptions\MethodNotAllowedException;

final class Route
{
    private string $method;
    private string $path;
    private string $handler;
    private array $vars = [];

    public function __construct(string $method, string $path, string $handler)
    {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
    }

    /**
     * @param string $method
     * @return void
     * @throws MethodNotAllowedException
     */
    public function checkMethod(string $method): void
    {
        if ($this->method !== $method) {
            throw new MethodNotAllowedException();
        }
    }

    public function checkUri(string $uri): bool
    {
        $explodedUri = explode('/', $uri);
        $explodedPath = explode('/', $this->path);

        if ($explodedUri[1] !== $explodedPath[1]) {
            return false;
        }
        unset($explodedUri[1], $explodedPath[1]);

        foreach ($explodedPath as $key => $item) {
            $isVar = (bool)preg_match('/\<([^\]]*)\>/', $item);

            if ($isVar && isset($explodedUri[$key])) {
                $this->vars[] = $explodedUri[$key];
                continue;
            }

            if ($item !== $explodedUri[$key]) {
                return false;
            }
        }

        return true;
    }

    public function getVars(): array
    {
        return $this->vars;
    }

    public function getHandler(): string
    {
        return $this->handler;
    }
}
