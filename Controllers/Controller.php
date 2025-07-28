<?php

namespace Controllers;

abstract class Controller
{
    protected function redirectBack($default = '/')
    {
        oldData();

        $this->redirect($_SERVER['HTTP_REFERER'] ?: $default);
    }

    protected function redirect($uri) 
    {
        header('Location: ' . $uri);
        
        exit;
    }
}