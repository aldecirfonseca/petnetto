<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Uf extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                'type'              => 'INT',
                'constraint'        => 11,
                'auto_increment'    =>  true,
            ],
            'sigla' => [
                'type'              => 'CHAR',
                'constraint'        => 2,
            ],
            'descricao' => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
            ],
            'regiao' => [
                'type'              => 'INT',
                'comment'           => '1=Norte; 2=Nordeste; 3=Sudeste; 4=Centro Oste; 5=Sul',
            ],
            'codIBGE' => [
                'type'              => 'CHAR',
                'constraint'        => 2,
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
        $this->forge->addKey('sigla', false, true);

        // Criar para a table
        $this->forge->createTable("uf", false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable("uf");
    }
}
