<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SobreNosModel;

class SobreNos extends BaseController
{
    public function __construct()
    {
        $this->model = new SobreNosModel();
    }

    public function listaSobreNos()
    {
        $this->dados["data"] = $this->model->findAll();

        return view("admin/listaSobreNos", $this->dados); 
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
        $this->dados["action"] = $action;

        if ($action != "new") {
            $this->dados["data"] = $this->model->find($id);
        }

        return view("admin/formSobreNos", $this->dados);
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $post = $this->request->getPost();

        // Preparar dados para salvar
        $dados = [
            "id"                => $post['id'],
            "title"             => $post['title'],
            "short_description" => $post['short_description'],
            "long_description"  => $post['long_description'],
            "valores_empresa"   => $post['valores_empresa'] ?? null,
            "status"            => $post['status'] ?? 0
        ];

        // Upload da imagem do slogan
        $imageSlogan = $this->request->getFile('image_slogan_file');
        if ($imageSlogan && $imageSlogan->isValid() && !$imageSlogan->hasMoved()) {
            $newName = $imageSlogan->getRandomName();
            $imageSlogan->move(ROOTPATH . 'public/uploads/sobrenos', $newName);
            $dados['image_slogan'] = 'uploads/sobrenos/' . $newName;
        } elseif (!empty($post['image_slogan_url'])) {
            $dados['image_slogan'] = $post['image_slogan_url'];
        } elseif (!empty($post['image_slogan'])) {
            $dados['image_slogan'] = $post['image_slogan'];
        }

        // Upload da imagem da página
        $imagePage = $this->request->getFile('image_page_file');
        if ($imagePage && $imagePage->isValid() && !$imagePage->hasMoved()) {
            $newName = $imagePage->getRandomName();
            $imagePage->move(ROOTPATH . 'public/uploads/sobrenos', $newName);
            $dados['image_page'] = 'uploads/sobrenos/' . $newName;
        } elseif (!empty($post['image_page_url'])) {
            $dados['image_page'] = $post['image_page_url'];
        } elseif (!empty($post['image_page'])) {
            $dados['image_page'] = $post['image_page'];
        }

        if ($this->model->save($dados)) {

            return redirect()->to('/SobreNos')->with('msgSucess', 'Dados Atualizados com Sucesso!');

        } else {

            return view('admin/formSobreNos', [
                'action' => $post['action'],
                'data'   => $post,
                'errors' => $this->model->errors()
            ]);

        }
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        if ($this->model->delete($this->request->getPost('id'))) {
            return redirect()->to('/SobreNos')->with('msgSucess', 'Dados Excluídos com Sucesso.');

        } else {
            return redirect()->to('/SobreNos')->with('msgError', 'Erro ao Tentar Excluir Dados.');
        }
    }

    /**
     * exibeSobreNos - Exibe a página pública
     *
     * @return void
     */
    public function exibeSobreNos()
    {
        // Busca o único registro ativo
        $data = $this->model->where('status', 1)->first();
        if (!$data) {
            $data = [
                'title' => 'Sobre nós',
                'short_description' => '',
                'long_description' => '',
                'image_slogan' => '',
                'image_page' => '',
            ];
        }
        return view("sobrenos", ['data' => $data]);
    }
}