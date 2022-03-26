<?php

namespace Tests\Support;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

abstract class FeatureTestCase extends TestCase
{
    protected ?Client $http;

    protected function setUp(): void
    {
        $this->http = new Client(['base_uri' => 'http://nginx']);
    }

    protected function tearDown(): void
    {
        $this->http = null;
    }
}
