<?php

namespace App\Models;

use CodeIgniter\Model;

class C1ac4Model extends Model{
   

    protected $tblc1 = "tbl_c1";
    protected $tblc1t = "tbl_c1_titles";

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 

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

    public function getac4($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac4', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    public function getppr1($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ppr1', 'code' => 'ac4', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
    public function getppr2($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ppr2', 'code' => 'ac4', 'c1tID' => $c1tID))->get();
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

    public function updateac4questions($req){

        $data = [
            'question' => $req['question'],
            'comment' => $req['comment'],
            'updated_on' => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }
        
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
