<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model de Contatos
 * 
 * Gerencia o histórico de mensagens recebidas através do
 * formulário de contato do site Pet Netto.
 */
class ContatoModel extends BaseModel
{
    protected $table            = 'contatos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nome',
        'email',
        'assunto',
        'mensagem',
        'ip',
        'lida'
    ];

    // Timestamps
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation - Regras de validação
    protected $validationRules = [
        'nome' => [
            'label' => 'Nome',
            'rules' => 'required|min_length[3]|max_length[255]'
        ],
        'email' => [
            'label' => 'E-mail',
            'rules' => 'required|valid_email|max_length[255]'
        ],
        'assunto' => [
            'label' => 'Assunto',
            'rules' => 'required|min_length[3]|max_length[255]'
        ],
        'mensagem' => [
            'label' => 'Mensagem',
            'rules' => 'required|min_length[10]'
        ]
    ];

    /**
     * Marca uma mensagem como lida
     * 
     * @param int $id
     * @return bool
     */
    public function marcarComoLida($id)
    {
        return $this->update($id, ['lida' => 1]);
    }

    /**
     * Marca uma mensagem como não lida
     * 
     * @param int $id
     * @return bool
     */
    public function marcarComoNaoLida($id)
    {
        return $this->update($id, ['lida' => 0]);
    }

    /**
     * Retorna todas as mensagens não lidas
     * 
     * @return array
     */
    public function getMensagensNaoLidas()
    {
        return $this->where('lida', 0)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Retorna a contagem de mensagens não lidas
     * 
     * @return int
     */
    public function contarNaoLidas()
    {
        return $this->where('lida', 0)->countAllResults();
    }
}
