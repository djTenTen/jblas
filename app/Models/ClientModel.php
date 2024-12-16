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
    protected $tblc1d   = "tbl_dclient_c1";
    protected $tblc2d   = "tbl_dclient_c2";
    protected $tblc3d   = "tbl_dclient_c3";

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
        where c1t.mtID = cd1t.mtID
        and cd1t.cID = {$cID}");
        $query2 = $this->db->query("select DISTINCT title,c2t.code
        from {$this->tblc2t} as c2t, {$this->tblc2d} as cd2t
        where c2t.mtID = cd2t.mtID
        and cd2t.cID = {$cID}");
        $query3 = $this->db->query("select DISTINCT title,c3t.code
        from {$this->tblc3t} as c3t, {$this->tblc3d} as cd3t
        where c3t.mtID = cd3t.mtID
        and cd3t.cID = {$cID}");
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

        $query = $this->db->query("select *, if((select count(DISTINCT mtID) from {$this->tblc1d} as dc where dc.cID = 2 and c1t.mtID = dc.mtID) > 0, 'Yes', 'No') as yn from {$this->tblc1t} as c1t where c1t.status = 'Active'");
        return $query->getResultArray();

    }

    /**
        * @method getc2() get the chapter 2 files not yet assigned to client
        * @param cID client id
        * @var query contains database result query
        * @return result-array
    */
    public function getc2($cID){

        $query = $this->db->query("select *, if((select count(DISTINCT mtID) from {$this->tblc2d} as dc where dc.cID = 2 and c1t.mtID = dc.mtID) > 0, 'Yes', 'No') as yn from {$this->tblc2t} as c1t where c1t.status = 'Active'");
        return $query->getResultArray();

    }

    /**
        * @method getc3() get the chapter 3 files not yet assigned to client
        * @param cID client id
        * @var query contains database result query
        * @return result-array
    */
    public function getc3($cID){

        $query = $this->db->query("select *, if((select count(DISTINCT mtID) from {$this->tblc3d} as dc where dc.cID = 2 and c1t.mtID = dc.mtID) > 0, 'Yes', 'No') as yn from {$this->tblc3t} as c1t where c1t.status = 'Active'");
        return $query->getResultArray();

    }

    /**
        * @method getc1values() get the chapter 1 assigned file to client
        * @param cID client id
        * @var query contains database result query
        * @return result-array
    */

    public function getchaptervalues($c,$cID){

        switch ($c) {
            case 'c1':
                $tablet = $this->tblc1t;
                $tabled = $this->tblc1d;
            break;
            case 'c2':
                $tablet = $this->tblc2t;
                $tabled = $this->tblc2d;
            break;
            case 'c3':
                $tablet = $this->tblc3t;
                $tabled = $this->tblc3d;
            break;
            
        }

        $query = $this->db->query("select DISTINCT title,ct.code,ct.mtID
        from {$tablet} as ct, {$tabled} as cd
        where ct.mtID = cd.mtID
        and cd.cID = {$cID}
        order by ct.mtID asc");
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
                $clID = $this->db->insertID();
                $c1 = $this->db->table($this->tblc1)->get();
                foreach($c1->getResultArray() as $r){
                    $datac1 = [
                        'fID'       => $req['fID'],
                        'cID'       => $clID,
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
                        'status'    => $r['status'],
                        'remarks'   => $r['remarks'],
                        'added_on'  => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc1d)->insert($datac1);
                }
                $c2 = $this->db->table($this->tblc2)->get();
                foreach($c2->getResultArray() as $r){
                    $datac2 = [
                        'fID'       => $req['fID'],
                        'cID'       => $clID,
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
                        'status'    => $r['status'],
                        'remarks'   => $r['remarks'],
                        'added_on'  => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc2d)->insert($datac2);
                }
                $c3 = $this->db->table($this->tblc2)->get();
                foreach($c3->getResultArray() as $r){
                    $datac3 = [
                        'fID'       => $req['fID'],
                        'cID'       => $clID,
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
                        'status'    => $r['status'],
                        'remarks'   => $r['remarks'],
                        'added_on'          => $this->date.' '.$this->time
                    ];
                    $this->db->table($this->tblc3d)->insert($datac3);
                }
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
                $check = $this->db->table($this->tblc1d)->where(array('mtID' => $req['mtID'], 'cID' => $req['cID']))->get()->getNumRows();
                if($check == 0){
                    $sc1 = $this->db->table($this->tblc1)->where(array('mtID' => $req['mtID']))->get();
                    foreach($sc1->getResultArray() as $r){
                        $datac1 = [
                            'fID'       => $req['fID'],
                            'cID'       => $req['cID'],
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
                            'status'    => $r['status'],
                            'remarks'   => $r['remarks'],
                            'added_on'  => $this->date.' '.$this->time
                        ];
                        $this->db->table($this->tblc1d)->insert($datac1);
                    }
                    return 'updated c1';
                }
            break;

            case 'c2':
                $check = $this->db->table($this->tblc2d)->where(array('mtID' => $req['mtID'], 'cID' => $req['cID']))->get()->getNumRows();
                if($check == 0){
                    $sc2 = $this->db->table($this->tblc2)->where(array('mtID' => $req['mtID']))->get();
                    foreach($sc2->getResultArray() as $r){
                        $datac2 = [
                            'fID'       => $req['fID'],
                            'cID'       => $req['cID'],
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
                            'status'    => $r['status'],
                            'remarks'   => $r['remarks'],
                            'added_on'          => $this->date.' '.$this->time
                        ];
                        $this->db->table($this->tblc2d)->insert($datac2);
                    }
                    return 'updated c2';
                }
            break;

            case 'c3':
                $check = $this->db->table($this->tblc3d)->where(array('mtID' => $req['mtID'], 'cID' => $req['cID']))->get()->getNumRows();
                if($check == 0){
                    $sc3 = $this->db->table($this->tblc3)->where(array('mtID' => $req['mtID']))->get();
                    foreach($sc3->getResultArray() as $r){
                        $datac3 = [
                            'fID'       => $req['fID'],
                            'cID'       => $req['cID'],
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
                            'status'    => $r['status'],
                            'remarks'   => $r['remarks'],
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

        $where = [
            'mtID'  => $req['mtID'], 
            'cID'   => $req['cID'],
            'fID'   => $req['fID']
        ];
        switch ($req['cval']) {
            case 'c1':
                $this->db->table($this->tblc1d)->where($where)->delete();
                return 'removed c1';
            break;
            case 'c2':
                $this->db->table($this->tblc2d)->where($where)->delete();
                return 'removed c2';
            break;
            case 'c3':
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
