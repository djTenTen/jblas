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

}