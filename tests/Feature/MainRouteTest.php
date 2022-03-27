<?php

namespace Tests\Feature;

use App\Core\Http\StatusCode;
use Tests\Support\FeatureTestCase;

class MainRouteTest extends FeatureTestCase
{
    public function testGet(): void
    {
        $response = $this->http->request('GET', '/');
        $this->assertEquals(StatusCode::FOUND, $response->getStatusCode());
    }
}
