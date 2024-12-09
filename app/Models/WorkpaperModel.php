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
    public function getfileinfoc1($wpID,$cID,$ctID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on
        from {$this->tblc1} as c1 
        where c1.workpaper = {$wpID}
        and c1.clientID = {$cID}
        and c1.c1tID = {$ctID} limit 1");
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
    public function getfileinfoc2($wpID,$cID,$ctID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on 
        from {$this->tblc2} as c2 
        where c2.workpaper = {$wpID}
        and c2.clientID = {$cID}
        and c2.c2tID = {$ctID} limit 1");
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
    public function getfileinfoc3($wpID,$cID,$ctID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on 
        from {$this->tblc3} as c3 
        where c3.workpaper = {$wpID}
        and c3.clientID = {$cID}
        and c3.c3tID = {$ctID} limit 1");
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
    public function getfileindex($cID,$wpID,$status){

        $query = $this->db->query("select *
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
    public function getc1values($cID,$wpID,$status){

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
    public function getc2values($cID,$wpID,$status){

        
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
    public function getc3values($cID,$wpID,$status){

        
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
        and tb.workpaper = {$wpID}
        and tb.client = {$cID}");
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
            'client' => $dcID,
            'workpaper' => $dwpID,
            'firm' => $fID,
            'client' => $dcID,
            'quarter' => $qtr,
            'type' => $type,
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
            $dtbID = $this->crypt->decrypt($req['tbID'][$i]);
            $data = [
                'supp_bal'      => $req['sb'][$i],
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

        $pdfPath = ROOTPATH .'/public/uploads/pdf/wp/'.$req['fID'].'/'.$req['wpID'].'/';
        if (!is_dir($pdfPath)) {
            mkdir($pdfPath, 0755, true);
        }

        if($req['fstax'] != ''){
            $where = [
                'client'        => $req['cID'],
                'workpaper'     => $req['wpID'],
                'firm'          => $req['fID'],
                'index'         => $req['index'],
                'quarter'       => $req['quarter'],
                'type'          => $req['part'],
            ];
            $res = $this->db->table($this->tblfst)->where($where)->get();
            if($res->getNumRows() >= 1){
                $f = $res->getRowArray();

                $ce = $this->db->table($this->tblfst)->where(array('client' => $req['cID'],'workpaper' => $req['wpID'],'firm' => $req['fID'],'quarter' => $req['quarter']))->get()->getRowArray();
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
                    'client'        => $req['cID'],
                    'workpaper'     => $req['wpID'],
                    'firm'          => $req['fID'],
                    'index'         => $req['index'],
                    'quarter'       => $req['quarter'],
                    'type'          => $req['part'],
                    'file'          => $filename,
                    'uploaded_on'    => $this->date.' '.$this->time,
                    'uploaded_by'    => $req['uID'],
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
        //$pdfname = $req['cfiID'].$req['cID'].$req['wpID'].$req['index'].'.pdf';
        if($req['pdf'] != ''){
            $pdfPath = ROOTPATH .'/public/uploads/pdf/wp/'.$req['fID'].'/'.$req['wpID'].'/';
            if (!is_dir($pdfPath)) {
                mkdir($pdfPath, 0755, true);
            }
            $pdffile = $pdfPath.$filename; 
            if (file_exists($pdffile)) {
                unlink($pdffile);
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
        * @method uploadcfsfiles() upload client supporting files
        * @param req trial file data
        * @var fn file name
        * @var pdfpath path of the file uploaded
        * @return updated-false
    */
    public function uploadcfsfiles($req){

        $filename = $req['file']->getClientName();

        if($req['file'] != ''){
            $pdfPath = ROOTPATH .'/public/uploads/pdf/wp/'.$req['fID'].'/'.$req['wpID'].'/';
            if (!is_dir($pdfPath)) {
                mkdir($pdfPath, 0755, true);
            }
        
            $pdffile = $pdfPath.$filename; 
            if(file_exists($pdffile) && is_file($pdffile)) {
                unlink($pdffile);
            }
            $req['file']->move($pdfPath);
            $where = [
                'clientID'  => $req['cID'],
                'firm'      => $req['fID'],
                'workpaper' => $req['wpID'],
                'index'     => 1,
            ];
            $data = ['file' =>  $filename];
            if($this->db->table($this->tblcfi)->where($where)->update($data)){
                $this->logs->log(session()->get('name'). " has uploaded a copy signed financial statement on workpaper");
                return 'uploaded';
            }
        }else{
            return false;
        }

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
            case 'c1': $table       = $this->tblc1;  $ctID = 'c1tID';break;
            case 'c2': $table       = $this->tblc2;  $ctID = 'c2tID';break;
            case 'c3': $table       = $this->tblc3;  $ctID = 'c3tID';break;
            case 'index': $table    = $this->tblcfi; $ctID = 'cfiID';break;
        }
        $where = [
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID'],
            $ctID           => $req['ctID'],
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
            case 'c1': $table       = $this->tblc1;  $ctID = 'c1tID';break;
            case 'c2': $table       = $this->tblc2;  $ctID = 'c2tID';break;
            case 'c3': $table       = $this->tblc3;  $ctID = 'c3tID';break;
            case 'index': $table    = $this->tblcfi; $ctID = 'cfiID';break;
        }
        $where = [
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID'],
            $ctID           => $req['ctID'],
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
            case 'c1': $table       = $this->tblc1;  $ctID = 'c1tID';break;
            case 'c2': $table       = $this->tblc2;  $ctID = 'c2tID';break;
            case 'c3': $table       = $this->tblc3;  $ctID = 'c3tID';break;
            case 'index': $table    = $this->tblcfi; $ctID = 'cfiID';break;
        }
        $where = [
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID'],
            $ctID           => $req['ctID'],
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
            case 'c1': $table       = $this->tblc1;  $ctID = 'c1tID';break;
            case 'c2': $table       = $this->tblc2;  $ctID = 'c2tID';break;
            case 'c3': $table       = $this->tblc3;  $ctID = 'c3tID';break;
            case 'index': $table    = $this->tblcfi; $ctID = 'cfiID';break;
        }
        $where = [
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID'],
            $ctID           => $req['ctID'],
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
            case 'c1': $table       = $this->tblc1;  $ctID = 'c1tID';break;
            case 'c2': $table       = $this->tblc2;  $ctID = 'c2tID';break;
            case 'c3': $table       = $this->tblc3;  $ctID = 'c3tID';break;
            case 'index': $table    = $this->tblcfi; $ctID = 'cfiID';break;
        }
        $where = [
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID'],
            $ctID           => $req['ctID'],
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
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID'],
        ];
        
        $this->db->table($this->tblwp)->where(array('wpID' => $req['wpID']))->delete();
        $this->db->table($this->tblc1)->where($where)->delete();
        $this->db->table($this->tblc2)->where($where)->delete();
        $this->db->table($this->tblc3)->where($where)->delete();
        $this->db->table($this->tblcfi)->where($where)->delete();
        $this->db->table($this->tbltb)->where(array('client' => $req['cID'], 'workpaper' => $req['wpID']))->delete();
        $this->db->table($this->tblfst)->where(array('client' => $req['cID'], 'workpaper' => $req['wpID']))->delete();

        return "deleted";

    }








    /**
        ----------------------------------------------------------
        CHAPTER GET FUNCTIONS
        ----------------------------------------------------------
    */
    public function getvalues_m($c,$type,$code,$ctID,$cID,$wpID){

        switch ($c) {
            case 'c1': $table = $this->tblc1; $cd = 'c1tID'; break;
            case 'c2': $table = $this->tblc2; $cd = 'c2tID'; break;
            case 'c3': $table = $this->tblc3; $cd = 'c3tID'; break;
        }
        $where = [
            'code'          => $code, 
            'type'          => $type,
            $cd             => $ctID,
            'clientID'      => $cID,
            'workpaper' => $wpID,
        ];
        $query =  $this->db->table($table)->where($where)->get();
        return $query->getResultArray();

    }

    public function getvalues_s($c,$type,$code,$ctID,$cID,$wpID){

        switch ($c) {
            case 'c1': $table = $this->tblc1; $cd = 'c1tID'; break;
            case 'c2': $table = $this->tblc2; $cd = 'c2tID'; break;
            case 'c3': $table = $this->tblc3; $cd = 'c3tID'; break;
        }
        $where = [
            'code'          => $code, 
            'type'          => $type,
            $cd             => $ctID,
            'clientID'      => $cID,
            'workpaper' => $wpID,
        ];
        $query =  $this->db->table($table)->where($where)->get();
        return $query->getrowArray();

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
    public function getac10data($part,$code,$c1tID,$cID,$wpID,$section){

        $where = [
            'type' => $part,
            'code' => $code,
            'c1tID' => $c1tID,
            'clientID'  => $cID,
            'question' => $section,
            'workpaper' => $wpID,
        ];
        $query = $this->db->table($this->tblc1)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getdatacount() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var query result from database
        * @return integer
    */
    public function getdatacount($c1tID,$part,$cID,$wpID){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac10', 'c1tID' => $c1tID, 'clientID'  => $cID));
        return $query->countAllResults();

    }

    /**
        * @method getsumation() Count/Compute the balances
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var total result from database
        * @return integer
    */
    public function getsumation($c1tID,$part,$cID,$wpID){

        $where1 = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $cID,
            'workpaper'     => $wpID,
        ];
        $where2 = [
            'type'          => $part.'cu', 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $cID,
            'workpaper'     => $wpID,
        ];
        $total = $this->db->table($this->tblc1)->selectSum('balance')->where($where1)->get()->getRowArray();
        $cu = $this->db->table($this->tblc1)->where($where2)->get()->getRowArray();
        return $cu['question'] - $total['balance'];

    }

    
    public function savevalues($param,$req){

        switch ($param['chapter']) {
            case 'c1':
                switch($param['code']) {
                    case 'AC1':
                        switch ($param['save']) {
                            case 'saveac1':
                                foreach($req['yesno'] as $i => $val){
                                    $acid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'yesno'             => $req['yesno'][$i],
                                        'comment'           => $req['comment'][$i],
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
                                }
                            break;
                            case 'saveac1eqr':
                                $acid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
                        return true;
                    break;
                    case 'AC2':
                        switch ($param['save']) {
                            case 'saveac2':
                                foreach($req['corptax'] as $i => $val){
                                    $acid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'corptax'           => $req['corptax'][$i],
                                        'statutory'         => $req['statutory'][$i],
                                        'accountancy'       => $req['accountancy'][$i],
                                        'other'             => $req['other'][$i],
                                        'totalcu'           => $req['totalcu'][$i],
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
                                }
                            break;
                            case 'saveac2aep':
                                $acid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['eap'],
                                    'name'          => $req['concl'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
                        return true;
                    break;
                    case 'AC3':
                        switch ($param['save']) {
                            case 'saveac3':
                                foreach($req['yesno'] as $i => $val){
                                    $acid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'yesno'         => $req['yesno'][$i],
                                        'comment'       => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
                        return true;
                    break;
                    case 'AC4':
                        switch ($param['save']) {
                            case 'saveac4':
                                foreach($req['comment'] as $i => $val){
                                    $acid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'comment'       => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
                                }
                            break;
                            case 'saveac4ppr':
                                $acid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['ppr'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
                        return true;
                    break;
                    case 'AC5':
                        switch ($param['save']) {
                            case 'saveac5':
                                $acid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['rescon'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
                        return true;
                    break;
                    case 'AC6':
                        switch ($param['save']) {
                            case 'saveac6ra':
                                foreach($req['planning'] as $i => $val){
                                    $acid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'planning'          => $req['planning'][$i],
                                        'finalization'      => $req['finalization'][$i],
                                        'reference'         => $req['reference'][$i],
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
                                }
                            break;
                            case 'saveac6s12':
                                $acid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['section'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
                            break;
                            case 'saveac6s3':
                                $where = [
                                    'type'          => $req['part'], 
                                    'code'          => $req['code'], 
                                    'c1tID'         => $req['c1tID'],
                                    'clientID'      => $param['cID'],
                                    'workpaper'     => $param['wpID'],
                                ];
                                $this->db->table($this->tblc1)->where($where)->delete();
                                foreach($req['financialstatement'] as $i => $val){
                                    $data = [
                                        'finstate'          => $req['financialstatement'][$i],
                                        'desc'              => $req['descriptioncontrol'][$i],
                                        'controleffect'     => $req['controleffective'][$i],
                                        'implemented'       => $req['controlimplemented'][$i],
                                        'assessed'          => $req['assesed'][$i],
                                        'reference'         => $req['crosstesting'][$i],
                                        'reliance'          => $req['reliancecontrol'][$i],
                                        'code'              => $req['code'],
                                        'c1tID'             => $req['c1tID'],
                                        'workpaper'         => $param['wpID'],
                                        'firmID'            => $param['fID'],
                                        'clientID'          => $param['cID'],
                                        'type'              => $req['part'],
                                        'status'            => 'Active',
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1)->insert($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
                        return true;
                    break;
                    case 'AC7':
                        switch ($param['save']) {
                            case 'saveac7':
                                $data = [
                                    'question'      => $req['genyn'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $where = [
                                    'type'          => $req['part'],
                                    'c1tID'         => $req['c1tID'],
                                    'clientID'      => $param['cID'],
                                    'workpaper'     => $param['wpID'],
                                ];
                                $this->db->table($this->tblc1)->where($where)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
                        return true;
                    break;
                    case 'AC8':
                        switch ($param['save']) {
                            case 'saveac8':
                                foreach($req['question'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'question'          => $req['question'][$i],
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1)->where('acID', $dacid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
                        return true;
                    break;
                    case 'AC9':
                        switch ($param['save']) {
                            case 'saveac9':
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['ac9'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc1)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
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
                                        'question'      => $val,
                                        'type'          => $r.'data',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $where1 = [
                                        'type'          => $r.'data',
                                        'code'          => $req['code'],
                                        'c1tID'         => $req['c1tID'],
                                        'clientID'      => $param['cID'],
                                        'workpaper'     => $param['wpID'],
                                    ];
                                    $this->db->table($this->tblc1)->where($where1)->update($data);
                                }
                                $where2 = [
                                    'type'          => 'materialdata',
                                    'code'          => $req['code'],
                                    'c1tID'         => $req['c1tID'],
                                    'clientID'      => $param['cID'],
                                    'workpaper'     => $param['wpID'],
                                ];
                                $this->db->table($this->tblc1)->where($where2)->update(array('question' => $req['materiality']));
                            break;
                            case 'saveac10s1':
                                $where = [
                                    'type'          => $req['type'], 
                                    'code'          => $req['code'],
                                    'question'      => 'section1',
                                    'c1tID'         => $req['c1tID'],
                                    'clientID'      => $param['cID'],
                                    'workpaper'     => $param['wpID'],
                                ];
                                $this->db->table($this->tblc1)->where($where)->delete();
                                foreach($req['name'] as $i => $val){
                                    $data = [
                                        'less'          => $req['less'][$i],
                                        'name'          => $req['name'][$i],
                                        'balance'       => $req['balance'][$i],
                                        'type'          => $req['type'],
                                        'code'          => $req['code'],
                                        'c1tID'         => $req['c1tID'],
                                        'clientID'      => $param['cID'],
                                        'workpaper'     => $param['wpID'],
                                        'firmID'        => $param['fID'],
                                        'question'      => 'section1',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1)->insert($data);
                                }
                            break;
                            case 'saveac10s2':
                                $where = [
                                    'type'          => $req['type'], 
                                    'code'          => $req['code'],
                                    'question'      => 'section2',
                                    'c1tID'         => $req['c1tID'],
                                    'clientID'      => $param['cID'],
                                    'workpaper'     => $param['wpID'],
                                ];
                                $this->db->table($this->tblc1)->where($where)->delete();
                                foreach($req['name'] as $i => $val){
                                    $data = [
                                        'less'          => $req['less'][$i],
                                        'name'          => $req['name'][$i],
                                        'reason'        => $req['reason'][$i],
                                        'balance'       => $req['balance'][$i],
                                        'type'          => $req['type'],
                                        'code'          => $req['code'],
                                        'c1tID'         => $req['c1tID'],
                                        'workpaper'     => $param['wpID'],
                                        'clientID'      => $param['cID'],
                                        'firmID'        => $param['fID'],
                                        'question'      => 'section2',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1)->insert($data);
                                }
                            break;
                            case 'saveac10cu':
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc1)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
                        return true;
                    break;
                    case 'AC11':
                        switch ($param['save']) {
                            case 'saveac11':
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['ac11'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc1)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
                        return true;
                    break;
                }
            break;

            case 'c2':
                switch($param['code']) {
                    case '2.1 B2':
                    case '2.2.1 C2':   
                    case '2.2.2 C2-1':  
                    case '2.3 D2':
                    case '2.4.1 E2':   
                    case '2.4.3 E2-2': 
                    case '2.4.4 E2-3': 
                    case '2.4.5 E2-4':
                    case '2.5 F2':
                    case '2.6 H2':
                    case '2.7 I2':
                    case '2.8 J2':
                    case '2.9 K2':
                    case '2.10 L2': 
                    case '2.11 M2':
                    case '2.12 N2':
                    case '2.13.1 O2':
                    case '2.13.2 O2-1':
                    case '2.14 P2':
                    case '2.15 Q2':
                    case '2.16 R2-1':
                    case '2.17 R2-2':
                    case '2.18.1 S2-1':
                    case '2.18.2 S2-2': 
                    case '2.18.3 S2-3':
                    case '2.18.4 S2-4':
                    case '2.19.1 U2-1':
                    case '2.19.2 U2-2':
                    case '2.19.3 U2-3':  
                    case '2.4.2 E2-1':
                        switch ($param['save']) {
                            case 'savec2':
                                foreach($req['extent'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'extent'        => $req['extent'][$i],
                                        'reference'     => $req['reference'][$i],
                                        'initials'      => $req['initials'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc2)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'aicpppa':
                                foreach($req['comment'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'reference'     => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc2)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'rcicp':
                                foreach($req['extent'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'extent'        => $req['extent'][$i],
                                        'reference'     => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc2)->where('acID', $dacid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 2 on work paper");
                        return true;
                    break;
                }
            break;

            case 'c3':
                switch ($param['code']) {
                    case '3.1 Aa1':
                        switch ($param['save']) {
                            case 'saveplaf' :
                                foreach($req['extent'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'extent'        => $req['extent'][$i],
                                        'reference'     => $req['reference'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'saveaa1s3' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                            case 'saverceap' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.2 Aa2':
                        switch ($param['save']) {
                            case 'saveaa2' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['aa2'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.3 Aa3a':
                        switch ($param['save']) {
                            case 'saveaa3a' :
                                foreach($req['comment'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'reference'         => $req['comment'][$i],
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'saveaa3afaf' :
                                foreach($req['extent'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'extent'        => $req['extent'][$i],
                                        'reference'     => $req['reference'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'saveaa3air' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['air'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.4 Aa3b':
                        switch ($param['save']) {
                            case 'saveaa3b' :
                                foreach($req['reference'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'reference'     => $req['reference'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'saveaa3bp4' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['p4'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.5 Aa4':
                        switch ($param['save']) {
                            case 'saveaa4' :
                                $where = [
                                    'type'          => $req['part'],
                                    'code'          => $req['code'],
                                    'c3tID'         => $req['c3tID'],
                                    'clientID'      => $param['cID'],
                                    'workpaper'     => $param['wpID'],
                                ];
                                $data = [
                                    'question'      => $req['aa4'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'        => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where($where)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.6.1 Aa5a':
                        switch ($param['save']) {
                            case 'saveaa5a' :
                                $where = [
                                    'type'          => $req['part'],
                                    'code'          => $req['code'],
                                    'c3tID'         => $req['c3tID'],
                                    'clientID'      => $param['cID'],
                                    'firmID'        => $param['fID'],
                                    'workpaper'     => $param['wpID']
                                ];
                                $data = [
                                    'question'      => $req['aa5a'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where($where)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.6.2 Aa5b':
                        switch ($param['save']) {
                            case 'saveaa5b' :
                                $where = [
                                    'type'          => $req['part'],
                                    'code'          => $req['code'],
                                    'c3tID'         => $req['c3tID'],
                                    'clientID'      => $param['cID'],
                                    'workpaper'     => $param['wpID']
                                ];
                                $this->db->table($this->tblc3)->where($where)->delete();
                                foreach($req['reference'] as $i => $val){
                                    $data = [
                                        'reference'         => $req['reference'][$i],
                                        'issue'             => $req['issue'][$i],
                                        'comment'           => $req['comment'][$i],
                                        'recommendation'    => $req['recommendation'][$i],
                                        'yesno'             => $req['yesno'][$i],
                                        'result'            => $req['result'][$i],
                                        'type'              => $req['part'],
                                        'code'              => $req['code'],
                                        'c3tID'             => $req['c3tID'],
                                        'workpaper'         => $param['wpID'],
                                        'clientID'          => $param['cID'],
                                        'firmID'            => $param['fID'],
                                        'status'            => 'Active',
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->insert($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.7 Aa7':
                        switch ($param['save']) {
                            case 'saveaa7isa' :
                                $where = [
                                    'type'          => $req['part'],
                                    'code'          => $req['code'],
                                    'c3tID'         => $req['c3tID'],
                                    'clientID'      => $param['cID'],
                                    'workpaper'     => $param['wpID']
                                ];
                                $this->db->table($this->tblc3)->where($where)->delete();
                                foreach($req['reference'] as $i => $val){
                                    $data = [
                                        'reference'         => $req['reference'][$i],
                                        'issue'             => $req['issue'][$i],
                                        'comment'           => $req['comment'][$i],
                                        'recommendation'    => $req['recommendation'][$i],
                                        'result'            => $req['result'][$i],
                                        'type'              => $req['part'],
                                        'code'              => $req['code'],
                                        'c3tID'             => $req['c3tID'],
                                        'workpaper'         => $param['wpID'],
                                        'clientID'          => $param['cID'],
                                        'firmID'            => $param['fID'],
                                        'status'            => 'Active',
                                        'updated_on'        => $this->date.' '.$this->time
                                    ];
                                    $this->db->table($this->tblc3)->insert($data);
                                }
                            break;
                            case 'saveaa7aepapp' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['aep'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                            case 'saveaa7aep' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['aep'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.8 Aa10':
                        switch ($param['save']) {
                            case 'saveaa10' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['aa10'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.10 Aa11-un':
                    case '3.10 Aa11-ad':
                        switch ($param['save']) {
                            case 'saveaa11un' :
                                $where = [
                                    'type'          => $req['part'],
                                    'code'          => $req['code'],
                                    'c3tID'         => $req['c3tID'],
                                    'clientID'      => $param['cID'],
                                    'workpaper'     => $param['wpID'],
                                ];
                                $this->db->table($this->tblc3)->where($where)->delete();
                                foreach($req['reference'] as $i => $val){
                                    $data = [
                                        'reference'         => $req['reference'][$i],
                                        'initials'          => $req['desc'][$i],
                                        'drps'              => $req['drps'][$i],
                                        'crps'              => $req['crps'][$i],
                                        'drfp'              => $req['drfp'][$i],
                                        'crfp'              => $req['crfp'][$i],
                                        'yesno'             => $req['yesno'][$i],
                                        'type'              => $req['part'],
                                        'code'              => $req['code'],
                                        'c3tID'             => $req['c3tID'],
                                        'workpaper'         => $param['wpID'],
                                        'clientID'          => $param['cID'],
                                        'firmID'            => $param['fID'],
                                        'status'            => 'Active',
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->insert($data);
                                }
                            break;
                            case 'saveaa11ad' :
                                $where = [
                                    'type'          => $req['part'],
                                    'code'          => $req['code'],
                                    'c3tID'         => $req['c3tID'],
                                    'clientID'      => $param['cID'],
                                    'workpaper'     => $param['wpID']
                                ];
                                $this->db->table($this->tblc3)->where($where)->delete();
                                foreach($req['reference'] as $i => $val){
                                    $data = [
                                        'reference'     => $req['reference'][$i],
                                        'initials'      => $req['desc'][$i],
                                        'drps'          => $req['drps'][$i],
                                        'crps'          => $req['crps'][$i],
                                        'drfp'          => $req['drfp'][$i],
                                        'crfp'          => $req['crfp'][$i],
                                        'type'          => $req['part'],
                                        'code'          => $req['code'],
                                        'c3tID'         => $req['c3tID'],
                                        'workpaper'     => $param['wpID'],
                                        'clientID'      => $param['cID'],
                                        'firmID'        => $param['fID'],
                                        'status'        => 'Active',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->insert($data);
                                }
                            break;
                            case 'saveaa11uead' :
                            case 'saveaa11ue' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['aa11'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                            case 'saveaa11con' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['aa11'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.11':
                        switch ($param['save']) {
                            case 'save311' :
                                $where = [
                                    'type'      => '311',
                                    'code'      => $req['code'],
                                    'c3tID'     => $req['c3tID'],
                                    'clientID'  => $param['cID'],
                                    'workpaper' => $param['wpID'],
                                ];
                                $data = [
                                    'question'      => $req['arf'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where($where)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.13 Ab1':
                        switch ($param['save']) {
                            case 'saveab1' :
                                foreach ($req['yesno'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'yesno'         => $req['yesno'][$i],
                                        'comment'       => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.14 Ab3':
                        switch ($param['save']) {
                            case 'saveab3' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.15 Ab4-checklist':
                    case '3.15 Ab4-section1':
                    case '3.15 Ab4-section2':
                    case '3.15 Ab4-section3':
                    case '3.15 Ab4-section4':
                    case '3.15 Ab4-section5':
                    case '3.15 Ab4-section6':
                    case '3.15 Ab4-section7':
                    case '3.15 Ab4-section8':
                    case '3.15 Ab4-section9':
                        switch ($param['save']) {
                            case 'saveab4' :
                                foreach($req['yesno'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'yesno'         => $req['yesno'][$i],
                                        'comment'       => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'saveab4checklist' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['chlst'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                    case '3.15.1 Ab4a':
                    case '3.15.2 Ab4b':
                    case '3.15.3 Ab4c':
                    case '3.15.4 Ab4d':
                    case '3.15.5 Ab4e':
                    case '3.15.6 Ab4f':
                    case '3.15.7 Ab4g':
                    case '3.15.8 Ab4h':
                        switch ($param['save']) {
                            case 'saveab4a' :
                                foreach($req['yesno'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'yesno'             => $req['yesno'][$i],
                                        'comment'           => $req['comment'][$i],
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
                        return true;
                    break;
                }
            break;
        }

    }


}