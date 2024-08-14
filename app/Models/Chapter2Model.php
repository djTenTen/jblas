<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class Chapter2Model extends Model{


    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR CHAPTER 2 FILE MANAGEMENT
        Properties being used on this file
        * @property tblc2 table of chapter 2
        * @property time-date to load the date and time
        * @property db to load the data base
        * @property crypt to load the encryption file
        * @property logs to load the logs libraries for user activity logs
    */
    protected $tblc2 = "tbl_c2";
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
        ----------------------------------------------------------
        CHAPTER 2 GET FUNCTIONS
        ----------------------------------------------------------
        * @method getvalues_m() get all the multi row data
        * @param type type or part of the file
        * @param code code of the file
        * @param code id of the file
        * @var where-array reference for the fetch
        * @return result-array
    */
    public function getvalues_m($type,$code,$ctID){

        $where = [
            'type' => $type, 
            'code' => $code,
            'c2tID' => $ctID
        ];
        $query =  $this->db->table($this->tblc2)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method savequestions() save the chapter 2
        * @param req chapter 2
        * @var data contains chapter 2
        * @return bool
    */
    public function savequestions($req){

        $this->db->table($this->tblc2)->where(array('type' => $req['part'], 'code' => $req['code'], 'c2tID' => $req['c2tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'question'      => $req['question'][$i],
                'extent'        => $req['extent'][$i],
                'reference'     => $req['reference'][$i],
                'initials'      => $req['initials'][$i],
                'type'          =>  $req['part'],
                'code'          =>  $req['code'],
                'c2tID'         => $req['c2tID'],
                'status'        => 'Active',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc2)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 2");
        return true;

    }

    /**
        * @method saveaicpppa() save the chapter 2
        * @param req chapter 2
        * @var data contains chapter 2
        * @return bool
    */
    public function saveaicpppa($req){

        $this->db->table($this->tblc2)->where(array('type' => $req['part'], 'code' => $req['code'], 'c2tID' => $req['c2tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'question'      => $req['question'][$i],
                'reference'     => $req['comment'][$i],
                'type'          =>  $req['part'],
                'code'          =>  $req['code'],
                'c2tID'         => $req['c2tID'],
                'status'        => 'Active',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc2)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 2");
        return true;

    }

    /**
        * @method savercicp() save the chapter 2
        * @param req chapter 2
        * @var data contains chapter 2
        * @return bool
    */
    public function savercicp($req){

        $this->db->table($this->tblc2)->where(array('type' => $req['part'], 'code' => $req['code'], 'c2tID' => $req['c2tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'question'      => $req['question'][$i],
                'extent'        => $req['extent'][$i],
                'reference'     => $req['comment'][$i],
                'type'          =>  $req['part'],
                'code'          =>  $req['code'],
                'c2tID'         => $req['c2tID'],
                'status'        => 'Active',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc2)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 2");
        return true;

    }

    /**
        * @method acin() set the chapter 2 files to active and inactive
        * @param req contains chapter file data
        * @var query result from database
        * @var r result from database as row array
        * @var stat set the status
        * @param duID user id
        * @var array-data contains auditor information going to save to database
        * @return bool
    */
    public function acin($req){

        $query = $this->db->table($this->tblc2)->where('acID', $req['c2ID'])->get();
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
        if($this->db->table($this->tblc2)->where('acID', $req['c2ID'])->update($data)){
            $this->logs->log(session()->get('name'). " Set the contents of ".$r['code']." to ".$stat);
            return true;
        }else{
            return false;
        }

    }


}