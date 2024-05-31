<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;
class AuthModel extends  Model {


    protected $tbluser  = "tbl_users";
    protected $tblfirm  = "tbl_firm";
    protected $tblpos   = "tbl_position";
    protected $crypt;
    protected $logs;

    public function __construct(){

        \Config\Services::session();
        $this->db = \Config\Database::connect('default'); 
        $this->crypt = \Config\Services::encrypter();
        $this->logs = new Logs();

    }

    public function authenticate($req){

        $email = $req['email'];
        $pass = $req['password'];
        $q = "select * , tf.firm as firmname, tp.position as pos
        from {$this->tbluser} as tu,{$this->tblfirm} as tf, {$this->tblpos} as tp
        where BINARY email = ? 
        and tu.firm = tf.firmID
        and tu.position = tp.posID"; 
        $user = $this->db->query($q, $email);
        if($user->getNumRows() == 1){
            $ud = $user->getRowArray();
            $dpss = $this->crypt->decrypt($ud['pass']);
            if($ud['verified'] == "Yes"){
                if($ud['status'] == "Active"){
                    if($pass == $dpss){
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
                        $this->logs->log($ud['name']. " has just Logged-in");
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

    public function getUserAccess(){

        $posID = $this->crypt->decrypt(session()->get('posID'));
        $query = $this->db->table($this->tblpos)->where('posID', $posID)->get()->getRowArray();
        session()->set('allowed', json_decode($query['allowed']));

    }

    
}