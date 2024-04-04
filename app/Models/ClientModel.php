<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model{
   

    protected $tblc = "tbl_clients";
    protected $tblf = "tbl_firm";
    protected $tblc1t = "tbl_c1_titles";
    protected $time,$date;

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 

        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }

    public function editclient($cID){

        $query = $this->db->table($this->tblc)->where('cID', $cID)->get();
        $r = $query->getRowArray();
        $data = [
            'name' => $r['name'],
            'org' => $r['org'],
            'email' => $r['email'],
        ];
        return json_encode($data);
    }

    public function getclients($fID){

        $query = $this->db->query("select *, tc.status
        from {$this->tblc} as tc, {$this->tblf} as tf
        where tc.fID = tf.firmID
        and tc.fID = {$fID}");
        return $query->getResultArray();

    }

    public function getc1(){

        $query =  $this->db->table($this->tblc1t)->get();
        return $query->getResultArray();

    }


    public function getclientname($cID){

        $query = $this->db->table($this->tblc)->where('cID',$cID)->get();
        return $query->getRowArray();

    }
    

    public function saveclient($req){

        $res1 = $this->db->table($this->tblc)->where('email', $req['email'])->get()->getNumRows();
        $res2 = $this->db->table($this->tblc)->where('name', $req['name'])->get()->getNumRows();

        if($res1 >= 1 or $res2 >= 1){

            return 'exist';

        }else{

            $data = [
                'name' => ucfirst($req['name']),
                'org' => ucfirst($req['org']),
                'email' => $req['email'],
                'fID' => $req['fID'],
                'status' => 'Active',
                'added_on' => $this->date.' '.$this->time,
            ];

            if($this->db->table($this->tblc)->insert($data)){

                return 'registered';

            }else{

                return 'failed';

            }


        }
        

    }



    public function acin($dcID){

        $query = $this->db->table($this->tblc)->where('cID', $dcID)->get();
        $r = $query->getRowArray();
        $stat = '';
        if($r['status'] == 'Active'){
            $stat = 'Inactive';
        }else{
            $stat = 'Active';
        }
        $data = [
            'status' => $stat,
            'updated_on' => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc)->where('cID', $dcID)->update($data)){
            return true;
        }else{
            return false;
        }

    }


    


    




    





}
