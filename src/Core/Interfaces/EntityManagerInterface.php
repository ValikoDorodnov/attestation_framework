<?php

declare(strict_types=1);

namespace App\Core\Interfaces;

interface EntityManagerInterface
{
    public function flush(Entity $entity): void;

    public function remove(Entity $entity): void;

    public function update(Entity $entity): void;
}
