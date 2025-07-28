<?php

use Core\App;

function dd($value) 
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    exit;
}

function base_path($path) 
{
    return ROOT . DIRECTORY_SEPARATOR . ltrim($path, '/');
}

function view($path, $attributes = []) 
{
    extract($attributes);

    require base_path('views/' . ltrim($path, '/'));
}

function abort($statusCode = 404) 
{
    http_response_code($statusCode);

    view("$statusCode.view.php");

    exit;
}

function nameIsValid($name) 
{
    if (strlen($name) > 255) {
        error('name', 'Your name must be less than 255 characters.');
        return false;
    }
    return true;
}

function emailAddressIsValid($address) 
{
    if (strlen($address) > 255) {
        error('email', 'Sry, your email must be less then 255 characters.');
        return false;
    }

    if (! preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $address)) {
        error('email', 'Please input a valid email address like \'example@example.com\'');
        return false;
    }
    
    return true;
}

function passwordIsValid($password) 
{
    // check length
    if (strlen($password) < 6) {
        error('password', 'The password field must be at least 6 characters.');
        return false;
    }

    if (strlen($password) > 200) {
        error('password', 'The password field must be less then 200 characters.');
        return false;
    }

    // let just check the length when testing
    return true;

    // check complex
    if (!preg_match('/[A-Z]/', $password)) {
        error('password', 'The password field must contain at least one capital letter.');
        return false;
    }
    if (!preg_match('/[a-z]/', $password)) {
        error('password', 'The password field should contain at least one lowercase letter.');
        return false;
    }
    if (!preg_match('/[\W_]/', $password)) {
        $errors[] = "The password field must contain at least one special character.";
    }
    return true;
}

function redirectBack($backup = '/')
 {
    oldData();

    $uri = $_SERVER['HTTP_REFERER'] ?: $backup;

    header('Location: ' . $uri);
    
    exit;
}

function error($key, $msg = '') 
{
    if (empty($msg)) {
        if (isset($_SESSION['errors'][$key])) {
            $val = $_SESSION['errors'][$key];
            unset($_SESSION['errors'][$key]);
            return $val;
        }

        return '';
    }
    
    $_SESSION['errors'][$key] = $msg;
}

function oldData($key = '') 
{
    if (empty($key)) {
        $_SESSION['old_data'] = $_POST;
        return;
    }
    
    if (isset($_SESSION['old_data'][$key])) {
        $val = $_SESSION['old_data'][$key];
        unset($_SESSION['old_data'][$key]);
        return $val;
    }

    return '';
}

function cleanErrors() 
{
    $_SESSION['errors'] = [];
}

function hasErrors() 
{
    return !empty($_SESSION['errors']);
}

function isGet() 
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function isPost() 
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function isAuthorized()
{
    return ! empty($_SESSION['authorized']['id']);
}

function user($key = '') {
    if ($key) {
        return $_SESSION['authorized'][$key] ?? '';
    }
    
    return $_SESSION['authorized'];
}

function setAuthorized($user) 
{
    $_SESSION['authorized'] = $user;
}

function destoryAuthor() 
{
    unset($_SESSION['authorized']);
}

function app($key, $val = null)
{
    if (is_null($val)) {
        return App::resolve($key);
    }

    App::bind($key, $val);
}