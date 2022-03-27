<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Http\Response;

final class SiteController
{
    public function index(): Response
    {
        return new Response('hello from framework!');
    }
}
