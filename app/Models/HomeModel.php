<?php
namespace App\Models;
use CodeIgniter\Model;

class HomeModel extends  Model {
    

    protected $tbluser = "users";

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 

    }

    public function getuser(){

        return $this->db->table($this->tbluser)->get()->getResultArray();

    }

    public function auth(){

        return true;

    }


}