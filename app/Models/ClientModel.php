<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class ClientModel extends Model{
   

    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR CLIENT MANAGEMENT
        Properties being used on this file
        * @property tblc table of clients
        * @property tblf table of firms
        * @property tblc1t table of chapter 1 titles
        * @property tblc2t table of chapter 2 titles
        * @property tblc3t table of chapter 3 titles
        * @property tblc1 table of chapter 1
        * @property tblc2 table of chapter 2
        * @property tblc3 table of chapter 3
        * @property tblc1d table of client files chapter 1
        * @property tblc2d table of client files chapter 2
        * @property tblc3d table of client files chapter 3
        * @property time-date to load the date and time
        * @property db to load the data base
        * @property crypt to load the encryption file
        * @property logs to load the logs libraries for user activity logs
    */
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
        * @method editclient() get all the auditors
        * @param cID client id
        * @var query contains database result query
        * @return json
    */
    public function editclient($cID){

        $query = $this->db->table($this->tblc)->where('cID', $cID)->get();
        return json_encode($query->getRowArray());

    }

    /**
        * @method getdefaultfiles() get all the selected files
        * @param cID client id
        * @var query1-query2-query3 contains database result query
        * @var data contains all the query result
        * @return json
    */
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

    /**
        * @method getclients() get all client information 
        * @param fID firm id
        * @var query contains database result query
        * @return result-array
    */
    public function getclients($fID){

        $query = $this->db->query("select *, tc.status
        from {$this->tblc} as tc, {$this->tblf} as tf
        where tc.fID = tf.firmID
        and tc.fID = {$fID}");
        return $query->getResultArray();

    }

    /**
        * @method getc1() get the chapter 1 files not yet assigned to client
        * @param cID client id
        * @var query contains database result query
        * @return result-array
    */
    public function getc1($cID){

        $query = $this->db->query("select *, if((select count(DISTINCT c1tID) from {$this->tblc1d} as c1tcd where clientID = {$cID} and c1t.c1titleID = c1tcd.c1tID) > 0, 'Yes', 'No') as yn from {$this->tblc1t} as c1t");
        return $query->getResultArray();

    }

    /**
        * @method getc2() get the chapter 2 files not yet assigned to client
        * @param cID client id
        * @var query contains database result query
        * @return result-array
    */
    public function getc2($cID){

        $query = $this->db->query("select *, if((select count(DISTINCT c2tID) from {$this->tblc2d} as c2tcd where clientID = {$cID} and c2t.c2titleID = c2tcd.c2tID) > 0, 'Yes', 'No') as yn from {$this->tblc2t} as c2t");
        return $query->getResultArray();

    }

    /**
        * @method getc3() get the chapter 3 files not yet assigned to client
        * @param cID client id
        * @var query contains database result query
        * @return result-array
    */
    public function getc3($cID){

        $query = $this->db->query("select *, if((select count(DISTINCT c3tID) from {$this->tblc3d} as c3tcd where clientID = {$cID} and c3t.c3titleID = c3tcd.c3tID) > 0, 'Yes', 'No') as yn from {$this->tblc3t} as c3t");
        return $query->getResultArray();

    }

    /**
        * @method getc1values() get the chapter 1 assigned file to client
        * @param cID client id
        * @var query contains database result query
        * @return result-array
    */
    public function getc1values($cID){

        $query = $this->db->query("select DISTINCT title,c1t.code,c1titleID
        from {$this->tblc1t} as c1t, {$this->tblc1d} as cd1t
        where c1t.c1titleID = cd1t.c1tID
        and cd1t.clientID = {$cID}");
        return $query->getResultArray();

    }

    /**
        * @method getc2values() get the chapter 2 assigned file to client
        * @param cID client id
        * @var query contains database result query
        * @return result-array
    */
    public function getc2values($cID){

        $query = $this->db->query("select DISTINCT title,c2t.code,c2titleID
        from {$this->tblc2t} as c2t, {$this->tblc2d} as cd2t
        where c2t.c2titleID = cd2t.c2tID
        and cd2t.clientID = {$cID}");
        return $query->getResultArray();

    }

    /**
        * @method getc2values() get the chapter 3 assigned file to client
        * @param cID client id
        * @var query contains database result query
        * @return result-array
    */
    public function getc3values($cID){

        $query = $this->db->query("select DISTINCT title,c3t.code,c3titleID
        from {$this->tblc3t} as c3t, {$this->tblc3d} as cd3t
        where c3t.c3titleID = cd3t.c3tID
        and cd3t.clientID = {$cID}");
        return $query->getResultArray();

    }

    /**
        * @method saveclient() save the client information to database
        * @param req client data
        * @var res1 result check if email exist
        * @var res2 result check if name exist
        * @var data contains client information
        * @return exist-registered-failed
    */
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
                $this->logs->log(session()->get('name'). " added a client ".$req['name'].'-'.$req['org']);
                return 'registered';
            }else{
                return 'failed';
            }
        }

    }

    /**
        * @method updateclient() update the client information to database
        * @param req client data
        * @var data contains client information
        * @return updated-failed
    */
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
            $this->logs->log(session()->get('name'). " updated the client ".$req['name'].'-'.$req['org']." information");
            return 'updated';
        }else{
            return 'failed';
        }

    }


    /**
        * @method setfiles() set the files on the client
        * @param req files data
        * @var check check if files are already exist
        * @var sc1-sc2-sc3 result from the system files
        * @var datac1 contains chapter 1 informations
        * @var datac2 contains chapter 2 informations
        * @var datac3 contains chapter 3 informations
        * @return files_added
    */
    public function setfiles($req){

        switch ($req['cval']) {
            case 'c1':
                $check = $this->db->table($this->tblc1d)->where(array('c1tID' => $req['ctID'], 'clientID' => $req['clientID']))->get()->getNumRows();
                if($check == 0){
                    $sc1 = $this->db->table($this->tblc1)->where(array('c1tID' => $req['ctID']))->get();
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
                    return 'updated c1';
                }
            break;

            case 'c2':
                $check = $this->db->table($this->tblc2d)->where(array('c2tID' => $req['ctID'], 'clientID' => $req['clientID']))->get()->getNumRows();
                if($check == 0){
                    $sc2 = $this->db->table($this->tblc2)->where(array('c2tID' => $req['ctID']))->get();
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
                    return 'updated c2';
                }
            break;

            case 'c3':
                $check = $this->db->table($this->tblc3d)->where(array('c3tID' => $req['ctID'], 'clientID' => $req['clientID']))->get()->getNumRows();
                if($check == 0){
                    $sc3 = $this->db->table($this->tblc3)->where(array('c3tID' => $req['ctID']))->get();
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
                    return 'updated c3';
                }
            break;
        }

    }

    /**
        * @method removefiles() remove the files from the client
        * @param req files data
        * @var check check if files are already exist
        * @var sc1-sc2-sc3 result from the system files
        * @var datac1 contains chapter 1 informations
        * @var datac2 contains chapter 2 informations
        * @var datac3 contains chapter 3 informations
        * @return files_added
    */
    public function removefiles($req){

        switch ($req['cval']) {
            case 'c1':
                $where = [
                    'c1tID' => $req['ctID'], 
                    'clientID' => $req['clientID'],
                    'firmID' => $req['firmID']
                ];
                $this->db->table($this->tblc1d)->where($where)->delete();
                return 'removed c1';
            break;

            case 'c2':
                $where = [
                    'c2tID' => $req['ctID'], 
                    'clientID' => $req['clientID'],
                    'firmID' => $req['firmID']
                ];
                $this->db->table($this->tblc2d)->where($where)->delete();
                return 'removed c2';
            break;

            case 'c3':
                $where = [
                    'c3tID' => $req['ctID'], 
                    'clientID' => $req['clientID'],
                    'firmID' => $req['firmID']
                ];
                $this->db->table($this->tblc3d)->where($where)->delete();
                return 'removed c3';
            break;
        }

    }


    /**
        * @method acin() set the client information to active and inactive
        * @param dcID decrypted client id
        * @var query result from database
        * @var r result from database as row array
        * @var stat set the status
        * @param duID user id
        * @var array-data contains auditor information going to save to database
        * @return bool
    */
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
            $this->logs->log(session()->get('name'). " Set the information of ".$r['name']." to ".$stat);
            return true;
        }else{
            return false;
        }

    }


}
