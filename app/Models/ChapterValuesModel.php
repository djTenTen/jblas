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
        ----------------------------------------------------------
        CHAPTER GET FUNCTIONS
        ----------------------------------------------------------
    */
    public function getvalues_c1($m,$type,$code,$mtID,$cID){

        $where = [
            'code'  => $code, 
            'type'  => $type,
            'mtID'  => $mtID,
            'cID'   => $cID,
        ];
        $query =  $this->db->table($this->tblc1d)->where($where)->get();

        if($m == 'm'){
            return $query->getResultArray();
        }else{
            return $query->getrowArray();
        }

    }


    public function getvalues_c2($m,$type,$code,$mtID,$cID){

        $where = [
            'code'  => $code, 
            'type'  => $type,
            'mtID'  => $mtID,
            'cID'   => $cID,
        ];
        $query =  $this->db->table($this->tblc2d)->where($where)->get();
        if($m == 'm'){
            return $query->getResultArray();
        }else{
            return $query->getrowArray();
        }

    }


    public function getvalues_s($c,$type,$code,$mtID,$cID){

        switch ($c) {
            case 'c1': $table = $this->tblc1d; break;
            case 'c2': $table = $this->tblc2d; break;
            case 'c3': $table = $this->tblc3d; break;
        }
        $where = [
            'code'  => $code, 
            'type'  => $type,
            'mtID'  => $mtID,
            'cID'   => $cID,
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
                                    $acid = $this->decr($req['acid'][$i]);
                                    $data = [
                                        'field2'        => $req['yesno'][$i],
                                        'field3'        => $req['comment'][$i],
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc1d)->where('mdID', $acid)->update($data);
                                }
                            break;
                            case 'saveac1eqr':
                                $acid = $this->decr($req['acid']);
                                $data = [
                                    'field1'        => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc1d)->where('mdID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Pre-Engagement Activities");
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
                                    $this->db->table($this->tblc1d)->where('mdID', $acid)->update($data);
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
                                $this->db->table($this->tblc1d)->where('mdID', $acid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Pre-Engagement Activities");
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
                                    $this->db->table($this->tblc2d)->where('mdID', $acid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Audit Planning");
                        return true;
                    break;
                    case 'AB4A':
                        switch ($param['save']) {
                            case 'saveab4a':
                                $this->db->table($this->tblc2d)->where(array('type' => $req['part'], 'code' => $param['code'], 'mtID' => $param['mtID'], 'cID' => $param['cID']))->delete();
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
                                        'type'          => $req['part'],
                                        'status'        => 'Active',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc2d)->insert($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Audit Planning");
                        return true;
                    break;
                    // case 'AC4':
                    //     switch ($param['save']) {
                    //         case 'saveac4':
                    //             foreach($req['comment'] as $i => $val){
                    //                 $acid = $this->crypt->decrypt($req['acid'][$i]);
                    //                 $data = [
                    //                     'comment'       => $req['comment'][$i],
                    //                     'updated_on'    => $this->date.' '.$this->time,
                    //                     'updated_by'    => $param['uID'],
                    //                 ];
                    //                 $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                    //             }
                    //         break;
                    //         case 'saveac4ppr':
                    //             $acid = $this->crypt->decrypt($req['acid']);
                    //             $data = [
                    //                 'question'      => $req['ppr'],
                    //                 'updated_on'    => $this->date.' '.$this->time,
                    //                 'updated_by'    => $param['uID'],
                    //             ];
                    //             $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                    //         break;
                    //     }
                    //     $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Audit Planning");
                    //     return true;
                    // break;
                    // case 'AC5':
                    //     switch ($param['save']) {
                    //         case 'saveac5':
                    //             $acid = $this->crypt->decrypt($req['acid']);
                    //             $data = [
                    //                 'question'      => $req['rescon'],
                    //                 'updated_on'    => $this->date.' '.$this->time,
                    //                 'updated_by'    => $param['uID'],
                    //             ];
                    //             $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                    //         break;
                    //     }
                    //     $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Audit Planning");
                    //     return true;
                    // break;
                    // case 'AC6':
                    //     switch ($param['save']) {
                    //         case 'saveac6ra':
                    //             foreach($req['planning'] as $i => $val){
                    //                 $acid = $this->crypt->decrypt($req['acid'][$i]);
                    //                 $data = [
                    //                     'planning'          => $req['planning'][$i],
                    //                     'finalization'      => $req['finalization'][$i],
                    //                     'reference'         => $req['reference'][$i],
                    //                     'updated_on'        => $this->date.' '.$this->time,
                    //                     'updated_by'        => $param['uID'],
                    //                 ];
                    //                 $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                    //             }
                    //         break;
                    //         case 'saveac6s12':
                    //             $acid = $this->crypt->decrypt($req['acid']);
                    //             $data = [
                    //                 'question'      => $req['section'],
                    //                 'updated_on'    => $this->date.' '.$this->time,
                    //                 'updated_by'    => $param['uID'],
                    //             ];
                    //             $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
                    //         break;
                    //         case 'saveac6s3':
                    //             $where = [
                    //                 'type'          => $req['part'], 
                    //                 'code'          => $req['code'], 
                    //                 'c1tID'         => $req['c1tID'],
                    //                 'clientID'      => $param['cID'],
                    //             ];
                    //             $this->db->table($this->tblc1d)->where($where)->delete();
                    //             foreach($req['financialstatement'] as $i => $val){
                    //                 $data = [
                    //                     'finstate'          => $req['financialstatement'][$i],
                    //                     'desc'              => $req['descriptioncontrol'][$i],
                    //                     'controleffect'     => $req['controleffective'][$i],
                    //                     'implemented'       => $req['controlimplemented'][$i],
                    //                     'assessed'          => $req['assesed'][$i],
                    //                     'reference'         => $req['crosstesting'][$i],
                    //                     'reliance'          => $req['reliancecontrol'][$i],
                    //                     'code'              => $req['code'],
                    //                     'c1tID'             => $req['c1tID'],
                    //                     'firmID'            => $param['fID'],
                    //                     'clientID'          => $param['cID'],
                    //                     'type'              => $req['part'],
                    //                     'status'            => 'Active',
                    //                     'updated_on'        => $this->date.' '.$this->time,
                    //                     'updated_by'        => $param['uID'],
                    //                 ];
                    //                 $this->db->table($this->tblc1d)->insert($data);
                    //             }
                    //         break;
                    //     }
                    //     $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Audit Planning");
                    //     return true;
                    // break;
                    // case 'AC7':
                    //     switch ($param['save']) {
                    //         case 'saveac7':
                    //             $data = [
                    //                 'question'      => $req['genyn'],
                    //                 'updated_on'    => $this->date.' '.$this->time,
                    //                 'updated_by'    => $param['uID'],
                    //             ];
                    //             $where = [
                    //                 'type'          => $req['part'],
                    //                 'c1tID'         => $req['c1tID'],
                    //                 'clientID'      => $param['cID'],
                    //             ];
                    //             $this->db->table($this->tblc1d)->where($where)->update($data);
                    //         break;
                    //     }
                    //     $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Audit Planning");
                    //     return true;
                    // break;
                    // case 'AC8':
                    //     switch ($param['save']) {
                    //         case 'saveac8':
                    //             foreach($req['question'] as $i => $val){
                    //                 $dacid = $this->crypt->decrypt($req['acid'][$i]);
                    //                 $data = [
                    //                     'question'          => $req['question'][$i],
                    //                     'updated_on'        => $this->date.' '.$this->time,
                    //                     'updated_by'        => $param['uID'],
                    //                 ];
                    //                 $this->db->table($this->tblc1d)->where('acID', $dacid)->update($data);
                    //             }
                    //         break;
                    //     }
                    //     $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Audit Planning");
                    //     return true;
                    // break;
                    // case 'AC9':
                    //     switch ($param['save']) {
                    //         case 'saveac9':
                    //             $dacid = $this->crypt->decrypt($req['acid']);
                    //             $data = [
                    //                 'question'      => $req['ac9'],
                    //                 'updated_on'    => $this->date.' '.$this->time,
                    //                 'updated_by'    => $param['uID'],
                    //             ];
                    //             $this->db->table($this->tblc1d)->where('acID', $dacid)->update($data);
                    //         break;
                    //     }
                    //     $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Audit Planning");
                    //     return true;
                    // break;
                    // case 'AC10-Tangibles':
                    // case 'AC10-PPE':
                    // case 'AC10-Investments':
                    // case 'AC10-Inventory':
                    // case 'AC10-Trade Receivables':
                    // case 'AC10-Other Receivables':
                    // case 'AC10-Bank and Cash':
                    // case 'AC10-Other Payables':
                    // case 'AC10-Provisions':        
                    // case 'AC10-Revenue':
                    // case 'AC10-Costs':
                    // case 'AC10-Payroll':
                    // case 'AC10-Summary':
                    //     switch ($param['save']) {
                    //         case 'saveac10summ':
                    //             foreach ($req as $r => $val){
                    //                 $data = [
                    //                     'question'      => $val,
                    //                     'type'          => $r.'data',
                    //                     'updated_on'    => $this->date.' '.$this->time,
                    //                     'updated_by'    => $param['uID'],
                    //                 ];
                    //                 $where1 = [
                    //                     'type'          => $r.'data',
                    //                     'code'          => $req['code'],
                    //                     'c1tID'         => $req['c1tID'],
                    //                     'clientID'      => $param['cID'],
                    //                 ];
                    //                 $this->db->table($this->tblc1d)->where($where1)->update($data);
                    //             }
                    //             $where2 = [
                    //                 'type'          => 'materialdata',
                    //                 'code'          => $req['code'],
                    //                 'c1tID'         => $req['c1tID'],
                    //                 'clientID'      => $param['cID'],
                    //             ];
                    //             $this->db->table($this->tblc1d)->where($where2)->update(array('question' => $req['materiality']));
                    //         break;
                    //         case 'saveac10s1':
                    //             $where = [
                    //                 'type'          => $req['type'], 
                    //                 'code'          => $req['code'],
                    //                 'question'      => 'section1',
                    //                 'c1tID'         => $req['c1tID'],
                    //                 'clientID'      => $param['cID'],
                    //             ];
                    //             $this->db->table($this->tblc1d)->where($where)->delete();
                    //             foreach($req['name'] as $i => $val){
                    //                 $data = [
                    //                     'less'          => $req['less'][$i],
                    //                     'name'          => $req['name'][$i],
                    //                     'balance'       => $req['balance'][$i],
                    //                     'type'          => $req['type'],
                    //                     'code'          => $req['code'],
                    //                     'c1tID'         => $req['c1tID'],
                    //                     'clientID'      => $param['cID'],
                    //                     'firmID'        => $param['fID'],
                    //                     'question'      => 'section1',
                    //                     'updated_on'    => $this->date.' '.$this->time,
                    //                     'updated_by'    => $param['uID'],
                    //                 ];
                    //                 $this->db->table($this->tblc1d)->insert($data);
                    //             }
                    //         break;
                    //         case 'saveac10s2':
                    //             $where = [
                    //                 'type'          => $req['type'], 
                    //                 'code'          => $req['code'],
                    //                 'question'      => 'section2',
                    //                 'c1tID'         => $req['c1tID'],
                    //                 'clientID'      => $param['cID'],
                    //             ];
                    //             $this->db->table($this->tblc1d)->where($where)->delete();
                    //             foreach($req['name'] as $i => $val){
                    //                 $data = [
                    //                     'less'          => $req['less'][$i],
                    //                     'name'          => $req['name'][$i],
                    //                     'reason'        => $req['reason'][$i],
                    //                     'balance'       => $req['balance'][$i],
                    //                     'type'          => $req['type'],
                    //                     'code'          => $req['code'],
                    //                     'c1tID'         => $req['c1tID'],
                    //                     'clientID'      => $param['cID'],
                    //                     'firmID'        => $param['fID'],
                    //                     'question'      => 'section2',
                    //                     'updated_on'    => $this->date.' '.$this->time,
                    //                     'updated_by'    => $param['uID'],
                    //                 ];
                    //                 $this->db->table($this->tblc1d)->insert($data);
                    //             }
                    //         break;
                    //         case 'saveac10cu':
                    //             $dacid = $this->crypt->decrypt($req['acid']);
                    //             $data = [
                    //                 'question'      => $req['question'],
                    //                 'updated_on'    => $this->date.' '.$this->time,
                    //                 'updated_by'    => $param['uID'],
                    //             ];
                    //             $this->db->table($this->tblc1d)->where('acID', $dacid)->update($data);
                    //         break;
                    //     }
                    //     $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Audit Planning");
                    //     return true;
                    // break;
                    // case 'AC11':
                    //     switch ($param['save']) {
                    //         case 'saveac11':
                    //             $dacid = $this->crypt->decrypt($req['acid']);
                    //             $data = [
                    //                 'question'      => $req['ac11'],
                    //                 'updated_on'    => $this->date.' '.$this->time,
                    //                 'updated_by'    => $param['uID'],
                    //             ];
                    //             $this->db->table($this->tblc1d)->where('acID', $dacid)->update($data);
                    //         break;
                    //     }
                    //     $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Audit Planning");
                    //     return true;
                    // break;
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
                                    $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'saveaa1s3' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                            case 'saverceap' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['question'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                    $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
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
                                    $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'saveaa3air' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['air'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                    $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'saveaa3bp4' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['p4'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
                        return true;
                    break;
                    case '3.5 Aa4':
                        switch ($param['save']) {
                            case 'saveaa4' :
                                $where = [
                                    'type'          => $req['part'],
                                    'code'          => $req['code'],
                                    'c3tID'         => $req['c3tID'],
                                    'clientID'      => $param['cID']
                                ];
                                $data = [
                                    'question'      => $req['aa4'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'        => $param['uID'],
                                ];
                                $this->db->table($this->tblc3d)->where($where)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                ];
                                $data = [
                                    'question'      => $req['aa5a'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3d)->where($where)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
                        return true;
                    break;
                    case '3.6.2 Aa5b':
                        switch ($param['save']) {
                            case 'saveaa5b' :
                                $where = [
                                    'type'          => $req['part'],
                                    'code'          => $req['code'],
                                    'c3tID'         => $req['c3tID'],
                                    'clientID'      => $param['cID']
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
                                        'clientID'          => $param['cID'],
                                        'firmID'            => $param['fID'],
                                        'status'            => 'Active',
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3d)->insert($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                        'clientID'          => $param['cID'],
                                        'firmID'            => $param['fID'],
                                        'status'            => 'Active',
                                        'updated_on'        => $this->date.' '.$this->time
                                    ];
                                    $this->db->table($this->tblc3d)->insert($data);
                                }
                            break;
                            case 'saveaa7aepapp' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['aep'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                            case 'saveaa7aep' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['aep'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                        'clientID'          => $param['cID'],
                                        'firmID'            => $param['fID'],
                                        'status'            => 'Active',
                                        'updated_on'        => $this->date.' '.$this->time,
                                        'updated_by'        => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3d)->insert($data);
                                }
                            break;
                            case 'saveaa11ad' :
                                $where = [
                                    'type'          => $req['part'],
                                    'code'          => $req['code'],
                                    'c3tID'         => $req['c3tID'],
                                    'clientID'      => $param['cID'],
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
                                        'type'          => $req['part'],
                                        'code'          => $req['code'],
                                        'c3tID'         => $req['c3tID'],
                                        'clientID'      => $param['cID'],
                                        'firmID'        => $param['fID'],
                                        'status'        => 'Active',
                                        'updated_on'    => $this->date.' '.$this->time,
                                        'updated_by'    => $param['uID'],
                                    ];
                                    $this->db->table($this->tblc3d)->insert($data);
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
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                            case 'saveaa11con' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['aa11'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                ];
                                $data = [
                                    'question'      => $req['arf'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3d)->where($where)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                    $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                    $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                                }
                            break;
                            case 'saveab4checklist' :
                                $dacid = $this->crypt->decrypt($req['acid']);
                                $data = [
                                    'question'      => $req['chlst'],
                                    'updated_on'    => $this->date.' '.$this->time,
                                    'updated_by'    => $param['uID'],
                                ];
                                $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
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
                                    $this->db->table($this->tblc3d)->where('acID', $dacid)->update($data);
                                }
                            break;
                        }
                        $this->logs->log(session()->get('name'). " set a default value on a client file {$param['code']} Chapter 3");
                        return true;
                    break;
                }
            break;
        }

    }

}