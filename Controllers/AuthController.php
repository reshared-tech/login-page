<?php

namespace Controllers;

use Core\App;
use Core\Database;

class AuthController extends Controller
{
    public function login()
    {
        if (isAuthorized()) {
            $this->redirectBack();
        }

        view('login.view.php', ['title' => 'Login Page']);
    }

    public function register()
    {
        view('register.view.php', ['title' => 'Register']);
    }

    public function loginSubmit()
    {
        cleanErrors();

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
        $db = App::resolve(Database::class);

        $user = $db->query('SELECT * FROM `users` WHERE `email` = :email', [
            'email' => $_POST['email'],
        ])->find();

        // if the recored is not exists
        if (empty($user)) {
            // login failed
            // may be we should increment failed times to limit retry
            error('email', 'These credentials do not exists.');
            return;
        }

        if (! password_verify($_POST['password'], $user['password'])) {
            error('email', 'These credentials do not match our records.');
            return;
        }

        // if user exists and password check passwd, set the session
        setAuthorized($user);

        redirectBack();
    }

    public function registerSubmit()
    {
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
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO `users`(`name`, `email`, `password`) VALUES(:name, :email, :passwrod)', [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ]);


        redirectBack();
    }
}