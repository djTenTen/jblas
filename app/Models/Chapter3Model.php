<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class Chapter3Model extends Model{

   
    protected $tblc3 = "tbl_c3";
    protected $crypt;
    protected $time,$date;
    protected $logs;

    public function __construct(){

        $this->db       = \Config\Database::connect('default'); 
        $this->crypt    = \Config\Services::encrypter();
        $this->logs     = new Logs();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time     = date("H:i:s");
        $this->date     = date("Y-m-d");

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
            $this->logs->log(session()->get('name'). " Set the contents of ".$r['code']." to ".$stat);
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
    public function getaa1($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'planning', 'code' => $code, 'c3tID' => $c3tID))->get();
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
                'question'      => $req['question'][$i],
                'extent'        => $req['extent'][$i],
                'reference'     => $req['reference'][$i],
                'type'          =>  $req['part'],
                'code'          =>  $req['code'],
                'c3tID'         => $req['c3tID'],
                'status'        => 'Active',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
        return true;

    }

    public function saveaa1s3($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['question'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c3tID'         => $req['c3tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
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
            'question'      => $req['aa2'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c3tID'         => $req['c3tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
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
    public function getaa3($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'cr', 'code' => $code, 'c3tID' => $c3tID))->get();
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
                'question'      => $req['question'][$i],
                'reference'     => $req['comment'][$i],
                'type'          =>  $req['part'],
                'code'          =>  $req['code'],
                'c3tID'         => $req['c3tID'],
                'status'        => 'Active',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
        return true;

    }

    public function saveaa3afaf($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'question'      => $req['question'][$i],
                'extent'        => $req['extent'][$i],
                'reference'     => $req['reference'][$i],
                'type'          =>  $req['part'],
                'code'          =>  $req['code'],
                'c3tID'         => $req['c3tID'],
                'status'        => 'Active',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
        return true;

    }

    public function saveaa3air($req){

        $this->db->table($this->tblc3)->where(array('type' => 'ir', 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['ir'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c3tID'         => $req['c3tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
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
    public function getaa3b($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
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
                'question'      => $req['question'][$i],
                'reference'     => $req['reference'][$i],
                'type'          =>  $req['part'],
                'code'          =>  $req['code'],
                'c3tID'         => $req['c3tID'],
                'status'        => 'Active',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
        return true;

    }

    public function saveaa3bp4($req){

        $this->db->table($this->tblc3)->where(array('type' => 'p4', 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['p4'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c3tID'         => $req['c3tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AA5b FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getaa5b($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'aa5b', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveaa5b($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        foreach($req['reference'] as $i => $val){
            $data = [
                'reference'             => $req['reference'][$i],
                'issue'                 => $req['issue'][$i],
                'comment'               => $req['comment'][$i],
                'recommendation'        => $req['recommendation'][$i],
                'yesno'                 => $req['yesno'][$i],
                'result'                => $req['result'][$i],
                'type'                  =>  $req['part'],
                'code'                  =>  $req['code'],
                'c3tID'                 => $req['c3tID'],
                'status'                => 'Active',
                'updated_on'            => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
        return true;

    }

    /**
        ----------------------------------------------------------
        AA7 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getaa7($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    public function getaa7aep($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveaa7isa($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        foreach($req['reference'] as $i => $val){
            $data = [
                'reference'         => $req['reference'][$i],
                'issue'             => $req['issue'][$i],
                'comment'           => $req['comment'][$i],
                'recommendation'    => $req['recommendation'][$i],
                'result'            => $req['result'][$i],
                'type'              =>  $req['part'],
                'code'              =>  $req['code'],
                'c3tID'             => $req['c3tID'],
                'status'            => 'Active',
                'updated_on'        => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
        return true;

    }

    public function saveaa7aepapp($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['aep'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c3tID'         => $req['c3tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
            return true;
        }else{
            return false;
        }

    }

    public function saveaa7aep($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['aep'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c3tID'         => $req['c3tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AA10 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getaa10($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'aa10', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveaa10($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['aa10'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c3tID'         => $req['c3tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AA11 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getaa11p2($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    public function getaa11p1($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    public function getaa11con($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveaa11un($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        foreach($req['reference'] as $i => $val){
            $data = [
                'reference'         => $req['reference'][$i],
                'initials'          => $req['desc'][$i],
                'drps'              => $req['drps'][$i],
                'crps'              => $req['crps'][$i],
                'drfp'              => $req['drfp'][$i],
                'crfp'              => $req['crfp'][$i],
                'yesno'             => $req['yesno'][$i],
                'type'              =>  $req['part'],
                'code'              =>  $req['code'],
                'c3tID'             => $req['c3tID'],
                'status'            => 'Active',
                'updated_on'        => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
        return true;

    }

    public function saveaa11ad($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        foreach($req['reference'] as $i => $val){
            $data = [
                'reference'     => $req['reference'][$i],
                'initials'      => $req['desc'][$i],
                'drps'          => $req['drps'][$i],
                'crps'          => $req['crps'][$i],
                'drfp'          => $req['drfp'][$i],
                'crfp'          => $req['crfp'][$i],
                'type'          =>  $req['part'],
                'code'          =>  $req['code'],
                'c3tID'         => $req['c3tID'],
                'status'        => 'Active',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
        return true;

    }
    
    public function saveaa11ue($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['aa11'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c3tID'         => $req['c3tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
            return true;
        }else{
            return false;
        }

    }

    public function saveaa11con($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['aa11'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c3tID'         => $req['c3tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AB1 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getab1($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab1', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveab1($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        foreach ($req['question'] as $i => $val){
            $data = [
                'question'      => $req['question'][$i],
                'yesno'         => $req['yesno'][$i],
                'comment'       => $req['comment'][$i],
                'type'          =>  $req['part'],
                'code'          =>  $req['code'],
                'c3tID'         => $req['c3tID'],
                'status'        => 'Active',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
        return true;
      
    }

    /**
        ----------------------------------------------------------
        AB3 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getab3($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab3', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveab3($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['question'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c3tID'         => $req['c3tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
            return true;
        }else{
            return false;
        }
      
    }

    /**
        ----------------------------------------------------------
        AB3 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getab4($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    public function getab4checklist($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveab4($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'reference'         => $req['reference'][$i],
                'extent'            => $req['num'][$i],
                'question'          => $req['question'][$i],
                'yesno'             => $req['yesno'][$i],
                'comment'           => $req['comment'][$i],
                'type'              =>  $req['part'],
                'code'              =>  $req['code'],
                'c3tID'             => $req['c3tID'],
                'status'            => 'Active',
                'updated_on'        => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
        return true;
      
    }

    public function saveab4checklist($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['chlst'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c3tID'         => $req['c3tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
            return true;
        }else{
            return false;
        }
      
    }

    /**
        ----------------------------------------------------------
        AB4a FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getab4a($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab4a', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /** 
        POST FUNCTIONS
    */
    public function saveab4a($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'reference'     => $req['reference'][$i],
                'extent'        => $req['num'][$i],
                'question'      => $req['question'][$i],
                'yesno'         => $req['yesno'][$i],
                'comment'       => $req['comment'][$i],
                'type'          =>  $req['part'],
                'code'          =>  $req['code'],
                'c3tID'         => $req['c3tID'],
                'status'        => 'Active',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 3");
        return true;
      
    }

    /**
        ----------------------------------------------------------
        AB4b FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getab4b($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab4b', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }
    /** 
        POST FUNCTIONS
    */

    /**
        ----------------------------------------------------------
        AB4c FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getab4c($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab4c', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }
    /** 
        POST FUNCTIONS
    */

     /**
        ----------------------------------------------------------
        AB4d FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getab4d($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab4d', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }
    /** 
        POST FUNCTIONS
    */

    /**
        ----------------------------------------------------------
        AB4e FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getab4e($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab4e', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }
    /** 
        POST FUNCTIONS
    */

    /**
        ----------------------------------------------------------
        AB4f FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getab4f($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab4f', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }
    /** 
        POST FUNCTIONS
    */

    /**
        ----------------------------------------------------------
        AB4g FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
    */
    public function getab4g($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab4g', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }
    /** 
        POST FUNCTIONS
    */

    /**
        ----------------------------------------------------------
        AB4h FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
    */
    public function getab4h($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab4h', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }
    /** 
        POST FUNCTIONS
    */


}