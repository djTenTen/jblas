<?php
namespace App\Models;
use CodeIgniter\Model;

class AuditorModel extends Model{
   

    protected $tblu = "tbl_users";
    protected $tblf = "tbl_firm";
    protected $tblp = "tbl_position";
    protected $time,$date;

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }

    public function editauditor($duID){

        $query = $this->db->table($this->tblu)->where('userID', $duID)->get();
        $r = $query->getRowArray();
        $data = [
            'name'  => $r['name'],
            'email' => $r['email'],
            'type'  =>  $r['type']
        ];
        return json_encode($data);
    
    }

    public function getauditor($fID,$uID){

        $query = $this->db->query("select *, tu.status, tp.position
        from {$this->tblu} as tu, {$this->tblf} as tf, {$this->tblp} as tp
        where tu.firm = tf.firmID
        and tu.position = tp.posID
        and tu.firm = {$fID}
        and tu.type != 'Admin'
        and tu.userID != {$uID}");
        return $query->getResultArray();

    }

    public function saveauditor($req){

        $res1 = $this->db->table($this->tblu)->where('email', $req['email'])->get()->getNumRows();
        if($res1 >= 1){
            return 'exist';
        }else{
            $sign = $req['signature']->getRandomName();
            $req['signature']->move(ROOTPATH .'public/uploads/signature', $sign);
            $data = [
                'name'      => ucfirst($req['name']),
                'email'     => $req['email'],
                'address'   => $req['address'],
                'contact'   => $req['contact'],
                'pass'      => $req['pass'],
                'type'      => $req['type'],
                'firm'      => $req['fID'],
                'position'  => $req['pos'],
                'status'    => 'Active',
                'signature' => $sign,
                'verified'  => 'No',
                'added_on'  => $this->date.' '.$this->time,
            ];
            if($this->db->table($this->tblu)->insert($data)){
                $refID = $this->db->insertID();
                $email = \Config\Services::email();
                $email->setFrom('applaud@buildappminds.com', 'ApplAud Systems');
                $email->setTo($req['email']);
                //$email->setTo('daviesjohn234567@gmail.com');
                $email->setSubject('Welcome to Applaud');
                $msg = "Dear ".ucfirst($req['name']).",\n\n".$req['firm']." added you as their ".$req['type']." on the firm, Click this Link for verificaton ".base_url('aud/').$req['email'].".\n\n Your password is: ".$req['genpass']." \n Your Reference ID is:".$refID."\n\nThank you so much,\nApplAud Systems";
                $email->setMessage($msg);
                $email->send();
                return 'registered';
            }else{
                return 'failed';
            }
        }

    }

    public function updateauditor($req){

        $data = [
            'name'          => $req['name'],
            'email'         => $req['email'],
            'type'          => $req['type'],
            'position'      => $req['pos'],
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblu)->where('userID', $req['uID'])->update($data)){
            return 'updated';
        }else{
            return 'failed';
        }

    }

    public function acin($duID){

        $query      = $this->db->table($this->tblu)->where('userID', $duID)->get();
        $r          = $query->getRowArray();
        $stat       = '';
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
            return true;
        }else{
            return false;
        }

    }


}
