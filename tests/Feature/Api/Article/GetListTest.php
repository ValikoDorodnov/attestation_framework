<?php

declare(strict_types=1);

use App\Core\Http\StatusCode;
use Tests\Support\FeatureTestCase;

final class GetListTest extends FeatureTestCase
{
    public function testGet(): void
    {
        $response = $this->http->request('GET', '/api/articles');
        $this->assertEquals(StatusCode::FOUND, $response->getStatusCode());
        $articles = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertCount(3, $articles);
    }
}
