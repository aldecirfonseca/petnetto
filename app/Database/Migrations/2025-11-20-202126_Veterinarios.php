<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Veterinarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                'type'              => 'INT',
                'constraint'        => 11,
                'auto_increment'    => true,
            ],

            'nome' => [
                'type'              => 'VARCHAR',
                'constraint'        => 150,
            ],

            'especialidade' => [
                'type'              => 'VARCHAR',
                'constraint'        => 150,
            ],

            'biografia' => [
                'type'              => 'VARCHAR',
                'constraint'        => 250,
                'null'              => true,
            ],

            'facebook' => [
                'type'              => 'VARCHAR',
                'constraint'        => 200,
                'null'              => true,
            ],

            'twitter' => [
                'type'              => 'VARCHAR',
                'constraint'        => 200,
                'null'              => true,
            ],

            'instagram' => [
                'type'              => 'VARCHAR',
                'constraint'        => 200,
                'null'              => true,
            ],

            'foto' => [
                'type'              => 'VARCHAR',
                'constraint'        => 200,
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

        // chave primária
        $this->forge->addKey("id", true);

        // cria a tabela
        $this->forge->createTable("veterinarios", false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable("veterinarios");
    }
}
