<?php
namespace App\Models;
use CodeIgniter\Model;
class AuthModel extends  Model {


    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR AUTHENTICATION
        Properties being used on this file
        * @property tbluser table of users
        * @property tblfirm table of firms
        * @property tblpos table of positions
        * @property db to load the data base
        * @property crypt to load the logs libraries for user activity logs
    */
    protected $tbluser  = "tbl_users";
    protected $tblfirm  = "tbl_firm";
    protected $tblpos   = "tbl_position";
    protected $db;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->db    = \Config\Database::connect('default'); 
        $this->crypt = \Config\Services::encrypter();

    }


    /**
        * @method authenticate() login the user
        * @param array-req contains the user information
        * @var email email information of user
        * @var pass password information of user
        * @var q query string for the authentication
        * @var user parametarized the email and query to avoid sql injections
        * @var ud contains user data as row array
        * @var dpss decrypted password from the database and validate it to the inputed password
        * @var array-arr contains the user information
        * @return array-arr, wrongpassword, userinactive, userunverified, usernotexist
    */
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


    /**
        * @method getUserAccess() get and update the user access information
        * @var posID decrypted position id
        * @var query result of query from database
        * @method session() to update the session "allowed"
     */
    public function getUserAccess(){

        $posID = $this->crypt->decrypt(session()->get('posID'));
        $query = $this->db->table($this->tblpos)->where('posID', $posID)->get()->getRowArray();
        session()->set('allowed', json_decode($query['allowed']));

    }

    
}