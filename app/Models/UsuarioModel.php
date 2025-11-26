<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model de Usuários
 * 
 * Gerencia os usuários administradores do sistema.
 * Inclui métodos para autenticação e recuperação de senha.
 */
class UsuarioModel extends BaseModel
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nome',
        'email',
        'senha',
        'ativo',
        'token_recuperacao',
        'token_expiracao'
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
            'rules' => 'required|valid_email|max_length[255]|is_unique[usuarios.email,id,{id}]'
        ],
        'senha' => [
            'label' => 'Senha',
            'rules' => 'permit_empty|min_length[6]'
        ]
    ];

    // Callbacks - Executa antes de inserir
    protected $beforeInsert = ['hashSenha'];
    protected $beforeUpdate = ['hashSenha'];

    /**
     * Criptografa a senha antes de salvar no banco
     * 
     * @param array $data
     * @return array
     */
    protected function hashSenha(array $data)
    {
        if (isset($data['data']['senha']) && !empty($data['data']['senha'])) {
            $data['data']['senha'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);
        } else {
            // Se a senha estiver vazia no update, remove do array
            unset($data['data']['senha']);
        }
        return $data;
    }

    /**
     * Verifica as credenciais do usuário
     * 
     * @param string $email
     * @param string $senha
     * @return array|false
     */
    public function verificarCredenciais($email, $senha)
    {
        $usuario = $this->where('email', $email)
                        ->where('ativo', 1)
                        ->first();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Remove a senha do array de retorno
            unset($usuario['senha']);
            return $usuario;
        }

        return false;
    }

    /**
     * Gera token para recuperação de senha
     * 
     * @param string $email
     * @return string|false
     */
    public function gerarTokenRecuperacao($email)
    {
        $usuario = $this->where('email', $email)->first();

        if (!$usuario) {
            return false;
        }

        // Gera token único
        $token = bin2hex(random_bytes(32));
        
        // Define expiração para 1 hora
        $expiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Atualiza o usuário com o token
        $this->update($usuario['id'], [
            'token_recuperacao' => $token,
            'token_expiracao'   => $expiracao
        ]);

        return $token;
    }

    /**
     * Verifica se o token de recuperação é válido
     * 
     * @param string $token
     * @return array|false
     */
    public function verificarToken($token)
    {
        $usuario = $this->where('token_recuperacao', $token)
                        ->where('token_expiracao >', date('Y-m-d H:i:s'))
                        ->first();

        return $usuario ? $usuario : false;
    }

    /**
     * Redefine a senha do usuário
     * 
     * @param int $id
     * @param string $novaSenha
     * @return bool
     */
    public function redefinirSenha($id, $novaSenha)
    {
        return $this->update($id, [
            'senha'             => $novaSenha, // Será hasheada pelo callback
            'token_recuperacao' => null,
            'token_expiracao'   => null
        ]);
    }
}
