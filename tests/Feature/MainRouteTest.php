<?php

namespace Tests\Feature;

use Tests\Support\FeatureTestCase;

class MainRouteTest extends FeatureTestCase
{
    public function testGet(): void
    {
        $response = $this->http->request('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
