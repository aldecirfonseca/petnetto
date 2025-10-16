<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cidade extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                'type'              => 'INT',
                'constraint'        => 11,
                'auto_increment'    =>  true,
            ],
            'uf_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
            ],
            'nome' => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
            ],
            'codIBGE' => [
                'type'              => 'CHAR',
                'constraint'        => 5,
                'null'              => true,
            ],
            'created_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'deleted_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);

        // criar a chave primaria
        $this->forge->addKey("id", true);

        // criar chave unica
        $this->forge->addKey(['uf_id','nome'], false, true);

        //
        $this->forge->addForeignKey("uf_id", "uf", "id", "NO ACTION", "NO ACTION");

        // Criar para a table
        $this->forge->createTable("cidade", false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable("cidade");
    }
}
