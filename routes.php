<?php

use Controllers\HomeController;
use Controllers\AuthController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'register']);

$router->post('/login', [AuthController::class, 'loginSubmit']);
$router->post('/register', [AuthController::class, 'registerSubmit']);