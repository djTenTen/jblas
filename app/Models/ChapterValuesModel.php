<?php

namespace App\Models;

use CodeIgniter\Model;

class ChapterValuesModel extends Model{

    protected $tblc1 = "tbl_c1";
    protected $tblc2 = "tbl_c2";
    protected $tblc3 = "tbl_c3";
    protected $tblc1d = "tbl_client_dfiles_c1";
    protected $tblc2d = "tbl_client_dfiles_c2";
    protected $tblc3d = "tbl_client_dfiles_c3";
    protected $time,$date;
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
        AC1 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac1($code,$c1tID,$dcID){

        $where = [
            'code' => $code, 
            'type' => 'cacf',
            'c1tID' => $c1tID,
            'clientID' => $dcID
        ];
        $query =  $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }
    public function getac1eqr($code,$c1tID,$dcID){
        
        $where = [
            'code' => $code, 
            'type' => 'eqr', 
            'c1tID' => $c1tID, 
            'clientID' => $dcID
        ];
        $query =  $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }
    /** 
        POST FUNCTIONS
    */
    public function saveac1($req){

        foreach($req['yesno'] as $i => $val){
            $acid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'yesno' => $req['yesno'][$i],
                'comment' => $req['comment'][$i],
                'updated_on' => $this->date.' '.$this->time,
                'updated_by' => $req['uID'],
            ];
            $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
        }
        
