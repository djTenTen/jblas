<?php
namespace App\Models;
use CodeIgniter\Model;
use \App\Models\DashController;

class DashModel extends Model{
   

    protected $tblc     = "tbl_clients";
    protected $tblwp    = "tbl_workpaper";
    protected $tblu     = "tbl_users";
    protected $tblp     = "tbl_position";
    protected $time,$date;

    public function __construct(){

        $this->db   = \Config\Database::connect('default'); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }

    public function getnumclients($fID){

        $query = $this->db->table($this->tblc)->where('fID',$fID)->get();
        return $query->getNumRows();

    }

    public function getnumwp($fID,$status){

        $where = ['firm' => $fID, 'status' => $status];
        $query = $this->db->table($this->tblwp)->where($where)->get();
        return $query->getNumRows();

    }

    public function getmyauditors($fID){

        $query = $this->db->query("select *
        from {$this->tblu} as tu, {$this->tblp} as tp
        where tu.position = tp.posID
        and tu.firm = {$fID}
        and tu.userID != 1");
        return $query->getResultArray();

    }


}
