<?php

namespace App\Models;

use CodeIgniter\Model;

class ChapterModel extends Model{
   
    protected $tblc1t = "tbl_c1_titles";
    protected $tblc2t = "tbl_c2_titles";
    protected $tblc3t = "tbl_c3_titles";

    protected $time,$date;

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 

        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s"); 
        $this->date = date("Y-m-d");

    }


    /**
        ----------------------------------------------------------
        CHAPTER 1 FUNCTIONS
        ----------------------------------------------------------
    */
    public function getc1(){

        $query =  $this->db->table($this->tblc1t)->get();
        return $query->getResultArray();

    }




    /**
        ----------------------------------------------------------
        CHAPTER 2 FUNCTIONS
        ----------------------------------------------------------
    */
    public function getc2(){

        $query =  $this->db->table($this->tblc2t)->get();
        return $query->getResultArray();

    }




    /**
        ----------------------------------------------------------
        CHAPTER 3 FUNCTIONS
        ----------------------------------------------------------
    */
    public function getc3(){

        $query =  $this->db->table($this->tblc3t)->get();
        return $query->getResultArray();

    }










    
    

    
   






    




    





}
