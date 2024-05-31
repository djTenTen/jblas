<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class PositionModel extends  Model {


    protected $tblpos = "tbl_position";
    protected $time,$date;
    protected $logs;

    public function __construct(){

        $this->db   = \Config\Database::connect('default'); 
        $this->logs = new Logs();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }

    public function editposition($pID){

        $query = $this->db->table($this->tblpos)->where('posID', $pID)->get();
        $r = $query->getRowArray();
        $data = [
            'position'  => $r['position'],
            'allowed'   => $r['allowed']
        ];
        return json_encode($data);

    }

    public function getposition(){

        $query = $this->db->table($this->tblpos)->get();
        return $query->getResultArray();

    }

    public function saveposition($req){

        $data = [
            'position'      => $req['pos'],
            'allowed'       => $req['dpt'],
            'status'        => $req['status'],
            'added_on'      => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblpos)->insert($data)){
            $this->logs->log(session()->get('name'). " added a position in the system");
            return true;
        }else{
            return false;
        }

    }

    public function updateposition($req){

        $data = [
            'position'      => $req['pos'],
            'allowed'       => $req['dpt'],
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblpos)->where('posID', $req['pID'])->update($data)){
            $this->logs->log(session()->get('name'). " updated a position in the system");
            return true;
        }else{
            return false;
        }

    }

    public function acin($dpID){

        $query = $this->db->table($this->tblpos)->where('posID', $dpID)->get();
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
        if($this->db->table($this->tblpos)->where('posID', $dpID)->update($data)){
            $this->logs->log(session()->get('name'). " set the information of ".$r['position']." to ".$stat);
            return true;
        }else{
            return false;
        }

    }


}