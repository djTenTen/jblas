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
        Chapter 1 AC1 AJAX FUNCTIONS
        ----------------------------------------------------------
    */
    public function editac4question($c1ID){

        $query = $this->db->table($this->tblc1)->where('acID', $c1ID)->get();
        $r = $query->getRowArray();
        $data = [
            'question' => $r['question'],
            'comment' => $r['comment']
        ];
        
        return json_encode($data);

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
    public function saveac4questions($req){

        foreach($req['question'] as $i => $val){

            $data = [
                'code' => $req['code'],
                'c1tID' => $req['c1tID'],
                'type' => 'table',
                'question' => $req['question'][$i],
                'comment' => $req['comment'][$i],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);
        }
        return true;

    }

    public function updates1($req){

        foreach($req['yesno'] as $i => $val){

            $dacid = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$req['acid'][$i]));
            $data = [
                'yesno' => $req['yesno'][$i],
            ];
            $this->db->table($this->tblc1)->where('acID', $dacid)->update($data);

        }

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




    



    public function activeinactiveac4($req){

        $query = $this->db->table($this->tblc1)->where('acID', $req['c1ID'])->get();
        $r = $query->getRowArray();
        $stat = '';
        if($r['status'] == 'Active'){
            $stat = 'Inactive';
        }else{
            $stat = 'Active';
        }
        $data = [
            'status' => $stat,
            'updated_on' => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }

    }



    public function updateppr($req){

        $data = [
            'question' => $req['ppr'],
            'updated_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }

    }




    

    




    





}
