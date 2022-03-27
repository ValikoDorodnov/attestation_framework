<?php

declare(strict_types=1);

namespace App\Controller\Interfaces\Rest;

use App\Core\Http\Response;

interface Update
{
    public function update(string $id): Response;
}
