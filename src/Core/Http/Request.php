<?php

declare(strict_types=1);

namespace App\Core\Http;

final class Request
{
    private array $post;
    private string $httpMethod;
    private string $uri;

    public function __construct()
    {
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->uri = $this->getUri();

        $data = $_POST ?? [];
        if (in_array($this->httpMethod, ['POST', 'PUT'])) {
            $contents = file_get_contents('php://input');
            if ($contents) {
                $data = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
            }
        }

        $this->post = $data;
    }

    public function bodyParams(): array
    {
        return $this->post;
    }

    public function requestedUri(): string
    {
        return $this->uri;
    }

    public function method(): string
    {
        return $this->httpMethod;
    }

    private function getUri(): string
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        return rawurldecode($uri);
    }
}
