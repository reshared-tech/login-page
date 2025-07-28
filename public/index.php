<?php

session_start();

define('ROOT', (dirname(__DIR__)));
require ROOT . '/Core/functions.php';
spl_autoload_register(function ($class) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path($path . '.php');
});

try {
    $router = new \Core\Router;

    require base_path('routes.php');

    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

    $uri = str_replace('/index.php', '', $uri);

    $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    
    $router->route($uri, $method);
} catch(Exception | Throwable $e) {
    dd($e->getMessage());

    view('500.view.php');
}