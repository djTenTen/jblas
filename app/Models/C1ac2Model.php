<?php

namespace App\Models;

use CodeIgniter\Model;

class C1ac2Model extends Model{
   

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
    public function editac2question($c1ID){

        $query = $this->db->table($this->tblc1)->where('acID', $c1ID)->get();
        $r = $query->getRowArray();
        $data = [
            'question' => $r['question'],
            'corptax' => $r['corptax'],
            'statutory' => $r['statutory'],
            'accountancy' => $r['accountancy'],
            'other' => $r['other'],
            'totalcu' => $r['totalcu'],
            'statutory' => $r['statutory'],
        ];
        
        return json_encode($data);

    }



    /**
        ----------------------------------------------------------
        Chapter 1 AC2 GET FUNCTIONS
        ----------------------------------------------------------
    */
    public function getac2($c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac2', 'type' => 'table', 'c1tID' => $c1tID))->get();
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
    public function saveac2questions($req){

        foreach($req['question'] as $i => $val){

            $data = [
                'code' => $req['code'],
                'c1tID' => $req['c1tID'],
                'type' => 'table',
                'question' => $req['question'][$i],
                'corptax' => $req['corptax'][$i],
                'statutory' => $req['statutory'][$i],
                'accountancy' => $req['accountancy'][$i],
                'other' => $req['other'][$i],
                'totalcu' => $req['totalcu'][$i],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);

        }
        return true;

    }

    public function updateac2questions($req){

        $data = [
            'question' => $req['question'],
            'corptax' => $req['corptax'],
            'statutory' => $req['statutory'],
            'accountancy' => $req['accountancy'],
            'other' => $req['other'],
            'totalcu' => $req['totalcu'],
            'updated_on' => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }
        
    }

    public function activeinactiveac2($req){

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
