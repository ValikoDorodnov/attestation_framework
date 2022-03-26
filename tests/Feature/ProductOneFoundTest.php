<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\Support\FeatureTestCase;

final class ProductOneFoundTest extends FeatureTestCase
{
    public function testGet(): void
    {
        $response = $this->http->request('GET', '/product/1');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('product one', $response->getBody()->getContents());
    }
}
