<?php

define('ROOT', (dirname(__DIR__)));

session_start();

require ROOT . '/functions.php';

try {
    require base_path('database.php');
    require base_path('router.php');
} catch(Error | Throwable $e) {
    echo $e->getMessage();
    exit;
    require ROOT . '/views/500.view.php';
}