<?php

namespace App\Models;

use CodeIgniter\Model;

class productModel extends Model{

    public function crearProducto($data){
        $table = $this->db->table('t_products');
        $table->insert($data);
        return $this->db->insertID();
    }

    public function obtenerProductos(){
        $table = $this->db->table('t_products');
        return $table->get()->getResultArray();
    }

    public function updateProducts($data){
        $table = $this->db->table('t_products');
        $table->where('id_product', $data['id_product']);
        $table->set($data);
        return $table->update();
    }

}