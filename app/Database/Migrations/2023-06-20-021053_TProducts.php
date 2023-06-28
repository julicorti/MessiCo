<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TProducts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_product' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            
            'stock' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'codigoDeBarra' => [
                'type'       => 'INT',
                'constraint' => 13,
            ],
            'price' => [
                'type'       => 'FLOAT',
                'constraint' => [9, 2],
            ],
        ]);
        $this->forge->addKey('id_product', true);
        $this->forge->createTable('t_products');
    }

    public function down()
    {
        $this->forge->dropTable('t_products');
    }
}
