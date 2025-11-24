<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicosModel;

class Servicos extends BaseController
{
    public function __construct()
    {
        $this->model = new ServicosModel();
        helper("servicos");
    }

    public function index()
    {
        $this->dados["data"] = $this->model->getLista();

        return view('admin/listaServicos', $this->dados);
    }

    public function form($action, $id = 0)
    {
        $this->dados["action"]  = $action;

        if ($action != "new") {
            $this->dados["data"] = $this->model->getById($id);
        }

        return view('admin/formServicos', $this->dados);
    }

    public function store()
    {
        $post = $this->request->getPost();

        // Busca dados ATUAIS do banco
        $id = $post['id'] ?? null;
        $servicoAtual = $id ? $this->model->find($id) : null;
        $imagemAtual = $servicoAtual['img'] ?? '';

        $data = $post;

        // 1. REMOVER IMAGEM ATUAL
        if (isset($post['remover_img']) && $post['remover_img'] == '1') {
            if (!empty($imagemAtual)) {
                $oldImagePath = WRITEPATH . '../public/' . $imagemAtual;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $data['img'] = null;
        }
        // 2. NOVA IMAGEM
        elseif ($imgFile = $this->request->getFile('img')) {
            if ($imgFile->isValid() && !$imgFile->hasMoved()) {
                // Deleta antiga
                if (!empty($imagemAtual)) {
                    $oldImagePath = WRITEPATH . '../public/' . $imagemAtual;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $newName = $imgFile->getRandomName();
                $imgFile->move(WRITEPATH . '../public/uploads/servicos/', $newName);
                $data['img'] = 'uploads/servicos/' . $newName;
            }
        }
        // 3. MANTER ATUAL
        else {
            $data['img'] = $imagemAtual;
        }

        if ($this->model->save($data)) {
            return redirect()->to('Servico')->with('msgSucess', 'Serviço salvo com sucesso!');
        } else {
            return view('admin/formServicos', [
                'action' => $post['action'],
                'data'   => $post + ['img' => $imagemAtual],
                'errors' => $this->model->errors()
            ]);
        }
    }


    public function delete()
    {
        $id = $this->request->getPost('id');

        // 1. BUSCA o registro para pegar o caminho da imagem
        $servico = $this->model->find($id);

        // 2. DELETA a imagem física SE existir
        if ($servico && !empty($servico['img'])) {
            $imagePath = WRITEPATH . '../public/' . $servico['img'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // 3. DELETA o registro do banco
        if ($this->model->delete($id)) {
            return redirect()->to('Servico')->with('msgSucess', 'Serviço excluído com sucesso.');
        } else {
            return redirect()->to('Servico')->with('msgError', 'Erro ao tentar excluir serviço.');
        }
    }
}
