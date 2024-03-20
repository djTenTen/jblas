<?php

namespace App\Models;

use CodeIgniter\Model;

class C1ac7Model extends Model{
   

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

    public function getac7data($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac7', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
   






    /**
        ----------------------------------------------------------
        Chapter 1 AC2 POST FUNCTIONS
        ----------------------------------------------------------
    */

    public function updates1($req,$ref){

        $this->db->table($this->tblc1)->where(array('type' => $ref['part'], 'code' => 'ac7','c1tID' => $ref['c1tID']))->delete();

        foreach ($req as $r => $val){

            $data = [
                'question' => $val,
                'type' =>  $ref['part'],
                'code' =>  $ref['code'],
                'c1tID' => $ref['c1tID'],
                'updated_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);

        }
        

        // foreach($req['yesno'] as $i => $val){

        //     $dacid = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$req['acid'][$i]));
        //     $data = [yesno
        //         'yesno' => $req['yesno'],
        //     ];
        //     $this->db->table($this->tblc1)->where('acID', $dacid)->update($data);

        // }

        return true;
    }


    public function updates2($req){

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





    

    




    





}
