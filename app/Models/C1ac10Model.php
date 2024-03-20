<?php

namespace App\Models;

use CodeIgniter\Model;

class C1ac10Model extends Model{
   

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
        Chapter 1 AC10 GET FUNCTIONS
        ----------------------------------------------------------
    */

    public function getac10s1data($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac10','question' => 'section1', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    public function getac10s2data($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac10','question' => 'section2', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    public function getac10cu($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac10', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    public function getdatacount($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac10', 'c1tID' => $c1tID));
        return $query->countAllResults();

    }

    public function getsumation($c1tID,$part){

        $total = $this->db->table($this->tblc1)->selectSum('balance')->where(array('type' => $part, 'code' => 'ac10', 'c1tID' => $c1tID))->get()->getRowArray();
        $cu = $this->db->table($this->tblc1)->where(array('type' => $part.'cu', 'code' => 'ac10', 'c1tID' => $c1tID))->get()->getRowArray();

        return $cu['question'] - $total['balance'];

    }
   

    public function getsummarydata($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part.'data', 'code' => 'ac10', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
    /**
        ----------------------------------------------------------
        Chapter 1 AC10 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function saves1ac10($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['type'], 'code' => 'ac10','question' => 'section1', 'c1tID' => $req['c1tID']))->delete();

        foreach($req['name'] as $i => $val){

            $data = [
                'less' => $req['less'][$i],
                'name' => $req['name'][$i],
                'balance' => $req['balance'][$i],
                'type' =>  $req['type'],
                'code' =>  $req['code'],
                'c1tID' => $req['c1tID'],
                'question' => 'section1',
                'updated_on' => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);

        }

        return true;
    }

    public function saves2ac10($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['type'], 'code' => 'ac10','question' => 'section2', 'c1tID' => $req['c1tID']))->delete();

        foreach($req['name'] as $i => $val){

            $data = [
                'less' => $req['less'][$i],
                'name' => $req['name'][$i],
                'reason' => $req['reason'][$i],
                'balance' => $req['balance'][$i],
                'type' =>  $req['type'],
                'code' =>  $req['code'],
                'c1tID' => $req['c1tID'],
                'question' => 'section2',
                'updated_on' => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);

        }

        return true;
    }

    public function savesummary($req,$ref){


        foreach ($req as $r => $val){

            $this->db->table($this->tblc1)->where(array('type' => $r.'data', 'code' => 'ac10','c1tID' => $ref['c1tID']))->delete();

            $data = [
                'question' => $val,
                'type' =>  $r.'data',
                'code' =>  $ref['code'],
                'c1tID' => $ref['c1tID'],
                'updated_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);
        }

        $this->db->table($this->tblc1)->where(array('type' => 'materialdata', 'code' => $ref['code'],'c1tID' => $ref['c1tID']))->delete();
        $this->db->table($this->tblc1)->insert(array('type' => 'materialdata', 'code' => $ref['code'],'c1tID' => $ref['c1tID'], 'question' => $ref['materiality']));

        return true;

    }
    public function updatecusection($req){


        $dacid = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$req['acid']));
        $data = [
            'question' => $req['question'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

        
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
