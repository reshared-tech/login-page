<?php

$routes = require(ROOT . '/routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = '/' . ltrim($uri, '/index.php');

if (array_key_exists($uri, $routes)) {
    require base_path($routes[$uri]);
} else {
    abort();
}