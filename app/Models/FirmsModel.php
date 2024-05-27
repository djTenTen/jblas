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

        $data = [
            'verified'          => 'Yes',
            'email_verify_at'   => $this->date.' '.$this->time,
            'updated_on'        => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tbluser)->where('userID', $uID)->update($data)){
            $f = $this->db->table($this->tbluser)->where('userID', $uID)->get()->getRowArray();
            $email = \Config\Services::email();
            $email->setFrom('applaud@buildappminds.com', 'ApplAud Systems');
            $email->setTo($f['email']);
            $email->setSubject('Confirmation');
            $msg = "Dear ".$f['name'].",\n\nYour registration has been approved, You can now Sign-in to this link, ".base_url().".\n\nThank you so much,\nApplAud Systems";
            $email->setMessage($msg);
            $email->send();
            return true;
        }else{
            return false;
        }

    }


}