<?php

namespace App\Models;

class UsuarioModel extends BaseModel
{
    protected $table      = 'usuario';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nome',
        'email',
        'senha',
        'nivel',
        'status',
        'token_recuperacao',
        'token_expiracao',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        "nome" => [
            "label" => "Nome completo",
            "rules" => "required|min_length[3]|max_length[150]"
        ],
        "email" => [
            "label" => "E-mail",
            "rules" => "required|valid_email|max_length[150]"
        ],
        "senha" => [
            "label" => "Senha",
            "rules" => "permit_empty|min_length[6]"
        ],
        "nivel" => [
            "label" => "Nível de acesso",
            "rules" => "required|integer"
        ],
        "status" => [
            "label" => "Status",
            "rules" => "required|integer"
        ],
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (! empty($data['data']['senha'])) {
            $data['data']['senha'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}
