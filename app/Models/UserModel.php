<?php
namespace App\Models;
use CodeIgniter\Model;


class UserModel extends  Model {

    protected $tblu = "tbl_users";
    protected $tblf = "tbl_firm";
    protected $tblp = "tbl_position";
    protected $time,$date;
    public function __construct(){

        $this->db = \Config\Database::connect('default'); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }

   

    public function edituser($duID){

        $query = $this->db->query("select *, tu.status, tp.position, tf.firm
        from {$this->tblu} as tu, {$this->tblf} as tf, {$this->tblp} as tp
        where tu.firm = tf.firmID
        and tu.position = tp.posID
        and tu.userID = {$duID}");
        $r = $query->getRowArray();
        $data = [
            'name' => $r['name'],
            'email' => $r['email'],
            'type' =>  $r['type'],
            'firm' =>  $r['firm'],
            'position' =>  $r['position']
        ];
        return json_encode($data);

    }

    public function getusers($uID){

        $query = $this->db->query("select *, tu.status, tp.position
        from {$this->tblu} as tu, {$this->tblf} as tf, {$this->tblp} as tp
        where tu.firm = tf.firmID
        and tu.position = tp.posID
        and tu.userID != {$uID}");
        return $query->getResultArray();

    }

    public function getfirm(){

        $query = $this->db->query("select * 
        from {$this->tblf} as tf
        where tf.firm != 'Admin'");
        return $query->getResultArray();

    }

    public function getposition(){

        $query = $this->db->table($this->tblp)->get();
        return $query->getResultArray();

    }

    public function signin($req){

        $res1 = $this->db->table($this->tblu)->where('email', $req['email'])->get()->getNumRows();
        $res2 = $this->db->table($this->tblf)->where('firm', $req['firm'])->get()->getNumRows();

        if($res1 >= 1 or $res2 >= 1){

            return 'exist';

        }else{

            $firm = [
                'firm' => $req['firm'], 
                'status' => 'Active',
                'added_on'=> $this->date.' '.$this->time
            ];
            $this->db->table($this->tblf)->insert($firm);
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
            if($this->db->table($this->tblu)->insert($data)){

                return 'registered';

            }else{

                return 'failed';

            }

        }

       

    }

    public function adduser($req){

        $res1 = $this->db->table($this->tblu)->where('email', $req['email'])->get()->getNumRows();
        $res2 = $this->db->table($this->tblu)->where('name', $req['name'])->get()->getNumRows();

        if($res1 >= 1 or $res2 >= 1){
            return 'exist';
        }else{
            $data = [
                'name' => $req['name'],
                'email' => $req['email'],
                'pass'  => $req['pass'],
                'type' => $req['type'],
                'firm' => $req['firm'],
                'position' => $req['pos'],
                'verified'  => 'Yes',
                'status'    => 'Active',
                'added_on' => $this->date.' '.$this->time
            ];

            if($this->db->table($this->tblu)->insert($data)){
                return 'added';
            }else{
                return 'failed';
            }
        }

        


    }

    public function udpateuser($req){

        $data = [
            'name' => $req['name'],
            'email' => $req['email'],
            'type' => $req['type'],
            'position' => $req['pos'],
            'updated_on' => $this->date.' '.$this->time
        ];

        if($this->db->table($this->tblu)->where('userID', $req['uID'])->update($data)){
            return 'updated';
        }else{
            return 'failed';
        }

    }



    public function acin($duID){

        $query = $this->db->table($this->tblu)->where('userID', $duID)->get();
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
        if($this->db->table($this->tblu)->where('userID', $duID)->update($data)){
            return true;
        }else{
            return false;
        }

    }






}