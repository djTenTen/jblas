<?php
namespace App\Models;
use CodeIgniter\Model;

class HomeModel extends  Model {
    
    protected $scheme = 'information_schema.SCHEMATA';
    protected $schemename = 'SCHEMA_NAME';
    protected $dbname = 'as';
    protected $tbluser = "tbl_users";
    protected $time,$date;

    public function __construct(){

        $this->db = \Config\Database::connect('default');
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d"); 

    }

    public function getdbexist(){

        try { $this->db->connect('default'); } catch (\Throwable $th) { return false; }
        $res = $this->db->table($this->scheme)->select($this->schemename)->where($this->schemename, $this->dbname)->get();
        return $res;

    }

    public function getuser(){

        return $this->db->table($this->tbluser)->get()->getResultArray();

    }

    public function resetpass($email){

        $req = $this->db->table($this->tbluser)->where('email', $email)->get();
        if($req->getNumRows() > 0){
            $res = $req->getRowArray();
            $otp = substr(bin2hex(random_bytes(8)), 0, 8);
            $this->db->table($this->tbluser)->where('userID', $res['userID'])->update(array('two_factor_secret' => $otp));
            $email = \Config\Services::email();
            $email->setFrom('applaud@buildappminds.com', 'ApplAud Systems');
            $email->setTo($res['email']);
            $email->setSubject('Reset Password');
            $msg = "Hi {$res['name']},\n\nWe've received your request to Applaud account password. \n Here's your One-Time-Password: {$otp}\n\nPlease Disregard this email if you did not request any reset password on your account. \n\nThank you so much,\nApplAud Systems";
            $email->setMessage($msg);
            $email->send();

            return true;
        }else{  
            return false;
        }

    }

    public function savepass($req){

        $where = ['two_factor_secret' => $req['otp'], 'email' => $req['email']];
        $checkotp = $this->db->table($this->tbluser)->where($where)->get();
        if($checkotp->getNumRows() > 0){
            $res = $checkotp->getRowArray();
            $this->db->table($this->tbluser)->where('userID', $res['userID'])->update(array ('pass' => $req['password'], 'two_factor_secret' => '' ,'updated_on' => $this->date.' '.$this->time));
            return true;
        }else{
            return false;
        }

    }


}