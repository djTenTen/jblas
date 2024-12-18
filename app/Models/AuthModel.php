<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;
class AuthModel extends  Model {


    // Properties
    protected $tbluser  = "tbl_users";
    protected $tblfirm  = "tbl_firm";
    protected $tblpos   = "tbl_position";
    protected $db;
    protected $crypt;
    protected $logs;

    // Load the method on the properties
    public function __construct(){

        \Config\Services::session();
        $this->db    = \Config\Database::connect('default'); 
        $this->crypt = \Config\Services::encrypter();
        $this->logs  = new Logs();

    }

    // Decrypting a Data
    public function decr($ecr){
        // return replace back the character that been changed and decrypt to its original form
        return $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ecr));
    }

    // Encrypting a Data
    public function encr($ecr){
        // return encrypt the data and replaced some characters
        return str_ireplace(['/','+'],['~','$'],$this->crypt->encrypt($ecr));
    }


    // Authenticate the user
    public function authenticate($req){

        $email = $req['email']; // user email
        $pass = $req['password']; // user password
        // parameterized query
        $q = "select * , tf.firm as firmname, tp.position as pos, tu.status as stat
        from {$this->tbluser} as tu,{$this->tblfirm} as tf, {$this->tblpos} as tp
        where BINARY email = ? 
        and tu.firm = tf.firmID
        and tu.position = tp.posID"; 
        // query result
        $user = $this->db->query($q, $email);
        // check if user exist
        if($user->getNumRows() !== 1){
            return false; // Email not found
        }
        // query result as single row data
        $ud = $user->getRowArray();
        // check if the user is not verified or Inactive
        if($ud['verified'] !== 'Yes' or $ud['stat'] !== 'Active'){
            return false; // Account not verified and active
        }
        // check if the unsuccessfull login attempts is exceeded to 5
        if($ud['logattempts'] > 5 or $ud['status'] == 'Locked'){
            $cnt = $ud['logattempts'] + 1; // Increment attempts
            $this->db->table($this->tbluser)->where(array('userID' => $ud['userID']))->update(array('logattempts' => $cnt));
            $this->logs->authlog("userid:".$ud['userID']." has ".$cnt." failed login attemps");
            return 'Locked'; // Account locked
        }
        // the last checking if the user password was verified
        if(!password_verify($pass, $ud['pass'])){
            $cnt = $ud['logattempts'] + 1;
            $this->db->table($this->tbluser)->where(array('userID' => $ud['userID']))->update(array('logattempts' => $cnt));
            $this->logs->authlog("userid:".$ud['userID']." has ".$cnt." failed login attemps");
            return false;
        }
        // if none of the top are true it will return the user's information
        $arr = [
            'userID'        => $ud['userID'],
            'name'          => $ud['name'],
            'email'         => $ud['email'],
            'pass'          => $ud['pass'],
            'firm'          => $ud['firmname'],
            'firmID'        => $ud['firmID'],
            'pos'           => $ud['pos'],
            'posID'         => $ud['posID'],
            'type'          => $ud['type'],
            'photo'         => $ud['photo'],
            'signature'     => $ud['signature'],
            'logo'          => $ud['logo'],
            'allowed'       => json_decode($ud['allowed']),
        ];
        // set the login attempts to 0 if success
        $this->db->table($this->tbluser)->where(array('userID' => $ud['userID']))->update(array('logattempts' => 0));
        // return the user information
        return $arr;

    }

    // This will check the user access information
    public function getUserAccess(){

        // decrypting position id
        $posID = $this->decr(session()->get('posID'));
        // query result as single row data
        $query = $this->db->table($this->tblpos)->where('posID', $posID)->get()->getRowArray();
        // update the user access settings
        session()->set('allowed', json_decode($query['allowed']));

    }

    
}