<?php

declare(strict_types=1);

namespace App\Models\Article;

use App\Core\Interfaces\Entity;

final class ArticleEntity implements Entity
{
    public function __construct(
        public string $id,
        public string $name,
        public string $text
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }
}
