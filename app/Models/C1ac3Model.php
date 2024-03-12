<?php

namespace App\Models;

use CodeIgniter\Model;

class C1ac3Model extends Model{
   

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
    public function editac3question($c1ID){

        $query = $this->db->table($this->tblc1)->where('acID', $c1ID)->get();
        $r = $query->getRowArray();
        $data = [
            'question' => $r['question'],
            'yesno' => $r['yesno'],
            'comment' => $r['comment']
        ];
        
        return json_encode($data);

    }



    /**
        ----------------------------------------------------------
        Chapter 1 AC2 GET FUNCTIONS
        ----------------------------------------------------------
    */

    public function getac3genmat($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'genmat', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }
    public function getac3doccors($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'doccors', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }
    public function getac3statutory($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'statutory', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }
    public function getac3accsys($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'accsys', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    public function getaep($c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac2', 'type' => 'aep', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }






    /**
        ----------------------------------------------------------
        Chapter 1 AC2 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac3questions($req){

        foreach($req['question'] as $i => $val){

            $data = [
                'code' => $req['code'],
                'c1tID' => $req['c1tID'],
                'type' => 'table',
                'question' => $req['question'][$i],
                'yesno' => $req['yesno'][$i],
                'comment' => $req['comment'][$i],
                'other' => $req['part'][$i],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);
        }
        return true;

    }

    public function updateac3questions($req){

        $data = [
            'question' => $req['question'],
            'yesno' => $req['yesno'],
            'comment' => $req['comment'],
            'updated_on' => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }
        
    }

    public function activeinactiveac3($req){

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

    public function updateaep($req){

        $data = [
            'question' => $req['eap'],
            'updated_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }

    }

    

    




    





}
