<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuario extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'auto_increment'    => true,
            ],
            'nome' => [
                'type'              => 'VARCHAR',
                'constraint'        => 150,
            ],
            'email' => [
                'type'              => 'VARCHAR',
                'constraint'        => 150,
            ],
            'senha' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
            ],
            'nivel' => [
                'type'              => 'INT',
                'default'           => 3,
            ],
            'status' => [
                'type'              => 'INT',
                'default'           => 1,
            ],
            'token_recuperacao' => [
                'type' => 'VARCHAR',
                'constraint'        => 255,
                'null'              => true,
            ],
            'token_expiracao' => [
                'type'              => 'DATETIME',
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

        $this->forge->addKey('id', true);

        $this->forge->addKey('email', false, true);

        $this->forge->createTable('usuario', false, ["ENGINE" => "InnoDB"]);
    }

    public function down()
    {
        $this->forge->dropTable("usuario");
    }
}
