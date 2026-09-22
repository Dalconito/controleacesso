<?php

require_once __DIR__ . '/../src/Router.php';

$router = new Router();

$webRoutes = require __DIR__ . '/../routes/web.php';
$apiRoutes = require __DIR__ . '/../routes/api.php';

$routes = array_merge($webRoutes, $apiRoutes);

foreach ($routes as $route => $file) {
    [$method, $path] = explode(' ', $route, 2);

    $router->add($method, $path, $file);
}

$router->dispatch();
