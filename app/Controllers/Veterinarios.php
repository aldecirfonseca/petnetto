<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VeterinariosModel;

class Veterinarios extends BaseController
{
    public function __construct()
    {
        $this->model = new VeterinariosModel();
        helper("veterinarios");
    }

    public function index()
    {
        $veterinarios = $this->model->getLista();

        $this->dados["data"] = $veterinarios;
        return view("veterinarios", $this->dados);
    }

    /**
     * form
     *
     * @param integer $id 
     * @param string $action 
     * @return void
     */
    public function form($action, $id = 0)
    {
        $this->dados["action"]  = $action;

        if ($action != "new") {
            $this->dados["data"] = $this->model->getById($id);
        }

        return view("admin/formVeterinarios", $this->dados);
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $post = $this->request->getPost();

        $dados = [
            "id"            => $post["id"],
            "nome"          => $post["nome"],
            "especialidade" => $post["especialidade"],
            "biografia"     => $post["biografia"],
            "facebook" => $post["facebook"],
            "twitter" => $post["twitter"],
            "instagram" => $post["instagram"],
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $nomeFoto = $foto->getRandomName();
            $foto->move('uploads/veterinarios', $nomeFoto);
            $dados['foto'] = $nomeFoto;
        }

        if ($this->model->save($dados)) {
            return redirect()->to('/Veterinarios')->with('msgSucess', 'Veterinário salvo com sucesso!');
        }

        return view('admin/formVeterinarios', [
            'action' => $post['action'],
            'data'   => $post,
            'errors' => $this->model->errors()
        ]);
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        if ($this->model->delete($this->request->getPost('id')) ) {
			return redirect()->to('/Uf')->with('msgSucess', 'Dados Excluídos com Sucesso.');

		} else {
			return redirect()->to('/Uf')->with('msgError', 'Erro ao Tentar Exluir Dados.');
		}
    }

}