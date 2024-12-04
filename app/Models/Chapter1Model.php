<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class Chapter1Model extends Model{
    

    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR CHAPTER 1 FILE MANAGEMENT
        Properties being used on this file
        * @property tblc1 table of chapter 1
        * @property time-date to load the date and time
        * @property db to load the data base
        * @property crypt to load the encryption file
        * @property logs to load the logs libraries for user activity logs
    */
    protected $tblc1 = "tbl_c1";
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
        CHAPTER 1 GET FUNCTIONS
        ----------------------------------------------------------
        * @method getvalues_m() get all the multi row data
        * @param type type or part of the file
        * @param code code of the file
        * @param code id of the file
        * @var where-array reference for the fetch
        * @return result-array
    */
    public function getvalues_m($type,$code,$mtID){

        $where = [
            'type' => $type, 
            'code' => $code,
            'mtID' => $mtID
        ];
        $query =  $this->db->table($this->tblc1)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getvalues_s() get a single row data
        * @param type type or part of the file
        * @param code code of the file
        * @param code id of the file
        * @var where-array reference for the fetch
        * @return row-array
    */
    public function getvalues_s($type,$code,$mtID){

        $where = [
            'type' => $type, 
            'code' => $code, 
            'mtID' => $mtID
        ];
        $query =  $this->db->table($this->tblc1)->where($where)->get();
        return $query->getrowArray();

    }


    /**
        ----------------------------------------------------------
        AC10 FUNCTIONS
        ----------------------------------------------------------
        * @method getac10s1data() get the ac10 information
        * @param mtID chapter 1 title id
        * @param part specifies the part of the file
        * @var query result from database
        * @return result-array
    */
    public function getac10data($part,$code,$mtID,$section){

        $where = [
            'type' => $part,
            'code' => $code,
            'mtID' => $mtID,
            'question' => $section,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getdatacount() get the ac10 information
        * @param mtID chapter 1 title id
        * @param part specifies the part of the file
        * @var query result from database
        * @return integer
    */
    public function getdatacount($mtID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac10', 'mtID' => $mtID));
        return $query->countAllResults();

    }

    /**
        * @method getsumation() Count/Compute the balances
        * @param mtID chapter 1 title id
        * @param part specifies the part of the file
        * @var total result from database
        * @return integer
    */
    public function getsumation($mtID,$part){

        $total = $this->db->table($this->tblc1)->selectSum('balance')->where(array('type' => $part, 'code' => 'ac10', 'mtID' => $mtID))->get()->getRowArray();
        $cu = $this->db->table($this->tblc1)->where(array('type' => $part.'cu', 'code' => 'ac10', 'mtID' => $mtID))->get()->getRowArray();
        return $cu['question'] - $total['balance'];

    }
    

}