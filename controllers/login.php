<?php

// when it is view the login page
if (isGet()) {
    // if the user had logined redirecd back, default url is /
    if (isAuthorized()) {
        redirectBack();
    }

    view('login.view.php', ['title' => 'Login Page']);
    
    return;
}


// when submit the form
if (isPost()) {
    require ROOT . '/validator.php';
    
    $_SESSION['errors'] = [];

    // Filter Spaces
    $_POST['email'] = trim($_POST['email']);
    $_POST['password'] = trim($_POST['password']);

    // check params is not empty
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

    // check passed, will select user from database
    $config = require ROOT . '/config.php';
    $db = new Database($config['database']);

    $user = $db->query('SELECT * FROM `users` WHERE `email` = :email', [
        'email' => $_POST['email'],
    ])->find();

    // if the recored is not exists
    if (empty($user) || ! password_verify($_POST['password'], $user['password'])) {
        // login failed
        // may be we should increment failed times to limit retry
        error('email', 'These credentials do not match our records.');
        return;
    }

    // if user exists and password check passwd, set the session
    setAuthorized($user);

    redirectBack();

    return;
}




// other method is invalid
abort();