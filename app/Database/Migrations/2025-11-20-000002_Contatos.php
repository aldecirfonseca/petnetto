<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration para criação da tabela de contatos
 * 
 * Esta tabela armazena o histórico de todas as mensagens enviadas
 * através do formulário de contato do site Pet Netto.
 */
class Contatos extends Migration
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
                'comment'    => 'Nome completo do remetente',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'comment'    => 'E-mail do remetente',
            ],
            'assunto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'comment'    => 'Assunto da mensagem',
            ],
            'mensagem' => [
                'type'    => 'TEXT',
                'comment' => 'Conteúdo da mensagem',
            ],
            'ip' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
                'comment'    => 'Endereço IP do remetente',
            ],
            'lida' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'comment'    => '0=Não lida, 1=Lida',
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

        // Cria a tabela
        $this->forge->createTable('contatos', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('contatos');
    }
}
