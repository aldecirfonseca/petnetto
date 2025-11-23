<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicosModel extends BaseModel
{
    protected $table      = 'servicos';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nome',
        'descricao',
        'img',
        'categoria',
        'created_at',
        'updated_at',
        'statusRegistro',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    protected $validationRules = [
        "nome" => [
            "label" => 'Nome do Serviço',
            "rules" => 'required|min_length[3]|max_length[255]'
        ],
        "descricao" => [
            "label" => 'Descrição do Serviço',
            "rules" => 'permit_empty|min_length[10]'
        ],
        "img" => [
            "label" => 'Imagem',
            "rules" => 'permit_empty|max_length[255]'
        ],
        "categoria" => [
            "label" => 'Categoria do Serviço',
            "rules" => 'permit_empty|max_length[100]'
        ],
        "statusRegistro" => [
            "label" => 'Status Ativo',
            "rules" => 'required|integer|in_list[0,1]'
        ]
    ];
}
