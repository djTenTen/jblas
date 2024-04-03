<?php
namespace App\Models;
use CodeIgniter\Model;
class AuthModel extends  Model {

    protected $tbluser = "tbl_users";
    protected $tblfirm = "tbl_firm";
    protected $crypt;

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 
        $this->crypt = \Config\Services::encrypter();

    }

    public function authenticate($req){

        $email = $req['email'];
        $pass = $req['password'];

        $q = "select * from {$this->tbluser} as tu,{$this->tblfirm} as tf where BINARY email = ? and tu.firm = tf.firmID"; 
        $user = $this->db->query($q, $email);
        if($user->getNumRows() == 1){
            $ud = $user->getRowArray();
            $dpss = $this->crypt->decrypt($ud['pass']);
            if($ud['verified'] == "Yes"){
                if($ud['status'] == "Active"){
                    if($pass == $dpss){
                        $arr = [
                            'userID' => $ud['userID'],
                            'name' => $ud['name'],
                            'email' => $ud['email'],
                            'firm' => $ud['firm']
                        ];
                        return $arr;
                    }else{
                        return 'wrongpassword';
                    }
                }else{
                    return 'userinactive';
                }
            }else{
                return 'userunverified';
            }
        }else{
            return 'usernotexist';
        }


    }


}