<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class AuditorModel extends Model{
   
    // Properties
    protected $tblu = "tbl_users";
    protected $tblf = "tbl_firm";
    protected $tblp = "tbl_position";
    protected $db;
    protected $time,$date;
    protected $logs;

    // Load the method on the properties
    public function __construct(){

        $this->db   = \Config\Database::connect('default'); 
        $this->logs = new Logs();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

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

    // Getting and editing the information of auditor based on id
    public function editauditor($uID){
        // query result
        $query = $this->db->table($this->tblu)->where('userID', $uID)->get();
        // return as single row data
        return json_encode($query->getRowArray());
    }

    // Get the firm's Auditors information
    public function getauditor($fID,$uID){
        // query result
        $query = $this->db->query("select *, tu.status, tp.position
        from {$this->tblu} as tu, {$this->tblf} as tf, {$this->tblp} as tp
        where tu.firm = tf.firmID
        and tu.position = tp.posID
        and tu.firm = {$fID}
        and tu.type != 'Admin'
        and tu.userID != {$uID}");
        // return as multiple row data
        return $query->getResultArray();
    }

    // Register the Auditor's Information
    public function saveauditor($req){
        // query result
        $res1 = $this->db->table($this->tblu)->where('email', $req['email'])->get()->getNumRows();
        // check if exist
        if($res1 >= 1){
            return 'exist';
        }else{
            $sign = '';
            // checking if the user uploaded a signature
            if($req['signature'] != ''){
                // getting the signature filename
                $sign = $req['signature']->getClientName();
                // folder path for storing the signature
                $signPath = ROOTPATH .'public/uploads/img/'.$req['fID'].'/signature/';
                if (!is_dir($signPath)) {
                    mkdir($signPath, 0755, true);
                }
                // check if file already exist and removed it
                $uploadpath = $signPath.$sign; 
                if (file_exists($uploadpath)) {
                    unlink($uploadpath);
                }
                // upload the signature
                $req['signature']->move($signPath, $sign);
            }
            // data container of Auditor's Information
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
            // save execution
            if($this->db->table($this->tblu)->insert($data)){
                // getting the id of the last inserted
                $refID = $this->db->insertID();
                // sending an email
                $email = \Config\Services::email();
                $email->setFrom('applaud@buildappminds.com', 'ApplAud Systems');
                $email->setTo($req['email']);
                //$email->setTo('daviesjohn234567@gmail.com');
                $email->setSubject('Welcome to Applaud');
                $msg = "Dear ".ucfirst($req['name']).",\n\n".$req['firm']." added you as their ".$req['type']." on the firm, Click this Link for verificaton ".base_url('aud/').$req['email'].".\n\n Your password is: ".$req['genpass']." \n Your Reference ID is:".$refID."\n\nThank you so much,\nApplAud Systems";
                $email->setMessage($msg);
                $email->send();
                // log the action
                $this->logs->log(session()->get('name'). " Added ".$req['name']." as a ".$req['name']." in your firm");
                //return bool
                return true;
            }else{
                return false;
            }
        }

    }

    // Update the Auditor's information
    public function updateauditor($req){

        // data container of Auditor's Information
        $data = [
            'name'          => $req['name'],
            'email'         => $req['email'],
            'type'          => $req['type'],
            'position'      => $req['pos'],
            'updated_on'    => $this->date.' '.$this->time
        ];
        // update execution
        if($this->db->table($this->tblu)->where('userID', $req['uID'])->update($data)){
            // log the action
            $this->logs->log(session()->get('name'). " Updated ".$req['name']."'s information");
            //return updated
            return 'updated';
        }else{
            return false;
        }

    }


    // Set to active & Inactive the Auditor's information
    public function acin($duID){

        // query result
        $query      = $this->db->table($this->tblu)->where('userID', $duID)->get();
        // get as single row data
        $r          = $query->getRowArray();
        $stat       = '';
        // check and set the current status
        if($r['status'] == 'Active'){
            $stat = 'Inactive';
        }else{
            $stat = 'Active';
        }
        // set the new status
        $data = [
            'status' => $stat,
            'updated_on' => $this->date.' '.$this->time
        ];
        // update execution
        if($this->db->table($this->tblu)->where('userID', $duID)->update($data)){
            // log the action
            $this->logs->log(session()->get('name'). " Set the information of ".$r['name']." to ".$stat);
            //return updated
            return 'updated';
        }else{
            return false;
        }

    }


}
