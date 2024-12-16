<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class SystemModel extends  Model {


    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR POSITION MANAGEMENT
        Properties being used on this file
        * @property tblf table of firms
        * @property logs scheme name
        * @property db to load the database
        * @property time-date to load the date and time
        
    */
    protected $tblf = "tbl_firm";
    protected $tbln = "tbl_notification";
    protected $tbls = "tbl_soqm";
    protected $logs;
    protected $crypt;
    protected $db;
    protected $time,$date;
    

    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        $this->db           = \Config\Database::connect('default'); 
        $this->logs         = new Logs();
        $this->crypt        = \Config\Services::encrypter();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time         = date("H:i:s");
        $this->date         = date("Y-m-d");

    }

    public function crontask(){
        
        $firm = $this->db->table($this->tblf)->get()->getResultArray();
        foreach($firm as $f){
            $now = new \DateTime();
            $targetdate = new \DateTime($f['exp_on']);
            $interval = $now->diff($targetdate);
            $days = $interval->invert ? -$interval->days : $interval->days;
            if($days < 15){
                $intensity = 'info';
                if($days <= 0){
                    $intensity = 'danger';
                    $msg = 'Your subscription has been expired, please re-new.';
                }else{
                    $intensity = 'warning';
                    $msg = 'Your subscription will expire in '.$days. ' days';
                }
                $data = [
                    'firm' => $f['firmID'],
                    'intensity' => $intensity,
                    'msg' => $msg,
                    'added_on' => $this->date.' '.$this->time
                ];
                $this->db->table($this->tbln)->insert($data);
                $insertedId = $this->db->insertID();
                $this->logs->cronlogs('Cron Job success Ref: '.$insertedId);
            }
        }

        return true;

    }

    public function getnotif(){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        $where = [
            'firm' => $fID,
            'isread' => 'No',
        ];
        $query = $this->db->table($this->tbln)->where($where)->get();
        return $query->getResultArray();

    }

    public function countnotif(){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        $where = [
            'firm' => $fID,
        ];
        $query = $this->db->table($this->tbln)->where($where)->get();
        return $query->getNumRows();

    }

    public function removenotif($nID){

        if($this->db->table($this->tbln)->where('notifID', $nID)->delete()){
            return 'deleted';
        }

    }

    public function getsoqm(){

        $soqm = $this->db->table($this->tbls)->where('soqmID',1)->get();
        return $soqm->getRowArray();

    }

    public function getfirmsoqm(){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        $query = $this->db->table($this->tblf)->where('firmID',$fID)->get();
        return $query->getRowArray();

    }

    public function uploadsoqm($req){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        $res = $this->db->table($this->tblf)->where('firmID',$fID)->get()->getRowArray();
        $filename = $req['file']->getClientName();
        if($req['file'] != ''){
            $pdfPath = ROOTPATH .'/public/uploads/pdf/'.$fID.'/soqm/';
            if (!is_dir($pdfPath)) {
                mkdir($pdfPath, 0755, true);
            }
            $pdfonfile  = $pdfPath.$filename; 
            if (file_exists($pdfonfile)) {
                unlink($pdfonfile);
            }
            $pdfondb    = $pdfPath.$res['soqm_data']; 
            if (file_exists($pdfondb)) {
                unlink($pdfondb);
            }
            $req['file']->move($pdfPath);
        }
        $data = [
            'soqm_data'     => $filename,
            'soqm'          => 'Uploaded',
        ];
        if($this->db->table($this->tblf)->where('firmID', $fID)->update($data)){
            $this->logs->log(session()->get('name'). " uploaded a file on work paper");
            return true;
        }
        
    }

    public function usesoqm(){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        $soqm = $this->db->table($this->tbls)->where('soqmID',1)->get()->getRowArray();
        $data = [
            'soqm'      => 'Using', 
            'soqm_data' => $soqm['data']
        ];
        if($this->db->table($this->tblf)->where('firmID',$fID)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    public function savesoqm($req){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        if($this->db->table($this->tblf)->where('firmID',$fID)->update(array('soqm_data' => $req))){
            return true;
        }else{
            return false;
        }

    }


    

    


}