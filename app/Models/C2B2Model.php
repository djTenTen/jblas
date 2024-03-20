<?php

namespace App\Models;

use CodeIgniter\Model;

class C2B2Model extends Model{
   
    protected $tblc2 = "tbl_c2";
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

    public function getquestionsdata($code,$c2tID){

        $query = $this->db->table($this->tblc2)->where(array('type' => $code, 'code' => $code, 'c2tID' => $c2tID))->get();
        return $query->getResultArray();

    }
   
    /**
        ----------------------------------------------------------
        Chapter 2 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function savequestions($req){

        $this->db->table($this->tblc2)->where(array('type' => $req['part'], 'code' => $req['code'], 'c2tID' => $req['c2tID']))->delete();

        foreach($req['question'] as $i => $val){

            $data = [
                'question' => $req['question'][$i],
                'extent' => $req['extent'][$i],
                'reference' => $req['reference'][$i],
                'initials' => $req['initials'][$i],
                'type' =>  $req['part'],
                'code' =>  $req['code'],
                'c2tID' => $req['c2tID'],
                'status' => 'Active',
                'updated_on' => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc2)->insert($data);
            
        }

        return true;
    }


    

    



    

    




    





}
