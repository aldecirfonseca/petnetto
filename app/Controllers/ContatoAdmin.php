<?php

namespace App\Controllers;

use App\Models\ContatoModel;

/**
 * Controller Administrativo de Contatos
 * 
 * Gerencia o histórico de mensagens recebidas na área administrativa.
 * Responsável por:
 * - Listar todas as mensagens
 * - Visualizar mensagem individual
 * - Marcar como lida/não lida
 * - Deletar mensagens
 */
class ContatoAdmin extends BaseController
{
    protected $contatoModel;

    public function __construct()
    {
        $this->contatoModel = new ContatoModel();
        helper(['form', 'url']);
    }

    /**
     * Lista todas as mensagens de contato
     * 
     * @return string
     */
    public function index()
    {
        $this->dados['titulo'] = 'Mensagens de Contato';
        $this->dados['data'] = $this->contatoModel->getLista([], 'created_at DESC');
        $this->dados['naoLidas'] = $this->contatoModel->contarNaoLidas();

        return view('admin/contatos/lista', $this->dados);
    }

    /**
     * Visualiza uma mensagem específica
     * 
     * Ao visualizar, marca automaticamente como lida
     * 
     * @param int $id
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function visualizar($id)
    {
        $contato = $this->contatoModel->find($id);

        if (!$contato) {
            return redirect()->to('/admin/contatos')
                           ->with('msgError', 'Mensagem não encontrada.');
        }

        // Marca como lida ao visualizar
        if ($contato['lida'] == 0) {
            $this->contatoModel->marcarComoLida($id);
            // Atualiza o array para exibir corretamente
            $contato['lida'] = 1;
        }

        $this->dados['titulo'] = 'Visualizar Mensagem';
        $this->dados['data'] = $contato;

        return view('admin/contatos/visualizar', $this->dados);
    }

    /**
     * Alterna o status de lida/não lida de uma mensagem
     * 
     * @param int $id
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function toggleLida($id)
    {
        $contato = $this->contatoModel->find($id);

        if (!$contato) {
            return redirect()->to('/admin/contatos')
                           ->with('msgError', 'Mensagem não encontrada.');
        }

        // Alterna o status
        if ($contato['lida'] == 1) {
            $this->contatoModel->marcarComoNaoLida($id);
            $mensagem = 'Mensagem marcada como não lida.';
        } else {
            $this->contatoModel->marcarComoLida($id);
            $mensagem = 'Mensagem marcada como lida.';
        }

        return redirect()->to('/admin/contatos')
                       ->with('msgSucess', $mensagem);
    }

    /**
     * Deleta uma mensagem (soft delete)
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete()
    {
        $id = $this->request->getPost('id');

        if ($this->contatoModel->delete($id)) {
            return redirect()->to('/admin/contatos')
                           ->with('msgSucess', 'Mensagem excluída com sucesso.');
        } else {
            return redirect()->to('/admin/contatos')
                           ->with('msgError', 'Erro ao excluir mensagem.');
        }
    }
}
