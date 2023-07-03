<?php
namespace App\Models;

use CodeIgniter\Model;

class ventaModel extends model{
    public function createVenta($data){
        $table = $this->db->table('t_venta');
        $table->insert($data);
        return $this->db->insertID();
    }
    public function getVentas(){
        $table = $this->db->table('t_venta');
        return $table->get()->getResultArray();
    }
    public function getVentaById($id){
        $table = $this->db->table('t_venta');
        $table->where(['id_venta'=>$id]);
        return $table->get()->getResultArray();
    }
}