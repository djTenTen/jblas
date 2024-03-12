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










    
    public function getac3genmat($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'genmat', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }
    public function getac3doccors($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'doccors', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }
    public function getac3statutory($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'statutory', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }
    public function getac3accsys($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac3', 'other' => 'accsys', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    public function getac4($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac4', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    public function getac6($c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'table', 'code' => 'ac6', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }



    
    /**
        ----------------------------------------------------------
        SAVING CHAPTER 1 FUNCTIONS
        ----------------------------------------------------------
    */
    public function savechapter1($req){

        switch ($req['code']) {


            case 'AC2':
                
            break;

            case 'AC3':
                foreach($req['question'] as $i => $val){
                    $data = [
                        'code' => $req['code'],
                        'c1tID' => $req['c1tID'],
                        'type' => 'table',
                        'question' => $req['question'][$i],
                        'yesno' => $req['yesno'][$i],
                        'comment' => $req['comment'][$i],
                        'other' => $req['part'][$i],
                        'status' => 'Active',
                        'added_on' => $this->date.' '.$this->time
                    ];
        
                    $this->db->table($this->tblc1)->insert($data);
                }
                return true;
            break;

            case 'AC4':
                foreach($req['question'] as $i => $val){
                    $data = [
                        'code' => $req['code'],
                        'c1tID' => $req['c1tID'],
                        'type' => 'table',
                        'question' => $req['question'][$i],
                        'comment' => $req['comment'][$i],
                        'status' => 'Active',
                        'added_on' => $this->date.' '.$this->time
                    ];
        
                    $this->db->table($this->tblc1)->insert($data);
                }
                return true;
            break;


            case 'AC5':
                // foreach($req['question'] as $i => $val){
                //     $data = [
                //         'code' => $req['code'],
                //         'c1tID' => $req['c1tID'],
                //         'type' => 'table',
                //         'question' => $req['question'][$i],
                //         'comment' => $req['comment'][$i],
                //         'status' => 'Active',
                //         'added_on' => $this->date.' '.$this->time
                //     ];
        
                //     $this->db->table($this->tblc1)->insert($data);
                // }
                return true;
            break;


            case 'AC6':
                foreach($req['question'] as $i => $val){
                    $data = [
                        'code' => $req['code'],
                        'c1tID' => $req['c1tID'],
                        'type' => 'table',
                        'question' => $req['question'][$i],
                        'planning' => $req['planning'][$i],
                        'finalization' => $req['finalization'][$i],
                        'reference' => $req['reference'][$i],
                        'status' => 'Active',
                        'added_on' => $this->date.' '.$this->time
                    ];
        
                    $this->db->table($this->tblc1)->insert($data);
                }
                return true;
            break;

            
            default:
                # code...
                break;
        }
        

    }





    /**
        ----------------------------------------------------------
        DISABLING AND ENABLING CHAPTER 1 FUNCTIONS
        ----------------------------------------------------------
    */

    

    




    




    





}
