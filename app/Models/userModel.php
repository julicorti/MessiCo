<?php 

namespace App\Models;

use CodeIgniter\Model;

class userModel extends Model{
    public function crearUsuario($data){
        $table = $this->db->table('t_users');

        $table->insert($data);

        return $this->db->insertID();
    }
    public function obtUsuarios(){
        $table = $this->db->table('t_users');
        return $table->get()->getResultArray();

    }
    public function obtUsuario($data){
        $table = $this->db->table('t_users');

        $table->where($data);
        
        return $table->get()->getResultArray();

    }
}