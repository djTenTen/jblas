<?php
namespace App\Models;
use CodeIgniter\Model;
use \App\Models\DashController;

class DashModel extends Model{
   
    protected $tblc1    = "tbl_client_files_c1";
    protected $tblc2    = "tbl_client_files_c2";
    protected $tblc3    = "tbl_client_files_c3";
    protected $tblc     = "tbl_clients";
    protected $tblwp    = "tbl_workpaper";
    protected $tblu     = "tbl_users";
    protected $tblp     = "tbl_position";
    protected $time,$date,$year;

    public function __construct(){

        $this->db   = \Config\Database::connect('default'); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");
        $this->year = date("Y");

    }

    public function getnumauds($fID){

        $query = $this->db->table($this->tblu)->where('firm',$fID)->get();
        return $query->getNumRows();

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

    public function getwpprogress($fID){

        $query = $this->db->query("select wpID,wp.added_by,wp.client, wp.auditor, wp.supervisor,wp.audmanager, wp.firm,wp.jobdur,wp.financial_year,wp.end_financial_year,wp.status,wp.remarks,wp.added_on,
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.workpaper = wp.wpID and tc1.clientID = wp.client) as x1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.workpaper = wp.wpID and tc2.clientID = wp.client) as x2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.workpaper = wp.wpID and tc3.clientID = wp.client) as x3,
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.workpaper = wp.wpID and tc1.clientID = wp.client and updated_on IS NOT NULL) as y1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.workpaper = wp.wpID and tc2.clientID = wp.client and updated_on IS NOT NULL) as y2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.workpaper = wp.wpID and tc3.clientID = wp.client and updated_on IS NOT NULL) as y3,
        tc.name as cli,
        tc.org
        from {$this->tblwp} as wp, {$this->tblc} as tc
        where wp.firm = {$fID}
        and tc.cID = wp.client
        and wp.financial_year = '{$this->year}'");
        return $query->getResultArray();

    }

    public function getwpp($year,$fID){

        //$query = $this->db->table($this->tblu)->get();
        $query = $this->db->query("select wpID,wp.added_by,wp.client, wp.auditor, wp.supervisor,wp.audmanager, wp.firm,wp.jobdur,wp.financial_year,wp.end_financial_year,wp.status,wp.remarks,wp.added_on,
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.workpaper = wp.wpID and tc1.clientID = wp.client) as x1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.workpaper = wp.wpID and tc2.clientID = wp.client) as x2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.workpaper = wp.wpID and tc3.clientID = wp.client) as x3,
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.workpaper = wp.wpID and tc1.clientID = wp.client and updated_on IS NOT NULL) as y1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.workpaper = wp.wpID and tc2.clientID = wp.client and updated_on IS NOT NULL) as y2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.workpaper = wp.wpID and tc3.clientID = wp.client and updated_on IS NOT NULL) as y3,
        tc.name as cli,
        tc.org
        from {$this->tblwp} as wp, {$this->tblc} as tc
        where wp.firm = {$fID}
        and tc.cID = wp.client
        and wp.financial_year = '{$year}'");
        return json_encode($query->getResultArray());

    }

    public function getnumwpp($fID,$status,$year){

        $where = ['firm' => $fID, 'status' => $status, 'financial_year' => $year];
        $query = $this->db->table($this->tblwp)->where($where)->get();
        return $query->getNumRows();

    }


}
