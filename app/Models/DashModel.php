<?php
namespace App\Models;
use CodeIgniter\Model;
use \App\Models\DashController;

class DashModel extends Model{
   

    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR DASHBOARD VIEW
        Properties being used on this file
        * @property tblc1 table of client files chapter 1
        * @property tblc2 table of client files chapter 2
        * @property tblc3 table of client files chapter 3
        * @property tblc table of clients
        * @property tblwp table of workpaper
        * @property tblu table of user
        * @property tblp table of position
        * @property time-date-year to load the date and time
        * @property db to load the data base
    */
    protected $tblc1    = "tbl_client_c1";
    protected $tblc2    = "tbl_client_c2";
    protected $tblc3    = "tbl_client_c3";
    protected $tblcfi   = "tbl_client_file_index";
    protected $tblc     = "tbl_clients";
    protected $tblwp    = "tbl_workpaper";
    protected $tblu     = "tbl_users";
    protected $tblp     = "tbl_position";
    protected $time,$date,$year;
    protected $db;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        $this->db   = \Config\Database::connect('default'); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");
        $this->year = date("Y");

    }


    /**
        * @method getnumauds() count all the auditors
        * @param fID firm id
        * @var query contains database result query
        * @return integer
    */
    public function getnumauds($fID){

        $query = $this->db->table($this->tblu)->where('firm',$fID)->get();
        return $query->getNumRows();

    }


    /**
        * @method getnumclients() count all the clients
        * @param fID firm id
        * @var query contains database result query
        * @return integer
    */
    public function getnumclients($fID){

        $query = $this->db->table($this->tblc)->where('fID',$fID)->get();
        return $query->getNumRows();

    }


    /**
        * @method getnumwp() count all the work paper per status
        * @param fID firm id
        * @param status status of the workpaper
        * @var where reference on the query
        * @var query contains database result query
        * @return integer
    */
    public function getnumwp($fID,$status){

        $where = ['firm' => $fID, 'status' => $status];
        $query = $this->db->table($this->tblwp)->where($where)->get();
        return $query->getNumRows();

    }


    /**
        * @method getmyauditors() get all my auditors
        * @param fID firm id
        * @var query contains database result query
        * @return result-array
    */
    public function getmyauditors($fID){

        $query = $this->db->query("select *
        from {$this->tblu} as tu, {$this->tblp} as tp
        where tu.position = tp.posID
        and tu.firm = {$fID}
        and tu.userID != 1");
        return $query->getResultArray();

    }


    /**
        * @method getwpprogress() get all the workpaper progress
        * @param fID firm id
        * @var query contains database result query
        * @return result-array
    */
    public function getwpprogress($fID){

        $query = $this->db->query("select wpID,wp.added_by,wp.client, wp.auditor, wp.supervisor,wp.audmanager, wp.firm,wp.jobdur,wp.financial_year,wp.end_financial_year,wp.status,wp.remarks,wp.added_on,
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.wpID = wp.wpID and tc1.cID = wp.client) as x1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.wpID = wp.wpID and tc2.cID = wp.client) as x2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.wpID = wp.wpID and tc3.cID = wp.client) as x3,
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.wpID = wp.wpID and tc1.cID = wp.client and updated_on IS NOT NULL) as y1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.wpID = wp.wpID and tc2.cID = wp.client and updated_on IS NOT NULL) as y2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.wpID = wp.wpID and tc3.cID = wp.client and updated_on IS NOT NULL) as y3,
        (select COUNT(*) from {$this->tblcfi} as cfi where cfi.wpID = wp.wpID and cfi.cID = wp.client and cfi.acquired = 'Yes' and cfi.status = 'Reviewing') as ir,
        (select COUNT(*) from {$this->tblcfi} as cfi where cfi.wpID = wp.wpID and cfi.cID = wp.client and cfi.acquired = 'Yes' and cfi.status = 'Checking') as ic,
        (select COUNT(*) from {$this->tblcfi} as cfi where cfi.wpID = wp.wpID and cfi.cID = wp.client and cfi.acquired = 'Yes' and cfi.status = 'Approved') as ia,
        (select COUNT(*) from {$this->tblcfi} as cfi where cfi.wpID = wp.wpID and cfi.cID = wp.client and cfi.acquired = 'Yes') as ti,
        tc.name as cli,
        tc.org
        from {$this->tblwp} as wp, {$this->tblc} as tc
        where wp.firm = {$fID}
        and tc.cID = wp.client
        and wp.financial_year = '{$this->year}'");
        return $query->getResultArray();

    }

    public function getindexprogress(){



    }


    /**
        * @method getwpp() get all the workpaper progress per year
        * @param year selected year
        * @param fID firm id
        * @var query contains database result query
        * @return json
    */
    public function getwpp($year,$fID){

        //$query = $this->db->table($this->tblu)->get();
        $query = $this->db->query("select wpID,wp.added_by,wp.client, wp.auditor, wp.supervisor,wp.audmanager, wp.firm,wp.jobdur,wp.financial_year,wp.end_financial_year,wp.status,wp.remarks,wp.added_on,
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.workpaper = wp.wpID and tc1.clientID = wp.client) as x1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.workpaper = wp.wpID and tc2.clientID = wp.client) as x2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.workpaper = wp.wpID and tc3.clientID = wp.client) as x3,
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.workpaper = wp.wpID and tc1.clientID = wp.client and updated_on IS NOT NULL) as y1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.workpaper = wp.wpID and tc2.clientID = wp.client and updated_on IS NOT NULL) as y2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.workpaper = wp.wpID and tc3.clientID = wp.client and updated_on IS NOT NULL) as y3,
        (select COUNT(*) from {$this->tblcfi} as cfi where cfi.workpaper = wp.wpID and cfi.clientID = wp.client and cfi.acquired = 'Yes' and cfi.status = 'Reviewing') as ir,
        (select COUNT(*) from {$this->tblcfi} as cfi where cfi.workpaper = wp.wpID and cfi.clientID = wp.client and cfi.acquired = 'Yes' and cfi.status = 'Checking') as ic,
        (select COUNT(*) from {$this->tblcfi} as cfi where cfi.workpaper = wp.wpID and cfi.clientID = wp.client and cfi.acquired = 'Yes' and cfi.status = 'Approved') as ia,
        (select COUNT(*) from {$this->tblcfi} as cfi where cfi.workpaper = wp.wpID and cfi.clientID = wp.client and cfi.acquired = 'Yes') as ti,
        tc.name as cli,
        tc.org
        from {$this->tblwp} as wp, {$this->tblc} as tc
        where wp.firm = {$fID}
        and tc.cID = wp.client
        and wp.financial_year = '{$year}'");
        return json_encode($query->getResultArray());

    }


    /**
        * @method getnumwpp() count progress per year
        * @param fID firm id
        * @param status status of the workpaper
        * @param year selected year
        * @var where reference on the query
        * @var query contains database result query
        * @return integer
    */
    public function getnumwpp($fID,$status,$year){

        $where = ['firm' => $fID, 'status' => $status, 'financial_year' => $year];
        $query = $this->db->table($this->tblwp)->where($where)->get();
        return $query->getNumRows();

    }


}
