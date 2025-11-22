<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration para criação da tabela de usuários administradores
 * 
 * Esta tabela armazena os usuários que terão acesso à área administrativa
 * do sistema Pet Netto.
 */
class Usuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'comment'    => 'Nome completo do usuário',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'comment'    => 'E-mail para login',
            ],
            'senha' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'comment'    => 'Senha criptografada (hash)',
            ],
            'ativo' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'comment'    => '1=Ativo, 0=Inativo',
            ],
            'token_recuperacao' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'comment'    => 'Token para recuperação de senha',
            ],
            'token_expiracao' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'comment' => 'Data de expiração do token',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Adiciona chave primária
        $this->forge->addKey('id', true);
        
        // Adiciona chave única para o e-mail
        $this->forge->addKey('email', false, true);

        // Cria a tabela
        $this->forge->createTable('usuarios', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
