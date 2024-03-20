<?php

namespace App\Models;

use CodeIgniter\Model;

class C1ac11Model extends Model{
   

    protected $tblc1 = "tbl_c1";
    protected $tblc1t = "tbl_c1_titles";

    protected $crypt;

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 

        $this->crypt = \Config\Services::encrypter();

        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }

    /**
        ----------------------------------------------------------
        Chapter 1 AC2 GET FUNCTIONS
        ----------------------------------------------------------
    */

    public function getac11data($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ac11data', 'code' => 'ac11', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
   
    /**
        ----------------------------------------------------------
        Chapter 1 AC2 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function updateac11($req,$ref){

        $this->db->table($this->tblc1)->where(array('type' => $ref['part'], 'code' => 'ac11', 'c1tID' => $ref['c1tID']))->delete();

        foreach($req as $r => $val){

            $data = [
                'question' => $val,
                'type' =>  $ref['part'],
                'code' =>  $ref['code'],
                'c1tID' => $ref['c1tID'],
                'updated_on' => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);
            
        }

        return true;
    }


    

    



    

    




    





}
