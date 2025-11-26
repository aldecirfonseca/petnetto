<?php
namespace App\Models;

class SobreNosModel extends BaseModel
{
    /**
     * Garante que só exista um registro ativo (status=1).
     * Ao inserir ou atualizar um registro como ativo, desativa todos os outros.
     */
    public function insert($data = null, bool $returnID = true)
    {
        if (isset($data['status']) && $data['status'] == 1) {
            // Desativa todos os outros antes de inserir
            $this->where('status', 1)->set(['status' => 0])->update();
        }
        return parent::insert($data, $returnID);
    }

    public function update($id = null, $data = null): bool
    {
        if (isset($data['status']) && $data['status'] == 1) {
            // Desativa todos os outros, exceto o atual
            $this->where('status', 1)->where($this->primaryKey . ' !=', $id)->set(['status' => 0])->update();
        }
        return parent::update($id, $data);
    }

    protected $table      = 'sobrenos';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'short_description',
        'long_description',
        'valores_empresa',
        'image_slogan',
        'image_page',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        "title" => [
            "label" => 'Título',
            "rules" => 'required|min_length[3]|max_length[75]'
        ],
        "short_description" => [
            "label" => 'Descrição Curta',
            "rules" => 'required|max_length[100]'
        ],
        "long_description" => [
            "label" => 'Descrição Longa',
            "rules" => 'required|max_length[850]'
        ]
    ];
}