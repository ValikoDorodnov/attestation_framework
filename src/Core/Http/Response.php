<?php

declare(strict_types=1);

namespace App\Core\Http;

use JsonException;

final class Response
{
    private string $data;
    private int $statusCode;

    /**
     * @param mixed $responseData
     * @param int $statusCode
     * @throws JsonException
     */
    public function __construct(mixed $responseData, int $statusCode = StatusCode::FOUND)
    {
        if (is_array($responseData) || is_object($responseData)) {
            $responseData = json_encode($responseData, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
        }

        $this->data = (string) $responseData;
        $this->statusCode = $statusCode;
    }

    public function __invoke(): void
    {
        echo $this->data;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
