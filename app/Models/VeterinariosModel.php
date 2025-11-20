<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\BaseModel;

class VeterinariosModel extends BaseModel
{
    protected $table      = 'veterinarios';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nome',
        'especialidade',
        'foto',
        'biografia',
        'facebook',
        'twitter',
        'instagram'
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        "nome"  => [
            "label" => 'Nome Completo',
            "rules" => 'required|min_length[3]|max_length[150]'
        ],
        "especialidade"  => [
            "label" => 'Especialidade',
            "rules" => 'required|min_length[3]|max_length[150]'
        ],
        "biografia"  => [
            "label" => 'Biografia',
            "rules" => 'required|min_length[3]|max_length[60]'
        ],
        "foto"  => [
            "label" => 'Foto',
            "rules" => 'required'
        ]
    ];
}