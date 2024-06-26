<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Logs;

class Chapter1Model extends Model{
    

    /**
        // ALL MODELS ARE COMMUNICATING ON THE DATABASE AND PROCESSES DATA TO THE DATABASE // 
        THIS FILE IS USED FOR CHAPTER 1 FILE MANAGEMENT
        Properties being used on this file
        * @property tblc1 table of chapter 1
        * @property time-date to load the date and time
        * @property db to load the data base
        * @property crypt to load the encryption file
        * @property logs to load the logs libraries for user activity logs
    */
    protected $tblc1 = "tbl_c1";
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
        * @method acin() set the chapter 1 files to active and inactive
        * @param req contains chapter file information
        * @var query result from database
        * @var r result from database as row array
        * @var stat set the status
        * @param duID user id
        * @var array-data contains auditor information going to save to database
        * @return bool
    */
    public function acin($req){

        $query = $this->db->table($this->tblc1)->where('acID', $req['c1ID'])->get();
        $r = $query->getRowArray();
        $stat = '';
        if($r['status'] == 'Active'){
            $stat = 'Inactive';
        }else{
            $stat = 'Active';
        }
        $data = [
            'status'        => $stat,
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->where('acID', $req['c1ID'])->update($data)){
            $this->logs->log(session()->get('name'). " Set the contents of ".$r['code']." to ".$stat);
            return true;
        }else{
            return false;
        }

    }

    
    /**
        ----------------------------------------------------------
        AC1 FUNCTIONS
        ----------------------------------------------------------
        * @method getac1() get the ac1 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @var query result from database
        * @return result-array
    */
    public function getac1($code,$c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => $code, 'type' => 'cacf', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method getac1eqr() get the ac1 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @var query result from database
        * @return row-array
    */
    public function getac1eqr($code,$c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => $code, 'type' => 'eqr', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveac1() save the ac1 information
        * @param req ac1 data
        * @var data contains ac1 information
        * @return bool
    */
    public function saveac1($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'question'      => $req['question'][$i],
                'yesno'         => $req['yesno'][$i],
                'comment'       => $req['comment'][$i],
                'code'          => $req['code'],
                'c1tID'         => $req['c1tID'],
                'type'          => $req['part'],
                'status'        => 'Active',
                'added_on'      => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
        return true;
      
    }

    /**
        * @method saveeqr() save the ac1 information
        * @param req ac1 data
        * @var data contains ac1 information
        * @return bool
    */
    public function saveeqr($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();
        $data = [
            'question'      => $req['question'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c1tID'         => $req['c1tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
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
        * @var query result from database
        * @return result-array
    */
    public function getac2($code,$c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => $code, 'type' => 'pans', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method getac2aep() get the ac2 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @var query result from database
        * @return row-array
    */
    public function getac2aep($code,$c1tID){

        $query =  $this->db->table($this->tblc1)->where(array('code' => $code, 'type' => 'ac2aep', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveac2() save the ac2 information
        * @param req ac2 data
        * @var data contains ac1 information
        * @return bool
    */
    public function saveac2($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'question'      => $req['question'][$i],
                'corptax'       => $req['corptax'][$i],
                'statutory'     => $req['statutory'][$i],
                'accountancy'   => $req['accountancy'][$i],
                'other'         => $req['other'][$i],
                'totalcu'       => $req['totalcu'][$i],
                'code'          => $req['code'],
                'c1tID'         => $req['c1tID'],
                'type'          => $req['part'],
                'status'        => 'Active',
                'added_on'      => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
        return true;

    }

    /**
        * @method saveac2aep() save the ac2 information
        * @param req ac2 data
        * @var data contains ac2 information
        * @return bool
    */
    public function saveac2aep($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();
        $data = [
            'question'      => $req['eap'],
            'name'          => $req['concl'],
            'type'          => $req['part'],
            'code'          => $req['code'],
            'c1tID'         => $req['c1tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
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
        * @var query result from database
        * @return result-array
    */
    public function getac3($part,$code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method saveac3() save the ac3 information
        * @param req ac3 data
        * @var data contains ac3 information
        * @return bool
    */
    public function saveac3($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();
        foreach($req['question'] as $i => $val){

            $data = [
                'question'  => $req['question'][$i],
                'yesno'     => $req['yesno'][$i],
                'comment'   => $req['comment'][$i],
                'code'      => $req['code'],
                'c1tID'     => $req['c1tID'],
                'type'      => $req['part'],
                'status'    => 'Active',
                'added_on'  => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
        return true;

    }


    /**
        ----------------------------------------------------------
        AC4 FUNCTIONS
        ----------------------------------------------------------
        * @method getac4ppr() get the ac4 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @var query result from database
        * @return row-array
    */
    public function getac4ppr($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ppr', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method getac4() get the ac4 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @var query result from database
        * @return result-array
    */
    public function getac4($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ac4sod', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method saveac4ppr() save the ac4 information
        * @param req ac4 data
        * @var data contains ac4 information
        * @return bool
    */
    public function saveac4ppr($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();
        $data = [
            'question'      => $req['ppr'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c1tID'         => $req['c1tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
            return true;
        }else{
            return false;
        }

    }

    /**
        * @method saveac4() save the ac4 information
        * @param req ac4 data
        * @var data contains ac4 information
        * @return bool
    */
    public function saveac4($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'question'      => $req['question'][$i],
                'comment'       => $req['comment'][$i],
                'code'          => $req['code'],
                'c1tID'         => $req['c1tID'],
                'type'          => $req['part'],
                'status'        => 'Active',
                'added_on'      => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
        return true;

    }


    /**
        ----------------------------------------------------------
        AC5 FUNCTIONS
        ----------------------------------------------------------
        * @method getac5() get the ac5 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @var query result from database
        * @return row-array
    */
    public function getac5($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'rescon', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveac5() save the ac5 information
        * @param req ac5 data
        * @var data contains ac5 information
        * @return bool
    */
    public function saveac5($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();
        $data = [
            'question'      => $req['rescon'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c1tID'         => $req['c1tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
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
        * @var query result from database
        * @return result-array
    */
    public function getac6($part,$code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method gets12() get the ac6 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @var query result from database
        * @return row-array
    */
    public function gets12($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ac6s12', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveac6ra() save the ac6 information
        * @param req ac6 data
        * @var data contains ac6 information
        * @return bool
    */
    public function saveac6ra($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();
        foreach($req['question'] as $i => $val){
            $data = [
                'question'          => $req['question'][$i],
                'planning'          => $req['planning'][$i],
                'finalization'      => $req['finalization'][$i],
                'reference'         => $req['reference'][$i],
                'code'              => $req['code'],
                'c1tID'             => $req['c1tID'],
                'type'              => $req['part'],
                'status'            => 'Active',
                'added_on'          => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
        return true;

    }

    /**
        * @method saveac6s12() save the ac6 information
        * @param req ac6 data
        * @var data contains ac6 information
        * @return bool
    */
    public function saveac6s12($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();
        $data = [
            'question'      => $req['section'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c1tID'         => $req['c1tID'],
            'status'        => 'Active',
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on AC6");
            return true;
        }else{
            return false;
        }

    }

    /**
        * @method saveac6s3() save the ac6 information
        * @param req ac6 data
        * @var data contains ac6 information
        * @return bool
    */
    public function saveac6s3($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'], 'c1tID' => $req['c1tID']))->delete();
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
                'type'              => $req['part'],
                'status'            => 'Active',
                'added_on'          => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
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
        * @var query result from database
        * @return row-array
    */
    public function getac7($code,$c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveac7() save the ac7 information
        * @param req ac7 data
        * @var data contains ac7 information
        * @return bool
    */
    public function saveac7($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'],'c1tID' => $req['c1tID']))->delete();
        $data = [
            'question'      => $req['genyn'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c1tID'         => $req['c1tID'],
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
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
        * @var query result from database
        * @return row-array
    */
    public function getac8($code,$c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => $code, 'c1tID' => $c1tID))->get();
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
                'question'      => $req['question'][$i],
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->where('acID', $dacid)->update($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
        return true;

    }


    /**
        ----------------------------------------------------------
        AC9 FUNCTIONS
        ----------------------------------------------------------
        * @method getac9data() get the ac9 information
        * @param code contains file codes
        * @param c1tID chapter 1 title id
        * @var query result from database
        * @return row-array
    */
    public function getac9data($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ac9data', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveac9() save the ac9 information
        * @param req ac9 data
        * @var data contains ac9 information
        * @return bool
    */
    public function saveac9($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => $req['code'],'c1tID' => $req['c1tID']))->delete();
        $data = [
            'question'      => $req['ac9'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c1tID'         => $req['c1tID'],
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
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
        * @var query result from database
        * @return result-array
    */
    public function getac10s1data($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac10','question' => 'section1', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method getac10s2data() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var query result from database
        * @return result-array
    */
    public function getac10s2data($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac10','question' => 'section2', 'c1tID' => $c1tID))->get();
        return $query->getResultArray();

    }

    /**
        * @method getac10cu() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var query result from database
        * @return row-array
    */
    public function getac10cu($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac10', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method getdatacount() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var query result from database
        * @return integer
    */
    public function getdatacount($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part, 'code' => 'ac10', 'c1tID' => $c1tID));
        return $query->countAllResults();

    }

    /**
        * @method getsumation() Count/Compute the balances
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var total result from database
        * @return integer
    */
    public function getsumation($c1tID,$part){

        $total = $this->db->table($this->tblc1)->selectSum('balance')->where(array('type' => $part, 'code' => 'ac10', 'c1tID' => $c1tID))->get()->getRowArray();
        $cu = $this->db->table($this->tblc1)->where(array('type' => $part.'cu', 'code' => 'ac10', 'c1tID' => $c1tID))->get()->getRowArray();
        return $cu['question'] - $total['balance'];

    }

    /**
        * @method getsummarydata() get the ac10 information
        * @param c1tID chapter 1 title id
        * @param part specifies the part of the file
        * @var query result from database
        * @return row-array
    */
    public function getsummarydata($c1tID,$part){

        $query = $this->db->table($this->tblc1)->where(array('type' => $part.'data', 'code' => 'ac10', 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }


    /**
        * @method saveac10summ() save the ac10 information
        * @param req ac10 data
        * @param ref ac10 reference
        * @var data contains ac10 information
        * @return bool
    */
    public function saveac10summ($req,$ref){

        foreach ($req as $r => $val){
            $this->db->table($this->tblc1)->where(array('type' => $r.'data', 'code' => 'ac10','c1tID' => $ref['c1tID']))->delete();
            $data = [
                'question'      => $val,
                'type'          =>  $r.'data',
                'code'          =>  $ref['code'],
                'c1tID'         => $ref['c1tID'],
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->db->table($this->tblc1)->where(array('type' => 'materialdata', 'code' => $ref['code'],'c1tID' => $ref['c1tID']))->delete();
        $this->db->table($this->tblc1)->insert(array('type' => 'materialdata', 'code' => $ref['code'],'c1tID' => $ref['c1tID'], 'question' => $ref['materiality']));
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
        return true;

    }

    /**
        * @method saves1ac10() save the ac10 information
        * @param req ac10 data
        * @var data contains ac10 information
        * @return bool
    */
    public function saves1ac10($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['type'], 'code' => $req['code'],'question' => 'section1', 'c1tID' => $req['c1tID']))->delete();
        foreach($req['name'] as $i => $val){
            $data = [
                'less'          => $req['less'][$i],
                'name'          => $req['name'][$i],
                'balance'       => $req['balance'][$i],
                'type'          =>  $req['type'],
                'code'          =>  $req['code'],
                'c1tID'         => $req['c1tID'],
                'question'      => 'section1',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
        return true;

    }

    /**
        * @method saveac10s2() save the ac10 information
        * @param req ac10 data
        * @var data contains ac10 information
        * @return bool
    */
    public function saveac10s2($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['type'], 'code' => $req['code'],'question' => 'section2', 'c1tID' => $req['c1tID']))->delete();
        foreach($req['name'] as $i => $val){
            $data = [
                'less'          => $req['less'][$i],
                'name'          => $req['name'][$i],
                'reason'        => $req['reason'][$i],
                'balance'       => $req['balance'][$i],
                'type'          =>  $req['type'],
                'code'          =>  $req['code'],
                'c1tID'         => $req['c1tID'],
                'question'      => 'section2',
                'updated_on'    => $this->date.' '.$this->time
            ];
            $this->db->table($this->tblc1)->insert($data);
        }
        $this->logs->log(session()->get('name'). " save a content on AC10");
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

        $dacid = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$req['acid']));
        $data = [
            'question' => $req['question'],
        ];
        if($this->db->table($this->tblc1)->where('acID', $dacid)->update($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
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
        * @var query result from database
        * @return row-array
    */
    public function getac11data($code,$c1tID){

        $query = $this->db->table($this->tblc1)->where(array('type' => 'ac11data', 'code' => $code, 'c1tID' => $c1tID))->get();
        return $query->getRowArray();

    }

    /**
        * @method saveac11() save the ac10 information
        * @param req ac10 data
        * @var data contains ac10 information
        * @return bool
    */
    public function saveac11($req){

        $this->db->table($this->tblc1)->where(array('type' => $req['part'], 'code' => 'ac11', 'c1tID' => $req['c1tID']))->delete();
        $data = [
            'question'      => $req['ac11'],
            'type'          =>  $req['part'],
            'code'          =>  $req['code'],
            'c1tID'         => $req['c1tID'],
            'updated_on'    => $this->date.' '.$this->time
        ];
        if($this->db->table($this->tblc1)->insert($data)){
            $this->logs->log(session()->get('name'). " save a content on ".$req['code']." Chapter 1");
            return true;
        }else{
            return false;
        }

    }
    

}