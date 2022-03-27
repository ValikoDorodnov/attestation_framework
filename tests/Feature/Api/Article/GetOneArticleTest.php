<?php

declare(strict_types=1);

use App\Core\Http\StatusCode;
use Tests\Support\FeatureTestCase;

final class GetOneArticleTest extends FeatureTestCase
{
    public function testGet(): void
    {
        $response = $this->http->request('GET', '/api/articles/article-1');
        $this->assertEquals(StatusCode::FOUND, $response->getStatusCode());
        $this->assertSame(
            '{"id":"article-1","name":"Статья 1","text":"Текст 1"}', $response->getBody()->getContents()
        );
    }
}
