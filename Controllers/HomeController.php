<?php

namespace Controllers;

class HomeController extends Controller
{
    public function index()
    {
        view('home.view.php', ['title' => 'Home Page']);
    }
}