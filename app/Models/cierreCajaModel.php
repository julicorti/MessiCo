<?php

namespace App\Models;

use CodeIgniter\Model;

class cierreCajaModel extends model{
    public function createCierre($data){
        $table = $this->db->table('t_cierreCaja');
        $table->insert($data);
        return $this->db->insertID();
    }

    public function getCierres(){
        $table = $this->db->table('t_cierreCaja');
        return $table->get()->getResultArray();

    }
}