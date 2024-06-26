<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class AuditorModel extends Model{
   

    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR AUDITOR MANAGEMENT
        Properties being used on this file
        * @property tblu table of users
        * @property tblf table of firms
        * @property tblp table of positions
        * @property db to load the data base
        * @property time-date to load the date and time
        * @property logs to load the logs libraries for user activity logs
    */
    protected $tblu = "tbl_users";
    protected $tblf = "tbl_firm";
    protected $tblp = "tbl_position";
    protected $db;
    protected $time,$date;
    protected $logs;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        $this->db   = \Config\Database::connect('default'); 
        $this->logs = new Logs();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }


    /**
        * @method editauditor() to edit the information of editor
        * @param duID decrypted user id
        * @var query contains database result query
        * @return json
    */
    public function editauditor($duID){

        $query = $this->db->table($this->tblu)->where('userID', $duID)->get();
        return json_encode($query->getRowArray());
    
    }


    /**
        * @method getauditor() get all the auditors
        * @param fID firms id
        * @param uID user id
        * @var query contains database result query
        * @return query-result-as-array
    */
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


    /**
        * @method saveauditor() save the information of the auditor
        * @param array-req contains the auditor information
        * @var res1 a number result of query if data exist
        * @var sign signature name
        * @var array-data contains auditor information going to save to database
        * @var refID reference id after registering
        * @var email email configuration for email notification
        * @return registered-failed
    */
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
                $this->logs->log(session()->get('name'). " Added ".$req['name']." as a ".$req['name']." in your firm");
                return 'registered';
            }else{
                return 'failed';
            }
        }

    }


    /**
        * @method updateauditor() update the information of the auditor
        * @param array-req contains the auditor information
        * @var array-data contains auditor information going to save to database
        * @return updated-failed
    */
    public function updateauditor($req){

        $data = [
            'name'          => $req['name'],
            'email'         => $req['email'],
            'type'          => $req['type'],
            'position'      => $req['pos'],
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblu)->where('userID', $req['uID'])->update($data)){
            $this->logs->log(session()->get('name'). " Updated ".$req['name']."'s information");
            return 'updated';
        }else{
            return 'failed';
        }

    }


    /**
        * @method acin() set the auditor information to active and inactive
        * @var query result from database
        * @var r result from database as row array
        * @var stat set the status
        * @param duID user id
        * @var array-data contains auditor information going to save to database
        * @return bool
    */
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
            $this->logs->log(session()->get('name'). " Set the information of ".$r['name']." to ".$stat);
            return true;
        }else{
            return false;
        }

    }


}
