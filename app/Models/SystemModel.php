<?php
namespace App\Models;
use CodeIgniter\Model;

class SystemModel extends  Model {


    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR POSITION MANAGEMENT
        Properties being used on this file
        * @property tblf table of firms
        * @property logs scheme name
        * @property db to load the database
        * @property time-date to load the date and time
        
    */
    protected $tblf = "tbl_firm";
    protected $tblu = "tbl_users";
    protected $logs;
    protected $db;
    protected $time,$date;
    

    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        $this->db           = \Config\Database::connect('default'); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time         = date("H:i:s");
        $this->date         = date("Y-m-d");

    }

    

    


}