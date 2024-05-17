<?php
namespace App\Models;
use CodeIgniter\Model;

class ClientModel extends Model{
   

    protected $tblc     = "tbl_clients";
    protected $tblf     = "tbl_firm";
    protected $tblc1t   = "tbl_c1_titles";
    protected $tblc2t   = "tbl_c2_titles";
    protected $tblc3t   = "tbl_c3_titles";
    protected $tblc1    = "tbl_c1";
    protected $tblc2    = "tbl_c2";
    protected $tblc3    = "tbl_c3";
    protected $tblc1d   = "tbl_client_dfiles_c1";
    protected $tblc2d   = "tbl_client_dfiles_c2";
    protected $tblc3d   = "tbl_client_dfiles_c3";
    protected $time,$date;
    protected $crypt;

    public function __construct(){

        $this->db       = \Config\Database::connect('default'); 
        $this->crypt    = \Config\Services::encrypter();
        date_default_timezone_set("Asia/Singapore"); 
        $this->time     = date("H:i:s");
        $this->date     = date("Y-m-d");

    }

    public function editclient($cID){

        $query = $this->db->table($this->tblc)->where('cID', $cID)->get();
        return json_encode($query->getRowArray());

    }

    public function getdefaultfiles($cID){

        $query1 = $this->db->query("select DISTINCT title,c1t.code
        from {$this->tblc1t} as c1t, {$this->tblc1d} as cd1t
        where c1t.c1titleID = cd1t.c1tID
        and cd1t.clientID = {$cID}");
        $query2 = $this->db->query("select DISTINCT title,c2t.code
        from {$this->tblc2t} as c2t, {$this->tblc2d} as cd2t
        where c2t.c2titleID = cd2t.c2tID
        and cd2t.clientID = {$cID}");
        $query3 = $this->db->query("select DISTINCT title,c3t.code
        from {$this->tblc3t} as c3t, {$this->tblc3d} as cd3t
        where c3t.c3titleID = cd3t.c3tID
        and cd3t.clientID = {$cID}");
        $data = [
            'c1'    => json_encode($query1->getResultArray()),
            'c2'    => json_encode($query2->getResultArray()),
            'c3'    => json_encode($query3->getResultArray()),
        ];
        return json_encode($data);

    }

    public function getclients($fID){

        $query = $this->db->query("select *, tc.status
        from {$this->tblc} as tc, {$this->tblf} as tf
        where tc.fID = tf.firmID
        and tc.fID = {$fID}");
        return $query->getResultArray();

    }

    public function getc1(){

        $query = $this->db->table($this->tblc1t)->get();
        return $query->getResultArray();

    }

    public function getc2(){

        $query = $this->db->table($this->tblc2t)->get();
        return $query->getResultArray();

    }

    public function getc3(){

        $query = $this->db->table($this->tblc3t)->get();
        return $query->getResultArray();

    }

    public function getc1values($cID){

        $query = $this->db->query("select DISTINCT title,c1t.code,c1titleID
        from {$this->tblc1t} as c1t, {$this->tblc1d} as cd1t
        where c1t.c1titleID = cd1t.c1tID
        and cd1t.clientID = {$cID}");
        return $query->getResultArray();

    }

    public function getc2values($cID){

        $query = $this->db->query("select DISTINCT title,c2t.code,c2titleID
        from {$this->tblc2t} as c2t, {$this->tblc2d} as cd2t
        where c2t.c2titleID = cd2t.c2tID
        and cd2t.clientID = {$cID}");
        return $query->getResultArray();

    }

    public function getc3values($cID){

        $query = $this->db->query("select DISTINCT title,c3t.code,c3titleID
        from {$this->tblc3t} as c3t, {$this->tblc3d} as cd3t
        where c3t.c3titleID = cd3t.c3tID
        and cd3t.clientID = {$cID}");
        return $query->getResultArray();

    }

    public function saveclient($req){

        $res1 = $this->db->table($this->tblc)->where('email', $req['email'])->get()->getNumRows();
        $res2 = $this->db->table($this->tblc)->where('name', $req['name'])->get()->getNumRows();
        if($res1 >= 1 or $res2 >= 1){
            return 'exist';
        }else{
            $data = [
                'name'          => ucfirst($req['name']),
                'org'           => ucfirst($req['org']),
                'orgtype'       => $req['orgtype'],
                'email'         => $req['email'],
                'contact'       => $req['contact'],
                'address'       => $req['address'],
                'industry'      => $req['industry'],
                'fID'           => $req['fID'],
                'status'        => 'Active',
                'added_on'      => $this->date.' '.$this->time,
            ];
            if($this->db->table($this->tblc)->insert($data)){
                return 'registered';
            }else{
                return 'failed';
            }
        }

    }

    public function updateclient($req){

        $data = [
            'name'          => ucfirst($req['name']),
            'org'           => ucfirst($req['org']),
            'orgtype'       => $req['orgtype'],
            'email'         => $req['email'],
            'contact'       => $req['contact'],
            'address'       => $req['address'],
            'industry'      => $req['industry'],
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc)->where('cID', $req['cID'])->update($data)){
            return 'updated';
        }else{
            return 'failed';
        }

    }

    public function setfiles($req){

        if(!empty($req['c1'] )){
            foreach($req['c1'] as $i => $val){
                $check = $this->db->table($this->tblc1d)->where(array('c1tID' => $this->crypt->decrypt($val), 'clientID' => $req['clientID']))->get()->getNumRows();
                if($check >= 1){
                    continue;
                }
                $sc1 = $this->db->table($this->tblc1)->where(array('c1tID' => $this->crypt->decrypt($val)))->get();
                foreach($sc1->getResultArray() as $r){
                    $datac1 = [
                        'firmID'            => $req['firmID'],
                        'clientID'          => $req['clientID'],
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
                        'status'            => $r['status'],
                        'remarks'           => $r['remarks'],
                        'added_on'          => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc1d)->insert($datac1);
                }
            }
        }
        if(!empty($req['c2'] )){
            foreach($req['c2'] as $i => $val){
                $check = $this->db->table($this->tblc2d)->where(array('c2tID' => $this->crypt->decrypt($val), 'clientID' => $req['clientID']))->get()->getNumRows();
                if($check >= 1){
                    continue;
                }
                $sc2 = $this->db->table($this->tblc2)->where(array('c2tID' => $this->crypt->decrypt($val)))->get();
                foreach($sc2->getResultArray() as $r){
                    $datac2 = [
                        'firmID'            => $req['firmID'],
                        'clientID'          => $req['clientID'],
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
                        'status'            => $r['status'],
                        'remarks'           => $r['remarks'],
                        'added_on'          => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc2d)->insert($datac2);
                }
            }
        }
        if(!empty($req['c3'] )){
            foreach($req['c3'] as $i => $val){
                $check = $this->db->table($this->tblc3d)->where(array('c3tID' => $this->crypt->decrypt($val), 'clientID' => $req['clientID']))->get()->getNumRows();
                if($check >= 1){
                    continue;
                }
                $sc3 = $this->db->table($this->tblc3)->where(array('c3tID' => $this->crypt->decrypt($val)))->get();
                foreach($sc3->getResultArray() as $r){
                    $datac3 = [
                        'firmID'            => $req['firmID'],
                        'clientID'          => $req['clientID'],
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
                        'status'            => $r['status'],
                        'remarks'           => $r['remarks'],
                        'added_on'          => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc3d)->insert($datac3);
                }
            }
        }
        return 'files_added';

    }

    public function acin($dcID){

        $query = $this->db->table($this->tblc)->where('cID', $dcID)->get();
        $r = $query->getRowArray();
        $stat = '';
        if($r['status'] == 'Active'){
            $stat = 'Inactive';
        }else{
            $stat = 'Active';
        }
        $data = [
            'status' => $stat,
            'updated_on' => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc)->where('cID', $dcID)->update($data)){
            return true;
        }else{
            return false;
        }

    }


}
