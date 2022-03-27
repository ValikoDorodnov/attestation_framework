<?php

declare(strict_types=1);

namespace App\Controller\Base;

abstract class WebController
{
    public function render(string $path, array $args = []): bool|string
    {
        extract($args, EXTR_OVERWRITE);
        ob_start();
        include( __DIR__ . '/../../Views/' . $path . '.php');
        return ob_get_clean();
    }
}
