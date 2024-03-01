<?php

namespace App\Models;

use CodeIgniter\Model;

class ChapterModel extends Model{
   

    protected $tblc1 = "tbl_c1_planning";
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
    public function viewchapter1($state){

        $query = $this->db->table($this->tblc1)->get();
        return $query->getResultArray();

    }

    public function savechapter1($req){

        $data = [
            'code' => $req['code'],
            'title' => $req['title'],
            'status' => 'Active',
            'added_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc1)->insert($data)){
            return true;
        }else{
            return false;
        }

    }

    public function savemanagechapter($req){

        foreach($req['q'] as $i => $val){

            $data = [
                'c1ID' => $req['cID'],
                'questions' => $req['q'][$i]
            ];

            $this->db->table($this->tblc1s)->insert($data);

            $last = $this->db->insertID();

            foreach($req['f'] as $i => $val){

                $fields = [
                    'c1_section' => $last,
                    'fields' => $req['f'][$i],
                    'd_value' => $req['dv'][$i]
                ];

                $this->db->table($this->tblc1sf)->insert($fields);

            }
            
            
        }

        return true;

    }












    // chapter 2
    public function viewchapter2($state){

        $query = $this->db->table($this->tblc2)->get();
        return $query->getResultArray();

    }

    public function savechapter2($req){

        $data = [
            'code' => $req['code'],
            'title' => $req['title'],
            'status' => 'Active',
            'added_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc2)->insert($data)){
            return true;
        }else{
            return false;
        }

    }








    // chapter 2
    public function viewchapter3($state){

        $query = $this->db->table($this->tblc3)->get();
        return $query->getResultArray();

    }

    public function savechapter3($req){

        $data = [
            'code' => $req['code'],
            'title' => $req['title'],
            'status' => 'Active',
            'added_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblc3)->insert($data)){
            return true;
        }else{
            return false;
        }

    }

}
