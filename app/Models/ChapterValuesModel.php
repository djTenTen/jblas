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
        CHAPTER 1
        AC1 FUNCTIONS
        ----------------------------------------------------------
        * @method getac1() get the ac1 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac1($code,$c1tID,$dcID){

        $where = [
            'code'      => $code, 
            'type'      => 'cacf',
            'c1tID'     => $c1tID,
            'clientID'  => $dcID
        ];
        $query =  $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getac1eqr() get the ac1 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac1eqr($code,$c1tID,$dcID){
        
        $where = [
            'code'      => $code, 
            'type'      => 'eqr', 
            'c1tID'     => $c1tID, 
            'clientID'  => $dcID
        ];
        $query =  $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
                'yesno'             => $req['yesno'][$i],
                'comment'           => $req['comment'][$i],
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file AC1 Chapter 1");
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
        if($this->db->table($this->tblc1d)->where('acID', $acid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file AC1 Chapter 1");
            return true;
        }else{
            return false;
        }

    }


    /**
        ----------------------------------------------------------
        AC2 FUNCTIONS
        ----------------------------------------------------------
        * @method getac2() get the ac2 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac2($code,$c1tID,$dcID){

        $where = [
            'code'      => $code, 
            'type'      => 'pans',
            'c1tID'     => $c1tID, 
            'clientID'  => $dcID
        ];
        $query =  $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getac2aep() get the ac2 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac2aep($code,$c1tID,$dcID){

        $where = [
            'code'      => $code, 
            'type'      => 'ac2aep',
            'c1tID'     => $c1tID, 
            'clientID'  => $dcID
        ];
        $query =  $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
        $this->logs->log(session()->get('name'). " set a default value on a client file AC2 Chapter 1");
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
        if($this->db->table($this->tblc1d)->where('acID', $acid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file AC2 Chapter 1");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AC3 FUNCTIONS
        ----------------------------------------------------------
        * @method getac3() get the ac3 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac3($part,$code,$c1tID,$dcID){

        $where = [
            'code'      => $code, 
            'type'      => $part,
            'c1tID'     => $c1tID, 
            'clientID'  => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
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
            $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file AC3 Chapter 1");
        return true;

    }

    
    /**
        ----------------------------------------------------------
        AC4 FUNCTIONS
        ----------------------------------------------------------
        * @method getac4ppr() get the ac4 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac4ppr($code,$c1tID,$dcID){

        $where = [
            'code'      => $code, 
            'type'      => 'ppr',
            'c1tID'     => $c1tID, 
            'clientID'  => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
        * @method getac4() get the ac4 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac4($code,$c1tID,$dcID){

        $where = [
            'code'      => $code, 
            'type'      => 'ac4sod',
            'c1tID'     => $c1tID, 
            'clientID'  => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
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
        if($this->db->table($this->tblc1d)->where('acID', $acid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file AC4 Chapter 1");
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
            $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file AC4 Chapter 1");
        return true;

    }

    
    /**
        ----------------------------------------------------------
        AC5 FUNCTIONS
        ----------------------------------------------------------
        * @method getac5() get the ac5 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac5($code,$c1tID,$dcID){

        $where = [
            'code'          => $code, 
            'type'          => 'rescon',
            'c1tID'         => $c1tID, 
            'clientID'      => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where )->get();
        return $query->getRowArray();

    }

    /**
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
        if($this->db->table($this->tblc1d)->where('acID', $acid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file AC5 Chapter 1");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AC6 FUNCTIONS
        ----------------------------------------------------------
        * @method getac6() get the ac6 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac6($part,$code,$c1tID,$dcID){

        $where = [
            'code'          => $code, 
            'type'          => $part,
            'c1tID'         => $c1tID, 
            'clientID'      => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method gets12() get the ac6 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function gets12($code,$c1tID,$dcID){

        $where = [
            'code'          => $code, 
            'type'          => 'ac6s12',
            'c1tID'         => $c1tID, 
            'clientID'      => $dcID
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
                'planning'          => $req['planning'][$i],
                'finalization'      => $req['finalization'][$i],
                'reference'         => $req['reference'][$i],
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc1d)->where('acID', $acid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file AC6 Chapter 1");
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
        if($this->db->table($this->tblc1d)->where('acID', $acid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file AC6 Chapter 1");
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
        $this->logs->log(session()->get('name'). " set a default value on a client file AC6 Chapter 1");
        return true;

    }

    
    /**
        ----------------------------------------------------------
        AC7 FUNCTIONS
        ----------------------------------------------------------
        * @method getac7() get the ac7 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac7($code,$c1tID,$part,$dcID){

        $where = [
            'type'          => $part, 
            'code'          => $code, 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
        ];
        if($this->db->table($this->tblc1d)->where($where)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file AC7 Chapter 1");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AC8 FUNCTIONS
        ----------------------------------------------------------
        * @method getac8() get the ac8 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac8($code,$c1tID,$part,$dcID){

        $where = [
            'type'      => $part, 
            'code'      => $code, 
            'c1tID'     => $c1tID,
            'clientID'  => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
                'question'          => $req['question'][$i],
                'updated_on'        => $this->date.' '.$this->time,
                'updated_by'        => $req['uID'],
            ];
            $this->db->table($this->tblc1d)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file AC8 Chapter 1");
        return true;

    }

    
    /**
        ----------------------------------------------------------
        AC9 FUNCTIONS
        ----------------------------------------------------------
        * @method getac9data() get the ac9 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac9data($code,$c1tID,$dcID){

        $where = [
            'type'          => 'ac9data', 
            'code'          => $code, 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
        if($this->db->table($this->tblc1d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file AC9 Chapter 1");
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AC10 FUNCTIONS
        ----------------------------------------------------------
        * @method getac10s1data() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac10s1data($c1tID,$part,$dcID){

        $where = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'question'      => 'section1',
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getac10s2data() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getac10s2data($c1tID,$part,$dcID){

        $where = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'question'      => 'section2',
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getac10cu() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac10cu($c1tID,$part,$dcID){

        $where = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
        * @method getdatacount() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return integer
    */
    public function getdatacount($c1tID,$part,$dcID){

        $where = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where);
        return $query->countAllResults();

    }

    /**
        * @method getdatacount() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @var array-where1-where2 reference data
        * @var query result from database
        * @return integer
    */
    public function getsumation($c1tID,$part,$dcID){

        $where1 = [
            'type'          => $part, 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
        ];
        $where2 = [
            'type'          => $part.'cu', 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
        ];
        $total = $this->db->table($this->tblc1d)->selectSum('balance')->where($where1)->get()->getRowArray();
        $cu = $this->db->table($this->tblc1d)->where($where2)->get()->getRowArray();
        return $cu['question'] - $total['balance'];

    }

    /**
        * @method getsummarydata() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getsummarydata($c1tID,$part,$dcID){

        $where = [
            'type'          => $part.'data', 
            'code'          => 'ac10', 
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
            ];
            $this->db->table($this->tblc1d)->where($where1)->update($data);
        }
        $where2 = [
            'type'          => 'materialdata',
            'code'          => $ref['code'],
            'c1tID'         => $ref['c1tID'],
            'clientID'      =>$ref['cID'],
        ];
        $this->db->table($this->tblc1d)->where($where2)->update(array('question' => $ref['materiality']));
        $this->logs->log(session()->get('name'). " set a default value on a client file AC10 Chapter 1");
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
        ];
        $this->db->table($this->tblc1d)->where($where)->delete();
        foreach($req['name'] as $i => $val){
            $data = [
                'less'          => $req['less'][$i],
                'name'          => $req['name'][$i],
                'balance'       => $req['balance'][$i],
                'type'          =>  $req['type'],
                'code'          =>  $req['code'],
                'c1tID'         => $req['c1tID'],
                'clientID'      => $req['cID'],
                'firmID'        => $req['fID'],
                'question'      => 'section1',
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc1d)->insert($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file AC10 Chapter 1");
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
        $this->logs->log(session()->get('name'). " set a default value on a client file AC10 Chapter 1");
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
        if($this->db->table($this->tblc1d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file AC10 Chapter 1");
            return true;
        }else{
            return false;
        }
        
    }


    /**
        ----------------------------------------------------------
        AC11 FUNCTIONS
        ----------------------------------------------------------
        * @method getac11data() get the ac11 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getac11data($code,$c1tID,$dcID){

        $where = [
            'type'          => 'ac11data',
            'code'          => $code,
            'c1tID'         => $c1tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc1d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
        if($this->db->table($this->tblc1d)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " set a default value on a client file AC11 Chapter 1");
            return true;
        }else{
            return false;
        }

    }


    /**
        ----------------------------------------------------------
        CHAPTER 2 FUNCTIONS
        ----------------------------------------------------------
        * @method getquestionsdata() get the chapter 2 data information
        * @param code contains file codes
        * @param c2tID chapter 2 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getquestionsdata($code,$c2tID,$dcID){

        $where = [
            'type'          => $code,
            'code'          => $code,
            'c2tID'         => $c2tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc2d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getquestionsaicpppa() get the chapter 2 data information
        * @param code contains file codes
        * @param c2tID chapter 2 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getquestionsaicpppa($code,$c2tID,$dcID){

        $where = [
            'type'      => 'aicpppa',
            'code'      => $code,
            'c2tID'     => $c2tID,
            'clientID'  => $dcID,
        ];
        $query = $this->db->table($this->tblc2d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getquestionsrcicp() get the chapter 2 data information
        * @param code contains file codes
        * @param c2tID chapter 2 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getquestionsrcicp($code,$c2tID,$dcID){

        $where = [
            'type'          => 'rcicp',
            'code'          => $code,
            'c2tID'         => $c2tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc2d)->where($where)->get();
        return $query->getResultArray();

    }
   
    /**
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
            $this->db->table($this->tblc2d)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 2");
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
                'reference'     => $req['comment'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc2d)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 2");
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
                'extent'        => $req['extent'][$i],
                'reference'     => $req['comment'][$i],
                'updated_on'    => $this->date.' '.$this->time,
                'updated_by'    => $req['uID'],
            ];
            $this->db->table($this->tblc2d)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " set a default value on a client file Chapter 2");
        return true;

    }

    /**
        ----------------------------------------------------------
        CHAPTER 3
        AA1 FUNCTIONS
        ----------------------------------------------------------
        * @method getaa1() get the aa1 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa1($part,$code,$c3tID,$dcID){

        $where = [
            'type'      => $part,
            'code'      => $code,
            'c3tID'     => $c3tID,
            'clientID'  => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa1s3() save the aa1 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa1s3($code,$c3tID,$dcID){

        $where = [
            'type'          => 'section3',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getRowArray();

    }
   
    /**
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
        ----------------------------------------------------------
        AA2 FUNCTIONS
        ----------------------------------------------------------
        * @method getaa2data() get the aa2 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa2data($code,$c3tID,$dcID){

        $where = [
            'type'          => 'aa2',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getRowArray();

    }
   
    /**
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
        * @method getaa3() get the aa3a information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa3($part,$code,$c3tID,$dcID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa3air() get the aa3a information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa3air($code,$c3tID,$dcID){

        $where = [
            'type'          => 'ir',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
            'question'      => $req['ir'],
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
        * @method getaa3b() get the aa3b information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa3b($part,$code,$c3tID,$dcID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa3bp4() get the aa3b information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa3bp4($code,$c3tID,$dcID){

        $where = [
            'type'          => 'p4',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
        * @method getaa4() get the aa4 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @var query result from database
        * @return result-array
    */
    public function getaa4($code,$c3tID,$dcID){

        $where = [
            'type'          => 'aa4',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
        $this->db->table($this->tblc3d)->where($where)->delete();
        $data = [
            'question'      => $req['aa4'],
            'type'          => $req['part'],
            'code'          => $req['code'],
            'c3tID'         => $req['c3tID'],
            'clientID'      => $req['cID'],
            'firmID'        => $req['fID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time,
            'updated_by'        => $req['uID'],
        ];
        if($this->db->table($this->tblc3d)->insert($data)){
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
        * @method getaa5b() get the aa5b information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa5b($code,$c3tID,$dcID){

        $where = [
            'type'          => 'aa5b',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
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
        * @method getaa7() get the aa7 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa7($part,$code,$c3tID,$dcID){

        $where = [
            'type'      => $part,
            'code'      => $code,
            'c3tID'     => $c3tID,
            'clientID'  => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa7aep() get the aa7 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa7aep($part,$code,$c3tID,$dcID){

        $where = [
            'type'      => $part,
            'code'      => $code,
            'c3tID'     => $c3tID,
            'clientID'  => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
        * @method getaa10() get the aa10 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa10($code,$c3tID,$dcID){

        $where = [
            'type'          => 'aa10',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
        * @method getaa11p2() get the aa11 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getaa11p2($part,$code,$c3tID,$dcID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getaa11p() get the aa11 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa11p($part,$code,$c3tID,$dcID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
        * @method getaa11con() get the aa11 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getaa11con($part,$code,$c3tID,$dcID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
        AB1 FUNCTIONS
        ----------------------------------------------------------
        * @method getab1() get the ab1 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getab1($code,$c3tID,$dcID){

        $where = [
            'type'      => 'ab1',
            'code'      => $code,
            'c3tID'     => $c3tID,
            'clientID'  => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
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
        * @method getab3() get the ab1 information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return row-array
    */
    public function getab3($code,$c3tID,$dcID){

        $where = [
            'type'          => 'ab3',
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
        * @method getab4() get the ab4 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getab4($part,$code,$c3tID,$dcID){
        
        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
        * @method getab4checklist() get the ab4 information
        * @param part specifies the part of the file
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getab4checklist($part,$code,$c3tID,$dcID){

        $where = [
            'type'          => $part,
            'code'          => $code,
            'c3tID'         => $c3tID,
            'clientID'      => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getRowArray();

    }

    /**
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
        * @method getab4a() get the ab4a information
        * @param code contains file codes
        * @param c3tID chapter 3 title id
        * @param dcID decrypted client id
        * @var array-where reference data
        * @var query result from database
        * @return result-array
    */
    public function getab4a($part,$code,$c3tID,$dcID){

        $where = [
            'type'      => $part,
            'code'      => $code,
            'c3tID'     => $c3tID,
            'clientID'  => $dcID,
        ];
        $query = $this->db->table($this->tblc3d)->where($where)->get();
        return $query->getResultArray();

    }

    /**
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