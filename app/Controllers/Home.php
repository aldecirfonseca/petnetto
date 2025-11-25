<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {
        helper("utilits");
    }

    public function index(): string
    {
        return view("home");
    }

    // public function sobrenos()
    // {
    //     return view("sobrenos");
    // }

    public function veterinarios()
    {
        return view("veterinarios");
    }

    public function servicos()
    {
        return view("servicos");
    }

    public function precos()
    {
        return view("precos");
    }

    public function blog()
    {
        return view("blog");
    }

    public function contato()
    {        
        return view("blog");
    }

    public function login()
    {
        return view("login");
    }
}
