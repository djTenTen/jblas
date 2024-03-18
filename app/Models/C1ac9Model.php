<?php

namespace App\Models;

use CodeIgniter\Model;

class C1ac9Model extends Model{
   

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

    public function getac9data($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac9', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
   
    /**
        ----------------------------------------------------------
        Chapter 1 AC2 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function updatesec1ac9($req){

        foreach($req['question'] as $i => $val){

            $dacid = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$req['acid'][$i]));
            $data = [
                'question' => $req['question'][$i],
                'updated_on' => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->where('acID', $dacid)->update($data);

        }

        return true;
    }

    public function updatesec2ac9($req){

        foreach($req['date'] as $i => $val){

            $dacid = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$req['acid'][$i]));
            $data = [
                'question' => $req['date'][$i],
                'updated_on' => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->where('acID', $dacid)->update($data);

        }

        return true;
    }

    public function updatesec3ac9($req){

        foreach($req['question'] as $i => $val){

            $dacid = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$req['acid'][$i]));
            $data = [
                'question' => $req['question'][$i],
                'planning' => $req['date'][$i],
                'updated_on' => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->where('acID', $dacid)->update($data);

        }

        return true;
    }

    

    



    

    




    





}
