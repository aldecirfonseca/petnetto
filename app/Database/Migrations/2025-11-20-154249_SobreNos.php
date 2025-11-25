<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SobreNos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                'type'              => 'INT',
                'constraint'        => 11,
                'auto_increment'    =>  true,
            ],
            'title' => [
                'type'              => 'VARCHAR',
                'constraint'        => 75,
            ],
            'short_description' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'long_description' => [
                'type'              => 'VARCHAR',
                'constraint'        => 850,
            ],
            'image_slogan' => [
                'type'              => 'VARCHAR',
                'constraint'        => 2000,
                'null'              => true,
            ],
            'image_page' => [
                'type'              => 'VARCHAR',
                'constraint'        => 2000,
                'null'              => true,
            ],
            'status' => [
                'type'              => 'TINYINT',
                'constraint'        => 1,
                'default'           => 1,
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
            'created_by' => [
                'type'              => 'INT',
                'null'              => true,
            ],
            'updated_by' => [
                'type'              => 'INT',
                'null'              => true,
            ],
            'deleted_by' => [
                'type'              => 'INT',
                'null'              => true,
            ],
        ]);

        // criar a chave primaria
        $this->forge->addKey("id", true);

        // Criar para a table
        $this->forge->createTable("sobrenos", false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable("sobrenos");
    }
}
