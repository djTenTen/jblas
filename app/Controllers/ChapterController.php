<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\ChapterModel;
use \App\Models\Chapter1Model;
use \App\Models\Chapter2Model;
use \App\Models\Chapter3Model;
use \App\Models\ChapterValuesModel;
use \App\Models\WorkpaperModel;

class ChapterController extends BaseController{


    /**
        * @property
    */
    protected $chapterModel;
    protected $c1model;
    protected $c2model;
    protected $c3model;
    protected $cvmodel;
    protected $wpmodel;
    protected $crypt;

    /**
        * Load the methods on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->chapterModel     = new ChapterModel();
        $this->c1model          = new Chapter1Model();
        $this->c2model          = new Chapter2Model();
        $this->c3model          = new Chapter3Model();
        $this->cvmodel          = new ChapterValuesModel();
        $this->wpmodel          = new WorkpaperModel();
        $this->crypt            = \Config\Services::encrypter();

    }


    /**
        * Replacing characters then Decrypting a Data @param ecr
    */
    public function decr($ecr){
        return $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ecr));
    }


    /**
        * Encypting a Data @param ecr then Replacing the characters
    */
    public function encr($ecr){
        return str_ireplace(['/','+'],['~','$'],$this->crypt->encrypt($ecr));
    }



    /** 
        --------------------------------------------------------------------------------------------------------------------
        SET DEFAULT MANAGEMENT CHAPTER 1
        --------------------------------------------------------------------------------------------------------------------
        * Dynamic page render based on @param code
        * Dynamic data fetch on @method getvalues_c1 based on @param type,part,code,moduletitleID,clientID
        * @param type contains 'm' for multiple row data and 's' for single row data
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        return as views
    */
    public function c1setvalues($code,$mtID,$cID,$name){

        $data['title']  = $code. ' - Pre-Engagement Activities';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['mtID']   = $mtID;
        $data['code']   = $code;
        $dcID           = $this->decr($cID);
        $dmtID          = $this->decr($mtID);
        switch ($code) {
            case 'AC1':
                $data['ac1']    = $this->cvmodel->getvalues_c1('m','cacf',$code,$dmtID,$dcID);
                $rdata          = $this->cvmodel->getvalues_c1('s','eqr',$code,$dmtID,$dcID);
                $data['eqr']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
            break;
            case 'AC2':
                $data['ac2']    = $this->cvmodel->getvalues_c1('m','pans',$code,$dmtID,$dcID);
                $data['aep']    = $this->cvmodel->getvalues_c1('s','ac2aep',$code,$dmtID,$dcID);
            break;
        }
        echo view('includes/Header', $data);
        echo view('client/chapter1/'.$code, $data);
        echo view('includes/Footer');

    }
    /** 
        --------------------------------------------------------------------------------------------------------------------
        PDF VIEWS CHAPTER 1
        --------------------------------------------------------------------------------------------------------------------
        * Dynamic page render based on @param code
        * Dynamic data fetch on @method getvalues_m based on @param part,code,moduletitleID
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        return as views
    */
    public function viewc1pdf($code,$mtID){

        $data['title']  = $code;
        $data['mtID']   = $mtID;
        $data['code']   = $code;
        $dmtID = $this->decr($mtID);
        switch ($code) {
            case 'AC1':
                $data['ac1']    = $this->c1model->getvalues_m('cacf',$code,$dmtID);
                $rdata          = $this->c1model->getvalues_s('eqr',$code,$dmtID);
                $data['eqr']    = json_decode($rdata['field1'], true);
            break;
            case 'AC2':
                $data['ac2']    = $this->c1model->getvalues_m('pans',$code,$dmtID);
                $data['aep']    = $this->c1model->getvalues_s('ac2aep',$code,$dmtID);
            break;
        }
        echo view('pdfc1/'.$code, $data);

    }



    /** 
        --------------------------------------------------------------------------------------------------------------------
        SET DEFAULT MANAGEMENT CHAPTER 2
        --------------------------------------------------------------------------------------------------------------------
        * Dynamic page render based on @param code
        * Dynamic data fetch on @method getvalues_c2 based on @param type,part,code,moduletitleID,clientID
        * @param type contains 'm' for multiple row data and 's' for single row data
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        return as views
    */
    public function c2setvalues($code,$mtID,$cID,$name){

        $data['title']  = $code. ' - Audit Planning';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['mtID']   = $mtID;
        $data['code']   = $code;
        $dcID           = $this->decr($cID);
        $dmtID          = $this->decr($mtID);
        switch ($code) {
            case 'AB4':
                $data['ac3genmat']      = $this->cvmodel->getvalues_c2('m','genmat',$code,$dmtID,$dcID);
                $data['ac3doccors']     = $this->cvmodel->getvalues_c2('m','doccors',$code,$dmtID,$dcID);
                $data['ac3statutory']   = $this->cvmodel->getvalues_c2('m','statutory',$code,$dmtID,$dcID);
                $data['ac3accsys']      = $this->cvmodel->getvalues_c2('m','accsys',$code,$dmtID,$dcID);
                $page = $code;
            break;
            case 'AB4A':
                $data['ab4a']   = $this->cvmodel->getvalues_c2('m','rd',$code,$dmtID,$dcID);
                $page = $code;
            break;
            case 'AC3':
                $data['ac4']    = $this->cvmodel->getvalues_c2('m','ac4sod',$code,$dmtID,$dcID);
                $rdata          = $this->cvmodel->getvalues_c2('s','ppr',$code,$dmtID,$dcID);
                $data['ppr']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
            break;
            case 'AC4':
                $rdata          = $this->cvmodel->getvalues_c2('s','rescon',$code,$dmtID,$dcID);
                $data['rc']     = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AC5':
                $rdata          = $this->cvmodel->getvalues_c2('s','td',$code,$dmtID,$dcID);
                $data['td']     = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AC6':
                $rdata          = $this->cvmodel->getvalues_c2('s','revp',$code,$dmtID,$dcID);
                $data['ac6']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AC7':
                $data['ac6']    = $this->cvmodel->getvalues_c2('m','ac6ra',$code,$dmtID,$dcID);
                $rdata          = $this->cvmodel->getvalues_c2('s','ac6s12',$code,$dmtID,$dcID);
                $data['s']      = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $data['s3']     = $this->cvmodel->getvalues_c2('m','ac6s3',$code,$dmtID,$dcID);
                $page = $code;
                break;
            case 'AC8':
                $rowdata = [
                    'bacdata','trdata','ordata','invtrdata','invmtdata','ppedata','incadata','tpdata','opdata','taxdata','provdata',
                    'roidata','dcodata','prdata','oadata'
                ];
                foreach($rowdata as $row){
                    $rdata       = $this->cvmodel->getvalues_c2('s',$row,$code,$dmtID,$dcID);
                    $data[$row]  = json_decode($rdata['field1'], true);
                }
                $page = $code;
                break;
            case 'AC9':
                $rdata = $this->cvmodel->getvalues_c2('s','ac9data',$code,$dmtID,$dcID);
                $data['ac9']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AC10-Tangibles':
            case 'AC10-PPE':
            case 'AC10-Investments':
            case 'AC10-Inventory':
            case 'AC10-Trade Receivables':
            case 'AC10-Other Receivables':
            case 'AC10-Bank and Cash':
            case 'AC10-Trade Payables':
            case 'AC10-Other Payables':
            case 'AC10-Provisions':
            case 'AC10-Revenue':
            case 'AC10-Costs':
            case 'AC10-Payroll':
                $s = explode('-', $code);
                $data ['sheet']     = $s[1];
                $data['code']       = $s[0];
                $data['cu']         = $this->cvmodel->getvalues_c2('s',$s[1].'cu',$s[0],$dmtID,$dcID);
                $data['ac10s1']     = $this->cvmodel->getac10data($s[1],$s[0],$dmtID,$dcID,'section1');
                $data['ac10s2']     = $this->cvmodel->getac10data($s[1],$s[0],$dmtID,$dcID,'section2');
                $page = $s[0];
                break;
            case 'AC10-Summary':
                $s = explode('-', $code);
                $data ['sheet']     = $s[1];
                $data['code']       = $s[0];
                $data['nmk_tgb']    = $this->cvmodel->getdatacount($dmtID,'Tangibles',$dcID);
                $data['nmk_ppe']    = $this->cvmodel->getdatacount($dmtID,'PPE',$dcID);
                $data['nmk_invmt']  = $this->cvmodel->getdatacount($dmtID,'Investments',$dcID);
                $data['nmk_invtr']  = $this->cvmodel->getdatacount($dmtID,'Inventory',$dcID);
                $data['nmk_tr']     = $this->cvmodel->getdatacount($dmtID,'Trade Receivables',$dcID);
                $data['nmk_or']     = $this->cvmodel->getdatacount($dmtID,'Other Receivables',$dcID);
                $data['nmk_bac']    = $this->cvmodel->getdatacount($dmtID,'Bank and Cash',$dcID);
                $data['nmk_tp']     = $this->cvmodel->getdatacount($dmtID,'Trade Payables',$dcID);
                $data['nmk_op']     = $this->cvmodel->getdatacount($dmtID,'Other Payables',$dcID);
                $data['nmk_prov']   = $this->cvmodel->getdatacount($dmtID,'Provisions',$dcID);
                $data['nmk_rev']    = $this->cvmodel->getdatacount($dmtID,'Revenue',$dcID);
                $data['nmk_cst']    = $this->cvmodel->getdatacount($dmtID,'Costs',$dcID);
                $data['nmk_pr']     = $this->cvmodel->getdatacount($dmtID,'Payroll',$dcID);
                $data['vop_tgb']    = $this->cvmodel->getsumation($dmtID,'Tangibles',$dcID);
                $data['vop_ppe']    = $this->cvmodel->getsumation($dmtID,'PPE',$dcID);
                $data['vop_invmt']  = $this->cvmodel->getsumation($dmtID,'Investments',$dcID);
                $data['vop_invtr']  = $this->cvmodel->getsumation($dmtID,'Inventory',$dcID);
                $data['vop_tr']     = $this->cvmodel->getsumation($dmtID,'Trade Receivables',$dcID);
                $data['vop_or']     = $this->cvmodel->getsumation($dmtID,'Other Receivables',$dcID);
                $data['vop_bac']    = $this->cvmodel->getsumation($dmtID,'Bank and Cash',$dcID);
                $data['vop_tp']     = $this->cvmodel->getsumation($dmtID,'Trade Payables',$dcID);
                $data['vop_op']     = $this->cvmodel->getsumation($dmtID,'Other Payables',$dcID);
                $data['vop_prov']   = $this->cvmodel->getsumation($dmtID,'Provisions',$dcID);
                $data['vop_rev']    = $this->cvmodel->getsumation($dmtID,'Revenue',$dcID);
                $data['vop_cst']    = $this->cvmodel->getsumation($dmtID,'Costs',$dcID);
                $data['vop_pr']     = $this->cvmodel->getsumation($dmtID,'Payroll',$dcID);
                $data['mat']        = $this->cvmodel->getvalues_c2('s','materialdata',$s[0],$dmtID,$dcID);
                $rowdata            = ['tgb','ppe','invmt','invtr','tr','or','bac','tp','op','prov','rev','cst','pr'];
                foreach($rowdata as $row){
                    $rdata = $this->cvmodel->getvalues_c2('s',$row.'data',$s[0],$dmtID,$dcID);
                    $data[$row] = json_decode($rdata['field1'], true);
                }
                $page = $code;
                break;
        }

        echo view('includes/Header', $data);
        echo view('client/chapter2/'.$page, $data);
        echo view('includes/Footer');

    }
    /** 
        --------------------------------------------------------------------------------------------------------------------
        PDF VIEWS CHAPTER 2
        --------------------------------------------------------------------------------------------------------------------
        * Dynamic page render based on @param code
        * Dynamic data fetch on @method getvalues_m based on @param part,code,moduletitleID
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        return as views
    */
    public function viewc2pdf($code,$mtID){

        $data['title']  = $code;
        $data['mtID']   = $mtID;
        $data['code']   = $code;
        $dmtID = $this->decr($mtID);
        switch ($code) {
            case 'AB4':
                $data['ac3genmat']      = $this->c2model->getvalues_m('genmat',$code,$dmtID);
                $data['ac3doccors']     = $this->c2model->getvalues_m('doccors',$code,$dmtID);
                $data['ac3statutory']   = $this->c2model->getvalues_m('statutory',$code,$dmtID);
                $data['ac3accsys']      = $this->c2model->getvalues_m('accsys',$code,$dmtID);
                break;
            case 'AB4A':
                $data['rd']   = $this->c2model->getvalues_m('rd',$code,$dmtID);
                break;
            case 'AC3':
                $data['ac4']  = $this->c2model->getvalues_m('ac4sod',$code,$dmtID);
                $rdata        = $this->c2model->getvalues_s('ppr',$code,$dmtID);
                $data['ppr']  = json_decode($rdata['field1'], true);
                break;
            case 'AC4':
                $rdata       = $this->c2model->getvalues_s('rescon',$code,$dmtID);
                $data['rc']  = json_decode($rdata['field1'], true);
                break;
            case 'AC5':
                $rdata       = $this->c2model->getvalues_s('td',$code,$dmtID);
                $data['td']  = json_decode($rdata['field1'], true);
                break;
            case 'AC6':
                $rdata          = $this->c2model->getvalues_s('revp',$code,$dmtID);
                $data['ac6']    = json_decode($rdata['field1'], true);
                break;
            case 'AC7':
                $data['ac6']   = $this->c2model->getvalues_m('ac6ra',$code,$dmtID);
                $rdata         = $this->c2model->getvalues_s('ac6s12',$code,$dmtID);
                $data['s']     = json_decode($rdata['field1'], true);
                $data['s3']    = $this->c2model->getvalues_m('ac6s3',$code,$dmtID);
                break;
            case 'AC8':
                $rowdata = [
                    'bacdata','trdata','ordata','invtrdata','invmtdata','ppedata','incadata','tpdata','opdata','taxdata','provdata',
                    'roidata','dcodata','prdata','oadata'
                ];
                foreach($rowdata as $row){
                    $rdata       = $this->c2model->getvalues_s($row,$code,$dmtID);
                    $data[$row]  = json_decode($rdata['field1'], true);
                }
                break;
            case 'AC9':
                $rdata        = $this->c2model->getvalues_s('ac9data',$code,$dmtID);
                $data['ac9']  = json_decode($rdata['field1'], true);
                break;
            case 'AC10-Tangibles':
            case 'AC10-PPE':
            case 'AC10-Investments':
            case 'AC10-Inventory':
            case 'AC10-Trade Receivables':
            case 'AC10-Other Receivables':
            case 'AC10-Bank and Cash':
            case 'AC10-Trade Payables':
            case 'AC10-Other Payables':
            case 'AC10-Provisions':
            case 'AC10-Revenue':
            case 'AC10-Costs':
            case 'AC10-Payroll':
                $s = explode('-', $code);
                $data ['sheet']  = $s[1];
                $data['code']    = $s[0];
                $data['cu']      = $this->c2model->getvalues_s($s[1].'cu',$s[0],$dmtID);
                $data['ac10s1']  = $this->c2model->getac10data($s[1],$s[0],$dmtID,'section1');
                $data['ac10s2']  = $this->c2model->getac10data($s[1],$s[0],$dmtID,'section2');
                echo view('pdfc2/AC10', $data);
                exit;
                break;
            case 'AC10-Summary':
                $s = explode('-', $code);
                $data ['sheet']     = $s[1];
                $data['code']       = $s[0];
                $data['nmk_tgb']    = $this->c2model->getdatacount($dmtID,'Tangibles');
                $data['nmk_ppe']    = $this->c2model->getdatacount($dmtID,'PPE');
                $data['nmk_invmt']  = $this->c2model->getdatacount($dmtID,'Investments');
                $data['nmk_invtr']  = $this->c2model->getdatacount($dmtID,'Inventory');
                $data['nmk_tr']     = $this->c2model->getdatacount($dmtID,'Trade Receivables');
                $data['nmk_or']     = $this->c2model->getdatacount($dmtID,'Other Receivables');
                $data['nmk_bac']    = $this->c2model->getdatacount($dmtID,'Bank and Cash');
                $data['nmk_tp']     = $this->c2model->getdatacount($dmtID,'Trade Payables');
                $data['nmk_op']     = $this->c2model->getdatacount($dmtID,'Other Payables');
                $data['nmk_prov']   = $this->c2model->getdatacount($dmtID,'Provisions');
                $data['nmk_rev']    = $this->c2model->getdatacount($dmtID,'Revenue');
                $data['nmk_cst']    = $this->c2model->getdatacount($dmtID,'Costs');
                $data['nmk_pr']     = $this->c2model->getdatacount($dmtID,'Payroll');
                $data['vop_tgb']    = $this->c2model->getsumation($dmtID,'Tangibles');
                $data['vop_ppe']    = $this->c2model->getsumation($dmtID,'PPE');
                $data['vop_invmt']  = $this->c2model->getsumation($dmtID,'Investments');
                $data['vop_invtr']  = $this->c2model->getsumation($dmtID,'Inventory');
                $data['vop_tr']     = $this->c2model->getsumation($dmtID,'Trade Receivables');
                $data['vop_or']     = $this->c2model->getsumation($dmtID,'Other Receivables');
                $data['vop_bac']    = $this->c2model->getsumation($dmtID,'Bank and Cash');
                $data['vop_tp']     = $this->c2model->getsumation($dmtID,'Trade Payables');
                $data['vop_op']     = $this->c2model->getsumation($dmtID,'Other Payables');
                $data['vop_prov']   = $this->c2model->getsumation($dmtID,'Provisions');
                $data['vop_rev']    = $this->c2model->getsumation($dmtID,'Revenue');
                $data['vop_cst']    = $this->c2model->getsumation($dmtID,'Costs');
                $data['vop_pr']     = $this->c2model->getsumation($dmtID,'Payroll');
                $data['mat']        = $this->c2model->getvalues_s('materialdata',$s[0],$dmtID);
                $rowdata            = ['tgb','ppe','invmt','invtr','tr','or','bac','tp','op','prov','rev','cst','pr'];
                foreach($rowdata as $row){
                    $rdata       = $this->c2model->getvalues_s($row.'data',$s[0],$dmtID);
                    $data[$row]  = json_decode($rdata['field1'], true);
                }
                break;
        }

        echo view('pdfc2/'.$code, $data);

    }



    /** 
        --------------------------------------------------------------------------------------------------------------------
        SET DEDAULT MANAGEMENT CHAPTER 3
        --------------------------------------------------------------------------------------------------------------------
        * Dynamic page render based on @param code
        * Dynamic data fetch on @method getvalues_c3 based on @param type,part,code,moduletitleID,clientID
        * @param type contains 'm' for multiple row data and 's' for single row data
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        return as views
    */
    public function c3setvalues($code,$mtID,$cID,$name){

        $data['title']  = $code. ' - Concluding the Audit';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['mtID']   = $mtID;
        $data['code']   = $code;
        $dcID           = $this->decr($cID);
        $dmtID          = $this->decr($mtID);
        switch ($code) {
            case 'AA1':
                $data['datapl'] = $this->cvmodel->getvalues_c3('m','planning',$code,$dmtID,$dcID);
                $data['dataaf'] = $this->cvmodel->getvalues_c3('m','audit finalisation',$code,$dmtID,$dcID);
                $rdata          = $this->cvmodel->getvalues_c3('s','section3',$code,$dmtID,$dcID);
                $data['s3']     = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $rdata2         = $this->cvmodel->getvalues_c3('s','rc',$code,$dmtID,$dcID);
                $data['rc']     = json_decode($rdata2['field1'], true);
                $data['mdID2']  = $this->encr($rdata2['mdID']);
                $page = $code;
                break;
            case 'AA2':
                $rdata          = $this->cvmodel->getvalues_c3('s','aa2',$code,$dmtID,$dcID);
                $data['aa2']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA3A':
                $data['cr']     = $this->cvmodel->getvalues_c3('m','cr',$code,$dmtID,$dcID);
                $data['dc']     = $this->cvmodel->getvalues_c3('m','dc',$code,$dmtID,$dcID);
                $data['faf']    = $this->cvmodel->getvalues_c3('m','faf',$code,$dmtID,$dcID);
                $rdata          = $this->cvmodel->getvalues_c3('s','air',$code,$dmtID,$dcID);
                $data['air']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA3B':
                $data['bp1']    = $this->cvmodel->getvalues_c3('m','p1',$code,$dmtID,$dcID);
                $data['bp2']    = $this->cvmodel->getvalues_c3('m','p2',$code,$dmtID,$dcID);
                $data['bp3a']   = $this->cvmodel->getvalues_c3('m','p3a',$code,$dmtID,$dcID);
                $data['bp3b']   = $this->cvmodel->getvalues_c3('m','p3b',$code,$dmtID,$dcID);
                $rdata          = $this->cvmodel->getvalues_c3('s','p4',$code,$dmtID,$dcID);
                $data['bp4']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA4':
                $rdata          = $this->cvmodel->getvalues_c3('s','aa4',$code,$dmtID,$dcID);
                $data['aa4']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA5A':
                $rdata          = $this->cvmodel->getvalues_c3('s','aa5a',$code,$dmtID,$dcID);
                $data['aa5a']   = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA5B':
                $data['aa5b']   = $this->cvmodel->getvalues_c3('m','aa5b',$code,$dmtID,$dcID);
                $page = $code;
                break;  
            case 'AA6':
                $data['aa7']    = $this->cvmodel->getvalues_c3('m','isa315',$code,$dmtID,$dcID);
                $data['cons']   = $this->cvmodel->getvalues_c3('m','consultation',$code,$dmtID,$dcID);
                $data['inc']    = $this->cvmodel->getvalues_c3('m','inconsistencies',$code,$dmtID,$dcID);
                $data['ref']    = $this->cvmodel->getvalues_c3('m','refusal',$code,$dmtID,$dcID);
                $data['dep']    = $this->cvmodel->getvalues_c3('m','departures',$code,$dmtID,$dcID);
                $data['oth']    = $this->cvmodel->getvalues_c3('m','other',$code,$dmtID,$dcID);
                $data['aepapp'] = $this->cvmodel->getvalues_c3('s','aepapp',$code,$dmtID,$dcID);
                $rdata          = $this->cvmodel->getvalues_c3('s','aep',$code,$dmtID,$dcID);
                $data['aep']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA7':
                $rdata          = $this->cvmodel->getvalues_c3('s','aa10',$code,$dmtID,$dcID);
                $data['aa10']   = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA8-un':
                $s                      = explode('-', $code);
                $data['sectiontitle']   = "SUMMARY OF UNADJUSTED ERRORS";
                $data['aef']            = $this->cvmodel->getvalues_c3('m','aef',$s[0],$dmtID,$dcID);
                $data['aej']            = $this->cvmodel->getvalues_c3('m','aej',$s[0],$dmtID,$dcID);
                $data['ee']             = $this->cvmodel->getvalues_c3('m','ee',$s[0],$dmtID,$dcID);
                $data['de']             = $this->cvmodel->getvalues_c3('m','de',$s[0],$dmtID,$dcID);
                $rdata                  = $this->cvmodel->getvalues_c3('s','aa11ue',$s[0],$dmtID,$dcID);
                $data['ue']             = json_decode($rdata['field1'], true);    
                $data['ueacID']         = $this->encr($rdata['mdID']);
                $rdata2                 = $this->cvmodel->getvalues_c3('s','con',$s[0],$dmtID,$dcID);
                $data['con']            = json_decode($rdata2['field1'], true);   
                $data['conacID']        = $this->encr($rdata2['mdID']);
                $page = $code;
                break;
            case 'AA9':
                $rdata          = $this->cvmodel->getvalues_c3('s','aa9',$code,$dmtID,$dcID);
                $data['a9']     = json_decode($rdata['field1'], true);    
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break; 
            case 'AA10':
                $rdata          = $this->cvmodel->getvalues_c3('s','aa10',$code,$dmtID,$dcID);
                $data['a10']    = json_decode($rdata['field1'], true); 
                $data['mdID']   = $this->encr($rdata['mdID']);   
                $page = $code;
                break; 
            case 'AA11':
                $data['a11']    = $this->cvmodel->getvalues_c3('m','aa11',$code,$dmtID,$dcID);
                $page = $code;
                break; 
            case 'AA12':
                $rdata          = $this->cvmodel->getvalues_c3('s','aa12',$code,$dmtID,$dcID);
                $data['a12']    = json_decode($rdata['field1'], true);   
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break; 
            case 'AA8-ad':
                $s                      = explode('-', $code);
                $data['sectiontitle']   = "SUMMARY OF ADJUSTMENTS MADE TO THE CLIENT'S FINANCIAL STATEMENTS";
                $data['ad']     = $this->cvmodel->getvalues_c3('m','ad',$s[0],$dmtID,$dcID);
                $rdata          = $this->cvmodel->getvalues_c3('s','aa11uead',$s[0],$dmtID,$dcID);
                $data['ue']     = json_decode($rdata['field1'], true);    
                $data['ueacID'] = $this->encr($rdata['mdID']);
                $page = $code;
                break;   
            case 'AB1':
                $data['ab1']    = $this->cvmodel->getvalues_c3('m','ab1',$code,$dmtID,$dcID);
                $page = $code;
                break;   
            case 'AB2':
                $rdata = $this->cvmodel->getvalues_c3('s','ab3',$code,$dmtID ,$dcID);
                $data['ab3']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break; 
            case 'AB3-checklist':
            case 'AB3-section1':
            case 'AB3-section2':
            case 'AB3-section3':
            case 'AB3-section4':
            case 'AB3-section5':
            case 'AB3-section6':
            case 'AB3-section7':
            case 'AB3-section8':
            case 'AB3-section9':
                $s = explode('-', $code);
                switch ($s[1]) {
                    case 'checklist':$data['sectiontitle']  = 'CORPORATE DISCLOSURE CHECKLIST (IFRS)';break;
                    case 'section1':$data['sectiontitle']   = 'Format of the Annual Report and Generic Information';break;
                    case 'section2':$data['sectiontitle']   = 'Statement of Comprehensive Income (SCI) and Related Notes';break;
                    case 'section3':$data['sectiontitle']   = 'Statement of Changes in Equity';break;
                    case 'section4':$data['sectiontitle']   = 'Statement of Financial Position and Related Notes';break;
                    case 'section5':$data['sectiontitle']   = 'Statement of Cash Flows'; break;
                    case 'section6':$data['sectiontitle']   = 'Accounting Policies and Estimation Techniques';break;
                    case 'section7':$data['sectiontitle']   = 'Notes and Other Disclosures';break;
                }
                $data['title']      = $code. ' - Chapter 3 Management';
                $data['section']    = $s[1];
                $data['mtID']       = $mtID;
                $data['code']       = $code;
                if($s[1] == "checklist"){
                    $rdata = $this->cvmodel->getvalues_c3('s',$s[1],$s[0],$dmtID,$dcID);
                    $data['sec']    = json_decode($rdata['field1'], true);
                    $data['mdID']   = $this->encr($rdata['mdID']);
                    $page = $code;
                }else{
                    $data['sec'] = $this->cvmodel->getvalues_c3('m',$s[1],$s[0],$dmtID,$dcID);
                    $page = 'AB3-section';
                }
                break;

        }

        echo view('includes/Header', $data);
        echo view('client/chapter3/'.$page, $data);
        echo view('includes/Footer');

    }
    /** 
        --------------------------------------------------------------------------------------------------------------------
        PDF VIEWS CHAPTER 3
        --------------------------------------------------------------------------------------------------------------------
        * Dynamic page render based on @param code
        * Dynamic data fetch on @method getvalues_m based on @param part,code,moduletitleID
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        return as views
    */
    public function viewc3pdf($code,$mtID){

        $data['title']  = $code;
        $data['mtID']   = $mtID;
        $data['code']   = $code;
        $dmtID          = $this->decr($mtID);
        switch ($code) {
            case 'AA1':
                $data['datapl'] = $this->c3model->getvalues_m('planning',$code,$dmtID);
                $data['dataaf'] = $this->c3model->getvalues_m('audit finalisation',$code,$dmtID);
                $rdata          = $this->c3model->getvalues_s('section3',$code, $dmtID);
                $data['s3']     = json_decode($rdata['field1'], true);
                $rdata2         = $this->c3model->getvalues_s('rc',$code,$dmtID);
                $data['rc']     = json_decode($rdata2['field1'], true);
                $page = $code;
                break;
            case 'AA2':
                $rdata          = $this->c3model->getvalues_s('aa2',$code, $dmtID);
                $data['aa2']    = json_decode($rdata['field1'], true);
                $page = $code;
                break;
            case 'AA3A':
                $data['cr']     = $this->c3model->getvalues_m('cr',$code,$dmtID);
                $data['dc']     = $this->c3model->getvalues_m('dc',$code,$dmtID);
                $data['faf']    = $this->c3model->getvalues_m('faf',$code,$dmtID);
                $rdata          = $this->c3model->getvalues_s('air',$code,$dmtID);
                $data['air']    = json_decode($rdata['field1'], true);
                $page = $code;
                break;
            case 'AA3B':
                $data['bp1']    = $this->c3model->getvalues_m('p1',$code,$dmtID);
                $data['bp2']    = $this->c3model->getvalues_m('p2',$code,$dmtID);
                $data['bp3a']   = $this->c3model->getvalues_m('p3a',$code,$dmtID);
                $data['bp3b']   = $this->c3model->getvalues_m('p3b',$code,$dmtID);
                $rdata          = $this->c3model->getvalues_s('p4',$code,$dmtID);
                $data['bp4']    = json_decode($rdata['field1'], true);
                $page = $code;
                break;
            case 'AA4':
                $rdata          = $this->c3model->getvalues_s('aa4',$code,$dmtID);
                $data['aa4']    = json_decode($rdata['field1'], true);
                $page = $code;
                break;
            case 'AA5A':
                $rdata          = $this->c3model->getvalues_s('aa5a',$code,$dmtID);
                $data['aa5a']   = json_decode($rdata['field1'], true);
                $page = $code;
                break;
            case 'AA5B':
                $data['aa5b']   = $this->c3model->getvalues_m('aa5b',$code,$dmtID);
                $page = $code;
                break;  
            case 'AA6':
                $data['aa7']    = $this->c3model->getvalues_m('isa315',$code,$dmtID);
                $data['cons']   = $this->c3model->getvalues_m('consultation',$code,$dmtID);
                $data['inc']    = $this->c3model->getvalues_m('inconsistencies',$code,$dmtID);
                $data['ref']    = $this->c3model->getvalues_m('refusal',$code,$dmtID);
                $data['dep']    = $this->c3model->getvalues_m('departures',$code,$dmtID);
                $data['oth']    = $this->c3model->getvalues_m('other',$code,$dmtID);
                $data['aepapp'] = $this->c3model->getvalues_s('aepapp',$code,$dmtID);
                $rdata          = $this->c3model->getvalues_s('aep',$code,$dmtID);
                $data['aep']    = json_decode($rdata['field1'], true);
                $page = $code;
                break;
            case 'AA7':
                $rdata          = $this->c3model->getvalues_s('aa10',$code,$dmtID);
                $data['aa10']   = json_decode($rdata['field1'], true);
                $page = $code;
                break;
            case 'AA8-un':
                $s = explode('-', $code);
                $data['aef']    = $this->c3model->getvalues_m('aef',$s[0],$dmtID);
                $data['aej']    = $this->c3model->getvalues_m('aej',$s[0],$dmtID);
                $data['ee']     = $this->c3model->getvalues_m('ee',$s[0],$dmtID);
                $data['de']     = $this->c3model->getvalues_m('de',$s[0],$dmtID);
                $rdata          = $this->c3model->getvalues_s('aa11ue',$s[0],$dmtID);
                $data['ue']     = json_decode($rdata['field1'], true);
                $rdata2         = $this->c3model->getvalues_s('con',$s[0],$dmtID);
                $data['con']    = json_decode($rdata2['field1'], true);  
                $page = $code;
                break;
            case 'AA8-ad':
                $s              = explode('-', $code);
                $data['ad']     = $this->c3model->getvalues_m('ad',$s[0],$dmtID);
                $rdata          = $this->c3model->getvalues_s('aa11uead',$s[0],$dmtID);
                $data['ue']     = json_decode($rdata['field1'], true);   
                $page = $code;
                break; 
            case 'AA9':
                $rdata          = $this->c3model->getvalues_s('aa9',$code,$dmtID);
                $data['a9']     = json_decode($rdata['field1'], true);    
                $page = $code;
                break; 
            case 'AA10':
                $rdata          = $this->c3model->getvalues_s('aa10',$code,$dmtID);
                $data['a10']    = json_decode($rdata['field1'], true); 
                $page = $code;
                break; 
            case 'AA11':
                $data['a11']    = $this->c3model->getvalues_m('aa11',$code,$dmtID);
                $page = $code;
                break; 
            case 'AA12':
                $rdata          = $this->c3model->getvalues_s('aa12',$code,$dmtID);
                $data['a12']    = json_decode($rdata['field1'], true);   
                $page = $code;
                break;   
            case 'AB1':
                $data['ab1']    = $this->c3model->getvalues_m('ab1',$code,$dmtID);
                $page = $code;
                break;   
            case 'AB2':
                $rdata = $this->c3model->getvalues_s('ab3',$code,$dmtID);
                $data['ab3']    = json_decode($rdata['field1'], true);
                $page = $code;
                break; 
            case 'AB3':
                $rdata = $this->c3model->getvalues_s('checklist',$code,$dmtID);
                $data['sec']    = json_decode($rdata['field1'], true);
                $data['sec1']   = $this->c3model->getvalues_m('section1',$code,$dmtID);
                $data['sec2']   = $this->c3model->getvalues_m('section2',$code,$dmtID);
                $data['sec3']   = $this->c3model->getvalues_m('section3',$code,$dmtID);
                $data['sec4']   = $this->c3model->getvalues_m('section4',$code,$dmtID);
                $data['sec5']   = $this->c3model->getvalues_m('section5',$code,$dmtID);
                $data['sec6']   = $this->c3model->getvalues_m('section6',$code,$dmtID);
                $data['sec7']   = $this->c3model->getvalues_m('section7',$code,$dmtID);
                $page = $code;
                break; 
        }

        echo view('pdfc3/'.$page, $data);

    }



    /** 
        --------------------------------------------------------------------------------------------------------------------
        WORPAPER MANAGEMENT CHAPTER 1
        --------------------------------------------------------------------------------------------------------------------
        * Dynamic page render based on @param code
        * Dynamic data fetch on @method getvalues_c1 based on @param type,part,code,moduletitleID,clientID,workpaperID
        * @param type contains 'm' for multiple row data and 's' for single row data
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        return as views
    */
    public function c1setworkpaper($code,$mtID,$cID,$wpID,$name){

        $data['title']  = $code. ' - Pre-Engagement Activities';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['mtID']   = $mtID;
        $data['wpID']   = $wpID;
        $data['code']   = $code;
        $dcID           = $this->decr($cID);
        $dwpID          = $this->decr($wpID);
        $dmtID          = $this->decr($mtID);
        switch ($code) {
            case 'AC1':
                $data['ac1']    = $this->wpmodel->getvalues_c1('m','cacf',$code,$dmtID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getvalues_c1('s','eqr',$code,$dmtID,$dcID,$dwpID);
                $data['eqr']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
            break;
            case 'AC2':
                $data['ac2']    = $this->wpmodel->getvalues_c1('m','pans',$code,$dmtID,$dcID,$dwpID);
                $data['aep']    = $this->wpmodel->getvalues_c1('s','ac2aep',$code,$dmtID,$dcID,$dwpID);
            break;
        }
        echo view('includes/Header', $data);
        echo view('workpaper/chapter1/'.$code, $data);
        echo view('includes/Footer');

    }


    
    /** 
        --------------------------------------------------------------------------------------------------------------------
        WORPAPER MANAGEMENT CHAPTER 2
        --------------------------------------------------------------------------------------------------------------------
        * Dynamic page render based on @param code
        * Dynamic data fetch on @method getvalues_c2 based on @param type,part,code,moduletitleID,clientID,workpaperID
        * @param type contains 'm' for multiple row data and 's' for single row data
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        return as views
    */
    public function c2setworkpaper($code,$mtID,$cID,$wpID,$name){

        $data['title']  = $code. ' - Audit Planning';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['mtID']   = $mtID;
        $data['wpID']   = $wpID;
        $data['code']   = $code;
        $dcID           = $this->decr($cID);
        $dwpID          = $this->decr($wpID);
        $dmtID          = $this->decr($mtID);
        switch ($code) {
            case 'AB4':
                $data['ac3genmat']      = $this->wpmodel->getvalues_c2('m','genmat',$code,$dmtID,$dcID,$dwpID);
                $data['ac3doccors']     = $this->wpmodel->getvalues_c2('m','doccors',$code,$dmtID,$dcID,$dwpID);
                $data['ac3statutory']   = $this->wpmodel->getvalues_c2('m','statutory',$code,$dmtID,$dcID,$dwpID);
                $data['ac3accsys']      = $this->wpmodel->getvalues_c2('m','accsys',$code,$dmtID,$dcID,$dwpID);
                $page = $code;
            break;
            case 'AB4A':
                $data['ab4a']   = $this->wpmodel->getvalues_c2('m','rd',$code,$dmtID,$dcID,$dwpID);
                $page = $code;
            break;
            case 'AC3':
                $data['ac4']    = $this->wpmodel->getvalues_c2('m','ac4sod',$code,$dmtID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getvalues_c2('s','ppr',$code,$dmtID,$dcID,$dwpID);
                $data['ppr']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
            break;
            case 'AC4':
                $rdata          = $this->wpmodel->getvalues_c2('s','rescon',$code,$dmtID,$dcID,$dwpID);
                $data['rc']     = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AC5':
                $rdata          = $this->wpmodel->getvalues_c2('s','td',$code,$dmtID,$dcID,$dwpID);
                $data['td']     = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AC6':
                $rdata          = $this->wpmodel->getvalues_c2('s','revp',$code,$dmtID,$dcID,$dwpID);
                $data['ac6']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AC7':
                $data['ac6']    = $this->wpmodel->getvalues_c2('m','ac6ra',$code,$dmtID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getvalues_c2('s','ac6s12',$code,$dmtID,$dcID,$dwpID);
                $data['s']      = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $data['s3']     = $this->wpmodel->getvalues_c2('m','ac6s3',$code,$dmtID,$dcID,$dwpID);
                $page = $code;
                break;
            case 'AC8':
                $rowdata = [
                    'bacdata','trdata','ordata','invtrdata','invmtdata','ppedata','incadata','tpdata','opdata','taxdata','provdata',
                    'roidata','dcodata','prdata','oadata'
                ];
                foreach($rowdata as $row){
                    $rdata       = $this->wpmodel->getvalues_c2('s',$row,$code,$dmtID,$dcID,$dwpID);
                    $data[$row]  = json_decode($rdata['field1'], true);
                }
                $page = $code;
                break;
            case 'AC9':
                $rdata = $this->wpmodel->getvalues_c2('s','ac9data',$code,$dmtID,$dcID,$dwpID);
                $data['ac9']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AC10-Tangibles':
            case 'AC10-PPE':
            case 'AC10-Investments':
            case 'AC10-Inventory':
            case 'AC10-Trade Receivables':
            case 'AC10-Other Receivables':
            case 'AC10-Bank and Cash':
            case 'AC10-Trade Payables':
            case 'AC10-Other Payables':
            case 'AC10-Provisions':
            case 'AC10-Revenue':
            case 'AC10-Costs':
            case 'AC10-Payroll':
                $s = explode('-', $code);
                $data ['sheet']     = $s[1];
                $data['code']       = $s[0];
                $data['cu']         = $this->wpmodel->getvalues_c2('s',$s[1].'cu',$s[0],$dmtID,$dcID,$dwpID);
                $data['ac10s1']     = $this->wpmodel->getac10data($s[1],$s[0],$dmtID,$dcID,$dwpID,'section1');
                $data['ac10s2']     = $this->wpmodel->getac10data($s[1],$s[0],$dmtID,$dcID,$dwpID,'section2');
                $page = $s[0];
                break;
            case 'AC10-Summary':
                $s = explode('-', $code);
                $data ['sheet']     = $s[1];
                $data['code']       = $s[0];
                $data['nmk_tgb']    = $this->wpmodel->getdatacount($dmtID,'Tangibles',$dcID,$dwpID);
                $data['nmk_ppe']    = $this->wpmodel->getdatacount($dmtID,'PPE',$dcID,$dwpID);
                $data['nmk_invmt']  = $this->wpmodel->getdatacount($dmtID,'Investments',$dcID,$dwpID);
                $data['nmk_invtr']  = $this->wpmodel->getdatacount($dmtID,'Inventory',$dcID,$dwpID);
                $data['nmk_tr']     = $this->wpmodel->getdatacount($dmtID,'Trade Receivables',$dcID,$dwpID);
                $data['nmk_or']     = $this->wpmodel->getdatacount($dmtID,'Other Receivables',$dcID,$dwpID);
                $data['nmk_bac']    = $this->wpmodel->getdatacount($dmtID,'Bank and Cash',$dcID,$dwpID);
                $data['nmk_tp']     = $this->wpmodel->getdatacount($dmtID,'Trade Payables',$dcID,$dwpID);
                $data['nmk_op']     = $this->wpmodel->getdatacount($dmtID,'Other Payables',$dcID,$dwpID);
                $data['nmk_prov']   = $this->wpmodel->getdatacount($dmtID,'Provisions',$dcID,$dwpID);
                $data['nmk_rev']    = $this->wpmodel->getdatacount($dmtID,'Revenue',$dcID,$dwpID);
                $data['nmk_cst']    = $this->wpmodel->getdatacount($dmtID,'Costs',$dcID,$dwpID);
                $data['nmk_pr']     = $this->wpmodel->getdatacount($dmtID,'Payroll',$dcID,$dwpID);
                $data['vop_tgb']    = $this->wpmodel->getsumation($dmtID,'Tangibles',$dcID,$dwpID);
                $data['vop_ppe']    = $this->wpmodel->getsumation($dmtID,'PPE',$dcID,$dwpID);
                $data['vop_invmt']  = $this->wpmodel->getsumation($dmtID,'Investments',$dcID,$dwpID);
                $data['vop_invtr']  = $this->wpmodel->getsumation($dmtID,'Inventory',$dcID,$dwpID);
                $data['vop_tr']     = $this->wpmodel->getsumation($dmtID,'Trade Receivables',$dcID,$dwpID);
                $data['vop_or']     = $this->wpmodel->getsumation($dmtID,'Other Receivables',$dcID,$dwpID);
                $data['vop_bac']    = $this->wpmodel->getsumation($dmtID,'Bank and Cash',$dcID,$dwpID);
                $data['vop_tp']     = $this->wpmodel->getsumation($dmtID,'Trade Payables',$dcID,$dwpID);
                $data['vop_op']     = $this->wpmodel->getsumation($dmtID,'Other Payables',$dcID,$dwpID);
                $data['vop_prov']   = $this->wpmodel->getsumation($dmtID,'Provisions',$dcID,$dwpID);
                $data['vop_rev']    = $this->wpmodel->getsumation($dmtID,'Revenue',$dcID,$dwpID);
                $data['vop_cst']    = $this->wpmodel->getsumation($dmtID,'Costs',$dcID,$dwpID);
                $data['vop_pr']     = $this->wpmodel->getsumation($dmtID,'Payroll',$dcID,$dwpID);
                $data['mat']        = $this->wpmodel->getvalues_c2('s','materialdata',$s[0],$dmtID,$dcID,$dwpID);
                $rowdata            = ['tgb','ppe','invmt','invtr','tr','or','bac','tp','op','prov','rev','cst','pr'];
                foreach($rowdata as $row){
                    $rdata = $this->wpmodel->getvalues_c2('s',$row.'data',$s[0],$dmtID,$dcID,$dwpID);
                    $data[$row] = json_decode($rdata['field1'], true);
                }
                $page = $code;
                break;
        }

        echo view('includes/Header', $data);
        echo view('workpaper/chapter2/'.$page, $data);
        echo view('includes/Footer');

    }


    
    /** 
        --------------------------------------------------------------------------------------------------------------------
        WORPAPER MANAGEMENT CHAPTER 3
        --------------------------------------------------------------------------------------------------------------------
        * Dynamic page render based on @param code
        * Dynamic data fetch on @method getvalues_c3 based on @param type,part,code,moduletitleID,clientID,workpaperID
        * @param type contains 'm' for multiple row data and 's' for single row data
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        return as views
    */
    public function c3setworkpaper($code,$mtID,$cID,$wpID,$name){

        $data['title']  = $code. ' - Concluding the Audit';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['wpID']   = $wpID;
        $data['mtID']   = $mtID;
        $data['code']   = $code;
        $dcID           = $this->decr($cID);
        $dwpID          = $this->decr($wpID);
        $dmtID          = $this->decr($mtID);
        switch ($code) {
            case 'AA1':
                $data['datapl'] = $this->wpmodel->getvalues_c3('m','planning',$code,$dmtID,$dcID,$dwpID);
                $data['dataaf'] = $this->wpmodel->getvalues_c3('m','audit finalisation',$code,$dmtID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getvalues_c3('s','section3',$code,$dmtID,$dcID,$dwpID);
                $data['s3']     = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $rdata2         = $this->wpmodel->getvalues_c3('s','rc',$code,$dmtID,$dcID,$dwpID);
                $data['rc']     = json_decode($rdata2['field1'], true);
                $data['mdID2']  = $this->encr($rdata2['mdID']);
                $page = $code;
                break;
            case 'AA2':
                $rdata          = $this->wpmodel->getvalues_c3('s','aa2',$code,$dmtID,$dcID,$dwpID);
                $data['aa2']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA3A':
                $data['cr']     = $this->wpmodel->getvalues_c3('m','cr',$code,$dmtID,$dcID,$dwpID);
                $data['dc']     = $this->wpmodel->getvalues_c3('m','dc',$code,$dmtID,$dcID,$dwpID);
                $data['faf']    = $this->wpmodel->getvalues_c3('m','faf',$code,$dmtID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getvalues_c3('s','air',$code,$dmtID,$dcID,$dwpID);
                $data['air']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA3B':
                $data['bp1']    = $this->wpmodel->getvalues_c3('m','p1',$code,$dmtID,$dcID,$dwpID);
                $data['bp2']    = $this->wpmodel->getvalues_c3('m','p2',$code,$dmtID,$dcID,$dwpID);
                $data['bp3a']   = $this->wpmodel->getvalues_c3('m','p3a',$code,$dmtID,$dcID,$dwpID);
                $data['bp3b']   = $this->wpmodel->getvalues_c3('m','p3b',$code,$dmtID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getvalues_c3('s','p4',$code,$dmtID,$dcID,$dwpID);
                $data['bp4']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA4':
                $rdata          = $this->wpmodel->getvalues_c3('s','aa4',$code,$dmtID,$dcID,$dwpID);
                $data['aa4']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA5A':
                $rdata          = $this->wpmodel->getvalues_c3('s','aa5a',$code,$dmtID,$dcID,$dwpID);
                $data['aa5a']   = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA5B':
                $data['aa5b']   = $this->wpmodel->getvalues_c3('m','aa5b',$code,$dmtID,$dcID,$dwpID);
                $page = $code;
                break;  
            case 'AA6':
                $data['aa7']    = $this->wpmodel->getvalues_c3('m','isa315',$code,$dmtID,$dcID,$dwpID);
                $data['cons']   = $this->wpmodel->getvalues_c3('m','consultation',$code,$dmtID,$dcID,$dwpID);
                $data['inc']    = $this->wpmodel->getvalues_c3('m','inconsistencies',$code,$dmtID,$dcID,$dwpID);
                $data['ref']    = $this->wpmodel->getvalues_c3('m','refusal',$code,$dmtID,$dcID,$dwpID);
                $data['dep']    = $this->wpmodel->getvalues_c3('m','departures',$code,$dmtID,$dcID,$dwpID);
                $data['oth']    = $this->wpmodel->getvalues_c3('m','other',$code,$dmtID,$dcID,$dwpID);
                $data['aepapp'] = $this->wpmodel->getvalues_c3('s','aepapp',$code,$dmtID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getvalues_c3('s','aep',$code,$dmtID,$dcID,$dwpID);
                $data['aep']    = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA7':
                $rdata          = $this->wpmodel->getvalues_c3('s','aa10',$code,$dmtID,$dcID,$dwpID);
                $data['aa10']   = json_decode($rdata['field1'], true);
                $data['mdID']   = $this->encr($rdata['mdID']);
                $page = $code;
                break;
            case 'AA8-un':
                $s                      = explode('-', $code);
                $data['sectiontitle']   = "SUMMARY OF UNADJUSTED ERRORS";
                $data['aef']     = $this->wpmodel->getvalues_c3('m','aef',$s[0],$dmtID,$dcID,$dwpID);
                $data['aej']     = $this->wpmodel->getvalues_c3('m','aej',$s[0],$dmtID,$dcID,$dwpID);
                $data['ee']      = $this->wpmodel->getvalues_c3('m','ee',$s[0],$dmtID,$dcID,$dwpID);
                $data['de']      = $this->wpmodel->getvalues_c3('m','de',$s[0],$dmtID,$dcID,$dwpID);
                $rdata           = $this->wpmodel->getvalues_c3('s','aa11ue',$s[0],$dmtID,$dcID,$dwpID);
                $data['ue']      = json_decode($rdata['field1'], true);    
                $data['ueacID']  = $this->encr($rdata['mdID']);
                $rdata2          = $this->wpmodel->getvalues_c3('s','con',$s[0],$dmtID,$dcID,$dwpID);
                $data['con']     = json_decode($rdata2['field1'], true);   
                $data['conacID'] = $this->encr($rdata2['mdID']);
                $page = $code;
                break;
            case 'AA9':
                $rdata           = $this->wpmodel->getvalues_c3('s','aa9',$code,$dmtID,$dcID,$dwpID);
                $data['a9']      = json_decode($rdata['field1'], true);    
                $data['mdID']    = $this->encr($rdata['mdID']);
                $page = $code;
                break; 
            case 'AA10':
                $rdata           = $this->wpmodel->getvalues_c3('s','aa10',$code,$dmtID,$dcID,$dwpID);
                $data['a10']     = json_decode($rdata['field1'], true); 
                $data['mdID']    = $this->encr($rdata['mdID']);   
                $page = $code;
                break; 
            case 'AA11':
                $data['a11']     = $this->wpmodel->getvalues_c3('m','aa11',$code,$dmtID,$dcID,$dwpID);
                $page = $code;
                break; 
            case 'AA12':
                $rdata           = $this->wpmodel->getvalues_c3('s','aa12',$code,$dmtID,$dcID,$dwpID);
                $data['a12']     = json_decode($rdata['field1'], true);   
                $data['mdID']    = $this->encr($rdata['mdID']);
                $page = $code;
                break; 
            case 'AA8-ad':
                $s                      = explode('-', $code);
                $data['sectiontitle']   = "SUMMARY OF ADJUSTMENTS MADE TO THE CLIENT'S FINANCIAL STATEMENTS";
                $data['ad']      = $this->wpmodel->getvalues_c3('m','ad',$s[0],$dmtID,$dcID,$dwpID);
                $rdata           = $this->wpmodel->getvalues_c3('s','aa11uead',$s[0],$dmtID,$dcID,$dwpID);
                $data['ue']      = json_decode($rdata['field1'], true);    
                $data['ueacID']  = $this->encr($rdata['mdID']);
                $page = $code;
                break;   
            case 'AB1':
                $data['ab1']     = $this->wpmodel->getvalues_c3('m','ab1',$code,$dmtID,$dcID,$dwpID);
                $page = $code;
                break;   
            case 'AB2':
                $rdata = $this->wpmodel->getvalues_c3('s','ab3',$code,$dmtID ,$dcID,$dwpID);
                $data['ab3']     = json_decode($rdata['field1'], true);
                $data['mdID']    = $this->encr($rdata['mdID']);
                $page = $code;
                break; 
            case 'AB3-checklist':
            case 'AB3-section1':
            case 'AB3-section2':
            case 'AB3-section3':
            case 'AB3-section4':
            case 'AB3-section5':
            case 'AB3-section6':
            case 'AB3-section7':
            case 'AB3-section8':
            case 'AB3-section9':
                $s = explode('-', $code);
                switch ($s[1]) {
                    case 'checklist':$data['sectiontitle']  = 'CORPORATE DISCLOSURE CHECKLIST (IFRS)';break;
                    case 'section1':$data['sectiontitle']   = 'Format of the Annual Report and Generic Information';break;
                    case 'section2':$data['sectiontitle']   = 'Statement of Comprehensive Income (SCI) and Related Notes';break;
                    case 'section3':$data['sectiontitle']   = 'Statement of Changes in Equity';break;
                    case 'section4':$data['sectiontitle']   = 'Statement of Financial Position and Related Notes';break;
                    case 'section5':$data['sectiontitle']   = 'Statement of Cash Flows'; break;
                    case 'section6':$data['sectiontitle']   = 'Accounting Policies and Estimation Techniques';break;
                    case 'section7':$data['sectiontitle']   = 'Notes and Other Disclosures';break;
                }
                $data['title']      = $code. ' - Chapter 3 Management';
                $data['section']    = $s[1];
                $data['mtID']       = $mtID;
                $data['code']       = $code;
                if($s[1] == "checklist"){
                    $rdata          = $this->wpmodel->getvalues_c3('s',$s[1],$s[0],$dmtID,$dcID,$dwpID);
                    $data['sec']    = json_decode($rdata['field1'], true);
                    $data['mdID']   = $this->encr($rdata['mdID']);
                    $page = $code;
                }else{
                    $data['sec']    = $this->wpmodel->getvalues_c3('m',$s[1],$s[0],$dmtID,$dcID,$dwpID);
                    $page = 'AB3-section';
                }
                break;

        }

        echo view('includes/Header', $data);
        echo view('workpaper/chapter3/'.$page, $data);
        echo view('includes/Footer');

    }


}


    



  


    












  







    






