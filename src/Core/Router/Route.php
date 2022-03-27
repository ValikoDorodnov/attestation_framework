<?php

declare(strict_types=1);

namespace App\Core\Router;

final class Route
{
    private const PARAMS_REGEXP = '/\<([^\]]*)\>/';

    private string $path;
    private string $handler;

    private array $vars = [];

    public function __construct(string $path, string $handler)
    {
        $this->path = $path;
        $this->handler = $handler;
    }

    public function validateRouteByPath(string $uri): bool
    {
        $explodedUri = explode('/', $uri);
        $explodedPath = explode('/', $this->path);

        foreach ($explodedUri as $key => $item) {

            if (!isset($explodedPath[$key])) {
                return false;
            }

            if ($this->isContainsVars($explodedPath[$key])) {
                continue;
            }

            if ($explodedPath[$key] !== $item) {
                return false;
            }
        }

        return true;
    }

    public function prepareVars(string $uri): void
    {
        $explodedUri = explode('/', $uri);
        $explodedPath = explode('/', $this->path);

        foreach ($explodedUri as $key => $item) {
            if ($this->isContainsVars($explodedPath[$key])) {
                $this->vars[] = $item;
            }
        }
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getVars(): array
    {
        return $this->vars;
    }

    public function getHandler(): string
    {
        return $this->handler;
    }

    private function isContainsVars(string $uri): bool
    {
        return (bool)preg_match(self::PARAMS_REGEXP, $uri);
    }
}
