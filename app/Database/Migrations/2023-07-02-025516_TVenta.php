<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TVenta extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_venta' => [
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
            
            'products' => [
                'type'       => 'TEXT',
            ],
            'total' => [
                'type' => 'FLOAT',
                'constraint'     => [11,2],
            ],
        ]);
        $this->forge->addKey('id_venta', true);
        $this->forge->createTable('t_venta');
    }

    public function down()
    {
        $this->forge->dropTable('t_venta');
    }
}
