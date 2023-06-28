<?php

namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
class adminSeeder extends Seeder{
    public function run(){
        $this->db->query("INSERT INTO t_users (username, password, email, fullname, type) VALUES('owner')");
    }
}