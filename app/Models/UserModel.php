<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class UserModel extends  Model {


    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR USER MANAGEMENT
        Properties being used on this file
        * @property tblu table of users
        * @property tblf table of firms
        * @property tblpos table of position
        * @property db to load the database
        * @property crypt to load the encryption file
        * @property logs scheme name
        * @property time-date to load the date and time
        
    */
    protected $tblu = "tbl_users";
    protected $tblf = "tbl_firm";
    protected $tblp = "tbl_position";
    protected $time,$date;
    protected $db;
    protected $crypt;
    protected $logs;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        $this->db    = \Config\Database::connect('default'); 
        $this->crypt = \Config\Services::encrypter();
        $this->logs  = new Logs();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time  = date("H:i:s");
        $this->date  = date("Y-m-d");

    }


    /**
        * @method edituser() edit the user information
        * @param duID decrypted user id
        * @var query contains database result query
        * @return json
    */
    public function edituser($duID){

        $query = $this->db->query("select *, tu.status, tp.position, tf.firm, tf.noemployee, tf.noclient, tf.address, tf.contact
        from {$this->tblu} as tu, {$this->tblf} as tf, {$this->tblp} as tp
        where tu.firm = tf.firmID
        and tu.position = tp.posID
        and tu.userID = {$duID}");
        return json_encode($query->getRowArray());

    }


    /**
        * @method getusers() get all the users
        * @param uID user id
        * @var query contains database result query
        * @return result-array
    */
    public function getusers($uID){

        $query = $this->db->query("select *, tu.status, tp.position,tu.added_on, tu.updated_on
        from {$this->tblu} as tu, {$this->tblf} as tf, {$this->tblp} as tp
        where tu.firm = tf.firmID
        and tu.position = tp.posID
        and tu.userID != {$uID}");
        return $query->getResultArray();

    }


    /**
        * @method getmyinfo() get the user personal information
        * @param uID user id
        * @var query contains database result query
        * @return row-array
    */
    public function getmyinfo($uID){

        $query = $this->db->query("select *, tu.status,tu.address,tu.contact,tp.position,tu.added_on, tu.updated_on
        from {$this->tblu} as tu, {$this->tblf} as tf, {$this->tblp} as tp
        where tu.firm = tf.firmID
        and tu.position = tp.posID
        and tu.userID = {$uID}");
        return $query->getRowArray();

    }


    /**
        * @method getfirm() get the firm information
        * @var query contains database result query
        * @return result-array
    */
    public function getfirm(){

        $query = $this->db->query("select * 
        from {$this->tblf} as tf
        where tf.firm != 'Admin'");
        return $query->getResultArray();

    }


    /**
        * @method getposition() get all the positions
        * @var query contains database result query
        * @return result-array
    */
    public function getposition(){

        $query = $this->db->table($this->tblp)->get();
        return $query->getResultArray();

    }


    /**
        * @method signin() firm signing up
        * @param array-req contains the firm data
        * @var res1 a number result of email if exist
        * @var res2 a number result of firm if exist
        * @var newlogoname the Logo Name
        * @var array-firm contains firm information
        * @var insertedId the id of firm just inserted
        * @var array-data contains contains firm user login information
        * @var email email configuration for email notification
        * @return registered-failed
    */
    public function signin($req){

        $date = new \DateTime($this->date);
        $date->modify('+30 days');
        $expdate = $date->format('Y-m-d');
        $res1 = $this->db->table($this->tblu)->where('email', $req['email'])->get()->getNumRows();
        $res2 = $this->db->table($this->tblf)->where('firm', $req['firm'])->get()->getNumRows();
        if($res1 >= 1 or $res2 >= 1){
            return 'exist';
        }else{
            if($req['logo'] != ''){
                $newlogoname = $req['logo']->getRandomName();
                $req['logo']->move(ROOTPATH .'public/uploads/logo', $newlogoname);
            }else{
                $newlogoname = '';
            }
            $firm = [
                'firm'          => $req['firm'], 
                'address'       => $req['address'],
                'contact'       => $req['contact'],
                'noemployee'    => $req['noemployee'],
                'noclient'      => $req['noclient'],
                'logo'          =>  $newlogoname,
                'status'        => 'Active',
                'added_on'      => $this->date.' '.$this->time,
                'exp_on'        => $expdate,
            ];
            $this->db->table($this->tblf)->insert($firm);
            $insertedId = $this->db->insertID();
            $data = [
                'name'          => $req['fname'],
                'firm'          => $insertedId,
                'email'         => $req['email'],
                'pass'          => $req['pass'],
                'position'      => 3,
                'type'          => 'Auditing Firm',
                'verified'      => 'No',
                'status'        => 'Active',
                'added_on'      => $this->date.' '.$this->time,
            ];
            if($this->db->table($this->tblu)->insert($data)){
                $email = \Config\Services::email();
                $email->setFrom('applaud@buildappminds.com', 'ApplAud Systems');
                $email->setTo($req['email']);
                $email->setSubject('Welcome to Applaud');
                $msg = "Dear ".$req['fname'].",\n\nWe have received your registration, Please wait a few minutes, and we will send a Confirmation once your information has been verified.\n\nThank you so much,\nApplAud Systems";
                $email->setMessage($msg);
                $email->send();
                return 'registered';
            }else{
                return 'failed';
            }
        }

    }


    /**
        * @method acceptaud() validation of auditor's account
        * @param array-req contains the auditor validation
        * @var array-where reference for the update
        * @var count count if the reference exist
        * @var newlogoname the Logo Name
        * @var array-data contains verification information
        * @var array-data contains contains firm user login information
        * @var email email configuration for email notification
        * @return confirmed-infonotfound
    */
    public function acceptaud($req){

        $where = [
            'userID' => $req['refID'],
            'email' => $req['email'],
        ];
        $count = $this->db->table($this->tblu)->where($where)->get();
        if($count->getNumRows() >= 1){
            $d = $count->getRowArray();
            if($req['password'] == $this->crypt->decrypt($d['pass'])){
                if($d['verified'] == 'No'){
                    $data = [
                        'verified' => 'Yes',
                        'email_verify_at' => $this->date.' '.$this->time,
                    ];
                    $this->db->table($this->tblu)->where(array('userID' => $d['userID']))->update($data);
                    $this->logs->log($req['email']. " has been confirmed his/her email ");
                    return 'confirmed';
                }else{
                    return 'confirmed';
                }
            }
        }else{
            return 'infonotfound';
        }

    }


    /**
        * @method adduser() register systems user
        * @param array-req contains the user data
        * @var res1 a number result of email if exist
        * @var res2 a number result of name if exist
        * @var array-data contains user information
        * @return added-failed
    */
    public function adduser($req){

        $res1 = $this->db->table($this->tblu)->where('email', $req['email'])->get()->getNumRows();
        $res2 = $this->db->table($this->tblu)->where('name', $req['name'])->get()->getNumRows();
        if($res1 >= 1 or $res2 >= 1){
            return 'exist';
        }else{
            $data = [
                'name'      => $req['name'],
                'email'     => $req['email'],
                'pass'      => $req['pass'],
                'type'      => $req['type'],
                'firm'      => $req['firm'],
                'position'  => $req['pos'],
                'verified'  => 'Yes',
                'status'    => 'Active',
                'added_on'  => $this->date.' '.$this->time
            ];
            if($this->db->table($this->tblu)->insert($data)){
                $this->logs->log(session()->get('name'). " added a user {$req['name']}");
                return 'added';
            }else{
                return 'failed';
            }
        }

    }


    /**
        * @method udpateuser() update the user
        * @param array-req contains the user data
        * @var array-data contains user information
        * @return updated-failed
    */
    public function udpateuser($req){

        $data = [
            'name'          => $req['name'],
            'email'         => $req['email'],
            'type'          => $req['type'],
            'position'      => $req['pos'],
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblu)->where('userID', $req['uID'])->update($data)){
            $this->logs->log(session()->get('name'). " updated a user {$req['name']}");
            return 'updated';
        }else{
            return 'failed';
        }

    }


    /**
        * @method updatemyinfo() use to update self information
        * @param array-req contains the user data
        * @var array-data contains user information
        * @var imagePath path of the uploaded photo
        * @var photoname photo name
        * @var signaturename signature name
        * @return updated-error
    */
    public function updatemyinfo($req){

        $data = [
            'name'          => $req['name'],
            'address'       => $req['address'],
            'pass'          => $req['pass'],
            'contact'       => $req['contact'],
            'email'         => $req['email'],
        ];
        if($req['photo'] != ''){
            $imagePath = ROOTPATH .'public/uploads/photo/'.$req['myphoto']; 
            if(file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
            $photoname = $req['photo']->getRandomName();
            $req['photo']->move(ROOTPATH .'public/uploads/photo', $photoname);
            $data['photo'] = $photoname;
            session()->set('photo', $photoname);
        }
        if($req['signature'] != ''){
            $imagePath = ROOTPATH .'public/uploads/signature/'.$req['mysignature']; 
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
            $signaturename = $req['signature']->getRandomName();
            $req['signature']->move(ROOTPATH .'public/uploads/signature', $signaturename);
            $data['signature'] = $signaturename;
            session()->set('signature', $signaturename);
        }
        if($this->db->table($this->tblu)->where('userID', $req['uID'])->update($data)){
            $this->logs->log($req['name']. " updated his/her information");
            return "updated";
        }else{
            return "error";
        }

    }


    /**
        * @method acin() set the user information to active and inactive
        * @param duID decrypted user id
        * @var query result from database
        * @var r result from database as row array
        * @var stat set the status
        * @var array-data contains auditor information going to save to database
        * @return bool
    */
    public function acin($duID){

        $query = $this->db->table($this->tblu)->where('userID', $duID)->get();
        $r = $query->getRowArray();
        $stat = '';
        if($r['status'] == 'Active'){
            $stat = 'Inactive';
        }else{
            $stat = 'Active';
        }
        $data = [
            'status' => $stat,
            'updated_on' => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblu)->where('userID', $duID)->update($data)){
            $this->logs->log(session()->get('name'). " set the information of ".$r['name']." to ".$stat);
            return true;
        }else{
            return false;
        }

    }


}