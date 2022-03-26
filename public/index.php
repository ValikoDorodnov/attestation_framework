<?php

use App\Core\Router\Dispatcher;
use App\Core\Router\RouteCollection;

require __DIR__ . '/../vendor/autoload.php';

$routes = require __DIR__ . '/../config/routes.php';

$routeCollection = new RouteCollection($routes);
$dispatcher = new Dispatcher($routeCollection);

(new App\Core\Application($dispatcher))->run();
