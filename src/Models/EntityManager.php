<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Interfaces\Entity;
use App\Core\Interfaces\EntityManagerInterface;

final class EntityManager implements EntityManagerInterface
{
    public function flush(Entity $entity): void
    {
        // TODO: Implement flush() method.
    }

    public function remove(Entity $entity): void
    {
        // TODO: Implement remove() method.
    }

    public function update(Entity $entity): void
    {
        // TODO: Implement update() method.
    }
}
