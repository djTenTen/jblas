<?php

namespace App\Models;

use CodeIgniter\Model;

class C1ac6Model extends Model{
   

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
    public function editac6question($c1ID){

        $query = $this->db->table($this->tblc1)->where('acID', $c1ID)->get();
        $r = $query->getRowArray();
        $data = [
            'question' => $r['question'],
            'planning' => $r['planning'],
            'finalization' => $r['finalization'],
            'reference' => $r['reference']
        ];
        
        return json_encode($data);

    }

    public function editacsection3($c1ID){

        $query = $this->db->table($this->tblc1)->where('acID', $c1ID)->get();
        $r = $query->getRowArray();
        $data = [
            'finstate' => $r['finstate'],
            'desc' => $r['desc'],
            'controleffect' => $r['controleffect'],
            'implemented' => $r['implemented'],
            'assessed' => $r['assessed'],
            'reference' => $r['reference'],
            'reliance' => $r['reliance'],
        ];
        
        return json_encode($data);

    }

    



    /**
        ----------------------------------------------------------
        Chapter 1 AC2 GET FUNCTIONS
        ----------------------------------------------------------
    */

    public function getac6($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac6', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }


    public function gets1($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 's1', 'code' => 'ac6', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
    public function gets2a($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 's2a', 'code' => 'ac6', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
    public function gets2b($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 's2b', 'code' => 'ac6', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
    public function gets3($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 's3', 'code' => 'ac6', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }






    /**
        ----------------------------------------------------------
        Chapter 1 AC2 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac6questions($req){

        foreach($req['question'] as $i => $val){

            $data = [
                'code' => $req['code'],
                'c1tID' => $req['c1tID'],
                'type' => 'table',
                'question' => $req['question'][$i],
                'planning' => $req['planning'][$i],
                'finalization' => $req['finalization'][$i],
                'reference' => $req['reference'][$i],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);
        }
        return true;

    }

    public function updateac6questions($req){

        $data = [
            'question' => $req['question'],
            'planning' => $req['planning'],
            'finalization' => $req['finalization'],
            'reference' => $req['reference'],
            'updated_on' => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }
        
    }

    public function activeinactiveac6($req){

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



    public function udpatesection($req){

        $data = [
            'question' => $req['section'],
            'updated_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }

    }

    public function savesection3($req){

        $data = [
            
            'code' => $req['code'],
            'c1tID' => $req['c1tID'],
            'finstate' => $req['financialstatement'],
            'desc' => $req['descriptioncontrol'],
            'controleffect' => $req['controleffective'],
            'implemented' => $req['controlimplemented'],
            'assessed' => $req['assesed'],
            'reference' => $req['crosstesting'],
            'reliance' => $req['reliancecontrol'],
            'type' => 's3',
            'status' => 'Active',
            'added_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc1)->insert($data)){
            return true;
        }else{
            return false;
        }

    }


    public function udpatesection3($req){

        $data = [
            'finstate' => $req['financialstatement'],
            'desc' => $req['descriptioncontrol'],
            'controleffect' => $req['controleffective'],
            'implemented' => $req['controlimplemented'],
            'assessed' => $req['assesed'],
            'reference' => $req['crosstesting'],
            'reliance' => $req['reliancecontrol'],
            'updated_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            return true;
        }else{
            return false;
        }

    }



    

    




    





}
