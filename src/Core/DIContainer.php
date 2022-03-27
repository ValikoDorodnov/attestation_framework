<?php

declare(strict_types=1);

namespace App\Core;

final class DIContainer
{
    private array $dependencies = [];

    public function __construct(array $dependencies)
    {
        foreach ($dependencies as $name => $classes) {
            $initialized = [];
            foreach ($classes as $class) {
                $initialized[] = new $class();
            }

            $this->dependencies[$name] = new $name(...$initialized);
        }
    }

    public function getDependencyByName(string $name): ?object
    {
        return $this->dependencies[$name] ?? null;
    }
}
