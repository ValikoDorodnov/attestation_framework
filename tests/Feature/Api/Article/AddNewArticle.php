<?php

declare(strict_types=1);

use App\Core\Http\StatusCode;
use Tests\Support\FeatureTestCase;
use GuzzleHttp\Exception\GuzzleException;

final class AddNewArticle extends FeatureTestCase
{
    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testAdd(): void
    {
        $response = $this->http->post('/api/articles', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'id'   => 'article-4',
                'name' => 'article 4',
                'text' => 'text text'
            ], JSON_THROW_ON_ERROR)
        ]);

        $this->assertEquals(StatusCode::FOUND, $response->getStatusCode());
        $this->assertSame('{"id":"article-4"}', $response->getBody()->getContents());
    }
}
