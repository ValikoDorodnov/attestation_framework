<?php

use App\Core\DIContainer;
use App\Core\Http\Request;
use App\Core\Router\Dispatcher;
use App\Core\Router\RouteCollector;

require __DIR__ . '/../vendor/autoload.php';

$routes = require __DIR__ . '/../config/routes.php';
$services = require __DIR__ . '/../config/services.php';

$diContainer = new DIContainer($services);
$collector = new RouteCollector($routes);
$request = new Request();

$dispatcher = new Dispatcher($collector, $diContainer, $request);

(new App\Core\Application($dispatcher))->run();
