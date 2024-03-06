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


    // chapter 1

    public function getc1(){

        $query =  $this->db->table($this->tblc1t)->get();
        return $query->getResultArray();

    }

    public function savechapter1($req){

        switch ($req['code']) {
            case 'AC1':
                foreach($req['question'] as $i => $val){

                    $data = [
                        'code' => $req['code'],
                        'c1tID' => $req['c1tID'],
                        'type' => 'table',
                        'question' => $req['question'][$i],
                        'yesno' => $req['yesno'][$i],
                        'comment' => $req['comment'][$i],
                        'status' => 'Active',
                        'added_on' => $this->date.' '.$this->time
                    ];
        
                    $this->db->table($this->tblc1)->insert($data);
        
                }
                return true;
            break;

            case 'AC2':
                foreach($req['question'] as $i => $val){

                    $data = [
                        'code' => $req['code'],
                        'c1tID' => $req['c1tID'],
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
            break;

            case 'AC3':
                $data = [
                    'code' => 'ac3',
                    'type' => 'table',
                    'question' => $req['question'][$i],
                    'yesno' => $req['yesno'][$i],
                    'comment' => $req['comment'][$i],
                    'other' => 'genmat',
                    'status' => 'Active',
                    'added_on' => $this->date.' '.$this->time
                ];
    
                $this->db->table($this->tblc1)->insert($data);
            break;
            
            default:
                # code...
                break;
        }
        

    }

    public function getac1($c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac1', 'type' => 'table', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    public function getac2($c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => 'ac2', 'type' => 'table', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }





    public function getac3genmat(){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'genmat'))->get();
        return $query->getResultArray();

    }

    public function saveac3genmat($req){

        foreach($req['question'] as $i => $val){

            

        }

        return true;

    }


    public function getac3doccors(){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'doccors'))->get();
        return $query->getResultArray();

    }

    public function saveac3doccors($req){

        foreach($req['question'] as $i => $val){

            $data = [
                'code' => 'ac3',
                'type' => 'table',
                'question' => $req['question'][$i],
                'yesno' => $req['yesno'][$i],
                'comment' => $req['comment'][$i],
                'other' => 'doccors',
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);

        }
        
        return true;

    }


    public function getac3statutory(){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'statutory'))->get();
        return $query->getResultArray();

    }

    public function saveac3statutory($req){

        foreach($req['question'] as $i => $val){

            $data = [
                'code' => 'ac3',
                'type' => 'table',
                'question' => $req['question'][$i],
                'yesno' => $req['yesno'][$i],
                'comment' => $req['comment'][$i],
                'other' => 'statutory',
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);

        }
        
        return true;

    }


    public function getac3accsys(){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'accsys'))->get();
        return $query->getResultArray();

    }

    public function saveac3accsys($req){

        foreach($req['question'] as $i => $val){

            $data = [
                'code' => 'ac3',
                'type' => 'table',
                'question' => $req['question'][$i],
                'yesno' => $req['yesno'][$i],
                'comment' => $req['comment'][$i],
                'other' => 'accsys',
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc1)->insert($data);

        }
        
        return true;

    }




    




    





}
