<?php
namespace App\Models;
use CodeIgniter\Model;

class FirmsModel extends  Model {


    protected $tbluser = "tbl_users";
    protected $tblfirm = "tbl_firm";
    protected $time,$date;

    public function __construct(){

        $this->db   = \Config\Database::connect('default'); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }

    public function getfirms(){

        $query = $this->db->query("select *,tf.firm as firmname 
        from {$this->tblfirm} as tf,{$this->tbluser} as tu 
        where tu.firm = tf.firmID
        and tu.type != 'Admin'");
        return $query->getResultArray();

    }

    public function verifyfirm($uID){

        if($this->db->table($this->tbluser)->where('userID', $uID)->update(array('verified' => 'Yes', 'email_verify_at' => $this->date.' '.$this->time, 'updated_on' => $this->date.' '.$this->time))){
            return true;
        }else{
            return false;
        }

    }


}