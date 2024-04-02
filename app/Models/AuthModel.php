<?php
namespace App\Models;
use CodeIgniter\Model;
class AuthModel extends  Model {

    protected $tbluser = "tbl_users";
    protected $crypt;

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 
        $this->crypt = \Config\Services::encrypter();

    }

    public function authenticate($req){

        $email = $req['email'];
        $pass = $req['password'];

        $q = "select * from {$this->tbluser} where BINARY email = ?"; 
        $user = $this->db->query($q, $email);
        $ud = $user->getRowArray();
        if($user->getNumRows() >= 0 && $user->getNumRows() <= 1){
            $ud = $user->getRowArray();
            $dpss = $this->crypt->decrypt($ud['pass']);
            if($ud['verified'] == "Yes"){
                if($ud['status'] == "Active"){
                    if($pass == $dpss){
                        $arr = [
                            'userID' => $ud['userID'],
                            'name' => $ud['name'],
                            'email' => $ud['email']
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