        return true;
      
    }

    public function saveac1eqr($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question' => $req['question'],
            'updated_on' => $this->date.' '.$this->time,
            'updated_by' => $req['uID'],
        ];
    
        if($this->db->table($this->tblc1d)->where('acID', $acid)->update($data)){
            return true;
        }else{
            return false;
        }
    }










    /**
        ----------------------------------------------------------
        AC2 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac2($code,$c1tID,$dcID){

        $where = [
            'code' => $code, 
            'type' => 'pans',
            'c1tID' => $c1tID, 
            'clientID' => $dcID
        ];
        $query =  $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }

    public function getac2aep($code,$c1tID,$dcID){

        $where = [
            'code' => $code, 
            'type' => 'ac2aep',
            'c1tID' => $c1tID, 
            'clientID' => $dcID
        ];
        $query =  $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }
    /** 
        POST FUNCTIONS
    */
    public function saveac2($req){

        foreach($req['corptax'] as $i => $val){

            $acid = $this->crypt->decrypt($req['acid'][$i]);

            $data = [
                'corptax' => $req['corptax'][$i],
                'statutory' => $req['statutory'][$i],
                'accountancy' => $req['accountancy'][$i],
                'other' => $req['other'][$i],
                'totalcu' => $req['totalcu'][$i],
                'updated_on' => $this->date.' '.$this->time,
                'updated_by' => $req['uID'],
            ];

            $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);

        }

        return true;

    }

    public function saveac2aep($req){

        $acid = $this->crypt->decrypt($req['acid']);

        $data = [
            'question' => $req['eap'],
            'updated_on' => $this->date.' '.$this->time,
            'updated_by' => $req['uID'],
        ];
    
        if($this->db->table($this->tblc1d)->where('acID', $acid)->update($data)){
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
    public function getac3($part,$code,$c1tID,$dcID){

        $where = [
            'code' => $code, 
            'type' => $part,
            'c1tID' => $c1tID, 
            'clientID' => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveac3($req){


        foreach($req['yesno'] as $i => $val){

            $acid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'yesno' => $req['yesno'][$i],
                'comment' => $req['comment'][$i],
                'updated_on' => $this->date.' '.$this->time,
                'updated_by' => $req['uID'],
            ];

            $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);

        }

        return true;

    }










    /**
        ----------------------------------------------------------
        AC4 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac4ppr($code,$c1tID,$dcID){

        $where = [
            'code' => $code, 
            'type' => 'ppr',
            'c1tID' => $c1tID, 
            'clientID' => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }
    public function getac4($code,$c1tID,$dcID){

        $where = [
            'code' => $code, 
            'type' => 'ac4sod',
            'c1tID' => $c1tID, 
            'clientID' => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveac4ppr($req){

        $acid = $this->crypt->decrypt($req['acid']);

        $data = [
            'question' => $req['ppr'],
            'updated_on' => $this->date.' '.$this->time,
            'updated_by' => $req['uID'],
        ];
    
        if($this->db->table($this->tblc1d)->where('acID', $acid)->update($data)){
            return true;
        }else{
            return false;
        }
        

    }
    public function saveac4($req){

        foreach($req['comment'] as $i => $val){
            $acid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'comment' => $req['comment'][$i],
                'updated_on' => $this->date.' '.$this->time,
                'updated_by' => $req['uID'],
            ];

            $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
        }
        return true;

    }










    /**
        ----------------------------------------------------------
        AC5 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac5($code,$c1tID,$dcID){

        $where = [
            'code' => $code, 
            'type' => 'rescon',
            'c1tID' => $c1tID, 
            'clientID' => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where )->get();
        return $query->getRowArray();

    }

    /**     
        POST FUNCTIONS
    */
    public function saveac5($req){

        $acid = $this->crypt->decrypt($req['acid']);

        $data = [
            'question' => $req['rescon'],
            'updated_on' => $this->date.' '.$this->time,
            'updated_by' => $req['uID'],
        ];

        if($this->db->table($this->tblc1d)->where('acID', $acid)->update($data)){
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
    public function getac6($part,$code,$c1tID,$dcID){

        $where = [
            'code' => $code, 
            'type' => $part,
            'c1tID' => $c1tID, 
            'clientID' => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }
    public function gets12($code,$c1tID,$dcID){

        $where = [
            'code' => $code, 
            'type' => 'ac6s12',
            'c1tID' => $c1tID, 
            'clientID' => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**     
        POST FUNCTIONS
    */
    public function saveac6ra($req){

        foreach($req['planning'] as $i => $val){

            $acid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'planning' => $req['planning'][$i],
                'finalization' => $req['finalization'][$i],
                'reference' => $req['reference'][$i],
                'updated_on' => $this->date.' '.$this->time,
                'updated_by' => $req['uID'],
            ];

            $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
        }
        return true;

    }

    public function saveac6s12($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question' => $req['section'],
            'updated_on' => $this->date.' '.$this->time,
            'updated_by' => $req['uID'],
        ];

        if($this->db->table($this->tblc1d)->where('acID', $acid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    public function saveac6s3($req){
        $where = [
            'type' => $req['part'], 
            'code' => $req['code'], 
            'c1tID' => $req['c1tID'],
            'clientID' => $req['cID'],
        ];

        $this->db->table($this->tblc1d)->where($where)->delete();

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
                'firmID' => $req['fID'],
                'clientID' => $req['cID'],
                'type' => $req['part'],
                'status' => 'Active',
                'updated_on' => $this->date.' '.$this->time,
                'updated_by' => $req['uID'],
            ];

            $this->db->table($this->tblc1d)->insert($data);
        }
        return true;

    }
    

    






    /**
        ----------------------------------------------------------
        AC7 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac7($code,$c1tID,$part,$dcID){

        $where = [
            'type' => $part, 
            'code' => $code, 
            'c1tID' => $c1tID,
            'clientID' => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**     
        POST FUNCTIONS
    */
    public function saveac7($req){

        $data = [
            'question' => $req['genyn'],
            'updated_on' => $this->date.' '.$this->time,
            'updated_by' => $req['uID'],
        ];
        $where = [
            'type' => $req['part'],
            'c1tID' => $req['c1tID'],
            'clientID' => $req['cID'],
        ];
        if($this->db->table($this->tblc1d)->where($where)->update($data)){
            return true;
        }else{
            return false;
        }

    }










    /**
        ----------------------------------------------------------
        AC8 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac8($code,$c1tID,$part,$dcID){

        $where = [
            'type' => $part, 
            'code' => $code, 
            'c1tID' => $c1tID,
            'clientID' => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**     
        POST FUNCTIONS
    */
    public function saveac8($req){

        foreach($req['question'] as $i => $val){

            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'question' => $req['question'][$i],
                'updated_on' => $this->date.' '.$this->time,
                'updated_by' => $req['uID'],
            ];
            $this->db->table($this->tblc1d)->where('acID', $dacid)->update($data);

        }

        return true;
    }










    /**
        ----------------------------------------------------------
        AC9 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac9data($code,$c1tID,$dcID){

        $where = [
            'type' => 'ac9data', 
            'code' => $code, 
            'c1tID' => $c1tID,
            'clientID' => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**     
        POST FUNCTIONS
    */
    public function saveac9($req){

        $dacid = $this->crypt->decrypt($req['acid']);

        $data = [
            'question' => $req['ac9'],
            'updated_on' => $this->date.' '.$this->time,
            'updated_by' => $req['uID'],
        ];

        if($this->db->table($this->tblc1d)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }










    /**
        ----------------------------------------------------------
        AC10 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac10s1data($c1tID,$part,$dcID){

        $where = [
            'type' => $part, 
            'code' => 'ac10', 
            'question' => 'section1',
            'c1tID' => $c1tID,
            'clientID' => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }
    public function getac10s2data($c1tID,$part,$dcID){

        $where = [
            'type' => $part, 
            'code' => 'ac10', 
            'question' => 'section2',
            'c1tID' => $c1tID,
            'clientID' => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }
    public function getac10cu($c1tID,$part,$dcID){

        $where = [
            'type' => $part, 
            'code' => 'ac10', 
            'c1tID' => $c1tID,
            'clientID' => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }
    public function getdatacount($c1tID,$part,$dcID){

        $where = [
            'type' => $part, 
            'code' => 'ac10', 
            'c1tID' => $c1tID,
            'clientID' => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where);
        return $query->countAllResults();

    }
    public function getsumation($c1tID,$part,$dcID){

        $where1 = [
            'type' => $part, 
            'code' => 'ac10', 
            'c1tID' => $c1tID,
            'clientID' => $dcID,
        ];
        $where2 = [
            'type' => $part.'cu', 
            'code' => 'ac10', 
            'c1tID' => $c1tID,
            'clientID' => $dcID,
        ];
        $total = $this->db->table($this->tblc1d)->selectSum('balance')->where($where1)->get()->getRowArray();
        $cu = $this->db->table($this->tblc1d)->where($where2)->get()->getRowArray();

        return $cu['question'] - $total['balance'];

    }
    public function getsummarydata($c1tID,$part,$dcID){

        $where2 = [
            'type' => $part.'data', 
            'code' => 'ac10', 
            'c1tID' => $c1tID,
            'clientID' => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where2)->get();
        return $query->getRowArray();

    }
    /**     
        POST FUNCTIONS
    */
    public function saveac10summ($req,$ref){

        foreach ($req as $r => $val){

            $data = [
                'question' => $val,
                'type' =>  $r.'data',
                'updated_on' => $this->date.' '.$this->time,
                'updated_by' => $ref['uID'],
            ];

            $where1 = [
                'type' => $r.'data',
                'code' => $ref['code'],
                'c1tID' => $ref['c1tID'],
                'clientID' =>$ref['cID'],
            ];
            $this->db->table($this->tblc1d)->where($where1)->update($data);

        }

        $where2 = [
            'type' => 'materialdata',
            'code' => $ref['code'],
            'c1tID' => $ref['c1tID'],
            'clientID' =>$ref['cID'],
        ];
        $this->db->table($this->tblc1d)->where($where2)->update(array('question' => $ref['materiality']));

        return true;

    }
    public function saveac10s1($req){

        $where = [
            'type' => $req['type'], 
            'code' => $req['code'],
            'question' => 'section1',
            'c1tID' => $req['c1tID'],
            'clientID' => $req['cID'],
        ];
        $this->db->table($this->tblc1d)->where($where)->delete();

        foreach($req['name'] as $i => $val){

            $data = [
                'less' => $req['less'][$i],
                'name' => $req['name'][$i],
                'balance' => $req['balance'][$i],
                'type' =>  $req['type'],
                'code' =>  $req['code'],
                'c1tID' => $req['c1tID'],
                'clientID' => $req['cID'],
                'firmID' => $req['fID'],
                'question' => 'section1',
                'updated_on' => $this->date.' '.$this->time,
                'updated_by' => $req['uID'],
            ];

            $this->db->table($this->tblc1d)->insert($data);

        }

        return true;
    }
    public function saveac10s2($req){

        $where = [
            'type' => $req['type'], 
            'code' => $req['code'],
            'question' => 'section2',
            'c1tID' => $req['c1tID'],
            'clientID' => $req['cID'],
        ];
    
        $this->db->table($this->tblc1d)->where($where)->delete();

        foreach($req['name'] as $i => $val){

            $data = [
                'less' => $req['less'][$i],
                'name' => $req['name'][$i],
                'reason' => $req['reason'][$i],
                'balance' => $req['balance'][$i],
                'type' =>  $req['type'],
                'code' =>  $req['code'],
                'c1tID' => $req['c1tID'],
                'clientID' => $req['cID'],
                'firmID' => $req['fID'],
                'question' => 'section2',
                'updated_on' => $this->date.' '.$this->time,
                'updated_by' => $req['uID'],
            ];
            $this->db->table($this->tblc1d)->insert($data);

        }

        return true;
    }
    public function saveac10cu($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        
        $data = [
            'question' => $req['question'],
            'updated_on' => $this->date.' '.$this->time,
            'updated_by' => $req['uID'],
        ];
        if($this->db->table($this->tblc1d)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

        
    }










     /**
        ----------------------------------------------------------
        AC11 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getac11data($code,$c1tID,$dcID){

        $where = [
            'type' => 'ac11data',
            'code' => $code,
            'c1tID' => $c1tID,
            'clientID' => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }
    /**     
        POST FUNCTIONS
    */
    public function saveac11($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question' => $req['ac11'],
            'updated_on' => $this->date.' '.$this->time,
            'updated_by' => $req['uID'],
        ];
        if($this->db->table($this->tblc1d)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }
    

    

    

    

    



}