<?php

declare(strict_types=1);

namespace App\Controller\Interfaces\Rest;

use App\Core\Http\Response;

interface View
{
    public function view(string $id): Response;
}
