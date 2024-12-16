<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class PositionModel extends  Model {


    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR POSITION MANAGEMENT
        Properties being used on this file
        * @property tblpos table of position
        * @property logs scheme name
        * @property db to load the database
        * @property time-date to load the date and time
        
    */
    protected $tblpos = "tbl_position";
    protected $logs;
    protected $db;
    protected $time,$date;
    

    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        $this->db   = \Config\Database::connect('default'); 
        $this->logs = new Logs();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }

    public function decr($ecr){
        return $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ecr));
    }

    public function encr($ecr){
        return str_ireplace(['/','+'],['~','$'],$this->crypt->encrypt($ecr));
    }



    /**
        * @method editposition() edit the position information
        * @param pId position ID
        * @var query contains database result query
        * @return json
    */
    public function editposition($pID){

        $query = $this->db->table($this->tblpos)->where('posID', $pID)->get();
        return json_encode($query->getRowArray());

    }


    /**
        * @method getposition() get all the positions
        * @var query contains database result query
        * @return result-array
    */
    public function getposition(){

        $query = $this->db->table($this->tblpos)->get();
        return $query->getResultArray();

    }


    /**
        * @method saveposition() save the position information
        * @param req contains position data
        * @var data contains position information
        * @return bool
    */
    public function saveposition($req){

        $data = [
            'position'      => $req['pos'],
            'allowed'       => $req['dpt'],
            'status'        => $req['status'],
            'added_on'      => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblpos)->insert($data)){
            $this->logs->log(session()->get('name'). " added a position in the system");
            return true;
        }else{
            return false;
        }

    }


    /**
        * @method updateposition() update the position information
        * @param req contains position data
        * @var data contains position update information
        * @return bool
    */
    public function updateposition($req){

        $data = [
            'position'      => $req['pos'],
            'allowed'       => $req['dpt'],
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblpos)->where('posID', $req['pID'])->update($data)){
            $this->logs->log(session()->get('name'). " updated a position in the system");
            return true;
        }else{
            return false;
        }

    }


    /**
        * @method acin() set the position information to active and inactive
        * @param dpID decrypted position ID
        * @var query result from database
        * @var r result from database as row array
        * @var stat set the status
        * @var array-data contains auditor information going to save to database
        * @return bool
    */
    public function acin($dpID){

        $query = $this->db->table($this->tblpos)->where('posID', $dpID)->get();
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
        if($this->db->table($this->tblpos)->where('posID', $dpID)->update($data)){
            $this->logs->log(session()->get('name'). " set the information of ".$r['position']." to ".$stat);
            return true;
        }else{
            return false;
        }

    }


}