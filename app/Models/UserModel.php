<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class UserModel extends  Model {

    protected $tblu = "tbl_users";
    protected $tblf = "tbl_firm";
    protected $tblp = "tbl_position";
    protected $time,$date;
    protected $crypt;
    protected $logs;

    public function __construct(){

        $this->db   = \Config\Database::connect('default'); 
        $this->crypt = \Config\Services::encrypter();
        $this->logs = new Logs();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }

    public function edituser($duID){

        $query = $this->db->query("select *, tu.status, tp.position, tf.firm, tf.noemployee, tf.noclient, tf.address, tf.contact
        from {$this->tblu} as tu, {$this->tblf} as tf, {$this->tblp} as tp
        where tu.firm = tf.firmID
        and tu.position = tp.posID
        and tu.userID = {$duID}");
        return json_encode($query->getRowArray());

    }

    public function getusers($uID){

        $query = $this->db->query("select *, tu.status, tp.position,tu.added_on, tu.updated_on
        from {$this->tblu} as tu, {$this->tblf} as tf, {$this->tblp} as tp
        where tu.firm = tf.firmID
        and tu.position = tp.posID
        and tu.userID != {$uID}");
        return $query->getResultArray();

    }

    public function getmyinfo($uID){

        $query = $this->db->query("select *, tu.status,tu.address,tu.contact,tp.position,tu.added_on, tu.updated_on
        from {$this->tblu} as tu, {$this->tblf} as tf, {$this->tblp} as tp
        where tu.firm = tf.firmID
        and tu.position = tp.posID
        and tu.userID = {$uID}");
        return $query->getRowArray();

    }

    public function getfirm(){

        $query = $this->db->query("select * 
        from {$this->tblf} as tf
        where tf.firm != 'Admin'");
        return $query->getResultArray();

    }

    public function getposition(){

        $query = $this->db->table($this->tblp)->get();
        return $query->getResultArray();

    }

    public function signin($req){

        $res1 = $this->db->table($this->tblu)->where('email', $req['email'])->get()->getNumRows();
        $res2 = $this->db->table($this->tblf)->where('firm', $req['firm'])->get()->getNumRows();
        if($res1 >= 1 or $res2 >= 1){
            return 'exist';
        }else{
            $newlogoname = $req['logo']->getRandomName();
            $req['logo']->move(ROOTPATH .'public/uploads/logo', $newlogoname);
            $firm = [
                'firm'          => $req['firm'], 
                'address'       => $req['address'],
                'contact'       => $req['contact'],
                'noemployee'    => $req['noemployee'],
                'noclient'      => $req['noclient'],
                'logo'          =>  $newlogoname,
                'status'        => 'Active',
                'added_on'      => $this->date.' '.$this->time
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
                'added_on'      => $this->date.' '.$this->time
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