<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class WorkpaperModel extends  Model {


    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR USER MANAGEMENT
        Properties being used on this file
        * @property tblu table of users
        * @property tblwp table of workpaper
        * @property tblc table of clients
        * @property tblc1t table of chapter 1 titles
        * @property tblc2t table of chapter 2 titles
        * @property tblc3t table of chapter 3 titles
        * @property tblc1d table of client default files chapter 1
        * @property tblc2d table of client default files chapter 2
        * @property tblc3d table of client default files chapter 3
        * @property tblc1 table of client files chapter 1
        * @property tblc2 table of client files chapter 2
        * @property tblc3 table of client files chapter 3
        * @property tblfi table of file index
        * @property tblcfi table of client file index
        * @property tbltb table of client trial balance
        * @property db to load the database
        * @property crypt to load the encryption file
        * @property logs scheme name
        * @property time-date to load the date and time
        
    */
    protected $tblu     = "tbl_users";
    protected $tblwp    = "tbl_workpaper";
    protected $tblc     = "tbl_clients";
    protected $tblc1t   = "tbl_c1_titles";
    protected $tblc2t   = "tbl_c2_titles";
    protected $tblc3t   = "tbl_c3_titles";
    protected $tblc1d   = "tbl_dclient_c1";
    protected $tblc2d   = "tbl_dclient_c2";
    protected $tblc3d   = "tbl_dclient_c3";
    protected $tblc1    = "tbl_client_c1";
    protected $tblc2    = "tbl_client_c2";
    protected $tblc3    = "tbl_client_c3";
    protected $tblfi    = "tbl_file_index";
    protected $tblcfi   = "tbl_client_file_index";
    protected $tbltb    = "tbl_client_trial_balance";
    protected $tblfst   = "tbl_client_fstax";
    protected $time,$date;
    protected $db;
    protected $crypt;
    protected $logs;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        $this->db       = \Config\Database::connect('default'); 
        $this->crypt    = \Config\Services::encrypter();
        $this->logs     = new Logs();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time     = date("H:i:s");
        $this->date     = date("Y-m-d");

    }


    public function decr($ecr){
        return $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ecr));
    }

    public function encr($ecr){
        return str_ireplace(['/','+'],['~','$'],$this->crypt->encrypt($ecr));
    }


    /**
        * @method getauditors() get the auditors for work paper assignment
        * @param firmID firm id
        * @param type type of auditor
        * @var query contains database result query
        * @return result-array
    */
    public function getauditors($firmID,$type){

        if($type == 'Audit Manager'){
            $query = $this->db->query("select * 
                from {$this->tblu} 
                where (type = 'Auditing Firm' or type = 'Audit Manager')
                and firm = {$firmID}
                and status = 'Active'
                and verified = 'Yes'
            ");
        }elseif($type == 'Reviewer'){
            $query = $this->db->query("select * 
                from {$this->tblu} 
                where (type = 'Auditing Firm' or type = 'Audit Manager' or type = 'Reviewer')
                and firm = {$firmID}
                and status = 'Active'
                and verified = 'Yes'
            ");
        }elseif($type == 'Preparer'){
            $query = $this->db->query("select * 
                from {$this->tblu} 
                where (type = 'Auditing Firm' or type = 'Audit Manager' or type = 'Reviewer' or type = 'Preparer')
                and firm = {$firmID}
                and status = 'Active'
                and verified = 'Yes'
            ");
        }
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
        * @method getfileinfoc1() get the clients file chapter 1
        * @param wpID workpaper id
        * @param cID client id
        * @param ctID chapter title id
        * @var query contains database result query
        * @return row-array
    */
    public function getfileinfoc1($wpID,$cID,$mtID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on
        from {$this->tblc1} as c1 
        where c1.wpID = {$wpID}
        and c1.cID = {$cID}
        and c1.mtID = {$mtID} limit 1");
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
    public function getfileinfoc2($wpID,$cID,$mtID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on 
        from {$this->tblc2} as c2 
        where c2.wpID = {$wpID}
        and c2.cID = {$cID}
        and c2.mtID = {$mtID} limit 1");
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
    public function getfileinfoc3($wpID,$cID,$mtID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on 
        from {$this->tblc3} as c3 
        where c3.wpID = {$wpID}
        and c3.cID = {$cID}
        and c3.mtID = {$mtID} limit 1");
        return $query->getRowArray();

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

        $query = $this->db->query("select * , 
        (select 100 - round(((SUM(ytd) - SUM(supp_bal)) / SUM(ytd)) * 100) from {$this->tbltb} as tb where tb.cID = {$cID} and tb.wpID = {$wpID} and cfi.index = tb.index) as prog
        from {$this->tblcfi} as cfi, {$this->tblfi} as fi
        where cfi.index = fi.fiID
        and cfi.wpID = {$wpID}
        and cfi.cID = {$cID}");
        return $query->getResultArray();

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

        $query = $this->db->query("select DISTINCT title,c1t.code,c1t.mtID,c1.remarks,c1.status,
        (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.mtID = c1.mtID and {$this->tblc1}.wpID = {$wpID} and {$this->tblc1}.cID = {$cID}) as x , 
        (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.mtID = c1.mtID and {$this->tblc1}.wpID = {$wpID} and {$this->tblc1}.cID = {$cID} and `updated_on` IS NOT NULL) as y
        from {$this->tblc1t} as c1t, {$this->tblc1} as c1
        where c1t.mtID = c1.mtID
        and c1.cID = {$cID}
        and c1.wpID = {$wpID}
        order by mtID asc");
        return $query->getResultArray();

    }


    /**
        * @method getacc1values() get the files AC index
        * @param code file code
        * @param cID client id
        * @param wpID workpaper id
        * @var query contains database result query
        * @return result-array
    */
    public function getacc1values($code,$cID,$wpID){

        $query = $this->db->query("select DISTINCT title,c1t.code,c1titleID,c1.remarks,c1.status,
        (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.c1tID = c1.c1tID and {$this->tblc1}.workpaper = {$wpID} and {$this->tblc1}.clientID = {$cID}) as x , 
        (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.c1tID = c1.c1tID and {$this->tblc1}.workpaper = {$wpID} and {$this->tblc1}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
        from {$this->tblc1t} as c1t, {$this->tblc1} as c1
        where c1t.c1titleID = c1.c1tID
        and c1.clientID = {$cID}
        and c1.workpaper = {$wpID}
        and c1.code like '%{$code}%'
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

        
        $query = $this->db->query("select DISTINCT title,c1t.code,c1t.mtID,c1.remarks,c1.status,
        (select COUNT(*) from {$this->tblc2} WHERE {$this->tblc2}.mtID = c1.mtID and {$this->tblc2}.wpID = {$wpID} and {$this->tblc2}.cID = {$cID}) as x , 
        (select COUNT(*) from {$this->tblc2} WHERE {$this->tblc2}.mtID = c1.mtID and {$this->tblc2}.wpID = {$wpID} and {$this->tblc2}.cID = {$cID} and `updated_on` IS NOT NULL) as y
        from {$this->tblc2t} as c1t, {$this->tblc2} as c1
        where c1t.mtID = c1.mtID
        and c1.cID = {$cID}
        and c1.wpID = {$wpID}
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

        
        $query = $this->db->query("select DISTINCT title,c1t.code,c1t.mtID,c1.remarks,c1.status,
        (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.mtID = c1.mtID and {$this->tblc3}.wpID = {$wpID} and {$this->tblc3}.cID = {$cID}) as x , 
        (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.mtID = c1.mtID and {$this->tblc3}.wpID = {$wpID} and {$this->tblc3}.cID = {$cID} and `updated_on` IS NOT NULL) as y
        from {$this->tblc3t} as c1t, {$this->tblc3} as c1
        where c1t.mtID = c1.mtID
        and c1.cID = {$cID}
        and c1.wpID = {$wpID}
        order by mtID asc");
        return $query->getResultArray();

    }


    public function getcfsvalues($cID,$wpID){

        $where = [
            'cID'   => $cID,
            'wpID'  => $wpID,
            'index' => 1,
        ];
        $query = $this->db->table($this->tblcfi)->where($where)->get();
        return $query->getRowArray();

    }

    public function getindexfiles($cID,$wpID,$index){

        $where = [
            'cID'       => $cID,
            'wpID'      => $wpID,
            'index'     => $index,
        ];
        $query = $this->db->table($this->tblcfi)->where($where)->get();
        return $query->getRowArray();

    }


    /**
        * @method getabc3values() get the files AB index
        * @param code file code
        * @param cID client id
        * @param wpID workpaper id
        * @var query contains database result query
        * @return result-array
    */
    public function getabc3values($code,$cID,$wpID){

        $query = $this->db->query("select DISTINCT title,c3t.code,c3titleID,c3.remarks,c3.status,
        (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.c3tID = c3.c3tID and {$this->tblc3}.workpaper = {$wpID} and {$this->tblc3}.clientID = {$cID}) as x ,
        (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.c3tID = c3.c3tID and {$this->tblc3}.workpaper = {$wpID} and {$this->tblc3}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
        from {$this->tblc3t} as c3t, {$this->tblc3} as c3
        where c3t.c3titleID = c3.c3tID
        and c3.clientID = {$cID}
        and c3.workpaper = '{$wpID}'
        and c3.code like '%{$code}%'
        order by c3titleID asc");
        return $query->getResultArray();

    }


    /**
        * @method getworkpaperspe() get the specified assigned work paper
        * @param pos position of the user
        * @param fID firm id
        * @param uID user id
        * @param status status of the file
        * @var query contains database result query
        * @return result-array
    */
    public function getworkpaperspe($pos,$fID,$uID,$status){

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
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.added_by) as added,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.auditor) as aud,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.supervisor) as sup,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.audmanager) as audm,
        tc.name as cli,
        tc.org
        from {$this->tblwp} as wp, {$this->tblc} as tc
        where wp.firm = {$fID}
        and wp.{$pos} = {$uID}
        and tc.cID = wp.client
        and wp.status != 'Approved'");
        return $query->getResultArray();

    }


    /**
        * @method getworkpaper() get all the work paper
        * @param fID firm id
        * @var query contains database result query
        * @return result-array
    */
    public function getworkpaper($fID){

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
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.added_by) as added,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.auditor) as aud,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.supervisor) as sup,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.audmanager) as audm,
        tc.name as cli,
        tc.org
        from {$this->tblwp} as wp, {$this->tblc} as tc
        where wp.firm = {$fID}
        and tc.cID = wp.client
        and wp.status != 'Approved'");
        return $query->getResultArray();

    }


    /**
        * @method getapprovedwp() get all the approved work paper
        * @param fID firm id
        * @var query contains database result query
        * @return result-array
    */
    public function getapprovedwp($fID){

        $query = $this->db->query("select wpID,wp.added_by,wp.client, wp.auditor, wp.supervisor,wp.audmanager, wp.firm,wp.jobdur,wp.financial_year,wp.end_financial_year,wp.status,wp.remarks,wp.added_on,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.added_by) as added,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.auditor) as aud,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.supervisor) as sup,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.audmanager) as audm,
        tc.name as cli,
        tc.org
        from {$this->tblwp} as wp, {$this->tblc} as tc
        where wp.firm = {$fID}
        and tc.cID = wp.client
        and wp.status = 'Approved'");
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
        * @method getindexfile() get the index file
        * @var query contains database result query
        * @return result-array
    */
    public function getindexfile(){

        $query = $this->db->query("select * 
        from {$this->tblfi} as fi
        where fi.fiID >= 2
        and fi.fiID <= 7");
        return $query->getResultArray();

    }

    
    public function getfstax($dcID,$dwpID,$fID,$qtr,$type){

        $where = [
            'cID'       => $dcID,
            'wpID'      => $dwpID,
            'fID'       => $fID,
            'quarter'   => $qtr,
            'type'      => $type,
        ];
        $query = $this->db->table($this->tblfst)->where($where)->get();
        return $query->getRowArray();

    }


    /**
        * @method updateindex() update the index if selected
        * @var req index data
        * @return updated-error
    */
    public function updateindex($req){

        $data = [
            'acquired' => $req['acquired']
        ];
        if($this->db->table($this->tblcfi)->where('cfiID', $req['cfiID'])->update($data)){
            return 'updated';
        }else{
            return 'error';
        }

    }


    /**
        * @method updatetb() update the trial balance
        * @param req trial balance data
        * @var dtbID decrypted trial balance id
        * @var data-array contains trial balance information
        * @return updated
    */
    public function updatetb($req){

        foreach($req['tbID'] as $i => $val){
            $dtbID = $this->decr($req['tbID'][$i]);
            $data = [
                'supp_bal'      => $req['sb'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tbltb)->where('tbID', $dtbID)->update($data);
        }
        $this->logs->log(session()->get('name'). " Updated a work paper");
        return 'updated';

    }


    public function uploadfstax($req){

        $filename = $req['fstax']->getClientName();

        $pdfPath = ROOTPATH .'public/uploads/pdf/'.$req['fID'].'/fstax/'.$req['wpID'].'/';
        if (!is_dir($pdfPath)) {
            mkdir($pdfPath, 0755, true);
        }

        if($req['fstax'] != ''){
            $where = [
                'cID'           => $req['cID'],
                'wpID'          => $req['wpID'],
                'fID'           => $req['fID'],
                'index'         => $req['index'],
                'quarter'       => $req['quarter'],
                'type'          => $req['part'],
            ];
            $res = $this->db->table($this->tblfst)->where($where)->get();
            if($res->getNumRows() >= 1){
                $f = $res->getRowArray();

                $ce = $this->db->table($this->tblfst)->where(array('cID' => $req['cID'],'wpID' => $req['wpID'],'fID' => $req['fID'],'quarter' => $req['quarter']))->get()->getRowArray();
                if($filename == $ce['file']){
                    return 'file_exist';
                }
                $uploadpath = $pdfPath.$f['file']; 
                if (file_exists($uploadpath)) {
                    unlink($uploadpath);
                }
                $this->db->table($this->tblfst)->where($where)->update(array('file' => $filename, 'uploaded_on' => $this->date.' '.$this->time,'uploaded_by' => $req['uID']));
                $req['fstax']->move($pdfPath);
                $this->logs->log(session()->get('name'). " uploaded a Financial Statement on work paper");
                return 'uploaded';
            }else{
                $data = [
                    'cID'           => $req['cID'],
                    'wpID'          => $req['wpID'],
                    'fID'           => $req['fID'],
                    'index'         => $req['index'],
                    'quarter'       => $req['quarter'],
                    'type'          => $req['part'],
                    'file'          => $filename,
                    'uploaded_on'   => $this->date.' '.$this->time,
                    'uploaded_by'   => $req['uID'],
                ];
                $this->db->table($this->tblfst)->insert($data);
                $req['fstax']->move($pdfPath);
                $this->logs->log(session()->get('name'). " uploaded a Financial Statement on work paper");
                return 'uploaded';
            }
        }else{
            return false;
        }

    }


    /**
        * @method uploadtbfiles() upload trial balance files
        * @param req trial balance data
        * @var pdfname file name
        * @var pdfPath path of the file uploaded
        * @var data-array contains file information
        * @return updated
    */
    public function uploadtbfiles($req){

        $filename = $req['pdf']->getClientName();

        $res = $this->db->table($this->tblcfi)->where('cfiID', $req['cfiID'])->get()->getRowArray();
    
        if($req['pdf'] != ''){
            $pdfPath = ROOTPATH .'public/uploads/pdf/'.$req['fID'].'/wp/'.$req['wpID'].'/';
            if (!is_dir($pdfPath)) {
                mkdir($pdfPath, 0755, true);
            }
            $pdfonfile  = $pdfPath.$filename; 
            if (file_exists($pdfonfile)) {
                unlink($pdfonfile);
            }
            $pdfondb    = $pdfPath.$res['file']; 
            if (file_exists($pdfondb)) {
                unlink($pdfondb);
            }
            $req['pdf']->move($pdfPath);
        }
        $data = [
            'file'      => $filename,
            'remarks'   => $req['remarks'],
        ];
        if($this->db->table($this->tblcfi)->where('cfiID', $req['cfiID'])->update($data)){
            $this->logs->log(session()->get('name'). " uploaded a file on work paper");
            return 'uploaded';
        }
    
    }


    /**
        * @method importtb() import trial balance
        * @param req trial balance data
        * @var where reference import
        * @var index decrypted index id
        * @var balcu balance CU on ac10 file
        * @var cal calculation balance CU on ac10 file
        * @var data-array contains trial balance information
        * @return uploaded
    */
    public function importtb($req){

        $where = [
            'cID'      => $req['cID'],
            'fID'      => $req['fID'],
            'wpID'     => $req['wpID'],
        ];
        $this->db->table($this->tbltb)->where($where)->delete();
        foreach($req['account_code'] as $i => $val){
            $index = $this->decr($req['index'][$i]);
            switch ($index) {
                case '2'    : $refaut = ['cID' => $req['cID'], 'fID' => $req['fID'], 'code' => 'AC10', 'type' => 'costscu']; break;
                case '3'    : $refaut = ['cID' => $req['cID'], 'fID' => $req['fID'], 'code' => 'AC10', 'type' => 'ppecu']; break;
                case '4'    : $refaut = ['cID' => $req['cID'], 'fID' => $req['fID'], 'code' => 'AC10', 'type' => 'inventorycu']; break;
                case '5'    : $refaut = ['cID' => $req['cID'], 'fID' => $req['fID'], 'code' => 'AC10', 'type' => 'trade receivablescu']; break;
                case '6'    : $refaut = ['cID' => $req['cID'], 'fID' => $req['fID'], 'code' => 'AC10', 'type' => 'bank and cashcu']; break;
                case '7'    : $refaut = ['cID' => $req['cID'], 'fID' => $req['fID'], 'code' => 'AC10', 'type' => 'revenuecu']; break;
            }
            $balcu = $this->db->table($this->tblc2)->where($refaut)->get()->getRowArray();
            if(!empty($balcu)){
                $cal = ['field1' => $balcu['field1'] + $req['ytd'][$i]];
                $this->db->table($this->tblc2)->where($refaut)->update($cal);
            }
            $this->db->table($this->tblcfi)->where(array('cID' => $req['cID'], 'fID' => $req['fID'], 'wpID' => $req['wpID'], 'index' => $index))->update(array('acquired' => 'Yes'));
            $data = [
                'cID'           => $req['cID'],
                'fID'           => $req['fID'],
                'wpID'          => $req['wpID'],
                'index'         => $index,
                'account_code'  => $req['account_code'][$i],
                'account'       => $req['account'][$i],
                'account_type'  => $req['account_type'][$i],
                'ytd'           => $req['ytd'][$i],
                'py'            => $req['py'][$i],
                'added_on'      => $this->date.' '.$this->time,
                'added_by'      => $req['uID'],
            ];
            $this->db->table($this->tbltb)->insert($data);
        }
        $this->logs->log(session()->get('name'). " has imported a trial balance");
        return "uploaded";

    }

    /**
        * @method saveworkpaper() saving the work paper
        * @param req work paper data
        * @var where-array check reference
        * @var checkexist check if the workpaper already exist
        * @var ind-array contains index information
        * @var c1df check assigned chapter 1 files
        * @var wherec1-array chapter 1 reference
        * @var datac1-array contains chapter 1 information
        * @var c2df check assigned chapter 2 files
        * @var wherec2-array chapter 2 reference
        * @var datac2-array contains chapter 2 information
        * @var c3df check assigned chapter 3 files
        * @var wherec3-array chapter 3 reference
        * @var datac3-array contains chapter 3 information
        * @return added
    */
    public function saveworkpaper($req){

        $where = [
            'client'                => $req['client'],
            'financial_year'        => $req['fy'],
            'firm'                  => $req['firm'],
        ];
        $checkexist = $this->db->table($this->tblwp)->where($where)->get()->getNumRows();
        if($checkexist >= 1){
            return 'exist';
        }else{
            $workpaper = [
                'auditor'               => $req['auditor'],
                'supervisor'            => $req['reviewer'],
                'audmanager'            => $req['audmanager'],
                'client'                => $req['client'],
                'firm'                  => $req['firm'],
                'jobdur'                => $req['jobdur'],
                'financial_year'        => $req['fy'],
                'end_financial_year'    => $req['efy'],
                'status'                => 'Preparing',
                'Remarks'               => 'Not Submitted',
                'added_on'              => $this->date.' '.$this->time,
                'added_by'              => $req['uID'],
            ];
            $this->db->table($this->tblwp)->insert($workpaper);
            $wpid = $this->db->insertID();
            $index = $this->db->table($this->tblfi)->get();
            foreach($index->getResultArray() as $i){
                $ind = [
                    'cID'           => $req['client'],
                    'fID'           => $req['firm'],
                    'wpID'          => $wpid,
                    'index'         => $i['fiID'],
                    'acquired'      => 'No',
                    'added_on'      => $this->date.' '.$this->time,
                    'added_by'      => $req['uID'],
                ];
                $this->db->table($this->tblcfi)->insert($ind);
            }
            $wherec1 = [
                'fID'   => $req['firm'],
                'cID'   => $req['client'],
            ];
            $c1df = $this->db->table($this->tblc1d)->where($wherec1)->get();
            if($c1df->getNumRows() >= 1){
                foreach($c1df->getResultArray() as $r){
                    $datac1 = [
                        'wpID'      => $wpid,
                        'fID'       => $req['firm'],
                        'cID'       => $req['client'],
                        'mtID'      => $r['mtID'],
                        'code'      => $r['code'],
                        'type'      => $r['type'],
                        'field1'    => $r['field1'],
                        'field2'    => $r['field2'],
                        'field3'    => $r['field3'],
                        'field4'    => $r['field4'],
                        'field5'    => $r['field5'],
                        'field6'    => $r['field6'],
                        'field7'    => $r['field7'],
                        'field8'    => $r['field8'],
                        'field9'    => $r['field9'],
                        'field10'   => $r['field10'],
                        'status'    => 'Preparing',
                        'remarks'   => $r['remarks'],
                        'added_on'  => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc1)->insert($datac1);
                }
            }
            $wherec2 = [
                'fID'   => $req['firm'],
                'cID'   => $req['client'],
            ];
            $c2df = $this->db->table($this->tblc2d)->where($wherec2)->get();
            if($c2df->getNumRows() >= 1){
                foreach($c2df->getResultArray() as $r){
                    $datac2 = [
                        'wpID'      => $wpid,
                        'fID'       => $req['firm'],
                        'cID'       => $req['client'],
                        'mtID'      => $r['mtID'],
                        'code'      => $r['code'],
                        'type'      => $r['type'],
                        'field1'    => $r['field1'],
                        'field2'    => $r['field2'],
                        'field3'    => $r['field3'],
                        'field4'    => $r['field4'],
                        'field5'    => $r['field5'],
                        'field6'    => $r['field6'],
                        'field7'    => $r['field7'],
                        'field8'    => $r['field8'],
                        'field9'    => $r['field9'],
                        'field10'   => $r['field10'],
                        'status'    => 'Preparing',
                        'remarks'   => $r['remarks'],
                        'added_on'  => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc2)->insert($datac2);
                }
            }
            $wherec3 = [
                'fID'   => $req['firm'],
                'cID'   => $req['client'],
            ];
            $c3df = $this->db->table($this->tblc3d)->where($wherec3)->get();
            if($c3df->getNumRows() >= 1){
                foreach($c3df->getResultArray() as $r){
                    $datac3 = [
                        'wpID'      => $wpid,
                        'fID'       => $req['firm'],
                        'cID'       => $req['client'],
                        'mtID'      => $r['mtID'],
                        'code'      => $r['code'],
                        'type'      => $r['type'],
                        'field1'    => $r['field1'],
                        'field2'    => $r['field2'],
                        'field3'    => $r['field3'],
                        'field4'    => $r['field4'],
                        'field5'    => $r['field5'],
                        'field6'    => $r['field6'],
                        'field7'    => $r['field7'],
                        'field8'    => $r['field8'],
                        'field9'    => $r['field9'],
                        'field10'   => $r['field10'],
                        'status'    => 'Preparing',
                        'remarks'   => $r['remarks'],
                        'added_on'  => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc3)->insert($datac3);
                }
            }
            $this->logs->log(session()->get('name'). " has initiated a workpaper");
            return "added";
        }

    }


    /**
        * @method sendtoreview() the the chapter file to review
        * @param req chapter file data
        * @var table dynamic table selection
        * @var ctID dynamic chapter id selection
        * @var where-array reference send
        * @var data-array contains send information
        * @return sent-false
    */
    public function sendtoreview($req){

        switch ($req['c']) {
            case 'c1': $table       = $this->tblc1;  $ctID = 'mtID';break;
            case 'c2': $table       = $this->tblc2;  $ctID = 'mtID';break;
            case 'c3': $table       = $this->tblc3;  $ctID = 'mtID';break;
            case 'index': $table    = $this->tblcfi; $ctID = 'cfiID';break;
        }
        $where = [
            'cID'      => $req['cID'],
            'wpID'     => $req['wpID'],
            $ctID      => $req['mtID'],
        ];
        $data = [
            'remarks'       => $req['remarks'],
            'status'        => 'Reviewing',
            'prepared_on'   => $this->date.' '.$this->time
        ];
        if($this->db->table($table)->where($where)->update($data)){
            $this->logs->log(session()->get('name'). " sent a file {$req['c']} to reviewer");
            return "sent";
        }else{
            return false;
        }

    }


    /**
        * @method sendtoauditor() the the chapter file to prepare
        * @param req chapter file data
        * @var table dynamic table selection
        * @var ctID dynamic chapter id selection
        * @var where-array reference send
        * @var data-array contains send information
        * @return sent-false
    */
    public function sendtoauditor($req){

        switch ($req['c']) {
            case 'c1': $table       = $this->tblc1;  $ctID = 'mtID';break;
            case 'c2': $table       = $this->tblc2;  $ctID = 'mtID';break;
            case 'c3': $table       = $this->tblc3;  $ctID = 'mtID';break;
            case 'index': $table    = $this->tblcfi; $ctID = 'cfiID';break;
        }
        $where = [
            'cID'      => $req['cID'],
            'wpID'     => $req['wpID'],
            $ctID      => $req['mtID'],
        ];
        $data = [
            'remarks'   => $req['remarks'],
            'status'    => 'Preparing',
        ];
        if($this->db->table($table)->where($where)->update($data)){
            $this->logs->log(session()->get('name'). " sent back a file {$req['c']} to preparer");
            return "sent";
        }else{
            return false;
        }

    }


    /**
        * @method sendtomanager() the the chapter file to manager for check
        * @param req chapter file data
        * @var table dynamic table selection
        * @var ctID dynamic chapter id selection
        * @var where-array reference send
        * @var data-array contains send information
        * @return sent-false
    */
    public function sendtomanager($req){

        switch ($req['c']) {
            case 'c1': $table       = $this->tblc1;  $ctID = 'mtID';break;
            case 'c2': $table       = $this->tblc2;  $ctID = 'mtID';break;
            case 'c3': $table       = $this->tblc3;  $ctID = 'mtID';break;
            case 'index': $table    = $this->tblcfi; $ctID = 'cfiID';break;
        }
        $where = [
            'cID'      => $req['cID'],
            'wpID'     => $req['wpID'],
            $ctID      => $req['ctID'],
        ];
        $data = [
            'remarks'       => $req['remarks'],
            'status'        => 'Checking',
            'reviewed_on'   => $this->date.' '.$this->time
        ];
        if($this->db->table($table)->where($where)->update($data)){
            $this->logs->log(session()->get('name'). " sent a file to {$req['c']} audit manager");
            return "sent";
        }else{
            return false;
        }

    }


    /**
        * @method sendtoapprove() the the chapter file to approve
        * @param req chapter file data
        * @var table dynamic table selection
        * @var ctID dynamic chapter id selection
        * @var where-array reference send
        * @var data-array contains send information
        * @return sent-false
    */
    public function sendtoapprove($req){

        switch ($req['c']) {
            case 'c1': $table       = $this->tblc1;  $ctID = 'mtID';break;
            case 'c2': $table       = $this->tblc2;  $ctID = 'mtID';break;
            case 'c3': $table       = $this->tblc3;  $ctID = 'mtID';break;
            case 'index': $table    = $this->tblcfi; $ctID = 'cfiID';break;
        }
        $where = [
            'cID'      => $req['cID'],
            'wpID'     => $req['wpID'],
            $ctID      => $req['mtID'],
        ];
        $data = [
            'remarks'       => $req['remarks'],
            'status'        => 'Approved',
            'approved_on'   => $this->date.' '.$this->time
        ];
        if($this->db->table($table)->where($where)->update($data)){
            $this->logs->log(session()->get('name'). " approved a file to {$req['c']}");
            return "sent";
        }else{
            return false;
        }

    }


    /**
        * @method sendtoreviewer() send the work paper to reviewer
        * @param req workpaper file data
        * @var data-array workpaper information
        * @return sent-false
    */
    public function sendtoreviewer($req){

        $data = [
            'remarks'   => $req['remarks'],
            'status'    => 'Reviewing',
        ];
        if($this->db->table($this->tblwp)->where('wpID', $req['wpID'])->update($data)){
            $this->logs->log(session()->get('name'). " sent a file to reviewer");
            return "sent";
        }else{
            return false;
        }
        
    }


    /**
        * @method sendtopreparer() send the work paper to preparer
        * @param req workpaper file data
        * @var data-array workpaper information
        * @return sent-false
    */
    public function sendtopreparer($req){

        $data = [
            'remarks'   => $req['remarks'],
            'status'    => 'Preparing',
        ];
        if($this->db->table($this->tblwp)->where('wpID', $req['wpID'])->update($data)){
            $this->logs->log(session()->get('name'). " sent back a file to preparer");
            return "sent";
        }else{
            return false;
        }
        
    }


    /**
        * @method sendtoapprover() send the work paper to approver
        * @param req workpaper file data
        * @var data-array workpaper information
        * @return sent-false
    */
    public function sendtoapprover($req){

        $data = [
            'remarks'   => $req['remarks'],
            'status'    => 'Checking',
        ];
        if($this->db->table($this->tblwp)->where('wpID', $req['wpID'])->update($data)){
            $this->logs->log(session()->get('name'). " sent a file to audit manager");
            return "sent";
        }else{
            return false;
        }
        
    }


    /**
        * @method sendtoapprover() approve the work paper
        * @param req workpaper file data
        * @var data-array workpaper information
        * @return sent-false
    */
    public function approvewp($req){

        $data = [
            'remarks'   => $req['remarks'],
            'status'    => 'Approved',
        ];
        if($this->db->table($this->tblwp)->where('wpID', $req['wpID'])->update($data)){
            $this->logs->log(session()->get('name'). " approved a work paper");
            return "sent";
        }else{
            return false;
        }

    }


    public function deletefiles($req){

        switch ($req['c']) {
            case 'c1': $table       = $this->tblc1;  $ctID = 'mtID';break;
            case 'c2': $table       = $this->tblc2;  $ctID = 'mtID';break;
            case 'c3': $table       = $this->tblc3;  $ctID = 'mtID';break;
            case 'index': $table    = $this->tblcfi; $ctID = 'cfiID';break;
        }
        $where = [
            'cID'      => $req['cID'],
            'wpID'     => $req['wpID'],
            $ctID      => $req['mtID'],
        ];
        if($this->db->table($table)->where($where)->delete()){
            $this->logs->log(session()->get('name'). " deleted a file from {$req['c']}");
            return "deleted";
        }else{
            return false;
        }

    }


    public function deleteworkpaper($req){

        $where = [
            'cID'      => $req['cID'],
            'wpID'     => $req['wpID'],
        ];
        
        $this->db->table($this->tblwp)->where(array('wpID' => $req['wpID']))->delete();
        $this->db->table($this->tblc1)->where($where)->delete();
        $this->db->table($this->tblc2)->where($where)->delete();
        $this->db->table($this->tblc3)->where($where)->delete();
        $this->db->table($this->tblcfi)->where($where)->delete();
        $this->db->table($this->tbltb)->where(array('cID' => $req['cID'], 'wpID' => $req['wpID']))->delete();
        $this->db->table($this->tblfst)->where(array('cID' => $req['cID'], 'wpID' => $req['wpID']))->delete();

        return "deleted";

    }








    /**
        ----------------------------------------------------------
        CHAPTER GET FUNCTIONS
        ----------------------------------------------------------
    */

    /**
        ----------------------------------------------------------
        CHAPTER GET FUNCTIONS
        ----------------------------------------------------------
    */
    public function getvalues_c1($m,$type,$code,$mtID,$cID,$wpID){

        $where = [
            'code'  => $code, 
            'type'  => $type,
            'mtID'  => $mtID,
            'cID'   => $cID,
            'wpID'  => $wpID
        ];
        $query =  $this->db->table($this->tblc1)->where($where)->get();

        if($m == 'm'){
            return $query->getResultArray();
        }else{
            return $query->getrowArray();
        }

    }


    public function getvalues_c2($m,$type,$code,$mtID,$cID,$wpID){

        $where = [
           'code'  => $code, 
            'type'  => $type,
            'mtID'  => $mtID,
            'cID'   => $cID,
            'wpID'  => $wpID
        ];
        $query =  $this->db->table($this->tblc2)->where($where)->get();
        if($m == 'm'){
            return $query->getResultArray();
        }else{
            return $query->getrowArray();
        }

    }


    public function getvalues_c3($m,$type,$code,$mtID,$cID,$wpID){

        $where = [
            'code'  => $code, 
            'type'  => $type,
            'mtID'  => $mtID,
            'cID'   => $cID,
            'wpID'  => $wpID
        ];
        $query =  $this->db->table($this->tblc3)->where($where)->get();
        if($m == 'm'){
            return $query->getResultArray();
        }else{
            return $query->getrowArray();
        }

    }


    /**
        ----------------------------------------------------------
        AC10 FUNCTIONS
        ----------------------------------------------------------
        * @method getac10s1data() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var query result from database
        * @return result-array
    */
    public function getac10data($part,$code,$mtID,$cID,$wpID,$section){

        $where = [
            'type'      => $part,
            'code'      => $code,
            'mtID'      => $mtID,
            'cID'       => $cID,
            'field1'    => $section,
            'wpID'      => $wpID,
        ];
        $query = $this->db->table($this->tblc2)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getdatacount() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var query result from database
        * @return integer
    */
    public function getdatacount($mtID,$part,$cID,$wpID){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac10', 'mtID' => $mtID, 'cID'  => $cID));
        return $query->countAllResults();

    }

    /**
        * @method getsumation() Count/Compute the balances
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var total result from database
        * @return integer
    */
    public function getsumation($mtID,$part,$cID,$wpID){

        $where1 = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'mtID'          => $mtID,
            'cID'           => $cID,
            'wpID'          => $wpID,
        ];
        $where2 = [
            'type'          => $part.'cu', 
            'code'          => 'ac10', 
            'mtID'          => $mtID,
            'cID'           => $cID,
            'wpID'          => $wpID,
        ];
        $total = $this->db->table($this->tblc2)->selectSum('field2')->where($where1)->get()->getRowArray();
        $cu = $this->db->table($this->tblc2)->where($where2)->get()->getRowArray();
        return $cu['field1'] - $total['field2'];

    }

    
    public function savevalues($param,$req){

        switch ($param['chapter']) {
            case 'c1':
                switch($param['code']) {
                    case 'AC1':
                        switch ($param['save']) {
                            case 'saveac1':
                                foreach($req['yesno'] as $i => $val){
                                    $acid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['yesno'][$i],
                                        'field3'        => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1)->where('mdID', $acid)->update($data);
                                }
                            break;
                            case 'saveac1eqr':
                                $acid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc1)->where('mdID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Pre-Engagement Activities on work paper");
                        return true;
                    break;
                    case 'AC2':
                        switch ($param['save']) {
                            case 'saveac2':
                                foreach($req['corptax'] as $i => $val){
                                    $acid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['corptax'][$i],
                                        'field3'        => $req['statutory'][$i],
                                        'field4'        => $req['accountancy'][$i],
                                        'field5'        => $req['other'][$i],
                                        'field6'        => $req['totalcu'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1)->where('mdID', $acid)->update($data);
                                }
                            break;
                            case 'saveac2aep':
                                $acid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['eap'],
                                    'field2'        => $req['concl'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc1)->where('mdID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Pre-Engagement Activities on work paper");
                        return true;
                    break;
                }
            break;

            case 'c2':
                switch($param['code']) {
                    case 'AB4':
                        switch ($param['save']) {
                            case 'saveac3':
                                foreach($req['yesno'] as $i => $val){
                                    $acid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['yesno'][$i],
                                        'field3'        => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc2)->where('mdID', $acid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Audit Planning on work paper");
                        return true;
                    break;
                    case 'AB4A':
                        switch ($param['save']) {
                            case 'saveab4a':
                                $this->db->table($this->tblc2)->where(array('type' => $req['part'], 'code' => $param['code'], 'mtID' => $param['mtID'], 'cID' => $param['cID'], 'wpID' => $param['wpID']))->delete();
                                foreach($req['yearto'] as $i => $val){
                                    $data = [
                                        'field1'        => $req['yearto'][$i],
                                        'field2'        => $req['preparedby'][$i],
                                        'field3'        => $req['date1'][$i],
                                        'field4'        => $req['reviewedby'][$i],
                                        'field5'        => $req['date2'][$i],
                                        'code'          => $param['code'],
                                        'mtID'          => $param['mtID'],
                                        'cID'           => $param['cID'],
                                        'fID'           => $param['fID'],
                                        'wpID'          => $param['wpID'],
                                        'type'          => $req['part'],
                                        'status'        => 'Preparing',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc2)->insert($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Audit Planning on work paper");
                        return true;
                    break;
                    case 'AC3':
                        switch ($param['save']) {
                            case 'saveac4':
                                foreach($req['comment'] as $i => $val){
                                    $acid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc2)->where('mdID', $acid)->update($data);
                                }
                            break;
                            case 'saveac4ppr':
                                $acid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['ppr'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc2)->where('mdID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Audit Planning on work paper");
                        return true;
                    break;
                    case 'AC4':
                        switch ($param['save']) {
                            case 'saveac5':
                                $acid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['rescon'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc2)->where('mdID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Audit Planning on work paper");
                        return true;
                    break;
                    case 'AC5':
                        switch ($param['save']) {
                            case 'savetdabm':
                                $acid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['td'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc2)->where('mdID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Audit Planning on work paper");
                        return true;
                    break;
                    case 'AC6':
                        switch ($param['save']) {
                            case 'saveac8':
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['om'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc2)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Audit Planning on work paper");
                        return true;
                    break;
                    case 'AC7':
                        switch ($param['save']) {
                            case 'saveac6ra':
                                foreach($req['planning'] as $i => $val){
                                    $acid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['planning'][$i],
                                        'field3'        => $req['finalization'][$i],
                                        'field4'        => $req['reference'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc2)->where('mdID', $acid)->update($data);
                                }
                            break;
                            case 'saveac6s12':
                                $acid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['section'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc2)->where('mdID', $acid)->update($data);
                            break;
                            case 'saveac6s3':
                                $where = [
                                    'type'      => $req['part'], 
                                    'code'      => $param['code'], 
                                    'mtID'      => $param['mtID'],
                                    'cID'       => $param['cID'],
                                    'wpID'      => $param['wpID'],
                                ];
                                $this->db->table($this->tblc2)->where($where)->delete();
                                foreach($req['financialstatement'] as $i => $val){
                                    $data = [
                                        'field1'            => $req['financialstatement'][$i],
                                        'field2'            => $req['descriptioncontrol'][$i],
                                        'field3'            => $req['controleffective'][$i],
                                        'field4'            => $req['controlimplemented'][$i],
                                        'field5'            => $req['assesed'][$i],
                                        'field6'            => $req['crosstesting'][$i],
                                        'field7'            => $req['reliancecontrol'][$i],
                                        'code'              => $param['code'],
                                        'mtID'              => $param['mtID'],
                                        'fID'               => $param['fID'],
                                        'cID'               => $param['cID'],
                                        'type'              => $req['part'],
                                        'status'            => 'Active',
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc2)->insert($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Audit Planning on work paper");
                        return true;
                    break;
                    case 'AC8':
                        switch ($param['save']) {
                            case 'saveac7':
                                $data = [
                                    'field1'        => $req['genyn'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $where = [
                                    'type'     => $req['part'],
                                    'mtID'     => $param['mtID'],
                                    'cID'      => $param['cID'],
                                ];
                                $this->db->table($this->tblc2)->where($where)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Audit Planning on work paper");
                        return true;
                    break;
                    case 'AC9':
                        switch ($param['save']) {
                            case 'saveac9':
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['ac9'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc2)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Audit Planning on work paper");
                        return true;
                    break;
                    case 'AC10-Tangibles':
                    case 'AC10-PPE':
                    case 'AC10-Investments':
                    case 'AC10-Inventory':
                    case 'AC10-Trade Receivables':
                    case 'AC10-Other Receivables':
                    case 'AC10-Bank and Cash':
                    case 'AC10-Other Payables':
                    case 'AC10-Provisions':        
                    case 'AC10-Revenue':
                    case 'AC10-Costs':
                    case 'AC10-Payroll':
                    case 'AC10-Summary':
                        switch ($param['save']) {
                            case 'saveac10summ':
                                foreach ($req as $r => $val){
                                    $data = [
                                        'field1'        => $val,
                                        'type'          => $r.'data',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $where1 = [
                                        'type'          => $r.'data',
                                        'code'          => $req['code'],
                                        'mtID'          => $param['mtID'],
                                        'cID'           => $param['cID'],
                                        'wpID'          => $param['wpID'],
                                    ];
                                    $this->db->table($this->tblc2)->where($where1)->update($data);
                                }
                                $where2 = [
                                    'type'          => 'materialdata',
                                    'code'          => $req['code'],
                                    'mtID'          => $param['mtID'],
                                    'cID'           => $param['cID'],
                                    'wpID'          => $param['wpID'],
                                ];
                                $this->db->table($this->tblc2)->where($where2)->update(array('field1' => $req['materiality']));
                            break;
                            case 'saveac10s1':
                                $where = [
                                    'type'          => $req['type'], 
                                    'code'          => $req['code'],
                                    'field1'        => 'section1',
                                    'mtID'          => $param['mtID'],
                                    'cID'           => $param['cID'],
                                    'wpID'          => $param['wpID'],
                                ];
                                $this->db->table($this->tblc2)->where($where)->delete();
                                foreach($req['name'] as $i => $val){
                                    $data = [
                                        'field3'        => $req['less'][$i],
                                        'field4'        => $req['name'][$i],
                                        'field2'        => $req['balance'][$i],
                                        'type'          => $req['type'],
                                        'code'          => $req['code'],
                                        'mtID'          => $param['mtID'],
                                        'cID'           => $param['cID'],
                                        'fID'           => $param['fID'],
                                        'wpID'          => $param['wpID'],
                                        'status'        => 'Preparing',
                                        'field1'        => 'section1',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc2)->insert($data);
                                }
                            break;
                            case 'saveac10s2':
                                $where = [
                                    'type'          => $req['type'], 
                                    'code'          => $req['code'],
                                    'field1'        => 'section2',
                                    'mtID'          => $param['mtID'],
                                    'cID'           => $param['cID'],
                                    'wpID'          => $param['wpID'],
                                ];
                                $this->db->table($this->tblc2)->where($where)->delete();
                                foreach($req['name'] as $i => $val){
                                    $data = [
                                        'field3'        => $req['less'][$i],
                                        'field4'        => $req['name'][$i],
                                        'field5'        => $req['reason'][$i],
                                        'field2'        => $req['balance'][$i],
                                        'type'          => $req['type'],
                                        'code'          => $req['code'],
                                        'mtID'          => $param['mtID'],
                                        'cID'           => $param['cID'],
                                        'fID'           => $param['fID'],
                                        'wpID'          => $param['wpID'],
                                        'status'        => 'Preparing',
                                        'field1'        => 'section2',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc2)->insert($data);
                                }
                            break;
                            case 'saveac10cu':
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc2)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$param['code']} Audit Planning on work paper");
                        return true;
                    break;
                }
            break;

            case 'c3':
                switch ($param['code']) {
                    case 'AA1':
                        switch ($param['save']) {
                            case 'saveplaf' :
                                foreach($req['extent'] as $i => $val){
                                    $dacid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['extent'][$i],
                                        'field3'        => $req['reference'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                                }
                            break;
                            case 'saveaa1s3' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                            case 'saverceap' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AA2':
                        switch ($param['save']) {
                            case 'saveaa2' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['aa2'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AA3A':
                        switch ($param['save']) {
                            case 'saveaa3a' :
                                foreach($req['comment'] as $i => $val){
                                    $dacid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                                }
                            break;
                            case 'saveaa3afaf' :
                                foreach($req['extent'] as $i => $val){
                                    $dacid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['extent'][$i],
                                        'field3'        => $req['reference'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                                }
                            break;
                            case 'saveaa3air' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['air'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AA3B':
                        switch ($param['save']) {
                            case 'saveaa3b' :
                                foreach($req['reference'] as $i => $val){
                                    $dacid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['reference'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                                }
                            break;
                            case 'saveaa3bp4' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['p4'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AA4':
                        switch ($param['save']) {
                            case 'saveaa4' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['aa4'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AA5A':
                        switch ($param['save']) {
                            case 'saveaa5a' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['aa5a'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AA5B':
                        switch ($param['save']) {
                            case 'saveaa5b' :
                                $where = [
                                    'type'    => $req['part'],
                                    'code'    => $param['code'],
                                    'mtID'    => $param['mtID'],
                                    'cID'     => $param['cID'],
                                    'wpID'    => $param['wpID'],
                                ];
                                $this->db->table($this->tblc3)->where($where)->delete();
                                foreach($req['reference'] as $i => $val){
                                    $data = [
                                        'field1'        => $req['reference'][$i],
                                        'field2'        => $req['issue'][$i],
                                        'field3'        => $req['comment'][$i],
                                        'field4'        => $req['recommendation'][$i],
                                        'field5'        => $req['yesno'][$i],
                                        'field6'        => $req['result'][$i],
                                        'type'          => $req['part'],
                                        'code'          => $param['code'],
                                        'mtID'          => $param['mtID'],
                                        'cID'           => $param['cID'],
                                        'fID'           => $param['fID'],
                                        'wpID'          => $param['wpID'],
                                        'status'        => 'Preparing',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->insert($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AA6':
                        switch ($param['save']) {
                            case 'saveaa7isa' :
                                $where = [
                                    'type'  => $req['part'],
                                    'code'  => $param['code'],
                                    'mtID'  => $param['mtID'],
                                    'cID'   => $param['cID'],
                                    'wpID'  => $param['wpID'],
                                ];
                                $this->db->table($this->tblc3)->where($where)->delete();
                                foreach($req['reference'] as $i => $val){
                                    $data = [
                                        'field1'        => $req['reference'][$i],
                                        'field2'        => $req['issue'][$i],
                                        'field3'        => $req['comment'][$i],
                                        'field4'        => $req['recommendation'][$i],
                                        'field5'        => $req['result'][$i],
                                        'type'          => $req['part'],
                                        'code'          => $param['code'],
                                        'mtID'          => $param['mtID'],
                                        'cID'           => $param['cID'],
                                        'fID'           => $param['fID'],
                                        'wpID'          => $param['wpID'],
                                        'status'        => 'Preparing',
                                        'updated_on'    => $this->date.' '.$this->time
                                    ];
                                    $this->db->table($this->tblc3)->insert($data);
                                }
                            break;
                            case 'saveaa7aepapp' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['aep'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                            case 'saveaa7aep' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['aep'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AA7':
                        switch ($param['save']) {
                            case 'saveaa10' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['aa10'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AA8-un':
                    case 'AA8-ad':
                        switch ($param['save']) {
                            case 'saveaa11un' :
                                $where = [
                                    'type'     => $req['part'],
                                    'code'     => $req['code'],
                                    'mtID'     => $param['mtID'],
                                    'cID'      => $param['cID'],
                                    'wpID'     => $param['wpID'],
                                ];
                                $this->db->table($this->tblc3)->where($where)->delete();
                                foreach($req['reference'] as $i => $val){
                                    $data = [
                                        'field1'            => $req['reference'][$i],
                                        'field2'            => $req['desc'][$i],
                                        'field3'            => $req['drps'][$i],
                                        'field4'            => $req['crps'][$i],
                                        'field5'            => $req['drfp'][$i],
                                        'field6'            => $req['crfp'][$i],
                                        'field7'            => $req['yesno'][$i],
                                        'type'              => $req['part'],
                                        'code'              => $req['code'],
                                        'mtID'              => $param['mtID'],
                                        'cID'               => $param['cID'],
                                        'fID'               => $param['fID'],
                                        'wpID'              => $param['wpID'],
                                        'status'            => 'Preparing',
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->insert($data);
                                }
                            break;
                            case 'saveaa11ad' :
                                $where = [
                                    'type'     => $req['part'],
                                    'code'     => $req['code'],
                                    'mtID'     => $param['mtID'],
                                    'cID'      => $param['cID'],
                                    'wpID'     => $param['wpID'],
                                ];
                                $this->db->table($this->tblc3)->where($where)->delete();
                                foreach($req['reference'] as $i => $val){
                                    $data = [
                                        'field1'        => $req['reference'][$i],
                                        'field2'        => $req['desc'][$i],
                                        'field3'        => $req['drps'][$i],
                                        'field4'        => $req['crps'][$i],
                                        'field5'        => $req['drfp'][$i],
                                        'field6'        => $req['crfp'][$i],
                                        'type'          => $req['part'],
                                        'code'          => $req['code'],
                                        'mtID'          => $param['mtID'],
                                        'cID'           => $param['cID'],
                                        'fID'           => $param['fID'],
                                        'wpID'          => $param['wpID'],
                                        'status'        => 'Preparing',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->insert($data);
                                }
                            break;
                            case 'saveaa11uead' :
                            case 'saveaa11ue' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['aa11'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                            case 'saveaa11con' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['aa11'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AA9':
                        switch ($param['save']) {
                            case 'saveaa9' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['aa9'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break; 
                    case 'AA10':
                        switch ($param['save']) {
                            case 'saveaa10' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['aa10'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break; 
                    case 'AA11':
                        switch ($param['save']) {
                            case 'saveaa11' :
                                $where = [
                                    'type'     => $req['part'],
                                    'code'     => $param['code'],
                                    'mtID'     => $param['mtID'],
                                    'cID'      => $param['cID'],
                                    'wpID'     => $param['wpID'],
                                ];
                                $this->db->table($this->tblc3)->where($where)->delete();
                                foreach ($req['matter'] as $i => $val){
                                    $data = [
                                        'field1'        => $req['matter'][$i],
                                        'field2'        => $req['notperv'][$i],
                                        'field3'        => $req['perv'][$i],
                                        'type'          => $req['part'],
                                        'code'          => $param['code'],
                                        'mtID'          => $param['mtID'],
                                        'cID'           => $param['cID'],
                                        'fID'           => $param['fID'],
                                        'wpID'          => $param['wpID'],
                                        'status'        => 'Preparing',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->insert($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break; 
                    case 'AA12':
                        switch ($param['save']) {
                            case 'saveaa12' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['aa12'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break; 
                    case 'AB1':
                        switch ($param['save']) {
                            case 'saveab1' :
                                foreach ($req['yesno'] as $i => $val){
                                    $dacid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['yesno'][$i],
                                        'field3'        => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AB2':
                        switch ($param['save']) {
                            case 'saveab3' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                    case 'AB3-checklist':
                    case 'AB3-section1':
                    case 'AB3-section2':
                    case 'AB3-section3':
                    case 'AB3-section4':
                    case 'AB3-section5':
                    case 'AB3-section6':
                    case 'AB3-section7':
                    case 'AB3-section8':
                    case 'AB3-section9':
                        switch ($param['save']) {
                            case 'saveab4' :
                                foreach($req['yesno'] as $i => $val){
                                    $dacid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['yesno'][$i],
                                        'field3'        => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                                }
                            break;
                            case 'saveab4checklist' :
                                $dacid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['chlst'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('mdID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Concluding the Audit");
                        return true;
                    break;
                }
            break;
        }

    }


}