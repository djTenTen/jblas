<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class Chapter3Model extends Model{

   
    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR CHAPTER 3 FILE MANAGEMENT
        Properties being used on this file
        * @property tblc3 table of chapter 3
        * @property time-date to load the date and time
        * @property db to load the data base
        * @property crypt to load the encryption file
        * @property logs to load the logs libraries for user activity logs
    */
    protected $tblc3 = "tbl_c3";
    protected $time,$date;
    protected $db;
    protected $crypt;
    protected $logs;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        $this->db       = \Config\Database::connect('default'); 
        $this->crypt    = \Config\Services::encrypter();
        $this->logs     = new Logs();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time     = date("H:i:s");
        $this->date     = date("Y-m-d");

    }


    /**
        * @method acin() set the chapter 3 files to active and inactive
        * @param req contains chapter file information
        * @var query result from database
        * @var r result from database as row array
        * @var stat set the status
        * @param duID user id
        * @var array-data contains auditor information going to save to database
        * @return bool
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
        * @method getaa1() get the aa1 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getaa1($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'planning', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa1s3() save the aa1 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return row-array
    */
    public function getaa1s3($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'section3', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }
   
    /**
        * @method savequestions() save the aa1 information
        * @param req aa1 data
        * @var data contains aa1 information
        * @return bool
    */
    public function savequestions($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'question'      => $req['question'][$i],
                'extent'        => $req['extent'][$i],
                'reference'     => $req['reference'][$i],
                'type'          => $req['part'],
                'code'          => $req['code'],
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
        * @method saveaa1s3() save the aa1 information
        * @param req aa1 data
        * @var data contains aa1 information
        * @return bool
    */
    public function saveaa1s3($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['question'],
            'type'          => $req['part'],
            'code'          => $req['code'],
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
        * @method getaa2data() get the aa2 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getaa2data($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'aa2', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }
   
    /**
        * @method saveaa2() save the aa2 information
        * @param req aa2 data
        * @var data contains aa2 information
        * @return bool
    */
    public function saveaa2($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['aa2'],
            'type'          => $req['part'],
            'code'          => $req['code'],
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
        * @method getaa3() get the aa3a information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getaa3($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa3air() get the aa3a information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return row-array
    */
    public function getaa3air($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ir', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveaa3a() save the aa3a information
        * @param req aa3a data
        * @var data contains aa3a information
        * @return bool
    */
    public function saveaa3a($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'question'      => $req['question'][$i],
                'reference'     => $req['comment'][$i],
                'type'          => $req['part'],
                'code'          => $req['code'],
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
        * @method saveaa3afaf() save the aa3a information
        * @param req aa3a data
        * @var data contains aa3a information
        * @return bool
    */
    public function saveaa3afaf($req){

        $this->db->table($this->tblc3)->where(array('type' => $req['part'], 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'question'      => $req['question'][$i],
                'extent'        => $req['extent'][$i],
                'reference'     => $req['reference'][$i],
                'type'          => $req['part'],
                'code'          => $req['code'],
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
        * @method saveaa3air() save the aa3a information
        * @param req aa3a data
        * @var data contains aa3a information
        * @return bool
    */
    public function saveaa3air($req){

        $this->db->table($this->tblc3)->where(array('type' => 'ir', 'code' => $req['code'], 'c3tID' => $req['c3tID']))->delete();
        $data = [
            'question'      => $req['ir'],
            'type'          => $req['part'],
            'code'          => $req['code'],
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
        * @method getaa3b() get the aa3b information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getaa3b($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa3bp4() get the aa3b information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return row-array
    */
    public function getaa3bp4($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'p4', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveaa3b() save the aa3b information
        * @param req aa3b data
        * @var data contains aa3b information
        * @return bool
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

    /**
        * @method saveaa3bp4() save the aa3b information
        * @param req aa3b data
        * @var data contains aa3b information
        * @return bool
    */
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
        AA4 FUNCTIONS
        ----------------------------------------------------------
        * @method getaa4() get the aa4 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getaa4($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'aa4', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }


    /**
        ----------------------------------------------------------
        AA5b FUNCTIONS
        ----------------------------------------------------------
        * @method getaa5b() get the aa5b information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getaa5b($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'aa5b', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method saveaa5b() save the aa5b information
        * @param req aa5b data
        * @var data contains aa5b information
        * @return bool
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
        * @method getaa7() get the aa7 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getaa7($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa7aep() get the aa7 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return row-array
    */
    public function getaa7aep($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveaa7isa() save the aa7 information
        * @param req aa7 data
        * @var data contains aa7 information
        * @return bool
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

    /**
        * @method saveaa7aepapp() save the aa7 information
        * @param req aa7 data
        * @var data contains aa7 information
        * @return bool
    */
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

    /**
        * @method saveaa7aep() save the aa7 information
        * @param req aa7 data
        * @var data contains aa7 information
        * @return bool
    */
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
        * @method getaa10() get the aa10 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return row-array
    */
    public function getaa10($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'aa10', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveaa10() save the aa10 information
        * @param req aa10 data
        * @var data contains aa10 information
        * @return bool
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
        * @method getaa11p2() get the aa11 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getaa11p2($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa11p1() get the aa11 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return row-array
    */
    public function getaa11p1($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method getaa11con() get the aa11 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return row-array
    */
    public function getaa11con($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveaa11un() save the aa11 information
        * @param req aa11 data
        * @var data contains aa11 information
        * @return bool
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

    /**
        * @method saveaa11ad() save the aa11 information
        * @param req aa11 data
        * @var data contains aa11 information
        * @return bool
    */
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
    
    /**
        * @method saveaa11ue() save the aa11 information
        * @param req aa11 data
        * @var data contains aa11 information
        * @return bool
    */
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

    /**
        * @method saveaa11con() save the aa11 information
        * @param req aa11 data
        * @var data contains aa11 information
        * @return bool
    */
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
        * @method getab1() get the ab1 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getab1($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab1', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method saveab1() save the ab1 information
        * @param req ab1 data
        * @var data contains ab1 information
        * @return bool
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
        * @method getab3() get the ab1 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return row-array
    */
    public function getab3($code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => 'ab3', 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveab3() save the ab3 information
        * @param req ab3 data
        * @var data contains ab3 information
        * @return bool
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
        AB4 FUNCTIONS
        ----------------------------------------------------------
        * @method getab4() get the ab4 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getab4($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method getab4checklist() get the ab4 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return row-array
    */
    public function getab4checklist($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveab4() save the ab4 information
        * @param req ab4 data
        * @var data contains ab4 information
        * @return bool
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

    /**
        * @method saveab4checklist() save the ab4 information
        * @param req ab4 data
        * @var data contains ab4 information
        * @return bool
    */
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
        AB4a,b,c,d,e,f,g,h FUNCTIONS
        ----------------------------------------------------------
        * @method getab4a() get the ab4a information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getab4a($part,$code,$c3tID){

        $query = $this->db->table($this->tblc3)->where(array('type' => $part, 'code' => $code, 'c3tID' => $c3tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method saveab4csaveab4ahecklist() save the ab4a information
        * @param req ab4a data
        * @var data contains ab4a information
        * @return bool
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


}