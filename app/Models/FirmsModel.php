<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class FirmsModel extends  Model {


    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR FIRMS MANAGEMENT
        Properties being used on this file
        * @property tbluser table of user
        * @property tblfirm table of firm
        * @property time-date-year to load the date and time
        * @property db to load the data base
    */
    protected $tbluser = "tbl_users";
    protected $tblfirm = "tbl_firm";
    protected $time,$date;
    protected $db;
    protected $logs;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        $this->db   = \Config\Database::connect('default'); 
        $this->logs = new Logs();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }


    /**
        * @method getfirms() get the firms informations
        * @var query contains database result query
        * @return result-array
    */
    public function getfirms(){

        $query = $this->db->query("select *,tf.firm as firmname 
        from {$this->tblfirm} as tf,{$this->tbluser} as tu 
        where tu.firm = tf.firmID
        and tu.type != 'Admin'");
        return $query->getResultArray();

    }


    /**
        * @method verifyfirm() verify the information of the firm
        * @param uID user id
        * @param data contains verify information
        * @var f contains firms data
        * @var email email confirguration for email notification
        * @return bool
    */
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
            $this->logs->log(session()->get('name'). " verify the firm ".$f['name']);
            return true;
        }else{
            return false;
        }

    }


}