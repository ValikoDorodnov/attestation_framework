<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Core\Http\StatusCode;
use Tests\Support\FeatureTestCase;
use GuzzleHttp\Exception\GuzzleException;

final class WrongHttpMethodTest extends FeatureTestCase
{
    public function testPostQuery(): void
    {
        try {
            $response = $this->http->post('/');
            $code = $response->getStatusCode();
        } catch (GuzzleException $e) {
            $code = $e->getCode();
        }

        $this->assertEquals(StatusCode::METHOD_NOT_ALLOWED, $code);
    }
}
