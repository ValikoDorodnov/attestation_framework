<?php

declare(strict_types=1);

namespace App\Core\Http;

use JsonException;

final class Response
{
    private string $data;

    /**
     * @param mixed $responseData
     * @throws JsonException
     */
    public function __construct(mixed $responseData)
    {
        if (is_array($responseData) || is_object($responseData)) {
            $responseData = json_encode($responseData, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
        }

        $this->data = (string) $responseData;
    }

    public function __invoke(): void
    {
        echo $this->data;
    }
}
