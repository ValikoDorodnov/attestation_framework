<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Core\Http\StatusCode;
use GuzzleHttp\Exception\GuzzleException;
use Tests\Support\FeatureTestCase;

final class NotFoundRouteTest extends FeatureTestCase
{
    public function testGet(): void
    {
        try {
            $request = $this->http->request('GET', '/some-route');
            $code = $request->getStatusCode();
        } catch (GuzzleException $e) {
            $code = $e->getCode();
        }

        $this->assertEquals(StatusCode::NOT_FOUND, $code);
    }
}
