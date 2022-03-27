<?php

declare(strict_types=1);

use App\Core\Http\StatusCode;
use Tests\Support\FeatureTestCase;
use GuzzleHttp\Exception\GuzzleException;

final class DeleteArticle extends FeatureTestCase
{
    /**
     * @throws GuzzleException
     */
    public function testUpdate(): void
    {
        $response = $this->http->delete('/api/articles/article-1', [
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $this->assertEquals(StatusCode::FOUND, $response->getStatusCode());
        $this->assertSame('{"id":"article-1"}', $response->getBody()->getContents());
    }
}