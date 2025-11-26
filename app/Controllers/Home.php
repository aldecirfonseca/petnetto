<?php

namespace App\Controllers;

use App\Models\ServicosModel;

class Home extends BaseController
{
    public function __construct()
    {
        helper("utilits");
    }

    public function index(): string
    {
        $servicosModel = new ServicosModel();
        $data = $servicosModel->where('statusRegistro', 1)->findAll();

        return view("home", ['servicosAtivos' => $data]);
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
        $servicosModel = new ServicosModel();
        $data = $servicosModel->where('statusRegistro', 1)->findAll();
        return view("servicos", ['servicosAtivos' => $data]);
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
        return view("contato");
    }

    public function login()
    {
        return view("login");
    }

    public function criarNovaConta()
    {
        return view("criarNovaConta");
    }
}
