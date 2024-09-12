<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class ChapterValuesModel extends Model{


    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR CHAPTER 2 FILE MANAGEMENT
        Properties being used on this file
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
        ----------------------------------------------------------
        CHAPTER GET FUNCTIONS
        ----------------------------------------------------------
    */
    public function getvalues_m($c,$type,$code,$ctID,$cID){

        switch ($c) {
            case 'c1': $table = $this->tblc1d; $cd = 'c1tID'; break;
            case 'c2': $table = $this->tblc2d; $cd = 'c2tID'; break;
            case 'c3': $table = $this->tblc3d; $cd = 'c3tID'; break;
        }
        $where = [
            'code'          => $code, 
            'type'          => $type,
            $cd             => $ctID,
            'clientID'      => $cID,
        ];
        $query =  $this->db->table($table)->where($where)->get();
        return $query->getResultArray();

    }

    public function getvalues_s($c,$type,$code,$ctID,$cID){

        switch ($c) {
            case 'c1': $table = $this->tblc1d; $cd = 'c1tID'; break;
            case 'c2': $table = $this->tblc2d; $cd = 'c2tID'; break;
            case 'c3': $table = $this->tblc3d; $cd = 'c3tID'; break;
        }
        $where = [
            'code'          => $code, 
            'type'          => $type,
            $cd             => $ctID,
            'clientID'      => $cID,
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
    public function getac10data($part,$code,$c1tID,$cID,$section){

        $where = [
            'type' => $part,
            'code' => $code,
            'c1tID' => $c1tID,
            'clientID'  => $cID,
            'question' => $section,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getdatacount() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var query result from database
        * @return integer
    */
    public function getdatacount($c1tID,$part,$cID){

        $query = $this->db->table($this->tblc1d)->where(array('type' => $part, 'code' => 'ac10', 'c1tID' => $c1tID, 'clientID'  => $cID));
        return $query->countAllResults();

    }

    /**
        * @method getsumation() Count/Compute the balances
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var total result from database
        * @return integer
    */
    public function getsumation($c1tID,$part,$cID){

        $total = $this->db->table($this->tblc1d)->selectSum('balance')->where(array('type' => $part, 'code' => 'ac10', 'c1tID' => $c1tID, 'clientID'  => $cID))->get()->getRowArray();
        $cu = $this->db->table($this->tblc1d)->where(array('type' => $part.'cu', 'code' => 'ac10', 'c1tID' => $c1tID))->get()->getRowArray();
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
                                        'updated_by'        => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                                }
                            break;
                            case 'saveac1eqr':
                                $acid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $req['uID'],
                                ];
                                $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
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
                                        'updated_by'        => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                                }
                            break;
                            case 'saveac2aep':
                                $acid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['eap'],
                                    'name'          => $req['concl'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $req['uID'],
                                ];
                                $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
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
                                        'updated_by'    => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
                        return true;
                    break;
                    case 'AC4':
                        switch ($param['save']) {
                            case 'saveac3':
                                foreach($req['comment'] as $i => $val){
                                    $acid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'comment'       => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                                }
                            break;
                            case 'saveac4ppr':
                                $acid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['ppr'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $req['uID'],
                                ];
                                $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
                        return true;
                    break;
                    case 'AC5':
                        switch ($param['save']) {
                            case 'saveac5':
                                $acid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['rescon'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $req['uID'],
                                ];
                                $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
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
                                        'updated_by'        => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                                }
                            break;
                            case 'saveac6s12':
                                $acid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['section'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $req['uID'],
                                ];
                                $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                            break;
                            case 'saveac6s3':
                                $where = [
                                    'type'          => $req['part'], 
                                    'code'          => $req['code'], 
                                    'c1tID'         => $req['c1tID'],
                                    'clientID'      => $req['cID'],
                                ];
                                $this->db->table($this->tblc1d)->where($where)->delete();
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
                                        'firmID'            => $req['fID'],
                                        'clientID'          => $req['cID'],
                                        'type'              => $req['part'],
                                        'status'            => 'Active',
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc1d)->insert($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
                        return true;
                    break;
                    case 'AC7':
                        switch ($param['save']) {
                            case 'saveac7':
                                $data = [
                                    'question'      => $req['genyn'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $req['uID'],
                                ];
                                $where = [
                                    'type'          => $req['part'],
                                    'c1tID'         => $req['c1tID'],
                                    'clientID'      => $req['cID'],
                                ];
                                $this->db->table($this->tblc1d)->where($where)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
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
                                        'updated_by'        => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc1d)->where('acID', $dacid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
                        return true;
                    break;
                    case 'AC9':
                        switch ($param['save']) {
                            case 'saveac9':
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['ac9'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $req['uID'],
                                ];
                                $this->db->table($this->tblc1d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
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
                                        'updated_by'    => $req['uID'],
                                    ];
                                    $where1 = [
                                        'type'          => $r.'data',
                                        'code'          => $req['code'],
                                        'c1tID'         => $req['c1tID'],
                                        'clientID'      => $req['cID'],
                                    ];
                                    $this->db->table($this->tblc1d)->where($where1)->update($data);
                                }
                                $where2 = [
                                    'type'          => 'materialdata',
                                    'code'          => $req['code'],
                                    'c1tID'         => $req['c1tID'],
                                    'clientID'      => $req['cID'],
                                ];
                                $this->db->table($this->tblc1d)->where($where2)->update(array('question' => $req['materiality']));
                            break;
                            case 'saveac10s1':
                                $where = [
                                    'type'          => $req['type'], 
                                    'code'          => $req['code'],
                                    'question'      => 'section1',
                                    'c1tID'         => $req['c1tID'],
                                    'clientID'      => $req['cID'],
                                ];
                                $this->db->table($this->tblc1d)->where($where)->delete();
                                foreach($req['name'] as $i => $val){
                                    $data = [
                                        'less'          => $req['less'][$i],
                                        'name'          => $req['name'][$i],
                                        'balance'       => $req['balance'][$i],
                                        'type'          => $req['type'],
                                        'code'          => $req['code'],
                                        'c1tID'         => $req['c1tID'],
                                        'clientID'      => $req['cID'],
                                        'firmID'        => $req['fID'],
                                        'question'      => 'section1',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc1d)->insert($data);
                                }
                            break;
                            case 'saveac10s2':
                                $where = [
                                    'type'          => $req['type'], 
                                    'code'          => $req['code'],
                                    'question'      => 'section2',
                                    'c1tID'         => $req['c1tID'],
                                    'clientID'      => $req['cID'],
                                ];
                                $this->db->table($this->tblc1d)->where($where)->delete();
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
                                        'firmID'        => $req['fID'],
                                        'question'      => 'section2',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc1d)->insert($data);
                                }
                            break;
                            case 'saveac10cu':
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $req['uID'],
                                ];
                                $this->db->table($this->tblc1d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
                        return true;
                    break;
                    case 'AC11':
                        switch ($param['save']) {
                            case 'saveac11':
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['ac11'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $req['uID'],
                                ];
                                $this->db->table($this->tblc1d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
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
                                        'updated_by'    => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc2d)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'aicpppa':
                                foreach($req['comment'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'reference'     => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc2d)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'rcicp':
                                foreach($req['extent'] as $i => $val){
                                    $dacid = $this->crypt->decrypt($req['acid'][$i]);
                                    $data = [
                                        'extent'        => $req['extent'][$i],
                                        'reference'     => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $req['uID'],
                                    ];
                                    $this->db->table($this->tblc2d)->where('acID', $dacid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 1");
                        return true;
                    break;
                }
            break;

            case 'c3':
                switch ($code) {
                    case '' :
                        switch ($save) {
                            case '' :
                            
                            break;
                        }
                    break;
                }
            break;
        }

    }

























    /**
        ----------------------------------------------------------
        CHAPTER 3 POST FUNCTIONS
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
            $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
            return true;
        }else{
            return false;
        }

    }


    /**
        * @method saverceap() save the aa1 information
        * @param req aa1 data
        * @var data contains aa1 information
        * @return bool
    */
    public function saverceap($req){

        $dacid = $this->crypt->decrypt($req['acid']);
        $data = [
            'question'      => $req['question'],
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
                'reference'         => $req['comment'][$i],
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
            $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
            'question'      => $req['air'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
            $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
            'clientID'      => $req['cID']
        ];
        $data = [
            'question'      => $req['aa4'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'        => $req['uID'],
        ];
        if($this->db->table($this->tblc3d)->where($where)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
            return true;
        }else{
            return false;
        }

    }

    public function saveaa5a($req){

        $where = [
            'type'          => $req['part'],
            'code'          => $req['code'],
            'c3tID'         => $req['c3tID'],
            'clientID'      => $req['cID'],
            'firmID'        => $req['fID'],
        ];
        $data = [
            'question'      => $req['aa5a'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3d)->where($where)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
            'clientID'      => $req['cID']
        ];
        $this->db->table($this->tblc3d)->where($where)->delete();
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
                'clientID'          => $req['cID'],
                'firmID'            => $req['fID'],
                'status'            => 'Active',
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc3d)->insert($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        ];
        $this->db->table($this->tblc3d)->where($where)->delete();
        foreach($req['reference'] as $i => $val){
            $data = [
                'reference'         => $req['reference'][$i],
                'issue'             => $req['issue'][$i],
                'comment'           => $req['comment'][$i],
                'recommendation'    => $req['recommendation'][$i],
                'result'            => $req['result'][$i],
                'type'              =>  $req['part'],
                'code'              =>  $req['code'],
                'c3tID'             => $req['c3tID'],
                'clientID'          => $req['cID'],
                'firmID'            => $req['fID'],
                'status'            => 'Active',
                'updated_on'        => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc3d)->insert($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        ];
        $this->db->table($this->tblc3d)->where($where)->delete();
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
                'firmID'            => $req['fID'],
                'status'            => 'Active',
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc3d)->insert($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        $this->db->table($this->tblc3d)->where($where)->delete();
        foreach($req['reference'] as $i => $val){
            $data = [
                'reference'     => $req['reference'][$i],
                'initials'      => $req['desc'][$i],
                'drps'          => $req['drps'][$i],
                'crps'          => $req['crps'][$i],
                'drfp'          => $req['drfp'][$i],
                'crfp'          => $req['crfp'][$i],
                'type'          =>  $req['part'],
                'code'          =>  $req['code'],
                'c3tID'         => $req['c3tID'],
                'clientID'      => $req['cID'],
                'firmID'        => $req['fID'],
                'status'        => 'Active',
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc3d)->insert($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
            return true;
        }else{
            return false;
        }

    }


    /**
        ----------------------------------------------------------
        311 FUNCTIONS
        ----------------------------------------------------------
    */
    public function save311($req){

        $where = [
            'type'      => '311',
            'code'      => $req['code'],
            'c3tID'     => $req['c3tID'],
            'clientID'  => $req['cID'],
        ];
        $data = [
            'question'      => $req['arf'],
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'    => $req['uID'],
        ];
        if($this->db->table($this->tblc3d)->where($where)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
            $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
            $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
        if($this->db->table($this->tblc3d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
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
                'yesno'             => $req['yesno'][$i],
                'comment'           => $req['comment'][$i],
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 3");
        return true;
      
    }


}