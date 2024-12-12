<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class ReportModel extends  Model {


    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR REPORT GENERATION
        Properties being used on this file
        * @property tblpos table of position
        * @property logs scheme name
        * @property db to load the database
        * @property time-date to load the date and time
        
    */

    protected $tblu     = "tbl_users";
    protected $tblwp    = "tbl_workpaper";
    protected $tblc     = "tbl_clients";
    protected $tblc1t   = "tbl_c1_titles";
    protected $tblc2t   = "tbl_c2_titles";
    protected $tblc3t   = "tbl_c3_titles";
    protected $tblc1    = "tbl_client_c1";
    protected $tblc2    = "tbl_client_c2";
    protected $tblc3    = "tbl_client_c3";
    protected $tblfi    = "tbl_file_index";
    protected $tblcfi   = "tbl_client_file_index";
    protected $tbltb    = "tbl_client_trial_balance";
    protected $tblfst   = "tbl_client_fstax";
    protected $tblf     = "tbl_firm";
    protected $logs;
    protected $db;
    protected $time,$date;
    

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


    public function getsoqm($fID){

        $query = $this->db->table($this->tblf)->where('firmID',$fID)->get();
        return $query->getRowArray();
        
    }


    public function getfstax($dcID,$dwpID,$fID,$qtr,$type){

        $where = [
            'cID' => $dcID,
            'wpID' => $dwpID,
            'fID' => $fID,
            'quarter' => $qtr,
            'type' => $type,
        ];
        $query = $this->db->table($this->tblfst)->where($where)->get();
        return $query->getRowArray();

    }

    public function getfstaxgen($dcID,$dwpID,$fID){

        $where = [
            'cID' => $dcID,
            'wpID' => $dwpID,
            'fID' => $fID,
        ];
        $query = $this->db->table($this->tblfst)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getfileinfo() get the clients file chapter 1
        * @param wpID workpaper id
        * @param cID client id
        * @param mtID chapter title id
        * @var query contains database result query
        * @return row-array
    */
    public function getfileinfo($c,$wpID,$cID,$mtID){

        switch ($c) {
            case 'c1': $table = $this->tblc1;  break;
            case 'c2': $table = $this->tblc2;  break;
            case 'c3': $table = $this->tblc3;  break;
        }
        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on
        from {$table} as cc 
        where cc.wpID = {$wpID}
        and cc.cID = {$cID}
        and cc.mtID = {$mtID} limit 1");
        return $query->getRowArray();

    }

    
    /**
        * @method getc1values() get the clients chapter 1
        * @param cID client id
        * @param wpID workpaper id
        * @param status status of the file
        * @var query contains database result query
        * @return result-array
    */
    public function getc1values($cID,$wpID){

        $query = $this->db->query("select DISTINCT title,c1t.code,c1t.mtID,c1.remarks,c1.status
        from {$this->tblc1t} as c1t, {$this->tblc1} as c1
        where c1t.mtID = c1.mtID
        and c1.cID = {$cID}
        and c1.wpID = {$wpID}
        order by mtID asc");
        return $query->getResultArray();

    }


    /**
        * @method getc2values() get the files of client chapter 2
        * @param cID client id
        * @param wpID workpaper id
        * @param status status of the file
        * @var query contains database result query
        * @return result-array
    */
    public function getc2values($cID,$wpID){

        $query = $this->db->query("select DISTINCT title,c2t.code,c2t.mtID,c2.remarks,c2.status
        from {$this->tblc2t} as c2t, {$this->tblc2} as c2
        where c2t.mtID = c2.mtID
        and c2.cID = {$cID}
        and c2.wpID = {$wpID}
        order by mtID asc");
        return $query->getResultArray();

    }


    /**
        * @method getc2values() get the files of client chapter 3
        * @param cID client id
        * @param wpID workpaper id
        * @param status status of the file
        * @var query contains database result query
        * @return result-array
    */
    public function getc3values($cID,$wpID){

        $query = $this->db->query("select DISTINCT title,c3t.code,c3t.mtID,c3.remarks,c3.status
        from {$this->tblc3t} as c3t, {$this->tblc3} as c3
        where c3t.mtID = c3.mtID
        and c3.cID = {$cID}
        and c3.wpID = '{$wpID}'
        order by mtID asc");
        return $query->getResultArray();

    }


    /**
        * @method getfileindex() get the clients file index
        * @param cID client id
        * @param wpID workpaper id
        * @param status status of the file
        * @var query contains database result query
        * @return result-array
    */
    public function getfileindex($cID,$wpID){

        $query = $this->db->query("select *
        from {$this->tblcfi} as cfi, {$this->tblfi} as fi
        where cfi.index = fi.fiID
        and cfi.wpID = {$wpID}
        and cfi.cID = {$cID}
        and acquired = 'Yes'");
        return $query->getResultArray();

    }


    /**
        * @method getlatestupload() get the latest upload og trial balance
        * @param cID client id
        * @param wpID work paper id
        * @var query contains database result query
        * @return row-array
    */
    public function getlatestupload($cID,$wpID){

        $query = $this->db->query("select DISTINCT cfi.added_on,cfi.added_by,tu.name
        from {$this->tblu} as tu, {$this->tbltb} as cfi
        where tu.userID = cfi.added_by
        and cfi.wpID = {$wpID}
        and cfi.cID = {$cID}");
        return $query->getRowArray();

    }

    /**
        * @method gettrialbalance() get the trial balance
        * @param cID client id
        * @param wpID work paper id
        * @var query contains database result query
        * @return result-array
    */
    public function gettrialbalance($cID,$wpID){

        $query = $this->db->query("select *
        from {$this->tbltb} as cfi, {$this->tblfi} as fi
        where cfi.index = fi.fiID
        and cfi.wpID = {$wpID}
        and cfi.cID = {$cID}");
        return $query->getResultArray();

    }


    /**
        * @method getindexfile() get the index file
        * @var query contains database result query
        * @return result-array
    */
    public function getindexfile(){

        $query = $this->db->query("select * 
        from {$this->tblfi} as fi
        where fi.fiID >= 6
        and fi.fiID <= 22");
        return $query->getResultArray();

    }


    /**
        * @method getclientinfo() get the clients workpaper
        * @param wpID workpaper id
        * @param cID client id
        * @param type type of auditor
        * @var query contains database result query
        * @return row-array
    */
    public function getclientinfo($wpID,$cID){

        $query = $this->db->query("select wpID,wp.added_by,wp.client, wp.auditor, wp.supervisor,wp.audmanager, wp.firm,wp.jobdur,wp.financial_year,wp.end_financial_year,wp.status,wp.remarks,wp.added_on,
        (select name from {$this->tblu} as tu where tu.userID = wp.auditor) as aud,
        (select name from {$this->tblu} as tu where tu.userID = wp.supervisor) as sup,
        (select name from {$this->tblu} as tu where tu.userID = wp.audmanager) as audm,
        (select signature from {$this->tblu} as tu where tu.userID = wp.auditor) as audsign,
        (select signature from {$this->tblu} as tu where tu.userID = wp.supervisor) as supsign,
        (select signature from {$this->tblu} as tu where tu.userID = wp.audmanager) as mansign,
        tc.name as clientname,
        tc.address as clientaddress
        from {$this->tblwp} as wp, {$this->tblc} as tc
        where tc.cID = wp.client
        and wp.wpID = {$wpID}
        and wp.client = {$cID}");
        return $query->getRowArray();

    }

    /**
     
        ----------------------------------------------------------
        WORKPAPER FUNCTIONS
        ----------------------------------------------------------
        * @method gettbindex() get the index file values
        * @param cID client id
        * @param wpID work paper id
        * @param index index id
        * @var query contains database result query
        * @return result-array
    */
    public function gettbindex($cID,$wpID,$index){

        $query = $this->db->query("select * 
        from {$this->tbltb} as tb
        where tb.index = {$index}
        and tb.wpID = {$wpID}
        and tb.cID = {$cID}");
        return $query->getResultArray();

    }




    /**
        ----------------------------------------------------------
        CHAPTER GET FUNCTIONS
        ----------------------------------------------------------
    */
    public function getvalues_m($c,$type,$code,$mtID,$cID,$wpID){

        switch ($c) {
            case 'c1': $table = $this->tblc1; break;
            case 'c2': $table = $this->tblc2; break;
            case 'c3': $table = $this->tblc3; break;
        }
        $where = [
            'code'     => $code, 
            'type'     => $type,
            'mtID'     => $mtID,
            'cID'      => $cID,
            'wpID'     => $wpID,
        ];
        $query =  $this->db->table($table)->where($where)->get();
        return $query->getResultArray();

    }

    public function getvalues_s($c,$type,$code,$mtID,$cID,$wpID){

        switch ($c) {
            case 'c1': $table = $this->tblc1; break;
            case 'c2': $table = $this->tblc2; break;
            case 'c3': $table = $this->tblc3; break;
        }
        $where = [
            'code'     => $code, 
            'type'     => $type,
            'mtID'     => $mtID,
            'cID'      => $cID,
            'wpID'     => $wpID,
        ];
        $query =  $this->db->table($table)->where($where)->get();
        return $query->getrowArray();

    }


   


    



    /**
        * @method getdatacount() get the ac10 information
        * @param mtID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return integer
    */
    public function getdatacount($mtID,$part,$dcID,$dwpID){

        $where = [
            'type'     => $part, 
            'code'     => 'ac10', 
            'mtID'     => $mtID,
            'cID'      => $dcID,
            'wpID'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc2)->where($where);
        return $query->countAllResults();

    }

    /**
        * @method getsumation() get the ac10 information
        * @param mtID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where1-where2 reference data
        * @var query result from database
        * @return integer
    */
    public function getsumation($mtID,$part,$dcID,$dwpID){

        $where1 = [
            'type'     => $part, 
            'code'     => 'ac10', 
            'mtID'     => $mtID,
            'cID'      => $dcID,
            'wpID'     => $dwpID,
        ];
        $where2 = [
            'type'     => $part.'cu',  
            'code'     => 'ac10', 
            'mtID'     => $mtID,
            'cID'      => $dcID,
            'wpID'     => $dwpID,
        ];
        $total = $this->db->table($this->tblc2)->selectSum('field2')->where($where1)->get()->getRowArray();
        $cu = $this->db->table($this->tblc2)->where($where2)->get()->getRowArray();
        return $cu['field1'] - $total['field2'];

    }

    /**
        * @method getsummarydata() get the ac10 information
        * @param mtID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getsummarydata($mtID,$part,$dcID,$dwpID){

        $where2 = [
            'type'          => $part.'data', 
            'code'     => 'ac10', 
            'mtID'     => $mtID,
            'cID'      => $dcID,
            'wpID'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc2)->where($where2)->get();
        return $query->getRowArray();

    }

 


    


}