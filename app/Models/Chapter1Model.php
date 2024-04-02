<?php

namespace App\Models;

use CodeIgniter\Model;

class Chapter1Model extends Model{

    protected $tblc1 = "tbl_c1";
    protected $time,$date;

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 

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








    /**
        ----------------------------------------------------------
        AC1 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac1($code,$c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => $code, 'type' => 'cacf', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }
    public function getac1eqr($code,$c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => $code, 'type' => 'eqr', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
    /** 
        POST FUNCTIONS
    */
    public function saveac1($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();

        foreach($req['question'] as $i => $val){

            $data = [
                'question' => $req['question'][$i],
                'yesno' => $req['yesno'][$i],
                'comment' => $req['comment'][$i],
                'code' => $req['code'],
                'c1tID' => $req['c1tID'],
                'type' => $req['part'],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);
        }
        
        return true;
       
      
    }

    public function saveeqr($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();

        $data = [
            'question' => $req['question'],
            'type' =>  $req['part'],
            'code' =>  $req['code'],
            'c1tID' => $req['c1tID'],
            'status' => 'Active',
            'updated_on' => $this->date.' '.$this->time
        ];
    
        if($this->db->table($this->tblc1)->insert($data)){
            return true;
        }else{
            return false;
        }
    }










    /**
        ----------------------------------------------------------
        AC1 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac2($code,$c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => $code, 'type' => 'pans', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    public function getac2aep($code,$c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => $code, 'type' => 'ac2aep', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
    /** 
        POST FUNCTIONS
    */
    public function saveac2($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();

        foreach($req['question'] as $i => $val){

            $data = [
                'question' => $req['question'][$i],
                'corptax' => $req['corptax'][$i],
                'statutory' => $req['statutory'][$i],
                'accountancy' => $req['accountancy'][$i],
                'other' => $req['other'][$i],
                'totalcu' => $req['totalcu'][$i],
                'code' => $req['code'],
                'c1tID' => $req['c1tID'],
                'type' => $req['part'],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);

        }

        return true;

    }

    public function saveac2aep($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();

        $data = [
            'question' => $req['eap'],
            'type' =>  $req['part'],
            'code' =>  $req['code'],
            'c1tID' => $req['c1tID'],
            'status' => 'Active',
            'updated_on' => $this->date.' '.$this->time
        ];
    
        if($this->db->table($this->tblc1)->insert($data)){
            return true;
        }else{
            return false;
        }
        

    }










    /**
        ----------------------------------------------------------
        AC3 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac3genmat($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'genmat', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }
    public function getac3doccors($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'doccors', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }
    public function getac3statutory($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'statutory', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }
    public function getac3accsys($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'accsys', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    public function getaep($code,$c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac2', 'type' => $code, 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveac3($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();

        foreach($req['question'] as $i => $val){

            $data = [
                'question' => $req['question'][$i],
                'yesno' => $req['yesno'][$i],
                'comment' => $req['comment'][$i],
                'code' => $req['code'],
                'c1tID' => $req['c1tID'],
                'type' => $req['part'],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);

        }

        return true;

    }










    /**
        ----------------------------------------------------------
        AC4 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac4ppr($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ppr', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
    public function getac4($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ac4sod', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveac4ppr($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();

        $data = [
            'question' => $req['ppr'],
            'type' =>  $req['part'],
            'code' =>  $req['code'],
            'c1tID' => $req['c1tID'],
            'status' => 'Active',
            'updated_on' => $this->date.' '.$this->time
        ];
    
        if($this->db->table($this->tblc1)->insert($data)){
            return true;
        }else{
            return false;
        }
        

    }
    public function saveac4($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();

        foreach($req['question'] as $i => $val){

            $data = [
                'question' => $req['question'][$i],
                'comment' => $req['comment'][$i],
                'code' => $req['code'],
                'c1tID' => $req['c1tID'],
                'type' => $req['part'],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);
        }
        return true;

    }










    /**
        ----------------------------------------------------------
        AC5 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac5($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'rescon', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /**     
        POST FUNCTIONS
    */
    public function saveac5($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();

        $data = [
            'question' => $req['rescon'],
            'type' =>  $req['part'],
            'code' =>  $req['code'],
            'c1tID' => $req['c1tID'],
            'status' => 'Active',
            'updated_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc1)->insert($data)){
            return true;
        }else{
            return false;
        }

    }










    /**
        ----------------------------------------------------------
        AC6 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac6($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ac6ra', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }
    public function gets12($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ac6s12', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }
    public function gets3($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ac6s3', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    /**     
        POST FUNCTIONS
    */
    public function saveac6ra($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();

        foreach($req['question'] as $i => $val){

            $data = [
                'question' => $req['question'][$i],
                'planning' => $req['planning'][$i],
                'finalization' => $req['finalization'][$i],
                'reference' => $req['reference'][$i],
                'code' => $req['code'],
                'c1tID' => $req['c1tID'],
                'type' => $req['part'],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);
        }
        return true;

    }
    public function saveac6s12($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();

        $data = [
            'question' => $req['section'],
            'type' =>  $req['part'],
            'code' =>  $req['code'],
            'c1tID' => $req['c1tID'],
            'status' => 'Active',
            'updated_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc1)->insert($data)){
            return true;
        }else{
            return false;
        }

    }
    public function saveac6s3($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();

        foreach($req['financialstatement'] as $i => $val){

            $data = [
                'finstate' => $req['financialstatement'][$i],
                'desc' => $req['descriptioncontrol'][$i],
                'controleffect' => $req['controleffective'][$i],
                'implemented' => $req['controlimplemented'][$i],
                'assessed' => $req['assesed'][$i],
                'reference' => $req['crosstesting'][$i],
                'reliance' => $req['reliancecontrol'][$i],
                'code' => $req['code'],
                'c1tID' => $req['c1tID'],
                'type' => $req['part'],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);
        }
        return true;

    }
    

    






    /**
        ----------------------------------------------------------
        AC6 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac7($code,$c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /**     
        POST FUNCTIONS
    */
    public function saveac7($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'],'c1tID' => $req['c1tID']))->delete();

        $data = [
            'question' => $req['genyn'],
            'type' =>  $req['part'],
            'code' =>  $req['code'],
            'c1tID' => $req['c1tID'],
            'updated_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc1)->insert($data)){
            return true;
        }else{
            return false;
        }

    }















    



}