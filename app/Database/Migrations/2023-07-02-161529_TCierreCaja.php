<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TCierreCaja extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cierreCaja' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'fecha' => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
            ],
            'totalVentas' => [
                'type' => 'FLOAT',
                'constraint'     => [11,2],
            ],
        ]);
        $this->forge->addKey('id_cierreCaja', true);
        $this->forge->createTable('t_cierreCaja');
    }

    public function down()
    {
        $this->forge->dropTable('t_cierreCaja');
    }
}
