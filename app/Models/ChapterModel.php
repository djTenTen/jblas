<?php

namespace App\Models;

use CodeIgniter\Model;

class ChapterModel extends Model{
   

    protected $tblc1 = "tbl_c1";
    protected $tblc1t = "tbl_c1_titles";


    protected $tblc1s = "tbl_c1_sections";
    protected $tblc1sf = "tbl_c1_section_fields";
    protected $tblc2 = "tbl_c2_detailed_procedure";
    protected $tblc3 = "tbl_c3_conclusion";
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










    
    

    
   






    




    





}
