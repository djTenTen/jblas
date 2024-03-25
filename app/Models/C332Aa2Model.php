<?php

namespace App\Models;

use CodeIgniter\Model;

class C332Aa2Model extends Model{
   
    protected $tblc3 = "tbl_c3";
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
        Chapter 2 GET FUNCTIONS
        ----------------------------------------------------------
    */

    public function getaa2data($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'aa2', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

   
   
    /**
        ----------------------------------------------------------
        Chapter 2 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveaa2($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();

        $data = [
            'question' => $req['aa2'],
            'type' =>  $req['part'],
            'code' =>  $req['code'],
            'c3tID' => $req['c3tID'],
            'status' => 'Active',
            'updated_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc3)->insert($data)){
            return true;
        }else{
            return false;
        }

    }

    

    



    

    




    





}
