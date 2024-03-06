<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model{
   

    protected $tbl_c = "tbl_clients";
    protected $tblc1t = "tbl_c1_titles";

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 

        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }


    public function getclients(){

        $query = $this->db->table($this->tbl_c)->get();
        return $query->getResultArray();

    }

    public function getc1(){

        $query =  $this->db->table($this->tblc1t)->get();
        return $query->getResultArray();

    }


    public function getclientname($cID){

        $query = $this->db->table($this->tbl_c)->where('cID',$cID)->get();
        return $query->getRowArray();

    }
    



    




    





}
