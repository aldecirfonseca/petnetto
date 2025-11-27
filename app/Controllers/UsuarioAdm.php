<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class UsuarioAdm extends BaseController
{
    public function __construct()
    {
        $this->model = new UsuarioModel();
        helper("utilits");
    }

    public function index()
    {
        $this->dados["data"] = $this->model->getLista();

        return view("admin/listaUsuario", $this->dados);
    }

    public function form($action, $id = 0)
    {
        $this->dados["action"] = $action;

        if ($action !== "new") {
            $this->dados["data"] = $this->model->getById($id);
        }

        return view("admin/formUsuario", $this->dados);
    }

    public function store()
    {
        $post = $this->request->getPost();

        // Não deixa alterar senha no admin
        $dadosSalvar = [
            "id"     => $post['id'],
            "nome"   => $post['nome'],
            "email"  => $post['email'],
            "nivel"  => $post['nivel'],
            "status" => $post['status'],
        ];

        if ($this->model->save($dadosSalvar)) {
            return redirect()->to('/UsuarioAdm')->with('msgSucess', 'Usuário salvo com sucesso!');
        } else {
            return view('admin/formUsuario', [
                'action' => $post['action'],
                'data'   => $post,
                'errors' => $this->model->errors()
            ]);
        }
    }

    public function delete()
    {
        if ($this->model->delete($this->request->getPost('id'))) {
            return redirect()->to('/UsuarioAdm')->with('msgSucess', 'Usuário excluído com sucesso!');
        } else {
            return redirect()->to('/UsuarioAdm')->with('msgError', 'Erro ao excluir usuário.');
        }
    }
}
