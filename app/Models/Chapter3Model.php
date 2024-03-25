<?php

namespace App\Models;

use CodeIgniter\Model;

class Chapter3Model extends Model{
   
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
        GENERAL FUNCTIONS
        ----------------------------------------------------------
    */
    public function acin($req){

        $query = $this->db->table($this->tblc3)->where('acID', $req['c3ID'])->get();
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
        if($this->db->table($this->tblc3)->where('acID', $req['c3ID'])->update($data)){
            return true;
        }else{
            return false;
        }

    }








    
    /**
        ----------------------------------------------------------
        AA1 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getaa1pl($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'planning', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    public function getaa1af($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'audit finalisation', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    public function getaa1s3($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'section3', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }
   
   
    /**
        POST FUNCTIONS
    */
    public function savequestions($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();

        foreach($req['question'] as $i => $val){

            $data = [
                'question' => $req['question'][$i],
                'extent' => $req['extent'][$i],
                'reference' => $req['reference'][$i],
                'type' =>  $req['part'],
                'code' =>  $req['code'],
                'c3tID' => $req['c3tID'],
                'status' => 'Active',
                'updated_on' => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
            
        }

        return true;
    }

    public function saveaa1s3($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();

        $data = [
            'question' => $req['question'],
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

    










    /**
        ----------------------------------------------------------
        AA2 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */

    public function getaa2data($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'aa2', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

   
    /**
        POST FUNCTIONS
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









    /**
        ----------------------------------------------------------
        AA3a FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getaa3acr($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'cr', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    public function getaa3adc($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'dc', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    public function getaa3afaf($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'faf', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    public function getaa3air($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ir', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }


    /** 
        POST FUNCTIONS
    */
    public function saveaa3a($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();

        foreach($req['question'] as $i => $val){

            $data = [
                'question' => $req['question'][$i],
                'reference' => $req['comment'][$i],
                'type' =>  $req['part'],
                'code' =>  $req['code'],
                'c3tID' => $req['c3tID'],
                'status' => 'Active',
                'updated_on' => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
            
        }

        return true;

    }

    public function saveaa3afaf($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();

        foreach($req['question'] as $i => $val){

            $data = [
                'question' => $req['question'][$i],
                'extent' => $req['extent'][$i],
                'reference' => $req['reference'][$i],
                'type' =>  $req['part'],
                'code' =>  $req['code'],
                'c3tID' => $req['c3tID'],
                'status' => 'Active',
                'updated_on' => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
            
        }

        return true;

    }

    public function saveaa3air($req){

        $this->db->table($this->tblc3)->where(array('type' => 'ir', 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();

        $data = [
            'question' => $req['ir'],
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










    /**
        ----------------------------------------------------------
        AA3b FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getaa3bp1($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'p1', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    public function getaa3bp2($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'p2', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    public function getaa3bp3($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'p3', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    public function getaa3bp4($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'p4', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }


    /** 
        POST FUNCTIONS
    */
    public function saveaa3b($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();

        foreach($req['question'] as $i => $val){

            $data = [
                'question' => $req['question'][$i],
                'reference' => $req['reference'][$i],
                'type' =>  $req['part'],
                'code' =>  $req['code'],
                'c3tID' => $req['c3tID'],
                'status' => 'Active',
                'updated_on' => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
            
        }

        return true;

    }

    public function saveaa3bp4($req){

        $this->db->table($this->tblc3)->where(array('type' => 'p4', 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();

        $data = [
            'question' => $req['p4'],
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