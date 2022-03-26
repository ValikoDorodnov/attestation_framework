<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Router\Dispatcher;

final class Application
{
    public function __construct(private Dispatcher $dispatcher)
    {
    }

    public function run(): void
    {
        $this->dispatcher->dispatch();
    }
}
