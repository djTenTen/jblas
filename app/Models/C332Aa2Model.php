<?php

namespace App\Models;

use CodeIgniter\Model;

class C332Aa2Model extends Model{
   
    protected $tblc3 = "tbl_c3";
    protected $crypt;

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 
        $this->crypt = \Config\Services::encrypter();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }

   
    

    



    

    




    





}
