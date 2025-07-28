<?php

if (isGet()) {
    view('views/register.view.php', ['title' => 'Register']);

    return;
}

// when submit the form
if (isPost()) {
    cleanErrors();

    // Filter Spaces
    $_POST['name'] = trim($_POST['name']);
    $_POST['email'] = trim($_POST['email']);
    $_POST['password'] = trim($_POST['password']);

    // check params is not empty
    if (empty($_POST['name'])) {
        error('name', 'Please input your name');
    }
    if (empty($_POST['email'])) {
        error('email', 'Please input your email address');
    }
    if (empty($_POST['password'])) {
        error('password', 'Please input your password');
    }

    // if params is not valid, just return back and show errors
    if (hasErrors()) {
        redirectBack();
    }

    // Verify whether the user's email address and password is valid
    if (! emailAddressIsValid($_POST['email']) || ! passwordIsValid($_POST['password'])) {
        redirectBack();
    }

    // check passed, will insert user info to database
    $config = require ROOT . '/config.php';
    $db = new Database($config['database']);

    $db->query('INSERT INTO `users`(`name`, `email`, `password`) VALUES(:name, :email, :passwrod)', [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ]);


    redirectBack();

    return;
}
