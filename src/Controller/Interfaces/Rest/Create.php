<?php

declare(strict_types=1);

namespace App\Controller\Interfaces\Rest;

use App\Core\Http\Response;

interface Create
{
    public function create(): Response;
}
