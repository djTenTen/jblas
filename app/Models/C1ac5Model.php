<?php

namespace App\Models;

use CodeIgniter\Model;

class C1ac5Model extends Model{
   

    protected $tblc1 = "tbl_c1";
    protected $tblc1t = "tbl_c1_titles";

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 

        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s"); 
        $this->date = date("Y-m-d");

    }


    public function updateres($req){

        $data = [
            'question' => $req['res'],
            'updated_on' => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }

    }



    public function getresult($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'result', 'code' => 'ac5', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    public function getconclusion($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'conclusion', 'code' => 'ac5', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }




}