<?php
namespace App\Models;
use CodeIgniter\Model;


class UserModel extends  Model {

    protected $tbluser = "tbl_users";
    protected $tblfirm = "tbl_firm";
    protected $time,$date;
    public function __construct(){

        $this->db = \Config\Database::connect('default'); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }


    public function signin($req){

        $res1 = $this->db->table($this->tbluser)->where('email', $req['email'])->get()->getNumRows();
        $res2 = $this->db->table($this->tblfirm)->where('firm', $req['firm'])->get()->getNumRows();

        if($res1 >= 1 or $res2 >= 1){

            return 'exist';

        }else{

            $firm = [
                'firm' => $req['firm'], 
                'status' => 'Active',
                'added_on'=> $this->date.' '.$this->time
            ];
            $this->db->table($this->tblfirm)->insert($firm);
            $insertedId = $this->db->insertID();

            $data = [
                'name'  => $req['fname'],
                'firm'  => $insertedId,
                'email' => $req['email'],
                'pass'  => $req['pass'],
                'position'  => 3,
                'type'  => 'Auditing Firm',
                'verified'  => 'No',
                'status'    => 'Active',
                'added_on'  => $this->date.' '.$this->time
            ];
            if($this->db->table($this->tbluser)->insert($data)){

                return 'registered';

            }else{

                return 'failed';

            }

        }

       

    }








}