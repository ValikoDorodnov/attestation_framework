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

    public function product($id): Response
    {
        $products = [
            1 => 'product one',
            2 => 'product two',
        ];

        return new Response($products[$id] ?? 'no product');
    }
}
