<?php
namespace App\Models;
use CodeIgniter\Model;

class WorkpaperModel extends  Model {

    protected $tblu = "tbl_users";
    protected $tblwp = "tbl_workpaper";
    protected $tblc = "tbl_clients";

    protected $tblc1d = "tbl_client_dfiles_c1";
    protected $tblc2d = "tbl_client_dfiles_c2";
    protected $tblc3d = "tbl_client_dfiles_c3";

    protected $tblc1 = "tbl_client_files_c1";
    protected $tblc2 = "tbl_client_files_c2";
    protected $tblc3 = "tbl_client_files_c3";

    
    protected $time,$date;

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s");
        $this->date = date("Y-m-d");

    }

    public function getauditors($firmID,$type){

        $where = [
            'firm' => $firmID,
            'type' => $type,
            'status' => 'Active',
            'verified' => 'Yes',
        ];
        $query = $this->db->table($this->tblu)->where($where)->get();
        return $query->getResultArray();


    }

    public function getprogress($wpID,$cID){

        $c1count = $this->db->table($this->tblc1)->where(array('workpaper' => $wpID, 'clientID' => $cID))->countAllResults();
        $c2count = $this->db->table($this->tblc2)->where(array('workpaper' => $wpID, 'clientID' => $cID))->countAllResults();
        $c3count = $this->db->table($this->tblc3)->where(array('workpaper' => $wpID, 'clientID' => $cID))->countAllResults();
        $x = $c1count + $c2count + $c3count;
        $c1 = $this->db->table($this->tblc1)->where('workpaper',$wpID)->where('clientID',$cID)->where('updated_on IS NOT NULL')->countAllResults();
        $c2 = $this->db->table($this->tblc2)->where('workpaper',$wpID)->where('clientID',$cID)->where('updated_on IS NOT NULL')->countAllResults();
        $c3 = $this->db->table($this->tblc3)->where('workpaper',$wpID)->where('clientID',$cID)->where('updated_on IS NOT NULL')->countAllResults();
        $y = $c1 + $c2 + $c3;

        $p = $y / $x;
        $progress = round($p, 2) * 100;
        return $progress;

       
        
    }

    public function getworkpaper($fID){

        $query = $this->db->query("select wpID,wp.added_by,wp.client, wp.auditor, wp.supervisor,wp.audmanager, wp.firm,wp.jobdur,wp.financial_year,wp.end_financial_year,wp.status,wp.remarks,wp.added_on,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.added_by) as added,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.auditor) as aud,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.supervisor) as sup,
        (select CONCAT(name,' - ',type) from {$this->tblu} as tu where tu.userID = wp.audmanager) as audm,
        tc.name as cli
        from {$this->tblwp} as wp, {$this->tblc} as tc
        where wp.firm = {$fID}
        and tc.cID = wp.client");
        
        return $query->getResultArray();

    }

    public function saveworkpaper($req){

        $where = [
            'client' => $req['client'],
            'financial_year' => $req['fy'],
            'end_financial_year' => $req['efy'],
            'firm' => $req['firm'],
        ];
        $checkexist = $this->db->table($this->tblwp)->where($where)->get()->getNumRows();

        if($checkexist >= 1){

            return 'exist';

        }else{

            $workpaper = [
                'auditor' => $req['auditor'],
                'supervisor' => $req['reviewer'],
                'audmanager' => $req['audmanager'],
                'client' => $req['client'],
                'firm' => $req['firm'],
                'jobdur' => $req['jobdur'],
                'financial_year' => $req['fy'],
                'end_financial_year' => $req['efy'],
                'status' => 'Preparing',
                'Remarks' => 'Not Submitted',
                'added_on'=> $this->date.' '.$this->time,
                'added_by' => $req['uID'],
            ];

            $this->db->table($this->tblwp)->insert($workpaper);
            $wpid = $this->db->insertID();
            
            $wherec1 = [
                'firmID' => $req['firm'],
                'clientID' => $req['client'],
            ];
            $c1df = $this->db->table($this->tblc1d)->where($wherec1)->get();
            if($c1df->getNumRows() >= 1){
                foreach($c1df->getResultArray() as $r){
                    $datac1 = [
                        'firmID' => $req['firm'],
                        'workpaper' => $wpid,
                        'clientID' => $req['client'],
                        'c1tID' => $r['c1tID'],
                        'code' => $r['code'],
                        'type' => $r['type'],
                        'question' => $r['question'],
                        'less' => $r['less'],
                        'name' => $r['name'],
                        'reason' => $r['reason'],
                        'balance' => $r['balance'],
                        'planning' => $r['planning'],
                        'finalization' => $r['finalization'],
                        'reference' => $r['reference'],
                        'reliance' => $r['reliance'],
                        'finstate' => $r['finstate'],
                        'desc' => $r['desc'],
                        'controleffect' => $r['controleffect'],
                        'implemented' => $r['implemented'],
                        'assessed' => $r['assessed'],
                        'yesno' => $r['yesno'],
                        'comment' => $r['comment'],
                        'corptax' => $r['corptax'],
                        'statutory' => $r['statutory'],
                        'accountancy' => $r['accountancy'],
                        'other' => $r['other'],
                        'totalcu' => $r['totalcu'],
                        'status' => $r['status'],
                        'remarks' => $r['remarks'],
                        'added_on' => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc1)->insert($datac1);
                }
            }

            $wherec2 = [
                'firmID' => $req['firm'],
                'clientID' => $req['client'],
            ];
            $c2df = $this->db->table($this->tblc2d)->where($wherec2)->get();
            if($c2df->getNumRows() >= 1){
                foreach($c2df->getResultArray() as $r){
                    $datac2 = [
                        'firmID' => $req['firm'],
                        'workpaper' => $wpid,
                        'clientID' => $req['client'],
                        'c2tID' => $r['c2tID'],
                        'code' => $r['code'],
                        'type' => $r['type'],
                        'question' => $r['question'],
                        'extent' => $r['extent'],
                        'reference' => $r['reference'],
                        'initials' => $r['initials'],
                        'desc' => $r['desc'],
                        'controleffect' => $r['controleffect'],
                        'assessed' => $r['assessed'],
                        'yesno' => $r['yesno'],
                        'comment' => $r['comment'],
                        'corptax' => $r['corptax'],
                        'statutory' => $r['statutory'],
                        'accountancy' => $r['accountancy'],
                        'other' => $r['other'],
                        'totalcu' => $r['totalcu'],
                        'status' => $r['status'],
                        'remarks' => $r['remarks'],
                        'added_on' => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc2)->insert($datac2);
                }
            }
            $wherec3 = [
                'firmID' => $req['firm'],
                'clientID' => $req['client'],
            ];
            $c3df = $this->db->table($this->tblc3d)->where($wherec3)->get();
            if($c3df->getNumRows() >= 1){
                foreach($c3df->getResultArray() as $r){
                    $datac3 = [
                        'firmID' => $req['firm'],
                        'workpaper' => $wpid,
                        'clientID' => $req['client'],
                        'c3tID' => $r['c3tID'],
                        'code' => $r['code'],
                        'type' => $r['type'],
                        'question' => $r['question'],
                        'extent' => $r['extent'],
                        'reference' => $r['reference'],
                        'initials' => $r['initials'],
                        'drps' => $r['drps'],
                        'crps' => $r['crps'],
                        'drfp' => $r['drfp'],
                        'crfp' => $r['crfp'],
                        'issue' => $r['issue'],
                        'recommendation' => $r['recommendation'],
                        'result' => $r['result'],
                        'yesno' => $r['yesno'],
                        'comment' => $r['comment'],
                        'other' => $r['other'],
                        'totalcu' => $r['totalcu'],
                        'status' => $r['status'],
                        'remarks' => $r['remarks'],
                        'added_on' => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc3)->insert($datac3);
                }
            }

            return "added";

        }

    

    }


    


}