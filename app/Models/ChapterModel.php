<?php
namespace App\Models;
use CodeIgniter\Model;

class ChapterModel extends Model{

   
    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR CHAPTER FILE MANAGEMENT
        Properties being used on this file
        * @property tblc1t table of chapter 1 titles
        * @property tblc2t table of chapter 2 titles
        * @property tblc3t table of chapter 3 titles
        * @property tblc4t table of chapter 4 titles
        * @property tblc5t table of chapter 5 titles
        * @property time-date to load the date and time
        * @property db to load the data base

    */
    protected $tblc1t = "tbl_c1_titles";
    protected $tblc2t = "tbl_c2_titles";
    protected $tblc3t = "tbl_c3_titles";
    protected $tblc4t = "tbl_c4_titles";
    protected $tblc5t = "tbl_c5_titles";
    protected $time,$date;
    protected $db;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        $this->db   = \Config\Database::connect('default'); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s"); 
        $this->date = date("Y-m-d");

    }


    /**
        ----------------------------------------------------------
        CHAPTER 1 FUNCTIONS
        ----------------------------------------------------------
        * @method getc1() get the chapter 1 titles
        * @var query result from database
        * @return result-array
    */
    public function getc1(){

        $query =  $this->db->table($this->tblc1t)->get();
        return $query->getResultArray();

    }


    /**
        ----------------------------------------------------------
        CHAPTER 2 FUNCTIONS
        ----------------------------------------------------------
        * @method getc2() get the chapter 2 titles
        * @var query result from database
        * @return result-array
    */
    public function getc2(){

        $query =  $this->db->table($this->tblc2t)->get();
        return $query->getResultArray();

    }


    /**
        ----------------------------------------------------------
        CHAPTER 3 FUNCTIONS
        ----------------------------------------------------------
        * @method getc3() get the chapter 3 titles
        * @var query result from database
        * @return result-array
    */
    public function getc3(){

        $query =  $this->db->table($this->tblc3t)->get();
        return $query->getResultArray();

    }

    /**
        ----------------------------------------------------------
        CHAPTER 4 FUNCTIONS
        ----------------------------------------------------------
        * @method getc4() get the chapter 4 titles
        * @var query result from database
        * @return result-array
    */
    public function getc4(){

        $query =  $this->db->table($this->tblc4t)->get();
        return $query->getResultArray();

    }

    /**
        ----------------------------------------------------------
        CHAPTER 5 FUNCTIONS
        ----------------------------------------------------------
        * @method getc5() get the chapter 5 titles
        * @var query result from database
        * @return result-array
    */
    public function getc5(){

        $query =  $this->db->table($this->tblc5t)->get();
        return $query->getResultArray();

    }


}
