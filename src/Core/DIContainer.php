<?php

declare(strict_types=1);

namespace App\Core;

final class DIContainer
{
    private array $classes = [];

    public function __construct(array $dependencies)
    {
        foreach ($dependencies as $name => $classes) {
            $initialized = [];
            foreach ($classes as $class) {
                $initialized[] = new $class();
            }

            $this->classes[$name] = new $name(...$initialized);
        }
    }

    public function getClassByName(string $name): ?object
    {
        return $this->classes[$name] ?? null;
    }
}
