<?php

namespace App\Models;

use CodeIgniter\Model;

class ChapterModel extends Model{
   

    protected $tblc1 = "tbl_c1";
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


    // chapter 1

    public function getac1(){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac1', 'type' => 'table'))->get();
        return $query->getResultArray();

    }


    public function saveac1($req){

        foreach($req['question'] as $i => $val){

            $data = [
                'code' => 'ac1',
                'tpye' => 'table',
                'question' => $req['question'][$i],
                'yesno' => $req['yesno'][$i],
                'comment' => $req['comment'][$i],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);

        }

        return true;
    }




    public function getac2(){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac2', 'type' => 'table'))->get();
        return $query->getResultArray();

    }


    public function saveac2($req){

        foreach($req['question'] as $i => $val){

            $data = [
                'code' => 'ac2',
                'type' => 'table',
                'question' => $req['question'][$i],
                'corptax' => $req['corptax'][$i],
                'statutory' => $req['statutory'][$i],
                'accountancy' => $req['accountancy'][$i],
                'other' => $req['other'][$i],
                'totalcu' => $req['totalcu'][$i],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);

        }

        return true;

    }




    




    





}
