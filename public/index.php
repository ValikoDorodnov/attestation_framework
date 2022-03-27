<?php

use App\Core\DIContainer;
use App\Core\Http\Request;
use App\Core\Router\Dispatcher;
use App\Core\Router\RouteCollector;

require __DIR__ . '/../vendor/autoload.php';

$routes = require __DIR__ . '/../config/routes.php';
$dependencies = require __DIR__ . '/../config/dependencies.php';

$diContainer = new DIContainer($dependencies);
$collector = new RouteCollector($routes);
$request = new Request();

$dispatcher = new Dispatcher($collector, $diContainer, $request);

(new App\Core\Application($dispatcher))->run();
