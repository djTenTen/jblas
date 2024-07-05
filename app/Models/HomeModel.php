<?php
namespace App\Models;
use CodeIgniter\Model;

class HomeModel extends  Model {
    
    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR HOME VIEW VALIDATION
        Properties being used on this file
        * @property tbluser table of user
        * @property time-date to load the date and time
        * @property db to load the data base
    */
    protected $tbluser = "tbl_users";
    protected $db;
    protected $time,$date;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        $this->db = \Config\Database::connect('default');
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d"); 

    }


    /**
        * @method getdbexist() check if db exist
        * @var res contains database result query
        * @return bool
    */
    public function getdbexist(){

        try { 
            if($this->db->connect('default')){
                return true;
            } 
        } catch (\Throwable $th) { 
            return false; 
        }
        

    }


    /**
        * @method getuser() get the user information
        * @return result-array
    */
    public function getuser(){

        return $this->db->table($this->tbluser)->get()->getResultArray();

    }


    /**
        * @method resetpass() request reset password
        * @param email user email
        * @var req check if user email exist
        * @var res contains user data
        * @var otp generate otp
        * @var email email confirguration for email notification
        * @return bool
    */
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


    /**
        * @method savepass() save the new password
        * @param req user data
        * @var where check references
        * @var checkotp result based on the references
        * @var res result from the query on database
        * @return bool
    */
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