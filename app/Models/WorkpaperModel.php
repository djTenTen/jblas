<?php
namespace App\Models;
use CodeIgniter\Model;

class WorkpaperModel extends  Model {


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
    protected $time,$date;
    protected $crypt;

    public function __construct(){

        $this->db       = \Config\Database::connect('default'); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->crypt    = \Config\Services::encrypter();
        $this->time     = date("H:i:s");
        $this->date     = date("Y-m-d");

    }

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

    public function getfileinfoc1($wpID,$cID,$ctID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on
        from {$this->tblc1} as c1 
        where c1.workpaper = {$wpID}
        and c1.clientID = {$cID}
        and c1.c1tID = {$ctID} limit 1");
        return $query->getRowArray();

    }

    public function getfileinfoc2($wpID,$cID,$ctID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on 
        from {$this->tblc2} as c2 
        where c2.workpaper = {$wpID}
        and c2.clientID = {$cID}
        and c2.c2tID = {$ctID} limit 1");
        return $query->getRowArray();

    }

    public function getfileinfoc3($wpID,$cID,$ctID){

        $query = $this->db->query("select distinct prepared_on,reviewed_on,approved_on 
        from {$this->tblc3} as c3 
        where c3.workpaper = {$wpID}
        and c3.clientID = {$cID}
        and c3.c3tID = {$ctID} limit 1");
        return $query->getRowArray();

    }

    public function getfileindex($cID,$wpID,$status){

        //if($status == 'All'){
            $query = $this->db->query("select *
            from {$this->tblcfi} as cfi, {$this->tblfi} as fi
            where cfi.index = fi.fiID
            and cfi.workpaper = {$wpID}
            and cfi.clientID = {$cID}");
        // }else{
        //     $query = $this->db->query("select *
        //     from {$this->tblcfi} as cfi, {$this->tblfi} as fi
        //     where cfi.index = fi.fiID
        //     and cfi.workpaper = {$wpID}
        //     and cfi.clientID = {$cID}
        //     and cfi.status = '{$status}'");
        // }
        return $query->getResultArray();

    }

    public function getc1values($cID,$wpID,$status){

        //if($status == 'All'){
            $query = $this->db->query("select DISTINCT title,c1t.code,c1titleID,c1.remarks,c1.status,
            (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.c1tID = c1.c1tID and {$this->tblc1}.workpaper = {$wpID} and {$this->tblc1}.clientID = {$cID}) as x , 
            (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.c1tID = c1.c1tID and {$this->tblc1}.workpaper = {$wpID} and {$this->tblc1}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
            from {$this->tblc1t} as c1t, {$this->tblc1} as c1
            where c1t.c1titleID = c1.c1tID
            and c1.clientID = {$cID}
            and c1.workpaper = {$wpID}");
        // }else{
        //     $query = $this->db->query("select DISTINCT title,c1t.code,c1titleID,c1.remarks,
        //     (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.c1tID = c1.c1tID and {$this->tblc1}.workpaper = {$wpID} and {$this->tblc1}.clientID = {$cID}) as x , 
        //     (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.c1tID = c1.c1tID and {$this->tblc1}.workpaper = {$wpID} and {$this->tblc1}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
        //     from {$this->tblc1t} as c1t, {$this->tblc1} as c1
        //     where c1t.c1titleID = c1.c1tID
        //     and c1.clientID = {$cID}
        //     and c1.workpaper = {$wpID}
        //     and c1.status = '{$status}'");
        // }
        return $query->getResultArray();

    }

    public function getacc1values($code,$cID,$wpID){

        $query = $this->db->query("select DISTINCT title,c1t.code,c1titleID,c1.remarks,c1.status,
            (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.c1tID = c1.c1tID and {$this->tblc1}.workpaper = {$wpID} and {$this->tblc1}.clientID = {$cID}) as x , 
            (select COUNT(*) from {$this->tblc1} WHERE {$this->tblc1}.c1tID = c1.c1tID and {$this->tblc1}.workpaper = {$wpID} and {$this->tblc1}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
            from {$this->tblc1t} as c1t, {$this->tblc1} as c1
            where c1t.c1titleID = c1.c1tID
            and c1.clientID = {$cID}
            and c1.workpaper = {$wpID}
            and c1.code like '%{$code}%'");
        return $query->getResultArray();

    }

    public function getc2values($cID,$wpID,$status){

        //if($status == 'All'){
            $query = $this->db->query("select DISTINCT title,c2t.code,c2titleID,c2.remarks,c2.status,
            (select COUNT(*) from {$this->tblc2} WHERE {$this->tblc2}.c2tID = c2.c2tID and {$this->tblc2}.workpaper = {$wpID} and {$this->tblc2}.clientID = {$cID}) as x ,
            (select COUNT(*) from {$this->tblc2} WHERE {$this->tblc2}.c2tID = c2.c2tID and {$this->tblc2}.workpaper = {$wpID} and {$this->tblc2}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
            from {$this->tblc2t} as c2t, {$this->tblc2} as c2
            where c2t.c2titleID = c2.c2tID
            and c2.clientID = {$cID}
            and c2.workpaper = {$wpID}");
        // }else{
        //     $query = $this->db->query("select DISTINCT title,c2t.code,c2titleID,c2.remarks,
        //     (select COUNT(*) from {$this->tblc2} WHERE {$this->tblc2}.c2tID = c2.c2tID and {$this->tblc2}.workpaper = {$wpID} and {$this->tblc2}.clientID = {$cID}) as x ,
        //     (select COUNT(*) from {$this->tblc2} WHERE {$this->tblc2}.c2tID = c2.c2tID and {$this->tblc2}.workpaper = {$wpID} and {$this->tblc2}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
        //     from {$this->tblc2t} as c2t, {$this->tblc2} as c2
        //     where c2t.c2titleID = c2.c2tID
        //     and c2.clientID = {$cID}
        //     and c2.workpaper = {$wpID}
        //     and c2.status = '{$status}'");
        // }
        return $query->getResultArray();

    }

    public function getc3values($cID,$wpID,$status){

        //if($status == 'All'){
            $query = $this->db->query("select DISTINCT title,c3t.code,c3titleID,c3.remarks,c3.status,
            (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.c3tID = c3.c3tID and {$this->tblc3}.workpaper = {$wpID} and {$this->tblc3}.clientID = {$cID}) as x ,
            (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.c3tID = c3.c3tID and {$this->tblc3}.workpaper = {$wpID} and {$this->tblc3}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
            from {$this->tblc3t} as c3t, {$this->tblc3} as c3
            where c3t.c3titleID = c3.c3tID
            and c3.clientID = {$cID}
            and c3.workpaper = '{$wpID}'");
        // }else{
        //     $query = $this->db->query("select DISTINCT title,c3t.code,c3titleID,c3.remarks,
        //     (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.c3tID = c3.c3tID and {$this->tblc3}.workpaper = {$wpID} and {$this->tblc3}.clientID = {$cID}) as x ,
        //     (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.c3tID = c3.c3tID and {$this->tblc3}.workpaper = {$wpID} and {$this->tblc3}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
        //     from {$this->tblc3t} as c3t, {$this->tblc3} as c3
        //     where c3t.c3titleID = c3.c3tID
        //     and c3.clientID = {$cID}
        //     and c3.workpaper = {$wpID}
        //     and c3.status = '{$status}'");
        // }
        return $query->getResultArray();

    }

    public function getabc3values($code,$cID,$wpID){

        $query = $this->db->query("select DISTINCT title,c3t.code,c3titleID,c3.remarks,c3.status,
        (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.c3tID = c3.c3tID and {$this->tblc3}.workpaper = {$wpID} and {$this->tblc3}.clientID = {$cID}) as x ,
        (select COUNT(*) from {$this->tblc3} WHERE {$this->tblc3}.c3tID = c3.c3tID and {$this->tblc3}.workpaper = {$wpID} and {$this->tblc3}.clientID = {$cID} and `updated_on` IS NOT NULL) as y
        from {$this->tblc3t} as c3t, {$this->tblc3} as c3
        where c3t.c3titleID = c3.c3tID
        and c3.clientID = {$cID}
        and c3.workpaper = '{$wpID}'
        and c3.code like '%{$code}%'");
        return $query->getResultArray();

    }

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
        and tc.cID = wp.client");
        return $query->getResultArray();

    }

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
        and tc.cID = wp.client");
        return $query->getResultArray();

    }

    public function getlatestupload($cID,$wpID){

        $query = $this->db->query("select DISTINCT cfi.added_on,cfi.added_by,tu.name
        from {$this->tblu} as tu, {$this->tbltb} as cfi
        where tu.userID = cfi.added_by
        and cfi.workpaper = {$wpID}
        and cfi.client = {$cID}");
        return $query->getRowArray();

    }

    public function gettrialbalance($cID,$wpID){

        $query = $this->db->query("select *
        from {$this->tbltb} as cfi, {$this->tblfi} as fi
        where cfi.index = fi.fiID
        and cfi.workpaper = {$wpID}
        and cfi.client = {$cID}");
        return $query->getResultArray();

    }

    public function gettbindex($cID,$wpID,$index){

        $query = $this->db->query("select * 
        from {$this->tbltb} as tb
        where tb.index = {$index}
        and tb.workpaper = {$wpID}
        and tb.client = {$cID}");
        return $query->getResultArray();

    }

    public function getindexfile(){

        $query = $this->db->query("select * 
        from {$this->tblfi} as fi
        where fi.fiID >= 6
        and fi.fiID <= 22");
        return $query->getResultArray();

    }

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
        return 'updated';

    }

    public function uploadtbfiles($req){

        $pdfname = $req['cfiID'].$req['cID'].$req['wpID'].$req['index'].'.pdf';
        if($req['pdf'] != ''){
            $pdfPath = ROOTPATH .'/public/uploads/pdf/'.$pdfname; 
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
            $req['pdf']->move(ROOTPATH .'public/uploads/pdf', $pdfname);
        }
        $data = [
            'file'      => $pdfname,
            'remarks'   => $req['remarks'],
        ];
        if($this->db->table($this->tblcfi)->where('cfiID', $req['cfiID'])->update($data)){
            return 'uploaded';
        }
    
    }

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
            $this->db->table($this->tblc1)->where($refaut)->update(array('question' => $balcu['question'] + ($req['debit'][$i] - $req['credit'][$i])));
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
        return "uploaded";

    }

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
            return "added";
        }

    }

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
            return "sent";
        }else{
            return false;
        }

    }

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
            return "sent";
        }else{
            return false;
        }

    }

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
            return "sent";
        }else{
            return false;
        }

    }

    public function sendtoreviewer($req){

        $data = [
            'remarks'   => $req['remarks'],
            'status'    => 'Reviewing',
        ];
        if($this->db->table($this->tblwp)->where('wpID', $req['wpID'])->update($data)){
            return "sent";
        }else{
            return false;
        }
        
    }

    public function sendtopreparer($req){

        $data = [
            'remarks'   => $req['remarks'],
            'status'    => 'Preparing',
        ];
        if($this->db->table($this->tblwp)->where('wpID', $req['wpID'])->update($data)){
            return "sent";
        }else{
            return false;
        }
        
    }

    public function sendtoapprover($req){

        $data = [
            'remarks'   => $req['remarks'],
            'status'    => 'Checking',
        ];
        if($this->db->table($this->tblwp)->where('wpID', $req['wpID'])->update($data)){
            return "sent";
        }else{
            return false;
        }
        
    }

    /**
        ----------------------------------------------------------
        AC1 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;
      
    }

    public function saveac1eqr($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['question'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $acid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AC2 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;

    }

    public function saveac2aep($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['eap'],
            'name'          => $req['concl'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $acid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AC3 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;

    }

    /**
        ----------------------------------------------------------
        AC4 FUNCTIONS
        ----------------------------------------------------------

        GET FUNCTIONS
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
        POST FUNCTIONS
    */
    public function saveac4ppr($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['ppr'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $acid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

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

        GET FUNCTIONS
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
        POST FUNCTIONS
    */
    public function saveac5($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['rescon'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $acid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AC6 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;

    }

    public function saveac6s12($req){

        $acid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['section'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $acid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

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
        return true;

    }

    /**
        ----------------------------------------------------------
        AC7 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AC8 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;

    }

    /**
        ----------------------------------------------------------
        AC9 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
    */
    public function saveac9($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['ac9'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AC10 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;

    }

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
        return true;

    }

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
        return true;

    }

    public function saveac10cu($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['question'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }
        
    }

     /**
        ----------------------------------------------------------
        AC11 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
    */
    public function saveac11($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['ac11'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        Chapter 2 GET FUNCTIONS
        ----------------------------------------------------------
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
        Chapter 2 POST FUNCTIONS
        ----------------------------------------------------------
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
        return true;

    }

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
        return true;

    }

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
        return true;

    }

    /**
        ----------------------------------------------------------
        CHAPTER 3
        AA1 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;

    }

    public function saveaa1s3($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['question'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AA2 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
    */
    public function saveaa2($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aa2'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AA3a FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;

    }

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
        return true;

    }

    public function saveaa3air($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['ir'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AA3b FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;

    }

    public function saveaa3bp4($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['p4'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AA5b FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
                'type'              =>  $req['part'],
                'code'              =>  $req['code'],
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
        return true;

    }

    /**
        ----------------------------------------------------------
        AA7 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;

    }

    public function saveaa7aepapp($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aep'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    public function saveaa7aep($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aep'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AA10 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
    */
    public function saveaa10($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aa10'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AA11 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
       return true;

    }

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
       return true;

    }
    
    public function saveaa11ue($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aa11'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    public function saveaa11con($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['aa11'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }

    }

    /**
        ----------------------------------------------------------
        AB1 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;
      
    }

    /**
        ----------------------------------------------------------
        AB3 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
    */
    public function saveab3($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['question'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }
      
    }

    /**
        ----------------------------------------------------------
        AB3 FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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
        POST FUNCTIONS
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
        return true;
      
    }

    public function saveab4checklist($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['chlst'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3)->where('acID', $dacid)->update($data)){
            return true;
        }else{
            return false;
        }
      
    }

    /**
        ----------------------------------------------------------
        AB4a FUNCTIONS
        ----------------------------------------------------------
        GET FUNCTIONS
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

    /** 
        POST FUNCTIONS
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
        return true;
      
    }


}