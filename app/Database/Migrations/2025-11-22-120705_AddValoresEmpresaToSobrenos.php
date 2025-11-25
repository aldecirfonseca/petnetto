<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddValoresEmpresaToSobrenos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sobrenos', [
            'valores_empresa' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'long_description'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('sobrenos', 'valores_empresa');
    }
}
