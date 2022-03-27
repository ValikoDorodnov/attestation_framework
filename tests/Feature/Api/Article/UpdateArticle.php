<?php

declare(strict_types=1);

use App\Core\Http\StatusCode;
use Tests\Support\FeatureTestCase;
use GuzzleHttp\Exception\GuzzleException;

final class UpdateArticle extends FeatureTestCase
{
    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testUpdate(): void
    {
        $response = $this->http->put('/api/articles/article-1', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'name' => 'article new name',
                'text' => 'text best'
            ], JSON_THROW_ON_ERROR)
        ]);

        $this->assertEquals(StatusCode::FOUND, $response->getStatusCode());
        $this->assertSame('{"id":"article-1","name":"article new name","text":"text best"}', $response->getBody()->getContents());
    }
}
