<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        //return view('welcome_message');
        return view(
            "home", 
            [
                "titulo" => "Seja bem vindo(a).",
                "dataHora" => date("d/m/Y H:i:s")
            ]
        );
    }

    public function login()
    {
        return view("login");
    }

    public function faleConosco()
    {
        echo "Fale conosco.";
    }

    public function produtoDetalhes($id, $acao)
    {
        echo "Produto: " . $id;
        echo "<br />Ação: " . $acao;
    }
}
