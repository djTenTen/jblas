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
    protected $tblc1    = "tbl_client_files_c1";
    protected $tblc2    = "tbl_client_files_c2";
    protected $tblc3    = "tbl_client_files_c3";
    protected $tblfi    = "tbl_file_index";
    protected $tblcfi   = "tbl_client_file_index";
    protected $tbltb    = "tbl_client_trial_balance";

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

    
    /**
        * @method getc1values() get the clients chapter 1
        * @param cID client id
        * @param wpID workpaper id
        * @param status status of the file
        * @var query contains database result query
        * @return result-array
    */
    public function getc1values($cID,$wpID){

        $query = $this->db->query("select DISTINCT title,c1t.code,c1titleID,c1tID,c1.remarks,c1.status
        from {$this->tblc1t} as c1t, {$this->tblc1} as c1
        where c1t.c1titleID = c1.c1tID
        and c1.clientID = {$cID}
        and c1.workpaper = {$wpID}
        order by c1titleID asc");
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

        $query = $this->db->query("select DISTINCT title,c2t.code,c2titleID,c2tID,c2.remarks,c2.status
        from {$this->tblc2t} as c2t, {$this->tblc2} as c2
        where c2t.c2titleID = c2.c2tID
        and c2.clientID = {$cID}
        and c2.workpaper = {$wpID}
        order by c2titleID asc");
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

        $query = $this->db->query("select DISTINCT title,c3t.code,c3titleID,c3tID,c3.remarks,c3.status
        from {$this->tblc3t} as c3t, {$this->tblc3} as c3
        where c3t.c3titleID = c3.c3tID
        and c3.clientID = {$cID}
        and c3.workpaper = '{$wpID}'
        order by c3titleID asc");
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
        and cfi.workpaper = {$wpID}
        and cfi.clientID = {$cID}
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
        and cfi.workpaper = {$wpID}
        and cfi.client = {$cID}");
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
        and cfi.workpaper = {$wpID}
        and cfi.client = {$cID}");
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
        tc.name as clientname
        from {$this->tblwp} as wp, {$this->tblc} as tc
        where tc.cID = wp.client
        and wp.wpID = {$wpID}
        and wp.client = {$cID}");
        return $query->getRowArray();

    }


    /**
        * @method getfileinfoc1() get the clients file chapter 1
        * @param wpID workpaper id
        * @param cID client id
        * @param ctID chapter title id
        * @var query contains database result query
        * @return row-array
    */
    public function getfileinfoc1($wpID,$cID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on
        from {$this->tblc1} as c1 
        where c1.workpaper = {$wpID}
        and c1.clientID = {$cID} limit 1");
        return $query->getRowArray();

    }

    
    /**
        * @method getfileinfoc2() get the clients file chapter 2
        * @param wpID workpaper id
        * @param cID client id
        * @param ctID chapter title id
        * @var query contains database result query
        * @return row-array
    */
    public function getfileinfoc2($wpID,$cID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on 
        from {$this->tblc2} as c2 
        where c2.workpaper = {$wpID}
        and c2.clientID = {$cID} limit 1");
        return $query->getRowArray();

    }


    /**
        * @method getfileinfoc2() get the clients file chapter 2
        * @param wpID workpaper id
        * @param cID client id
        * @param ctID chapter title id
        * @var query contains database result query
        * @return row-array
    */
    public function getfileinfoc3($wpID,$cID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on 
        from {$this->tblc3} as c3 
        where c3.workpaper = {$wpID}
        and c3.clientID = {$cID} limit 1");
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
        and tb.workpaper = {$wpID}
        and tb.client = {$cID}");
        return $query->getResultArray();

    }











    /**
        ----------------------------------------------------------
        CHAPTER 1
        AC1 FUNCTIONS
        ----------------------------------------------------------
        * @method getac1() get the ac1 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac1($code,$c1tID,$dcID,$dwpID){

        $where = [
            'code'          => $code, 
            'type'          => 'cacf',
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query =  $this->db->table($this->tblc1)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getac1eqr() get the ac1 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac1eqr($code,$c1tID,$dcID,$dwpID){
        
        $where = [
            'code'          => $code, 
            'type'          => 'eqr', 
            'c1tID'         => $c1tID, 
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query =  $this->db->table($this->tblc1)->where($where)->get();
        return $query->getRowArray();

    }


    /**
        ----------------------------------------------------------
        AC2 FUNCTIONS
        ----------------------------------------------------------
        * @method getac2() get the ac2 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac2($code,$c1tID,$dcID,$dwpID){

        $where = [
            'code'          => $code, 
            'type'          => 'pans',
            'c1tID'         => $c1tID, 
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query =  $this->db->table($this->tblc1)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getac2aep() get the ac2 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac2aep($code,$c1tID,$dcID,$dwpID){

        $where = [
            'code'          => $code, 
            'type'          => 'ac2aep',
            'c1tID'         => $c1tID, 
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query =  $this->db->table($this->tblc1)->where($where)->get();
        return $query->getRowArray();

    }
    
    /**
        ----------------------------------------------------------
        AC3 FUNCTIONS
        ----------------------------------------------------------
        * @method getac3() get the ac3 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac3($part,$code,$c1tID,$dcID,$dwpID){

        $where = [
            'code'          => $code, 
            'type'          => $part,
            'c1tID'         => $c1tID, 
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getResultArray();

    }


    /**
        ----------------------------------------------------------
        AC4 FUNCTIONS
        ----------------------------------------------------------
        * @method getac4ppr() get the ac4 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac4ppr($code,$c1tID,$dcID,$dwpID){

        $where = [
            'code'      => $code, 
            'type'      => 'ppr',
            'c1tID'     => $c1tID, 
            'clientID'  => $dcID,
            'workpaper' => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getRowArray();

    }

    /**
        * @method getac4() get the ac4 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac4($code,$c1tID,$dcID,$dwpID){

        $where = [
            'code'          => $code, 
            'type'          => 'ac4sod',
            'c1tID'         => $c1tID, 
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getResultArray();

    }

    
    /**
        ----------------------------------------------------------
        AC5 FUNCTIONS
        ----------------------------------------------------------
        * @method getac5() get the ac5 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac5($code,$c1tID,$dcID,$dwpID){

        $where = [
            'code'          => $code, 
            'type'          => 'rescon',
            'c1tID'         => $c1tID, 
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where )->get();
        return $query->getRowArray();

    }

    /**
        ----------------------------------------------------------
        AC6 FUNCTIONS
        ----------------------------------------------------------
        * @method getac6() get the ac6 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac6($part,$code,$c1tID,$dcID,$dwpID){

        $where = [
            'code'          => $code, 
            'type'          => $part,
            'c1tID'         => $c1tID, 
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method gets12() get the ac6 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function gets12($code,$c1tID,$dcID,$dwpID){

        $where = [
            'code'          => $code, 
            'type'          => 'ac6s12',
            'c1tID'         => $c1tID, 
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getRowArray();

    }

    /**
        ----------------------------------------------------------
        AC7 FUNCTIONS
        ----------------------------------------------------------
        * @method getac7() get the ac7 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac7($code,$c1tID,$part,$dcID,$dwpID){

        $where = [
            'type'          => $part, 
            'code'          => $code, 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getRowArray();

    }
    
    /**
        ----------------------------------------------------------
        AC8 FUNCTIONS
        ----------------------------------------------------------
        * @method getac8() get the ac8 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac8($code,$c1tID,$part,$dcID,$dwpID){

        $where = [
            'type'          => $part, 
            'code'          => $code, 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getRowArray();

    }

    
    /**
        ----------------------------------------------------------
        AC9 FUNCTIONS
        ----------------------------------------------------------
        * @method getac9data() get the ac9 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac9data($code,$c1tID,$dcID,$dwpID){

        $where = [
            'type'      => 'ac9data', 
            'code'      => $code, 
            'c1tID'     => $c1tID,
            'clientID'  => $dcID,
            'workpaper' => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getRowArray();

    }

   
    /**
        ----------------------------------------------------------
        AC10 FUNCTIONS
        ----------------------------------------------------------
        * @method getac10s1data() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac10s1data($c1tID,$part,$dcID,$dwpID){

        $where = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'question'      => 'section1',
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getResultArray();

    }


    /**
        * @method getac10s2data() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac10s2data($c1tID,$part,$dcID,$dwpID){

        $where = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'question'      => 'section2',
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getac10cu() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac10cu($c1tID,$part,$dcID,$dwpID){

        $where = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getRowArray();

    }

    /**
        * @method getdatacount() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return integer
    */
    public function getdatacount($c1tID,$part,$dcID,$dwpID){

        $where = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where);
        return $query->countAllResults();

    }

    /**
        * @method getsumation() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where1-where2 reference data
        * @var query result from database
        * @return integer
    */
    public function getsumation($c1tID,$part,$dcID,$dwpID){

        $where1 = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $where2 = [
            'type'          => $part.'cu', 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $total = $this->db->table($this->tblc1)->selectSum('balance')->where($where1)->get()->getRowArray();
        $cu = $this->db->table($this->tblc1)->where($where2)->get()->getRowArray();
        return $cu['question'] - $total['balance'];

    }

    /**
        * @method getsummarydata() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getsummarydata($c1tID,$part,$dcID,$dwpID){

        $where2 = [
            'type'          => $part.'data', 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where2)->get();
        return $query->getRowArray();

    }

    /**
        ----------------------------------------------------------
        AC11 FUNCTIONS
        ----------------------------------------------------------
        * @method getac11data() get the ac11 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac11data($code,$c1tID,$dcID,$dwpID){

        $where = [
            'type'          => 'ac11data',
            'code'          => $code,
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getRowArray();

    }

    
    /**
        ----------------------------------------------------------
        CHAPTER 2 FUNCTIONS
        ----------------------------------------------------------
        * @method getquestionsdata() get the chapter 2 data information
        * @param code contains file codes
        * @param c2tID chapter 2 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getquestionsdata($code,$c2tID,$dcID,$dwpID){

        $where = [
            'type'          => $code,
            'code'          => $code,
            'c2tID'         => $c2tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc2)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getquestionsaicpppa() get the chapter 2 data information
        * @param code contains file codes
        * @param c2tID chapter 2 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getquestionsaicpppa($code,$c2tID,$dcID,$dwpID){

        $where = [
            'type'          => 'aicpppa',
            'code'          => $code,
            'c2tID'         => $c2tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc2)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getquestionsrcicp() get the chapter 2 data information
        * @param code contains file codes
        * @param c2tID chapter 2 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getquestionsrcicp($code,$c2tID,$dcID,$dwpID){

        $where = [
            'type'          => 'rcicp',
            'code'          => $code,
            'c2tID'         => $c2tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc2)->where($where)->get();
        return $query->getResultArray();

    }
   

    /**
        ----------------------------------------------------------
        CHAPTER 3
        AA1 FUNCTIONS
        ----------------------------------------------------------
        * @method getaa1() get the aa1 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa1($part,$code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa1s3() save the aa1 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa1s3($code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => 'section3',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getRowArray();

    }


    /**
        ----------------------------------------------------------
        AA2 FUNCTIONS
        ----------------------------------------------------------
        * @method getaa2data() get the aa2 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa2data($code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'      => 'aa2',
            'code'      => $code,
            'c3tID'     => $c3tID,
            'clientID'  => $dcID,
            'workpaper' => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getRowArray();

    }

    
    /**
        ----------------------------------------------------------
        AA3a FUNCTIONS
        ----------------------------------------------------------
        * @method getaa3() get the aa3a information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa3($part,$code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa3air() get the aa3a information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa3air($code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => 'ir',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getRowArray();

    }


    /**
        ----------------------------------------------------------
        AA3b FUNCTIONS
        ----------------------------------------------------------
        * @method getaa3b() get the aa3b information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa3b($part,$code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa3bp4() get the aa3b information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa3bp4($code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => 'p4',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getRowArray();

    }

    
    /**
        ----------------------------------------------------------
        AA5b FUNCTIONS
        ----------------------------------------------------------
        * @method getaa5b() get the aa5b information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa5b($code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'      => 'aa5b',
            'code'      => $code,
            'c3tID'     => $c3tID,
            'clientID'  => $dcID,
            'workpaper' => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        ----------------------------------------------------------
        AA7 FUNCTIONS
        ----------------------------------------------------------
        * @method getaa7() get the aa7 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa7($part,$code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa7aep() get the aa7 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa7aep($part,$code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getRowArray();

    }

    
    /**
        ----------------------------------------------------------
        AA10 FUNCTIONS
        ----------------------------------------------------------
        * @method getaa10() get the aa10 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa10($code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => 'aa10',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getRowArray();

    }

    
    /**
        ----------------------------------------------------------
        AA11 FUNCTIONS
        ----------------------------------------------------------
        * @method getaa11p2() get the aa11 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa11p2($part,$code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa11p() get the aa11 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa11p($part,$code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getRowArray();

    }

    /**
        * @method getaa11con() get the aa11 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa11con($part,$code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getRowArray();

    }

    
    /**
        ----------------------------------------------------------
        AB1 FUNCTIONS
        ----------------------------------------------------------
        * @method getab1() get the ab1 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getab1($code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => 'ab1',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getResultArray();

    }

    
    /**
        ----------------------------------------------------------
        AB3 FUNCTIONS
        ----------------------------------------------------------
        * @method getab3() get the ab1 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getab3($code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => 'ab3',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getRowArray();

    }


    /**
        ----------------------------------------------------------
        AB4 FUNCTIONS
        ----------------------------------------------------------
        * @method getab4() get the ab4 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getab4($part,$code,$c3tID,$dcID,$dwpID){
        
        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getab4checklist() get the ab4 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getab4checklist($part,$code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getRowArray();

    }


    /**
        ----------------------------------------------------------
        AB4a,b,c,d,e,f,g,h FUNCTIONS
        ----------------------------------------------------------
        * @method getab4a() get the ab4a information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @param dwpID worpaper id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getab4a($part,$code,$c3tID,$dcID,$dwpID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
            'workpaper'     => $dwpID,
        ];
        $query = $this->db->table($this->tblc3)->where($where)->get();
        return $query->getResultArray();

    }


    


}