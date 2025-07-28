<?php

use Core\App;
use \Core\Error;
use Core\Container;
use Core\Database;

App::setController(new Container);

app(Database::class, function() {
    $config = require base_path('config.php');

    return new Database($config['database']);
});

app(Error::class, function () {
    return new \Core\Error();
});