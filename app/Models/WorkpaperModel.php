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
    protected $tblc1d   = "tbl_client_dfiles_c1";
    protected $tblc2d   = "tbl_client_dfiles_c2";
    protected $tblc3d   = "tbl_client_dfiles_c3";
    protected $tblc1    = "tbl_client_files_c1";
    protected $tblc2    = "tbl_client_files_c2";
    protected $tblc3    = "tbl_client_files_c3";
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
        and cfi.workpaper = {$wpID}
        and cfi.clientID = {$cID}");
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

        $query = $this->db->query("select DISTINCT title,c1t.code,c1titleID,c1.remarks,c1.status,
        (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.c1tID = c1.c1tID and {$this->tblc1}.workpaper = {$wpID} and {$this->tblc1}.clientID = {$cID}) as x , 
        (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.c1tID = c1.c1tID and {$this->tblc1}.workpaper = {$wpID} and {$this->tblc1}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
        from {$this->tblc1t} as c1t, {$this->tblc1} as c1
        where c1t.c1titleID = c1.c1tID
        and c1.clientID = {$cID}
        and c1.workpaper = {$wpID}
        order by c1titleID asc");
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

        
        $query = $this->db->query("select DISTINCT title,c2t.code,c2titleID,c2.remarks,c2.status,
        (select COUNT(*) from {$this->tblc2} WHERE {$this->tblc2}.c2tID = c2.c2tID and {$this->tblc2}.workpaper = {$wpID} and {$this->tblc2}.clientID = {$cID}) as x ,
        (select COUNT(*) from {$this->tblc2} WHERE {$this->tblc2}.c2tID = c2.c2tID and {$this->tblc2}.workpaper = {$wpID} and {$this->tblc2}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
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
    public function getc3values($cID,$wpID,$status){

        
        $query = $this->db->query("select DISTINCT title,c3t.code,c3titleID,c3.remarks,c3.status,
        (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.c3tID = c3.c3tID and {$this->tblc3}.workpaper = {$wpID} and {$this->tblc3}.clientID = {$cID}) as x ,
        (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.c3tID = c3.c3tID and {$this->tblc3}.workpaper = {$wpID} and {$this->tblc3}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
        from {$this->tblc3t} as c3t, {$this->tblc3} as c3
        where c3t.c3titleID = c3.c3tID
        and c3.clientID = {$cID}
        and c3.workpaper = '{$wpID}'
        order by c3titleID asc");
        return $query->getResultArray();

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
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.workpaper = wp.wpID and tc1.clientID = wp.client) as x1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.workpaper = wp.wpID and tc2.clientID = wp.client) as x2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.workpaper = wp.wpID and tc3.clientID = wp.client) as x3,
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.workpaper = wp.wpID and tc1.clientID = wp.client and updated_on IS NOT NULL) as y1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.workpaper = wp.wpID and tc2.clientID = wp.client and updated_on IS NOT NULL) as y2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.workpaper = wp.wpID and tc3.clientID = wp.client and updated_on IS NOT NULL) as y3,
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
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.workpaper = wp.wpID and tc1.clientID = wp.client) as x1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.workpaper = wp.wpID and tc2.clientID = wp.client) as x2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.workpaper = wp.wpID and tc3.clientID = wp.client) as x3,
        (select COUNT(*) from {$this->tblc1} as tc1 where tc1.workpaper = wp.wpID and tc1.clientID = wp.client and updated_on IS NOT NULL) as y1,
        (select COUNT(*) from {$this->tblc2} as tc2 where tc2.workpaper = wp.wpID and tc2.clientID = wp.client and updated_on IS NOT NULL) as y2,
        (select COUNT(*) from {$this->tblc3} as tc3 where tc3.workpaper = wp.wpID and tc3.clientID = wp.client and updated_on IS NOT NULL) as y3,
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
        where fi.fiID >= 6
        and fi.fiID <= 22");
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

        $pdfname = $req['cfiID'].$req['cID'].$req['wpID'].$req['index'].'.pdf';
        if($req['pdf'] != ''){

            $pdfPath = ROOTPATH .'/public/uploads/pdf/wp/'.$req['fID'].'/'.$req['wpID'].'/';
            if (!is_dir($pdfPath)) {
                mkdir($pdfPath, 0755, true);
            }

            $pdffile = $pdfPath.$pdfname; 
            if (file_exists($pdffile)) {
                unlink($pdffile);
            }
            $req['pdf']->move($pdfPath, $pdfname);
        }
        $data = [
            'file'      => $pdfname,
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
            'client'        => $req['client'],
            'firm'          => $req['firm'],
            'workpaper'     => $req['workpaper'],
        ];
        $this->db->table($this->tbltb)->where($where)->delete();
        foreach($req['account_code'] as $i => $val){
            $index = $this->crypt->decrypt($req['fileindex'][$i]);
            switch ($index) {
                case '6'    : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'tangiblescu']; break;
                case '7'    : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'ppecu']; break;
                case '8'    : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'investmentscu']; break;
                case '9'    : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'inventorycu']; break;
                case '10'   : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'trade receivablescu']; break;
                //case '20'   : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'other receivablescu']; break;
                case '11'   : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'bank and cashcu']; break;
                case '12'   : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'trade payablescu']; break;
                //case '21'   : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'other payablescu']; break;
                case '15'   : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'provisionscu']; break;
                case '18'   : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'revenuecu']; break;
                case '19'   : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'costscu']; break;
                //case '17'   : $refaut = ['clientID' => $req['client'], 'firmID' => $req['firm'], 'code' => 'AC10', 'type' => 'payrollcu']; break;
            }
            $balcu = $this->db->table($this->tblc1)->where($refaut)->get()->getRowArray();
            if(!empty($balcu)){
                // if($balcu['question'] != 0){
                //     $cal = ['question' => $req['debit'][$i] - $req['credit'][$i]];
                // }else{
                    $cal = ['question' => $balcu['question'] + ($req['debit'][$i] - $req['credit'][$i])];
                //}
                $this->db->table($this->tblc1)->where($refaut)->update($cal);
            }
            
            $this->db->table($this->tblcfi)->where(array('clientID' => $req['client'], 'firm' => $req['firm'], 'workpaper' => $req['workpaper'], 'index' => $index))->update(array('acquired' => 'Yes'));
            $data = [
                'client'        => $req['client'],
                'firm'          => $req['firm'],
                'workpaper'     => $req['workpaper'],
                'index'         => $index,
                'account_code'  => $req['account_code'][$i],
                'account'       => $req['account'][$i],
                'account_type'  => $req['account_type'][$i],
                'debit'         => $req['debit'][$i],
                'credit'        => $req['credit'][$i],
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

        if($req['file'] != ''){
            $pdfPath = ROOTPATH .'/public/uploads/pdf/wp/'.$req['fID'].'/'.$req['wpID'].'/';
            if (!is_dir($pdfPath)) {
                mkdir($pdfPath, 0755, true);
            }
            $fn = $req['cID'].'-'.$req['wpID'].'.pdf';
            $pdffile = $pdfPath.$fn; 
            if(file_exists($pdffile) && is_file($pdffile)) {
                unlink($pdffile);
            }
            $req['file']->move($pdfPath, $fn);
            $this->logs->log(session()->get('name'). " has uploaded a copy signed financial statement on workpaper");
            return 'uploaded';
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
            'end_financial_year'    => $req['efy'],
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
                    'clientID'        => $req['client'],
                    'firm'          => $req['firm'],
                    'workpaper'     => $wpid,
                    'index'         => $i['fiID'],
                    'acquired'      => 'No',
                    'added_on'      => $this->date.' '.$this->time,
                    'added_by'      => $req['uID'],
                ];
                $this->db->table($this->tblcfi)->insert($ind);
            }
            $wherec1 = [
                'firmID'    => $req['firm'],
                'clientID'  => $req['client'],
            ];
            $c1df = $this->db->table($this->tblc1d)->where($wherec1)->get();
            if($c1df->getNumRows() >= 1){
                foreach($c1df->getResultArray() as $r){
                    $datac1 = [
                        'firmID'            => $req['firm'],
                        'workpaper'         => $wpid,
                        'clientID'          => $req['client'],
                        'c1tID'             => $r['c1tID'],
                        'code'              => $r['code'],
                        'type'              => $r['type'],
                        'question'          => $r['question'],
                        'less'              => $r['less'],
                        'name'              => $r['name'],
                        'reason'            => $r['reason'],
                        'balance'           => $r['balance'],
                        'planning'          => $r['planning'],
                        'finalization'      => $r['finalization'],
                        'reference'         => $r['reference'],
                        'reliance'          => $r['reliance'],
                        'finstate'          => $r['finstate'],
                        'desc'              => $r['desc'],
                        'controleffect'     => $r['controleffect'],
                        'implemented'       => $r['implemented'],
                        'assessed'          => $r['assessed'],
                        'yesno'             => $r['yesno'],
                        'comment'           => $r['comment'],
                        'corptax'           => $r['corptax'],
                        'statutory'         => $r['statutory'],
                        'accountancy'       => $r['accountancy'],
                        'other'             => $r['other'],
                        'totalcu'           => $r['totalcu'],
                        'status'            => 'Preparing',
                        'remarks'           => $r['remarks'],
                        'added_on'          => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc1)->insert($datac1);
                }
            }
            $wherec2 = [
                'firmID'    => $req['firm'],
                'clientID'  => $req['client'],
            ];
            $c2df = $this->db->table($this->tblc2d)->where($wherec2)->get();
            if($c2df->getNumRows() >= 1){
                foreach($c2df->getResultArray() as $r){
                    $datac2 = [
                        'firmID'            => $req['firm'],
                        'workpaper'         => $wpid,
                        'clientID'          => $req['client'],
                        'c2tID'             => $r['c2tID'],
                        'code'              => $r['code'],
                        'type'              => $r['type'],
                        'question'          => $r['question'],
                        'extent'            => $r['extent'],
                        'reference'         => $r['reference'],
                        'initials'          => $r['initials'],
                        'desc'              => $r['desc'],
                        'controleffect'     => $r['controleffect'],
                        'assessed'          => $r['assessed'],
                        'yesno'             => $r['yesno'],
                        'comment'           => $r['comment'],
                        'corptax'           => $r['corptax'],
                        'statutory'         => $r['statutory'],
                        'accountancy'       => $r['accountancy'],
                        'other'             => $r['other'],
                        'totalcu'           => $r['totalcu'],
                        'status'            => 'Preparing',
                        'remarks'           => $r['remarks'],
                        'added_on'          => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc2)->insert($datac2);
                }
            }
            $wherec3 = [
                'firmID'    => $req['firm'],
                'clientID'  => $req['client'],
            ];
            $c3df = $this->db->table($this->tblc3d)->where($wherec3)->get();
            if($c3df->getNumRows() >= 1){
                foreach($c3df->getResultArray() as $r){
                    $datac3 = [
                        'firmID'            => $req['firm'],
                        'workpaper'         => $wpid,
                        'clientID'          => $req['client'],
                        'c3tID'             => $r['c3tID'],
                        'code'              => $r['code'],
                        'type'              => $r['type'],
                        'question'          => $r['question'],
                        'extent'            => $r['extent'],
                        'reference'         => $r['reference'],
                        'initials'          => $r['initials'],
                        'drps'              => $r['drps'],
                        'crps'              => $r['crps'],
                        'drfp'              => $r['drfp'],
                        'crfp'              => $r['crfp'],
                        'issue'             => $r['issue'],
                        'recommendation'    => $r['recommendation'],
                        'result'            => $r['result'],
                        'yesno'             => $r['yesno'],
                        'comment'           => $r['comment'],
                        'other'             => $r['other'],
                        'totalcu'           => $r['totalcu'],
                        'status'            => 'Preparing',
                        'remarks'           => $r['remarks'],
                        'added_on'          => $this->date.' '.$this->time
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
            case 'index': $table    = $this->tblcfi; $ctID = 'index';break;
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
            case 'index': $table    = $this->tblcfi; $ctID = 'index';break;
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
            case 'index': $table    = $this->tblcfi; $ctID = 'index';break;
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
            case 'index': $table    = $this->tblcfi; $ctID = 'index';break;
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
            case 'index': $table    = $this->tblcfi; $ctID = 'index';break;
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





    /**
        ----------------------------------------------------------
        CHAPTER 1 GET FUNCTIONS
        ----------------------------------------------------------
        * @method getvalues_m() get all the multi row data
        * @param type type or part of the file
        * @param code code of the file
        * @param ctID id of the file
        * @param cID id of the client
        * @var where-array reference for the fetch
        * @return result-array
    */
    public function getvalues_mc1($type,$code,$ctID,$cID,$wpID){

        $where = [
            'type'      => $type, 
            'code'      => $code,
            'c1tID'     => $ctID,
            'clientID'  => $cID,
            'workpaper' => $wpID,
        ];
        $query =  $this->db->table($this->tblc1)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getvalues_s() get a single row data
        * @param type type or part of the file
        * @param code code of the file
        * @param ctID id of the file
        * @param cID id of the client
        * @var where-array reference for the fetch
        * @return row-array
    */
    public function getvalues_sc1($type,$code,$ctID,$cID,$wpID){

        $where = [
            'type'      => $type, 
            'code'      => $code,
            'c1tID'     => $ctID,
            'clientID'  => $cID,
            'workpaper' => $wpID,
        ];
        $query =  $this->db->table($this->tblc1)->where($where)->get();
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
    public function getac10data($part,$code,$c1tID,$cID,$section,$wpID){

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

    
    
    /**
        ----------------------------------------------------------
        CHAPTER 1 POST FUNCTIONS
        AC1 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac1() save the ac1 information
        * @param req ac1 data
        * @var acid decrypted chapter id
        * @var data contains ac1 information
        * @return bool
    */
    public function saveac1($req){

        foreach($req['yesno'] as $i => $val){
            $acid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'yesno'         => $req['yesno'][$i],
                'comment'       => $req['comment'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
        return true;
      
    }

    /**
        * @method saveeqr() save the ac1 information
        * @param req ac1 data
        * @var acid decrypted chapter id
        * @var data contains ac1 information
        * @return bool
    */
    public function saveac1eqr($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['question'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $acid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
            return true;
        }else{
            return false;
        }

    }


    /**
        ----------------------------------------------------------
        AC2 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac2() save the ac2 information
        * @param req ac2 data
        * @var acid decrypted chapter id
        * @var data contains ac1 information
        * @return bool
    */
    public function saveac2($req){

        foreach($req['corptax'] as $i => $val){
            $acid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'corptax'       => $req['corptax'][$i],
                'statutory'     => $req['statutory'][$i],
                'accountancy'   => $req['accountancy'][$i],
                'other'         => $req['other'][$i],
                'totalcu'       => $req['totalcu'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
        return true;

    }

    /**
        * @method saveac2aep() save the ac2 information
        * @param req ac2 data
        * @var acid decrypted chapter id
        * @var data contains ac2 information
        * @return bool
    */
    public function saveac2aep($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['eap'],
            'name'          => $req['concl'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $acid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AC3 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac3() save the ac3 information
        * @param req ac3 data
        * @var acid decrypted chapter id
        * @var data contains ac3 information
        * @return bool
    */
    public function saveac3($req){

        foreach($req['yesno'] as $i => $val){
            $acid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'yesno'         => $req['yesno'][$i],
                'comment'       => $req['comment'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
        return true;

    }


    /**
        ----------------------------------------------------------
        AC4 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac4ppr() save the ac4 information
        * @param req ac4 data
        * @var acid decrypted chapter id
        * @var data contains ac4 information
        * @return bool
    */
    public function saveac4ppr($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['ppr'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $acid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
            return true;
        }else{
            return false;
        }

    }

    /**
        * @method saveac4() save the ac4 information
        * @param req ac4 data
        * @var acid decrypted chapter id
        * @var data contains ac4 information
        * @return bool
    */
    public function saveac4($req){

        foreach($req['comment'] as $i => $val){
            $acid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'comment'       => $req['comment'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
        }
        return true;

    }

    
    /**
        ----------------------------------------------------------
        AC5 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac5() save the ac5 information
        * @param req ac5 data
        * @var acid decrypted chapter id
        * @var data contains ac5 information
        * @return bool
    */
    public function saveac5($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['rescon'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $acid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AC6 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac6ra() save the ac6 information
        * @param req ac6 data
        * @var acid decrypted chapter id
        * @var data contains ac6 information
        * @return bool
    */
    public function saveac6ra($req){

        foreach($req['planning'] as $i => $val){
            $acid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'planning'      => $req['planning'][$i],
                'finalization'  => $req['finalization'][$i],
                'reference'     => $req['reference'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc1)->where('acID', $acid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
        return true;

    }

    /**
        * @method saveac6s12() save the ac6 information
        * @param req ac6 data
        * @var acid decrypted chapter id
        * @var data contains ac6 information
        * @return bool
    */
    public function saveac6s12($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['section'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $acid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
            return true;
        }else{
            return false;
        }

    }

    /**
        * @method saveac6s3() save the ac6 information
        * @param req ac6 data
        * @var array-where reference data
        * @var acid decrypted chapter id
        * @var data contains ac6 information
        * @return bool
    */
    public function saveac6s3($req){
        $where = [
            'type'          => $req['part'], 
            'code'          => $req['code'], 
            'c1tID'         => $req['c1tID'],
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID'],
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
                'workpaper'         => $req['wpID'],
                'firmID'            => $req['fID'],
                'clientID'          => $req['cID'],
                'type'              => $req['part'],
                'status'            => 'Active',
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
        return true;

    }

    
    /**
        ----------------------------------------------------------
        AC7 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac7() save the ac7 information
        * @param req ac7 data
        * @var data contains ac7 information
        * @var array-where reference data
        * @return bool
    */
    public function saveac7($req){

        $data = [
            'question'      => $req['genyn'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        $where = [
            'type'          => $req['part'],
            'c1tID'         => $req['c1tID'],
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID'],
        ];
        if($this->db->table($this->tblc1)->where($where)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AC8 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac8() save the ac8 information
        * @param req ac8 data
        * @var dacid decrypted chapter id
        * @var data contains ac4 information
        * @return bool
    */
    public function saveac8($req){

        foreach($req['question'] as $i => $val){
            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'question'      => $req['question'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc1)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
        return true;

    }

    
    /**
        ----------------------------------------------------------
        AC9 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac9() save the ac9 information
        * @param req ac9 data
        * @var dacid decrypted chapter id
        * @var data contains ac9 information
        * @return bool
    */
    public function saveac9($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['ac9'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
            return true;
        }else{
            return false;
        }

    }

   
    /**
        ----------------------------------------------------------
        AC10 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac10summ() save the ac10 information
        * @param req ac10 data
        * @param ref ac10 reference
        * @var data contains ac10 information
        * @var where1-where2 update reference on client files
        * @return bool
    */
    public function saveac10summ($req,$ref){

        foreach ($req as $r => $val){
            $data = [
                'question'      => $val,
                'type'          =>  $r.'data',
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $ref['uID'],
            ];
            $where1 = [
                'type'          => $r.'data',
                'code'          => $ref['code'],
                'c1tID'         => $ref['c1tID'],
                'clientID'      =>$ref['cID'],
                'workpaper'     => $req['wpID'],
            ];
            $this->db->table($this->tblc1)->where($where1)->update($data);
        }
        $where2 = [
            'type'          => 'materialdata',
            'code'          => $ref['code'],
            'c1tID'         => $ref['c1tID'],
            'clientID'      =>$ref['cID'],
            'workpaper'     => $req['wpID'],
        ];
        $this->db->table($this->tblc1)->where($where2)->update(array('question' => $ref['materiality']));
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
        return true;

    }

    /**
        * @method saves1ac10() save the ac10 information
        * @param req ac10 data
        * @var where update reference on client files
        * @var data contains ac10 information
        * @return bool
    */
    public function saveac10s1($req){

        $where = [
            'type'          => $req['type'], 
            'code'          => $req['code'],
            'question'      => 'section1',
            'c1tID'         => $req['c1tID'],
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID'],
        ];
        $this->db->table($this->tblc1)->where($where)->delete();
        foreach($req['name'] as $i => $val){
            $data = [
                'less'          => $req['less'][$i],
                'name'          => $req['name'][$i],
                'balance'       => $req['balance'][$i],
                'type'          =>  $req['type'],
                'code'          =>  $req['code'],
                'c1tID'         => $req['c1tID'],
                'clientID'      => $req['cID'],
                'workpaper'     => $req['wpID'],
                'firmID'        => $req['fID'],
                'question'      => 'section1',
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
        return true;

    }

    /**
        * @method saveac10s2() save the ac10 information
        * @param req ac10 data
        * @var where update reference on client files
        * @var data contains ac10 information
        * @return bool
    */
    public function saveac10s2($req){

        $where = [
            'type'          => $req['type'], 
            'code'          => $req['code'],
            'question'      => 'section2',
            'c1tID'         => $req['c1tID'],
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID'],
        ];
        $this->db->table($this->tblc1)->where($where)->delete();
        foreach($req['name'] as $i => $val){
            $data = [
                'less'          => $req['less'][$i],
                'name'          => $req['name'][$i],
                'reason'        => $req['reason'][$i],
                'balance'       => $req['balance'][$i],
                'type'          =>  $req['type'],
                'code'          =>  $req['code'],
                'c1tID'         => $req['c1tID'],
                'clientID'      => $req['cID'],
                'workpaper'     => $req['wpID'],
                'firmID'        => $req['fID'],
                'question'      => 'section2',
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
        return true;

    }

    /**
        * @method saveac10cu() save the ac10 information
        * @param req ac10 data
        * @var dacid decrypted chapter id
        * @var data contains ac10 information
        * @return bool
    */
    public function saveac10cu($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['question'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
            return true;
        }else{
            return false;
        }
        
    }


    /**
        ----------------------------------------------------------
        AC11 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac11() save the ac10 information
        * @param req ac10 data
        * @var dacid decrypted chapter id
        * @var data contains ac10 information
        * @return bool
    */
    public function saveac11($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['ac11'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 1 on work paper");
            return true;
        }else{
            return false;
        }

    }






















    



    /**
        ----------------------------------------------------------
        CHAPTER 2 GET FUNCTIONS
        ----------------------------------------------------------
        * @method getvalues_m() get all the multi row data
        * @param type type or part of the file
        * @param code code of the file
        * @param ctID id of the file
        * @param cID id of the client
        * @var where-array reference for the fetch
        * @return result-array
    */
    public function getvalues_mc2($type,$code,$ctID,$cID,$wpID){

        $where = [
            'type'      => $type, 
            'code'      => $code,
            'c2tID'     => $ctID,
            'clientID'  => $cID,
            'workpaper' => $wpID,
        ];
        $query =  $this->db->table($this->tblc2)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        ----------------------------------------------------------
        CHAPTER 2 POST FUNCTIONS
        ----------------------------------------------------------
        * @method savequestions() save the chapter 2
        * @param req chapter 2
        * @var dacid decrypted chapter id
        * @var data contains chapter 2
        * @return bool
    */
    public function savequestions($req){

        foreach($req['extent'] as $i => $val){
            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'extent'        => $req['extent'][$i],
                'reference'     => $req['reference'][$i],
                'initials'      => $req['initials'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc2)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 2 on work paper");
        return true;

    }

    /**
        * @method saveaicpppa() save the chapter 2
        * @param req chapter 2
        * @var dacid decrypted chapter id
        * @var data contains chapter 2
        * @return bool
    */
    public function saveaicpppa($req){

        foreach($req['comment'] as $i => $val){
            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'reference'         => $req['comment'][$i],
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc2)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 2 on work paper");
        return true;

    }

    /**
        * @method savercicp() save the chapter 2
        * @param req chapter 2
        * @var dacid decrypted chapter id
        * @var data contains chapter 2
        * @return bool
    */
    public function savercicp($req){

        foreach($req['extent'] as $i => $val){
            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'extent'            => $req['extent'][$i],
                'reference'         => $req['comment'][$i],
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc2)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 2 on work paper");
        return true;

    }





















    /**
        ----------------------------------------------------------
        CHAPTER 3 GET FUNCTIONS
        ----------------------------------------------------------
        * @method getvalues_m() get all the multi row data
        * @param type type or part of the file
        * @param code code of the file
        * @param ctID id of the file
        * @param cID id of the client
        * @var where-array reference for the fetch
        * @return result-array
    */
    public function getvalues_mc3($type,$code,$ctID,$cID,$wpID){

        $where = [
            'type'      => $type, 
            'code'      => $code,
            'c3tID'     => $ctID,
            'clientID'  => $cID,
            'workpaper' => $wpID,
        ];
        $query =  $this->db->table($this->tblc3)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getvalues_s() get a single row data
        * @param type type or part of the file
        * @param code code of the file
        * @param ctID id of the file
        * @param cID id of the client
        * @var where-array reference for the fetch
        * @return row-array
    */
    public function getvalues_sc3($type,$code,$ctID,$cID,$wpID){

        $where = [
            'type'      => $type, 
            'code'      => $code,
            'c3tID'     => $ctID,
            'clientID'  => $cID,
            'workpaper' => $wpID,
        ];
        $query =  $this->db->table($this->tblc3)->where($where)->get();
        return $query->getrowArray();

    }
    /**
        ----------------------------------------------------------
        CHAPTER 3 POST FUNCTIONS
        AA1 FUNCTIONS
        ----------------------------------------------------------
        * @method savequestions() save the aa1 information
        * @param req aa1 data
        * @var dacid decrypted chapter id
        * @var data contains aa1 information
        * @return bool
    */
    public function saveplaf($req){

        foreach($req['extent'] as $i => $val){
            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'extent'        => $req['extent'][$i],
                'reference'     => $req['reference'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
        return true;

    }

    /**
        * @method saveaa1s3() save the aa1 information
        * @param req aa1 data
        * @var dacid decrypted chapter id
        * @var data contains aa1 information
        * @return bool
    */
    public function saveaa1s3($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['question'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }

    }


    /**
        ----------------------------------------------------------
        AA2 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa2() save the aa2 information
        * @param req aa2 data
        * @var dacid decrypted chapter id
        * @var data contains aa2 information
        * @return bool
    */
    public function saveaa2($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aa2'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AA3a FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa3a() save the aa3a information
        * @param req aa3a data
        * @var dacid decrypted chapter id
        * @var data contains aa3a information
        * @return bool
    */
    public function saveaa3a($req){

        foreach($req['comment'] as $i => $val){
            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'reference'     => $req['comment'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
        return true;

    }

    /**
        * @method saveaa3afaf() save the aa3a information
        * @param req aa3a data
        * @var dacid decrypted chapter id
        * @var data contains aa3a information
        * @return bool
    */
    public function saveaa3afaf($req){

        foreach($req['extent'] as $i => $val){
            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'extent'        => $req['extent'][$i],
                'reference'     => $req['reference'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
        return true;

    }

    /**
        * @method saveaa3air() save the aa3a information
        * @param req aa3a data
        * @var dacid decrypted chapter id
        * @var data contains aa3a information
        * @return bool
    */
    public function saveaa3air($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['ir'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AA3b FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa3b() save the aa3b information
        * @param req aa3b data
        * @var dacid decrypted chapter id
        * @var data contains aa3b information
        * @return bool
    */
    public function saveaa3b($req){

        foreach($req['reference'] as $i => $val){
            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'reference'     => $req['reference'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
        return true;

    }

    /**
        * @method saveaa3bp4() save the aa3b information
        * @param req aa3b data
        * @var dacid decrypted chapter id
        * @var data contains aa3b information
        * @return bool
    */
    public function saveaa3bp4($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['p4'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }

    }


    /**
        ----------------------------------------------------------
        AA4 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa4() save the aa4 information
        * @param req aa4 data
        * @var data contains aa3b information
        * @return bool
    */
    public function saveaa4($req){

        $where = [
            'type'          => $req['part'],
            'code'          => $req['code'],
            'c3tID'         => $req['c3tID'],
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID']
        ];
        $data = [
            'question'      => $req['aa4'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where($where)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AA5b FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa5b() save the aa5b information
        * @param req aa5b data
        * @var array-where reference data
        * @var data contains aa5b information
        * @return bool
    */
    public function saveaa5b($req){

        $where = [
            'type'          => $req['part'],
            'code'          => $req['code'],
            'c3tID'         => $req['c3tID'],
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID']
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
                'workpaper'         => $req['wpID'],
                'clientID'          => $req['cID'],
                'firmID'            => $req['fID'],
                'status'            => 'Active',
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
        return true;

    }


    /**
        ----------------------------------------------------------
        AA7 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa7isa() save the aa7 information
        * @param req aa7 data
        * @var array-where reference data
        * @var data contains aa7 information
        * @return bool
    */
    public function saveaa7isa($req){

        $where = [
            'type'          => $req['part'],
            'code'          => $req['code'],
            'c3tID'         => $req['c3tID'],
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID']
        ];
        $this->db->table($this->tblc3)->where($where)->delete();
        foreach($req['reference'] as $i => $val){
            $data = [
                'reference'             => $req['reference'][$i],
                'issue'                 => $req['issue'][$i],
                'comment'               => $req['comment'][$i],
                'recommendation'        => $req['recommendation'][$i],
                'result'                => $req['result'][$i],
                'type'                  =>  $req['part'],
                'code'                  =>  $req['code'],
                'c3tID'                 => $req['c3tID'],
                'clientID'              => $req['cID'],
                'workpaper'             => $req['wpID'],
                'firmID'                => $req['fID'],
                'status'                => 'Active',
                'updated_on'            => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
        return true;

    }

    /**
        * @method saveaa7aepapp() save the aa7 information
        * @param req aa7 data
        * @var dacid decrypted chapter id
        * @var data contains aa7 information
        * @return bool
    */
    public function saveaa7aepapp($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aep'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }

    }

    /**
        * @method saveaa7aep() save the aa7 information
        * @param req aa7 data
        * @var dacid decrypted chapter id
        * @var data contains aa7 information
        * @return bool
    */
    public function saveaa7aep($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aep'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AA10 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa10() save the aa10 information
        * @param req aa10 data
        * @var dacid decrypted chapter id
        * @var data contains aa10 information
        * @return bool
    */
    public function saveaa10($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aa10'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AA11 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa11un() save the aa11 information
        * @param req aa11 data
        * @var array-where reference data
        * @var data contains aa11 information
        * @return bool
    */
    public function saveaa11un($req){

        $where = [
            'type'          => $req['part'],
            'code'          => $req['code'],
            'c3tID'         => $req['c3tID'],
            'clientID'      => $req['cID'],
            'workpaper'     => $req['wpID'],
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
                'type'              =>  $req['part'],
                'code'              =>  $req['code'],
                'c3tID'             => $req['c3tID'],
                'clientID'          => $req['cID'],
                'workpaper'         => $req['wpID'],
                'firmID'            => $req['fID'],
                'status'            => 'Active',
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
       return true;

    }

    /**
        * @method saveaa11ad() save the aa11 information
        * @param req aa11 data
        * @var array-where reference data
        * @var data contains aa11 information
        * @return bool
    */
    public function saveaa11ad($req){

        $where = [
            'type'          => $req['part'],
            'code'          => $req['code'],
            'c3tID'         => $req['c3tID'],
            'clientID'      => $req['cID'],
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
                'type'              =>  $req['part'],
                'code'              =>  $req['code'],
                'c3tID'             => $req['c3tID'],
                'clientID'          => $req['cID'],
                'workpaper'         => $req['wpID'],
                'firmID'            => $req['fID'],
                'status'            => 'Active',
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc3)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
       return true;

    }
    
    /**
        * @method saveaa11ue() save the aa11 information
        * @param req aa11 data
        * @var dacid decrypted chapter id
        * @var data contains aa11 information
        * @return bool
    */
    public function saveaa11ue($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aa11'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }

    }

    /**
        * @method saveaa11con() save the aa11 information
        * @param req aa11 data
        * @var dacid decrypted chapter id
        * @var data contains aa11 information
        * @return bool
    */
    public function saveaa11con($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aa11'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }

    }


    public function save311($req){

        $where = [
            'type'          => $req['part'],
            'code'          => $req['code'],
            'c3tID'         => $req['c3tID'],
            'clientID'      => $req['cID'],
        ];
        $data = [
            'question'      => $req['arf'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where($where)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AB1 FUNCTIONS
        ----------------------------------------------------------
        * @method saveab1() save the ab1 information
        * @param req ab1 data
        * @var dacid decrypted chapter id
        * @var data contains ab1 information
        * @return bool
    */
    public function saveab1($req){

        foreach ($req['yesno'] as $i => $val){
            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'yesno'         => $req['yesno'][$i],
                'comment'       => $req['comment'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
        return true;
      
    }

    
    /**
        ----------------------------------------------------------
        AB3 FUNCTIONS
        ----------------------------------------------------------
        * @method saveab3() save the ab3 information
        * @param req ab3 data
        * @var dacid decrypted chapter id
        * @var data contains ab3 information
        * @return bool
    */
    public function saveab3($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['question'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }
      
    }

    /**
        ----------------------------------------------------------
        AB4 FUNCTIONS
        ----------------------------------------------------------
        * @method saveab4() save the ab4 information
        * @param req ab4 data
        * @var dacid decrypted chapter id
        * @var data contains ab4 information
        * @return bool
    */
    public function saveab4($req){

        foreach($req['yesno'] as $i => $val){
            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'yesno'         => $req['yesno'][$i],
                'comment'       => $req['comment'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
        return true;
      
    }

    /**
        * @method saveab4checklist() save the ab4 information
        * @param req ab4 data
        * @var dacid decrypted chapter id
        * @var data contains ab4 information
        * @return bool
    */
    public function saveab4checklist($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['chlst'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
            return true;
        }else{
            return false;
        }
      
    }

    /**
        ----------------------------------------------------------
        AB4a,b,c,d,e,f,g,h FUNCTIONS
        ----------------------------------------------------------
        * @method saveab4csaveab4ahecklist() save the ab4a information
        * @param req ab4a data
        * @var dacid decrypted chapter id
        * @var data contains ab4a information
        * @return bool
    */
    public function saveab4a($req){

        foreach($req['yesno'] as $i => $val){
            $dacid = $this->crypt->decrypt($req['acid'][$i]);
            $data = [
                'yesno'         => $req['yesno'][$i],
                'comment'       => $req['comment'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc3)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a file {$req['code']} Chapter 3 on work paper");
        return true;
      
    }


}