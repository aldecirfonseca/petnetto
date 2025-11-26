<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Servicos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'descricao' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'img' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'Imagem do serviço',
            ],
            'categoria' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'comment'    => 'Categoria dos serviços',
            ],
            'statusRegistro' => [
                'type'       => 'INT',
                'constraint' => 1,
                'default'    => 1,
                'comment'    => '1 = ativo, 0 = inativo',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);

        // criar a chave primaria
        $this->forge->addKey("id", true);

        // criar chave unica
        $this->forge->addKey('nome', false, true);

        // Criar para a table
        $this->forge->createTable("servicos", false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable("servicos");
    }
}
