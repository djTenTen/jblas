<?php

namespace App\Models;

use CodeIgniter\Model;

class C1ac1Model extends Model{
   

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
    public function editac1question($c1ID){

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
        Chapter 1 AC1 GET FUNCTIONS
        ----------------------------------------------------------
    */
    public function getac1($c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac1', 'type' => 'table', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    public function getnameap($c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac1', 'type' => 'nameap', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    public function geteqr1($c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac1', 'type' => 'eqr1', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    public function geteqr2($c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac1', 'type' => 'eqr2', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    public function geteqrreason($c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac1', 'type' => 'eqrreason', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }






    /**
        ----------------------------------------------------------
        Chapter 1 AC1 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac1questions($req){

        foreach($req['question'] as $i => $val){

            $data = [
                'code' => $req['code'],
                'c1tID' => $req['c1tID'],
                'type' => 'table',
                'question' => $req['question'][$i],
                'yesno' => $req['yesno'][$i],
                'comment' => $req['comment'][$i],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);
    
        }
        return true;

    }

    public function updateac1questions($req){

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

    public function activeinactiveac1($req){

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

    public function updatenameap($req){

        $data = [
            'question' => $req['nameap'],
            'updated_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }

    }

    public function updateeqr($req){

        $data = [
            'question' => $req['eqr'],
            'updated_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }

    }
    

    




    





}
