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
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL //
        THIS FILE IS USED TO VIEW OF ALL THE CHAPTER FILES
        Properties being used on this file
        * @property chapterModel to include the file chapter model
        * @property c1model to include the file chapter 1 model
        * @property c2model to include the file chapter 2 model
        * @property c3model to include the file chapter 3 model
        * @property cvmodel to include the file chapter values model
        * @property wpmodel to include the file work paper model
        * @property crypt to load the encryption file
    */
    protected $chapterModel;
    protected $c1model;
    protected $c2model;
    protected $c3model;
    protected $cvmodel;
    protected $wpmodel;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
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
        ----------------------------------------------------------
        PDF VIEW CHAPTER 1
        ----------------------------------------------------------
        * @method viewc1pdf() used to generate a pdf file of Chapter 1
        * @param code consists of file code
        * @param c1tID encrypted of title id
        * @var dc1tID decrypted id of @param c1tID
        * @var rdata contains raw json data from database
        * @param array-data consist the data from database to display on the page
          THE VIEWS ARE DYNAMICALLY DISPLAYED BASED ON THE @param code RESULT ON THE SWITCH CONDITION
        * @return pdf-view
    */
    public function viewc1pdf($code,$c1tID){

        $data['title']  = $code;
        $data['c1tID']  = $c1tID;
        $data['code']   = $code;
        $dc1tID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID));
        switch ($code) {
            case 'AC1':
                $data['ac1']  = $this->c1model->getvalues_m('cacf',$code,$dc1tID);
                $rdata        = $this->c1model->getvalues_s('eqr',$code,$dc1tID);
                $data['eqr']  = json_decode($rdata['question'], true);
                echo view('pdfc1/AC1', $data);
                break;
            case 'AC2':
                $data['ac2'] = $this->c1model->getvalues_m('pans',$code,$dc1tID);
                $data['aep'] = $this->c1model->getvalues_s('ac2aep',$code,$dc1tID);
                echo view('pdfc1/AC2', $data);
                break;
            case 'AC3':
                $data['ac3genmat']      = $this->c1model->getvalues_m('genmat',$code,$dc1tID);
                $data['ac3doccors']     = $this->c1model->getvalues_m('doccors',$code,$dc1tID);
                $data['ac3statutory']   = $this->c1model->getvalues_m('statutory',$code,$dc1tID);
                $data['ac3accsys']      = $this->c1model->getvalues_m('accsys',$code,$dc1tID);
                echo view('pdfc1/AC3', $data);
                break;
            case 'AC4':
                $data['ac4']  = $this->c1model->getvalues_m('ac4sod',$code,$dc1tID);
                $rdata        = $this->c1model->getvalues_s('ppr',$code,$dc1tID);
                $data['ppr']  = json_decode($rdata['question'], true);
                echo view('pdfc1/AC4', $data);
                break;
            case 'AC5':
                $rdata       = $this->c1model->getvalues_s('rescon',$code,$dc1tID);
                $data['rc']  = json_decode($rdata['question'], true);
                echo view('pdfc1/AC5', $data);
                break;
            case 'AC6':
                $data['ac6']   = $this->c1model->getvalues_m('ac6ra',$code,$dc1tID);
                $rdata         = $this->c1model->getvalues_s('ac6s12',$code,$dc1tID);
                $data['s']     = json_decode($rdata['question'], true);
                $data['s3']    = $this->c1model->getvalues_m('ac6s3',$code,$dc1tID);
                echo view('pdfc1/AC6', $data);
                break;
            case 'AC7':
                $rowdata = [
                    'bacdata','trdata','ordata','invtrdata','invmtdata','ppedata','incadata','tpdata','opdata','taxdata','provdata',
                    'roidata','dcodata','prdata','oadata'
                ];
                foreach($rowdata as $row){
                    $rdata       = $this->c1model->getvalues_s($row,$code,$dc1tID);
                    $data[$row]  = json_decode($rdata['question'], true);
                }
                echo view('pdfc1/AC7', $data);
                break;
            case 'AC8':
                $rowdata = [
                    'revp','revf','prop','prof','grop','grof','revpr','revfr','propr','profr','gropr','grofr','pcu','fcu','adjap','adjbp','adjcp','adjaf','adjbf','adjcf',
                    'aomp','aomf','justn45','pcur','fcur','mlpinfo','conplst','confnst','oirp','oirf','pmpp','pmpf','apmp','apmf','conplst2','confnst2',
                    'rsp','confnst','ctp','ctf','aest','aestp','aestf','rptp','rptf',
                    'itbd1','itbd1p','itbd1f','itbd2','itbd2p','itbd2f','itbd3','itbd3p','itbd3f','adja','adjb','adjc','itbdae1','itbdae2','itbdae3'
                ];
                foreach($rowdata as $row){
                    $data[$row] = $this->c1model->getvalues_s($row,$code,$dc1tID);
                }
                echo view('pdfc1/AC8', $data);
                break;
            case 'AC9':
                $rdata        = $this->c1model->getvalues_s('ac9data',$code,$dc1tID);
                $data['ac9']  = json_decode($rdata['question'], true);
                echo view('pdfc1/AC9', $data);
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
                $data['cu']      = $this->c1model->getvalues_s($s[1].'cu',$s[0],$dc1tID);
                $data['ac10s1']  = $this->c1model->getac10data($s[1],$s[0],$dc1tID,'section1');
                $data['ac10s2']  = $this->c1model->getac10data($s[1],$s[0],$dc1tID,'section2');
                echo view('pdfc1/AC10', $data);
                break;
            case 'AC10-Summary':
                $s = explode('-', $code);
                $data ['sheet']     = $s[1];
                $data['code']       = $s[0];
                $data['nmk_tgb']    = $this->c1model->getdatacount($dc1tID,'Tangibles');
                $data['nmk_ppe']    = $this->c1model->getdatacount($dc1tID,'PPE');
                $data['nmk_invmt']  = $this->c1model->getdatacount($dc1tID,'Investments');
                $data['nmk_invtr']  = $this->c1model->getdatacount($dc1tID,'Inventory');
                $data['nmk_tr']     = $this->c1model->getdatacount($dc1tID,'Trade Receivables');
                $data['nmk_or']     = $this->c1model->getdatacount($dc1tID,'Other Receivables');
                $data['nmk_bac']    = $this->c1model->getdatacount($dc1tID,'Bank and Cash');
                $data['nmk_tp']     = $this->c1model->getdatacount($dc1tID,'Trade Payables');
                $data['nmk_op']     = $this->c1model->getdatacount($dc1tID,'Other Payables');
                $data['nmk_prov']   = $this->c1model->getdatacount($dc1tID,'Provisions');
                $data['nmk_rev']    = $this->c1model->getdatacount($dc1tID,'Revenue');
                $data['nmk_cst']    = $this->c1model->getdatacount($dc1tID,'Costs');
                $data['nmk_pr']     = $this->c1model->getdatacount($dc1tID,'Payroll');
                $data['vop_tgb']    = $this->c1model->getsumation($dc1tID,'Tangibles');
                $data['vop_ppe']    = $this->c1model->getsumation($dc1tID,'PPE');
                $data['vop_invmt']  = $this->c1model->getsumation($dc1tID,'Investments');
                $data['vop_invtr']  = $this->c1model->getsumation($dc1tID,'Inventory');
                $data['vop_tr']     = $this->c1model->getsumation($dc1tID,'Trade Receivables');
                $data['vop_or']     = $this->c1model->getsumation($dc1tID,'Other Receivables');
                $data['vop_bac']    = $this->c1model->getsumation($dc1tID,'Bank and Cash');
                $data['vop_tp']     = $this->c1model->getsumation($dc1tID,'Trade Payables');
                $data['vop_op']     = $this->c1model->getsumation($dc1tID,'Other Payables');
                $data['vop_prov']   = $this->c1model->getsumation($dc1tID,'Provisions');
                $data['vop_rev']    = $this->c1model->getsumation($dc1tID,'Revenue');
                $data['vop_cst']    = $this->c1model->getsumation($dc1tID,'Costs');
                $data['vop_pr']     = $this->c1model->getsumation($dc1tID,'Payroll');
                $data['mat']        = $this->c1model->getvalues_s('material',$s[0],$dc1tID);
                $rowdata            = ['tgb','ppe','invmt','invtr','tr','or','bac','tp','op','prov','rev','cst','pr'];
                foreach($rowdata as $row){
                    $rdata       = $this->c1model->getvalues_s($row.'data',$s[0],$dc1tID);
                    $data[$row]  = json_decode($rdata['question'], true);
                }
                echo view('pdfc1/AC10Summ', $data);
                break;
            case 'AC11':
                $rdata = $this->c1model->getvalues_s('ac11data',$code,$dc1tID);
                $data['ac11'] = json_decode($rdata['question'], true);
                echo view('pdfc1/AC11', $data);
                break;
            default:
            break;
        }

    }


    /** 
        ----------------------------------------------------------
        PDF VIEW CHAPTER 2
        ----------------------------------------------------------
        * @method viewc2pdf() used to generate a pdf file of Chapter 2
        * @param code consists of file code
        * @param c2tID encrypted of title id
        * @var dc2tID decrypted id of @param c2tID
        * @param array-data consist the data from database to display on the page
          THE VIEWS ARE DYNAMICALLY DISPLAYED BASED ON THE @param code RESULT ON THE SWITCH CONDITION
        * @return pdf-view
    */
    public function viewc2pdf($code,$c2tID){

        $data['title']  = $code;
        $data['c2tID']  = $c2tID;
        $data['code']   = $code;
        $dc2tID         = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID));
        switch ($code) {
            case '2.1 B2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/B2', $data);
                break;
            case '2.2.1 C2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/C2', $data);
                break;
            case '2.2.2 C2-1':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/C2-1', $data);
                break;
            case '2.3 D2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/D2', $data);
                break;
            case '2.4.1 E2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/E2', $data);
                break;
            case '2.4.2 E2-1':
                $data['aicpppa'] = $this->c2model->getquestionsaicpppa($code,$dc2tID);
                $data['rcicp'] = $this->c2model->getquestionsrcicp($code,$dc2tID);
                echo view('pdfc2/E2-1', $data);
                break;
            case '2.4.3 E2-2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/E2-2', $data);
                break;
            case '2.4.4 E2-3':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/E2-3', $data);
                break;
            case '2.4.5 E2-4':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/E2-4', $data);
                break;
            case '2.5 F2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/F2', $data);
                break;
            case '2.6 H2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/H2', $data);
                break;
            case '2.7 I2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/I2', $data);
                break;
            case '2.8 J2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/J2', $data);
                break;
            case '2.9 K2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/K2', $data);
                break;
            case '2.10 L2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/L2', $data);
                break;
            case '2.11 M2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/M2', $data);
                break;
            case '2.12 N2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/N2', $data);
                break;
            case '2.13.1 O2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/O2', $data);
                break;
            case '2.13.2 O2-1':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/O2-1', $data);
                break;
            case '2.14 P2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/P2', $data);
                break;
            case '2.15 Q2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/Q2', $data);
                break;  
            case '2.16 R2-1':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/R2-1', $data);
                break;  
            case '2.17 R2-2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/R2-2', $data);
                break;  
            case '2.18.1 S2-1':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/S2-1', $data);
                break;  
            case '2.18.2 S2-2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/S2-2', $data);
                break; 
            case '2.18.3 S2-3':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/S2-3', $data);
                break;  
            case '2.18.4 S2-4':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/S2-4', $data);
                break; 
            case '2.19.1 U2-1':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/U2-1', $data);
                break;   
            case '2.19.2 U2-2':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/U2-2', $data);
                break; 
            case '2.19.3 U2-3':
                $data['qdata'] = $this->c2model->getquestionsdata($code,$dc2tID);
                echo view('pdfc2/U2-3', $data);
                break;   
            default:
                break;
        }

    }


    /** 
        ----------------------------------------------------------
        PDF VIEW CHAPTER 3
        ----------------------------------------------------------
        * @method viewc3pdf() used to generate a pdf file of Chapter 3
        * @param code consists of file code
        * @param c3tID encrypted of title id
        * @var dc3tID decrypted id of @param c3tID
        * @var rdata contains raw json data from database
        * @param array-data consist the data from database to display on the page
          THE VIEWS ARE DYNAMICALLY DISPLAYED BASED ON THE @param code RESULT ON THE SWITCH CONDITION
        * @return pdf-view
    */
    public function viewc3pdf($code,$c3tID){

        $data['title']  = $code;
        $data['c3tID']  = $c3tID;
        $data['code']   = $code;
        $dc3tID         = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID));
        switch ($code) {
            case '3.1 Aa1':
                $data['datapl'] = $this->c3model->getaa1('planning',$code,$dc3tID);
                $data['dataaf'] = $this->c3model->getaa1('audit finalisation',$code,$dc3tID);
                $rdata = $this->c3model->getaa1s3($code, $dc3tID);
                $data['s3'] = json_decode($rdata['question'], true);
                echo view('pdfc3/AA1', $data);
                break;
            case '3.2 Aa2':
                $rdata = $this->c3model->getaa2data($code, $dc3tID);
                $data['aa2'] = json_decode($rdata['question'], true);
                echo view('pdfc3/AA2', $data);
                break;
            case '3.3 Aa3a':
                $data['cr']     = $this->c3model->getaa3('cr',$code,$dc3tID);
                $data['dc']     = $this->c3model->getaa3('dc',$code,$dc3tID);
                $data['faf']    = $this->c3model->getaa3('faf',$code,$dc3tID);
                $data['ir']     = $this->c3model->getaa3air($code,$dc3tID);
                echo view('pdfc3/AA3A', $data);
                break;
            case '3.4 Aa3b':
                $data['bp1']    = $this->c3model->getaa3b('p1',$code,$dc3tID);
                $data['bp2']    = $this->c3model->getaa3b('p2',$code,$dc3tID);
                $data['bp3a']   = $this->c3model->getaa3b('p3a',$code,$dc3tID);
                $data['bp3b']   = $this->c3model->getaa3b('p3b',$code,$dc3tID);
                $rdata          = $this->c3model->getaa3bp4($code,$dc3tID);
                $data['bp4']    = json_decode($rdata['question'], true);
                echo view('pdfc3/AA3B', $data);
                break;
            case '3.5 Aa4':
                $rdata          = $this->c3model->getaa4($code,$dc3tID);
                $data['aa4']    = json_decode($rdata['question'], true);
                echo view('pdfc3/AA4', $data);
                break;
            case '3.6.1 Aa5a':
                echo view('pdfc3/AA5A', $data);
                break;
            case '3.6.2 Aa5b':
                $data['aa5b'] = $this->c3model->getaa5b($code,$dc3tID);
                echo view('pdfc3/AA5B', $data);
                break;  
            case '3.7 Aa7':
                $data['aa7']    = $this->c3model->getaa7('isa315',$code,$dc3tID);
                $data['cons']   = $this->c3model->getaa7('consultation',$code,$dc3tID);
                $data['inc']    = $this->c3model->getaa7('inconsistencies',$code,$dc3tID);
                $data['ref']    = $this->c3model->getaa7('refusal',$code,$dc3tID);
                $data['dep']    = $this->c3model->getaa7('departures',$code,$dc3tID);
                $data['oth']    = $this->c3model->getaa7('other',$code,$dc3tID);
                $data['aepapp'] = $this->c3model->getaa7aep('aepapp',$code,$dc3tID);
                $rdata          = $this->c3model->getaa7aep('aep',$code,$dc3tID);
                $data['aep']    = json_decode($rdata['question'], true);
                echo view('pdfc3/AA7', $data);
                break;
            case '3.8 Aa10':
                $rdata = $this->c3model->getaa10($code,$dc3tID);
                $data['aa10'] = json_decode($rdata['question'], true);
                echo view('pdfc3/AA10', $data);
                break;
            case '3.9':
                echo view('pdfc3/39', $data);
                break;
            case '3.10 Aa11-un':
                $s = explode('-', $code);
                $data['aef']    = $this->c3model->getaa11p2('aef',$s[0],$dc3tID);
                $data['aej']    = $this->c3model->getaa11p2('aej',$s[0],$dc3tID);
                $data['ee']     = $this->c3model->getaa11p2('ee',$s[0],$dc3tID);
                $data['de']     = $this->c3model->getaa11p2('de',$s[0],$dc3tID);
                $rdata          = $this->c3model->getaa11p1('aa11ue',$s[0],$dc3tID);
                $data['ue']     = json_decode($rdata['question'], true);
                $rdata2         = $this->c3model->getaa11con('con',$s[0],$dc3tID);
                $data['con']    = json_decode($rdata2['question'], true);    
                echo view('pdfc3/AA11-un', $data);
            case '3.10 Aa11-ad':
                $s = explode('-', $code);
                $data['ad'] = $this->c3model->getaa11p2('ad',$s[0],$dc3tID);
                $rdata = $this->c3model->getaa11p1('aa11uead',$s[0],$dc3tID);
                $data['ue'] = json_decode($rdata['question'], true);   
                $s = explode('-', $code);
                echo view('pdfc3/AA11-ad', $data);
                break;   
            case '3.11':
                $rdata          = $this->c3model->get311($code,$dc3tID);
                $data['arf']    = json_decode($rdata['question'], true);
                echo view('pdfc3/311', $data);
                break;   
            case '3.12':
                echo view('pdfc3/312', $data);
                break;   
            case '3.13 Ab1':
                $data['ab1'] = $this->c3model->getab1($code,$dc3tID);
                echo view('pdfc3/AB1', $data);
                break;   
            case '3.14 Ab3':
                $rdata = $this->c3model->getab3($code,$dc3tID);
                $data['ab3'] = json_decode($rdata['question'], true);
                echo view('pdfc3/AB3', $data);
                break; 
            case '3.15 Ab4':
                $rdata = $this->c3model->getab4checklist('checklist',$code,$dc3tID);
                $data['sec']  = json_decode($rdata['question'], true);
                $data['sec1'] = $this->c3model->getab4('section1',$code,$dc3tID);
                $data['sec2'] = $this->c3model->getab4('section2',$code,$dc3tID);
                $data['sec3'] = $this->c3model->getab4('section3',$code,$dc3tID);
                $data['sec4'] = $this->c3model->getab4('section4',$code,$dc3tID);
                $data['sec5'] = $this->c3model->getab4('section5',$code,$dc3tID);
                $data['sec6'] = $this->c3model->getab4('section6',$code,$dc3tID);
                $data['sec7'] = $this->c3model->getab4('section7',$code,$dc3tID);
                $data['sec8'] = $this->c3model->getab4('section8',$code,$dc3tID);
                $data['sec9'] = $this->c3model->getab4('section9',$code,$dc3tID);
                echo view('pdfc3/AB4', $data);
                break; 
            case '3.15.1 Ab4a':
                $data['ab4a'] = $this->c3model->getab4a('ab4a',$code,$dc3tID);
                echo view('pdfc3/AB4A', $data);
                break; 
            case '3.15.2 Ab4b':
                $data['ab4b'] = $this->c3model->getab4a('ab4b',$code,$dc3tID);
                echo view('pdfc3/AB4B', $data);
                break; 
            case '3.15.3 Ab4c':
                $data['ab4c'] = $this->c3model->getab4a('ab4c',$code,$dc3tID);
                echo view('pdfc3/AB4C', $data);
                break; 
            case '3.15.4 Ab4d':
                $data['ab4d'] = $this->c3model->getab4a('ab4d',$code,$dc3tID);
                echo view('pdfc3/AB4D', $data);
                break; 
            case '3.15.5 Ab4e':
                $data['ab4e'] = $this->c3model->getab4a('ab4e',$code,$dc3tID);
                echo view('pdfc3/AB4E', $data);
                break; 
            case '3.15.6 Ab4f':
                $data['ab4f'] = $this->c3model->getab4a('ab4f',$code,$dc3tID);
                echo view('pdfc3/AB4F', $data);
                break; 
            case '3.15.7 Ab4g':
                $data['ab4g'] = $this->c3model->getab4a('ab4g',$code,$dc3tID);
                echo view('pdfc3/AB4G', $data);
                break; 
            case '3.15.8 Ab4h':
                $data['ab4h'] = $this->c3model->getab4a('ab4h',$code,$dc3tID);
                echo view('pdfc3/AB4H', $data);
                break; 
            default:
                break;
        }

    }


    /** 
        ----------------------------------------------------------
        CHAPTER 1 VALUES
        ----------------------------------------------------------
        * @method c1setvalues() used view the default values file of Chapter 1
        * @param code consists of file code
        * @param c1tID encrypted of title id
        * @param cID encrypted of client id
        * @param name client name
        * @var dc1tID decrypted id of @param c1tID
        * @var rdata contains raw json data from database
        * @param array-data consist the data from database to display on the page
          THE VIEWS ARE DYNAMICALLY DISPLAYED BASED ON THE @param code RESULT ON THE SWITCH CONDITION
        * @return pdf-view
    */
    public function c1setvalues($code,$c1tID,$cID,$name){

        $data['title']  = $code. ' - Chapter 1 Management';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['c1tID']  = $c1tID;
        $data['code']   = $code;
        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dc1tID         = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID));
        switch ($code) {
            case 'AC1':
                $data['ac1']    = $this->cvmodel->getac1($code,$dc1tID,$dcID);
                $rdata          = $this->cvmodel->getac1eqr($code,$dc1tID,$dcID);
                $data['eqr']    = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac1', $data);
                echo view('includes/Footer');
                break;
            case 'AC2':
                $data['ac2'] = $this->cvmodel->getac2($code,$dc1tID,$dcID);
                $data['aep'] = $this->cvmodel->getac2aep($code,$dc1tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac2', $data);
                echo view('includes/Footer');
                break;
            case 'AC3':
                $data['ac3genmat']      = $this->cvmodel->getac3('genmat',$code,$dc1tID,$dcID);
                $data['ac3doccors']     = $this->cvmodel->getac3('doccors',$code,$dc1tID,$dcID);
                $data['ac3statutory']   = $this->cvmodel->getac3('statutory',$code,$dc1tID,$dcID);
                $data['ac3accsys']      = $this->cvmodel->getac3('accsys',$code,$dc1tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac3', $data);
                echo view('includes/Footer');
                break;
            case 'AC4':
                $data['ac4']    = $this->cvmodel->getac4($code,$dc1tID,$dcID);
                $rdata          = $this->cvmodel->getac4ppr($code,$dc1tID,$dcID);
                $data['ppr']    = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac4', $data);
                echo view('includes/Footer');
                break;
            case 'AC5':
                $rdata          = $this->cvmodel->getac5($code,$dc1tID,$dcID);
                $data['rc']     = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac5', $data);
                echo view('includes/Footer');
                break;
            case 'AC6':
                $data['ac6']    = $this->cvmodel->getac6('ac6ra',$code,$dc1tID,$dcID);
                $rdata          = $this->cvmodel->gets12($code,$dc1tID,$dcID);
                $data['s']      = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                $data['s3']     = $this->cvmodel->getac6('ac6s3',$code,$dc1tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac6', $data);
                echo view('includes/Footer');
                break;
            case 'AC7':
                $rowdata = [
                    'bacdata','trdata','ordata','invtrdata','invmtdata','ppedata','incadata','tpdata','opdata','taxdata','provdata',
                    'roidata','dcodata','prdata','oadata'
                ];
                foreach($rowdata as $row){
                    $rdata = $this->cvmodel->getac7($code,$dc1tID, $row,$dcID);
                    $data[$row] = json_decode($rdata['question'], true);
                }
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac7', $data);
                echo view('includes/Footer');
                break;
            case 'AC8':
                $rowdata = [
                    'revp','revf','prop','prof','grop','grof','revpr','revfr','propr','profr','gropr','grofr','pcu','fcu','adjap','adjbp','adjcp','adjaf','adjbf','adjcf',
                    'aomp','aomf','justn45','pcur','fcur','mlpinfo','conplst','confnst','oirp','oirf','pmpp','pmpf','apmp','apmf','conplst2','confnst2',
                    'rsp','confnst','ctp','ctf','aest','aestp','aestf','rptp','rptf',
                    'itbd1','itbd1p','itbd1f','itbd2','itbd2p','itbd2f','itbd3','itbd3p','itbd3f','adja','adjb','adjc','itbdae1','itbdae2','itbdae3'
                ];
                foreach($rowdata as $row){
                    $data[$row] = $this->cvmodel->getac8($code,$dc1tID,$row,$dcID);
                }
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac8', $data);
                echo view('includes/Footer');
                break;
            case 'AC9':
                $rdata = $this->cvmodel->getac9data($code,$dc1tID,$dcID);
                $data['ac9'] = json_decode($rdata['question'], true);
                $data['acID'] = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac9', $data);
                echo view('includes/Footer');
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
                $data['cu']         = $this->cvmodel->getac10cu($dc1tID,$s[1].'cu',$dcID);
                $data['ac10s1']     = $this->cvmodel->getac10s1data($dc1tID,$s[1],$dcID);
                $data['ac10s2']     = $this->cvmodel->getac10s2data($dc1tID,$s[1],$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac10', $data);
                echo view('includes/Footer');
                break;
            case 'AC10-Summary':
                $s = explode('-', $code);
                $data ['sheet']     = $s[1];
                $data['code']       = $s[0];
                $data['nmk_tgb']    = $this->cvmodel->getdatacount($dc1tID,'Tangibles',$dcID);
                $data['nmk_ppe']    = $this->cvmodel->getdatacount($dc1tID,'PPE',$dcID);
                $data['nmk_invmt']  = $this->cvmodel->getdatacount($dc1tID,'Investments',$dcID);
                $data['nmk_invtr']  = $this->cvmodel->getdatacount($dc1tID,'Inventory',$dcID);
                $data['nmk_tr']     = $this->cvmodel->getdatacount($dc1tID,'Trade Receivables',$dcID);
                $data['nmk_or']     = $this->cvmodel->getdatacount($dc1tID,'Other Receivables',$dcID);
                $data['nmk_bac']    = $this->cvmodel->getdatacount($dc1tID,'Bank and Cash',$dcID);
                $data['nmk_tp']     = $this->cvmodel->getdatacount($dc1tID,'Trade Payables',$dcID);
                $data['nmk_op']     = $this->cvmodel->getdatacount($dc1tID,'Other Payables',$dcID);
                $data['nmk_prov']   = $this->cvmodel->getdatacount($dc1tID,'Provisions',$dcID);
                $data['nmk_rev']    = $this->cvmodel->getdatacount($dc1tID,'Revenue',$dcID);
                $data['nmk_cst']    = $this->cvmodel->getdatacount($dc1tID,'Costs',$dcID);
                $data['nmk_pr']     = $this->cvmodel->getdatacount($dc1tID,'Payroll',$dcID);
                $data['vop_tgb']    = $this->cvmodel->getsumation($dc1tID,'Tangibles',$dcID);
                $data['vop_ppe']    = $this->cvmodel->getsumation($dc1tID,'PPE',$dcID);
                $data['vop_invmt']  = $this->cvmodel->getsumation($dc1tID,'Investments',$dcID);
                $data['vop_invtr']  = $this->cvmodel->getsumation($dc1tID,'Inventory',$dcID);
                $data['vop_tr']     = $this->cvmodel->getsumation($dc1tID,'Trade Receivables',$dcID);
                $data['vop_or']     = $this->cvmodel->getsumation($dc1tID,'Other Receivables',$dcID);
                $data['vop_bac']    = $this->cvmodel->getsumation($dc1tID,'Bank and Cash',$dcID);
                $data['vop_tp']     = $this->cvmodel->getsumation($dc1tID,'Trade Payables',$dcID);
                $data['vop_op']     = $this->cvmodel->getsumation($dc1tID,'Other Payables',$dcID);
                $data['vop_prov']   = $this->cvmodel->getsumation($dc1tID,'Provisions',$dcID);
                $data['vop_rev']    = $this->cvmodel->getsumation($dc1tID,'Revenue',$dcID);
                $data['vop_cst']    = $this->cvmodel->getsumation($dc1tID,'Costs',$dcID);
                $data['vop_pr']     = $this->cvmodel->getsumation($dc1tID,'Payroll',$dcID);
                $data['mat']        = $this->cvmodel->getsummarydata($dc1tID,'material',$dcID);
                $rowdata            = ['tgb','ppe','invmt','invtr','tr','or','bac','tp','op','prov','rev','cst','pr'];
                foreach($rowdata as $row){
                    $rdata = $this->cvmodel->getsummarydata($dc1tID, $row,$dcID);
                    $data[$row] = json_decode($rdata['question'], true);
                }
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac10-Summary', $data);
                echo view('includes/Footer');
                break;
            case 'AC11':
                $rdata = $this->cvmodel->getac11data($code,$dc1tID,$dcID);
                $data['ac11'] = json_decode($rdata['question'], true);
                $data['acID'] = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter1/Ac11', $data);
                echo view('includes/Footer');
                break;
            default:
            break;
        }

    }


    /** 
        ----------------------------------------------------------
        CHAPTER 2 VALUES
        ----------------------------------------------------------
        * @method c2setvalues() used view the default values file of Chapter 2
        * @param code consists of file code
        * @param c2tID encrypted of title id
        * @param cID encrypted of client id
        * @param name client name
        * @var dc2tID decrypted id of @param c2tID
        * @param array-data consist the data from database to display on the page
          THE VIEWS ARE DYNAMICALLY DISPLAYED BASED ON THE @param code RESULT ON THE SWITCH CONDITION
        * @return pdf-view
    */
    public function c2setvalues($code,$c2tID,$cID,$name){

        $data['title']  = $code. ' - Chapter 2 Management';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['c2tID']  = $c2tID;
        $data['code']   = $code;
        $dcID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dc2tID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID));
        switch ($code) {
            case '2.1 B2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/21B2', $data);
                echo view('includes/Footer');
                break;
            case '2.2.1 C2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/221C2', $data);
                echo view('includes/Footer');
                break;
            case '2.2.2 C2-1':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/222C21', $data);
                echo view('includes/Footer');
                break;
            case '2.3 D2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/23D2', $data);
                echo view('includes/Footer');
                break;
            case '2.4.1 E2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/241E2', $data);
                echo view('includes/Footer');
                break;
            case '2.4.2 E2-1':
                $data['aicpppa'] = $this->cvmodel->getquestionsaicpppa($code,$dc2tID,$dcID);
                $data['rcicp'] = $this->cvmodel->getquestionsrcicp($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/242E21', $data);
                echo view('includes/Footer');
                break;
            case '2.4.3 E2-2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/243E22', $data);
                echo view('includes/Footer');
                break;
            case '2.4.4 E2-3':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/243E23', $data);
                echo view('includes/Footer');
                break;
            case '2.4.5 E2-4':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/245E24', $data);
                echo view('includes/Footer');
                break;
            case '2.5 F2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/25F2', $data);
                echo view('includes/Footer');
                break;
            case '2.6 H2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/26H2', $data);
                echo view('includes/Footer');
                break;
            case '2.7 I2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/27I2', $data);
                echo view('includes/Footer');
                break;
            case '2.8 J2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/28J2', $data);
                echo view('includes/Footer');
                break;
            case '2.9 K2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/29K2', $data);
                echo view('includes/Footer');
                break;
            case '2.10 L2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/210L2', $data);
                echo view('includes/Footer');
                break;
            case '2.11 M2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/211M2', $data);
                echo view('includes/Footer');
                break;
            case '2.12 N2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/212N2', $data);
                echo view('includes/Footer');
                break;
            case '2.13.1 O2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/2131O2', $data);
                echo view('includes/Footer');
                break;
            case '2.13.2 O2-1':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/2132O21', $data);
                echo view('includes/Footer');
                break;
            case '2.14 P2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/214P2', $data);
                echo view('includes/Footer');
                break;
            case '2.15 Q2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/215Q2', $data);
                echo view('includes/Footer');
                break;  
            case '2.16 R2-1':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/216R21', $data);
                echo view('includes/Footer');
                break;  
            case '2.17 R2-2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/217R22', $data);
                echo view('includes/Footer');
                break;  
            case '2.18.1 S2-1':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/2181S21', $data);
                echo view('includes/Footer');
                break;  
            case '2.18.2 S2-2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/2182S22', $data);
                echo view('includes/Footer');
                break; 
            case '2.18.3 S2-3':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/2183S23', $data);
                echo view('includes/Footer');
                break;  
            case '2.18.4 S2-4':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/2184S24', $data);
                echo view('includes/Footer');
                break; 
            case '2.19.1 U2-1':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/2191U21', $data);
                echo view('includes/Footer');
                break;   
            case '2.19.2 U2-2':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/2192U22', $data);
                echo view('includes/Footer');
                break; 
            case '2.19.3 U2-3':
                $data['qdata'] = $this->cvmodel->getquestionsdata($code,$dc2tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter2/2193U23', $data);
                echo view('includes/Footer');
                break;   
            default:
                break;
        }

    }


    /** 
        ----------------------------------------------------------
        CHAPTER 3 VALUES
        ----------------------------------------------------------
        * @method c3setvalues() used view the default values file of Chapter 3
        * @param code consists of file code
        * @param c3tID encrypted of title id
        * @param cID encrypted of client id
        * @param name client name
        * @var dc3tID decrypted id of @param c3tID
        * @var rdata contains raw json data from database
        * @param array-data consist the data from database to display on the page
          THE VIEWS ARE DYNAMICALLY DISPLAYED BASED ON THE @param code RESULT ON THE SWITCH CONDITION
        * @return pdf-view
    */
    public function c3setvalues($code,$c3tID,$cID,$name){

        $data['title']  = $code. ' - Chapter 3 Management';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['c3tID']  = $c3tID;
        $data['code']   = $code;
        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dc3tID         = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID));
        switch ($code) {
            case '3.1 Aa1':
                $data['datapl'] = $this->cvmodel->getaa1('planning',$code,$dc3tID,$dcID);
                $data['dataaf'] = $this->cvmodel->getaa1('audit finalisation',$code,$dc3tID,$dcID);
                $rdata          = $this->cvmodel->getaa1s3($code, $dc3tID,$dcID);
                $data['s3']     = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter3/31Aa1', $data);
                echo view('includes/Footer');
                break;
            case '3.2 Aa2':
                $rdata          = $this->cvmodel->getaa2data($code, $dc3tID,$dcID);
                $data['aa2']    = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter3/32Aa2', $data);
                echo view('includes/Footer');
                break;
            case '3.3 Aa3a':
                $data['cr']     = $this->cvmodel->getaa3('cr',$code,$dc3tID,$dcID);
                $data['dc']     = $this->cvmodel->getaa3('dc',$code,$dc3tID,$dcID);
                $data['faf']    = $this->cvmodel->getaa3('faf',$code,$dc3tID,$dcID);
                $data['ir']     = $this->cvmodel->getaa3air($code,$dc3tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter3/33Aa3a', $data);
                echo view('includes/Footer');
                break;
            case '3.4 Aa3b':
                $data['bp1']    = $this->cvmodel->getaa3b('p1',$code,$dc3tID,$dcID);
                $data['bp2']    = $this->cvmodel->getaa3b('p2',$code,$dc3tID,$dcID);
                $data['bp3a']   = $this->cvmodel->getaa3b('p3a',$code,$dc3tID,$dcID);
                $data['bp3b']   = $this->cvmodel->getaa3b('p3b',$code,$dc3tID,$dcID);
                $rdata          = $this->cvmodel->getaa3bp4($code,$dc3tID,$dcID);
                $data['bp4']    = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter3/34Aa3b', $data);
                echo view('includes/Footer');
                break;
            case '3.5 Aa4':
                $rdata          = $this->cvmodel->getaa4($code,$dc3tID,$dcID);
                $data['aa4']    = json_decode($rdata['question'], true);
                echo view('includes/Header', $data);
                echo view('client/chapter3/35Aa4', $data);
                echo view('includes/Footer');
                break;
            case '3.6.1 Aa5a':
                echo view('includes/Header', $data);
                echo view('client/chapter3/361Aa5a', $data);
                echo view('includes/Footer');
                break;
            case '3.6.2 Aa5b':
                $data['aa5b'] = $this->cvmodel->getaa5b($code,$dc3tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter3/362Aa5b', $data);
                echo view('includes/Footer');
                break;  
            case '3.7 Aa7':
                $data['aa7']    = $this->cvmodel->getaa7('isa315',$code,$dc3tID,$dcID);
                $data['cons']   = $this->cvmodel->getaa7('consultation',$code,$dc3tID,$dcID);
                $data['inc']    = $this->cvmodel->getaa7('inconsistencies',$code,$dc3tID,$dcID);
                $data['ref']    = $this->cvmodel->getaa7('refusal',$code,$dc3tID,$dcID);
                $data['dep']    = $this->cvmodel->getaa7('departures',$code,$dc3tID,$dcID);
                $data['oth']    = $this->cvmodel->getaa7('other',$code,$dc3tID,$dcID);
                $data['aepapp'] = $this->cvmodel->getaa7aep('aepapp',$code,$dc3tID,$dcID);
                $rdata          = $this->cvmodel->getaa7aep('aep',$code,$dc3tID,$dcID);
                $data['aep']    = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter3/37Aa7', $data);
                echo view('includes/Footer');
                break;
            case '3.8 Aa10':
                $rdata          = $this->cvmodel->getaa10($code,$dc3tID,$dcID);
                $data['aa10']   = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter3/38Aa10', $data);
                echo view('includes/Footer');
                break;
            case '3.9':
                echo view('includes/Header', $data);
                echo view('client/chapter3/39', $data);
                echo view('includes/Footer');
                break;
            case '3.10 Aa11-un':
                $s                      = explode('-', $code);
                $data['sectiontitle']   = "SUMMARY OF UNADJUSTED ERRORS";
                $data['aef']            = $this->cvmodel->getaa11p2('aef',$s[0],$dc3tID,$dcID);
                $data['aej']            = $this->cvmodel->getaa11p2('aej',$s[0],$dc3tID,$dcID);
                $data['ee']             = $this->cvmodel->getaa11p2('ee',$s[0],$dc3tID,$dcID);
                $data['de']             = $this->cvmodel->getaa11p2('de',$s[0],$dc3tID,$dcID);
                $rdata                  = $this->cvmodel->getaa11p('aa11ue',$s[0],$dc3tID,$dcID);
                $data['ue']             = json_decode($rdata['question'], true);    
                $data['ueacID']         = $this->crypt->encrypt($rdata['acID']);
                $rdata2                 = $this->cvmodel->getaa11p('con',$s[0],$dc3tID,$dcID);
                $data['con']            = json_decode($rdata2['question'], true);   
                $data['conacID']        = $this->crypt->encrypt($rdata2['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter3/310Aa11_un', $data); 
                echo view('includes/Footer');
                break;   
            case '3.10 Aa11-ad':
                $s                      = explode('-', $code);
                $data['sectiontitle']   = "SUMMARY OF ADJUSTMENTS MADE TO THE CLIENT'S FINANCIAL STATEMENTS";
                $data['ad']             = $this->cvmodel->getaa11p2('ad',$s[0],$dc3tID,$dcID);
                $rdata                  = $this->cvmodel->getaa11p('aa11uead',$s[0],$dc3tID,$dcID);
                $data['ue']             = json_decode($rdata['question'], true);    
                $data['ueacID']         = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter3/310Aa11_ad', $data);
                echo view('includes/Footer');
                break;   
            case '3.11':
                $rdata          = $this->cvmodel->get311($code,$dc3tID,$dcID);
                $data['arf']    = json_decode($rdata['question'], true);
                echo view('includes/Header', $data);
                echo view('client/chapter3/311', $data);
                echo view('includes/Footer');
                break;   
            case '3.12':
                echo view('includes/Header', $data);
                echo view('client/chapter3/312', $data);
                echo view('includes/Footer');
                break;   
            case '3.13 Ab1':
                $data['ab1'] = $this->cvmodel->getab1($code,$dc3tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter3/313Ab1', $data);
                echo view('includes/Footer');
                break;   
            case '3.14 Ab3':
                $rdata = $this->cvmodel->getab3($code,$dc3tID ,$dcID);
                $data['ab3'] = json_decode($rdata['question'], true);
                $data['acID'] = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('client/chapter3/314Ab3', $data);
                echo view('includes/Footer');
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
                $s = explode('-', $code);
                switch ($s[1]) {
                    case 'checklist':$data['sectiontitle']  = 'CORPORATE DISCLOSURE CHECKLIST (IFRS)';break;
                    case 'section1':$data['sectiontitle']   = 'Format of the Annual Report and Generic Information';break;
                    case 'section2':$data['sectiontitle']   = 'Directors Report (Review of the Business) ~ Best Practice Disclosures';break;
                    case 'section3':$data['sectiontitle']   = 'Directors Report ~ Best Practice Disclosures';break;
                    case 'section4':$data['sectiontitle']   = 'Statement of Comprehensive Income (SCI) and Related Notes';break;
                    case 'section5':$data['sectiontitle']   = 'Statement of Changes in Equity';break;
                    case 'section6':$data['sectiontitle']   = 'Statement of Financial Position and Related Notes';break;
                    case 'section7':$data['sectiontitle']   = 'Statement of Cash Flows';break;
                    case 'section8':$data['sectiontitle']   = 'Accounting Policies and Estimation Techniques';break;
                    case 'section9':$data['sectiontitle']   = 'Notes and Other Disclosures';break;
                }
                $data['title']      = $code. ' - Chapter 3 Management';
                $data['section']    = $s[1];
                $data['c3tID']      = $c3tID;
                $data['code']       = $code;
                if($s[1] == "checklist"){
                    $rdata = $this->cvmodel->getab4checklist($s[1],$s[0],$dc3tID,$dcID);
                    $data['sec'] = json_decode($rdata['question'], true);
                    $data['acID'] = $this->crypt->encrypt($rdata['acID']);
                    echo view('includes/Header', $data);
                    echo view('client/chapter3/315Ab4_checklist', $data);
                    echo view('includes/Footer');
                }else{
                    $data['sec'] = $this->cvmodel->getab4($s[1],$s[0],$dc3tID,$dcID);
                    echo view('includes/Header', $data);
                    echo view('client/chapter3/315Ab4_section', $data);
                    echo view('includes/Footer');
                }
                break; 
            case '3.15.1 Ab4a':
                $data['ab4a'] = $this->cvmodel->getab4a('ab4a',$code,$dc3tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter3/3151Ab4a', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.2 Ab4b':
                $data['ab4b'] = $this->cvmodel->getab4a('ab4b',$code,$dc3tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter3/3152Ab4b', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.3 Ab4c':
                $data['ab4c'] = $this->cvmodel->getab4a('ab4c',$code,$dc3tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter3/3153Ab4c', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.4 Ab4d':
                $data['ab4d'] = $this->cvmodel->getab4a('ab4d',$code,$dc3tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter3/3154Ab4d', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.5 Ab4e':
                $data['ab4e'] = $this->cvmodel->getab4a('ab4e',$code,$dc3tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter3/3155Ab4e', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.6 Ab4f':
                $data['ab4f'] = $this->cvmodel->getab4a('ab4f',$code,$dc3tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter3/3156Ab4f', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.7 Ab4g':
                $data['ab4g'] = $this->cvmodel->getab4a('ab4g',$code,$dc3tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter3/3157Ab4g', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.8 Ab4h':
                $data['ab4h'] = $this->cvmodel->getab4a('ab4h',$code,$dc3tID,$dcID);
                echo view('includes/Header', $data);
                echo view('client/chapter3/3158Ab4h', $data);
                echo view('includes/Footer');
                break; 
            default:
                break;
        }

    }


    /** 
        ----------------------------------------------------------
        WORK PAPER CHAPTER 1 VALUES
        ----------------------------------------------------------
        * @method c1setworkpaper() used view the workpaper values file of Chapter 1
        * @param code consists of file code
        * @param c1tID encrypted of title id
        * @param cID encrypted of client id
        * @param wpID encrypted of work paper id
        * @param name client name
        * @var dc1tID decrypted id of @param c1tID
        * @var dcID decrypted id of @param cID
        * @var dwpID decrypted id of @param wpID
        * @var rdata contains raw json data from database
        * @param array-data consist the data from database to display on the page
          THE VIEWS ARE DYNAMICALLY DISPLAYED BASED ON THE @param code RESULT ON THE SWITCH CONDITION
        * @return view
    */
    public function c1setworkpaper($code,$c1tID,$cID,$wpID,$name){

        $data['title']  = $code. ' - Chapter 1 Management';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['wpID']   = $wpID;
        $data['c1tID']  = $c1tID;
        $data['code']   = $code;
        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dwpID          = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID));
        $dc1tID         = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID));
        switch ($code) {
            case 'AC1':
                $data['ac1']    = $this->wpmodel->getac1($code,$dc1tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getac1eqr($code,$dc1tID,$dcID,$dwpID);
                $data['eqr']    = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac1', $data);
                echo view('includes/Footer');
                break;
            case 'AC2':
                $data['ac2'] = $this->wpmodel->getac2($code,$dc1tID,$dcID,$dwpID);
                $data['aep'] = $this->wpmodel->getac2aep($code,$dc1tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac2', $data);
                echo view('includes/Footer');
                break;
            case 'AC3':
                $data['ac3genmat']      = $this->wpmodel->getac3('genmat',$code,$dc1tID,$dcID,$dwpID);
                $data['ac3doccors']     = $this->wpmodel->getac3('doccors',$code,$dc1tID,$dcID,$dwpID);
                $data['ac3statutory']   = $this->wpmodel->getac3('statutory',$code,$dc1tID,$dcID,$dwpID);
                $data['ac3accsys']      = $this->wpmodel->getac3('accsys',$code,$dc1tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac3', $data);
                echo view('includes/Footer');
                break;
            case 'AC4':
                $data['ac4']    = $this->wpmodel->getac4($code,$dc1tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getac4ppr($code,$dc1tID,$dcID,$dwpID);
                $data['ppr']    = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac4', $data);
                echo view('includes/Footer');
                break;
            case 'AC5':
                $rdata          = $this->wpmodel->getac5($code,$dc1tID,$dcID,$dwpID);
                $data['rc']     = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac5', $data);
                echo view('includes/Footer');
                break;
            case 'AC6':
                $data['ac6']    = $this->wpmodel->getac6('ac6ra',$code,$dc1tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->gets12($code,$dc1tID,$dcID,$dwpID);
                $data['s']      = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                $data['s3']     = $this->wpmodel->getac6('ac6s3',$code,$dc1tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac6', $data);
                echo view('includes/Footer');
                break;
            case 'AC7':
                $rowdata = [
                    'bacdata','trdata','ordata','invtrdata','invmtdata','ppedata','incadata','tpdata','opdata','taxdata','provdata',
                    'roidata','dcodata','prdata','oadata'
                ];
                foreach($rowdata as $row){
                    $rdata      = $this->wpmodel->getac7($code,$dc1tID,$row,$dcID,$dwpID);
                    $data[$row] = json_decode($rdata['question'], true);
                }
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac7', $data);
                echo view('includes/Footer');
                break;
            case 'AC8':
                $rowdata = [
                    'revp','revf','prop','prof','grop','grof','revpr','revfr','propr','profr','gropr','grofr','pcu','fcu','adjap','adjbp','adjcp','adjaf','adjbf','adjcf',
                    'aomp','aomf','justn45','pcur','fcur','mlpinfo','conplst','confnst','oirp','oirf','pmpp','pmpf','apmp','apmf','conplst2','confnst2',
                    'rsp','confnst','ctp','ctf','aest','aestp','aestf','rptp','rptf',
                    'itbd1','itbd1p','itbd1f','itbd2','itbd2p','itbd2f','itbd3','itbd3p','itbd3f','adja','adjb','adjc','itbdae1','itbdae2','itbdae3'
                ];
                foreach($rowdata as $row){
                    $data[$row] = $this->wpmodel->getac8($code,$dc1tID,$row,$dcID,$dwpID);
                }
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac8', $data);
                echo view('includes/Footer');
                break;
            case 'AC9':
                $rdata = $this->wpmodel->getac9data($code,$dc1tID,$dcID,$dwpID);
                $data['ac9'] = json_decode($rdata['question'], true);
                $data['acID'] = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac9', $data);
                echo view('includes/Footer');
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
                $s              = explode('-', $code);
                $data ['sheet'] = $s[1];
                $data['code']   = $s[0];
                $data['cu']     = $this->wpmodel->getac10cu($dc1tID,$s[1].'cu',$dcID,$dwpID);
                $data['ac10s1'] = $this->wpmodel->getac10s1data($dc1tID,$s[1],$dcID,$dwpID);
                $data['ac10s2'] = $this->wpmodel->getac10s2data($dc1tID,$s[1],$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac10', $data);
                echo view('includes/Footer');
                break;
            case 'AC10-Summary':
                $s                  = explode('-', $code);
                $data ['sheet']     = $s[1];
                $data['code']       = $s[0];
                $data['nmk_tgb']    = $this->wpmodel->getdatacount($dc1tID,'Tangibles',$dcID,$dwpID);
                $data['nmk_ppe']    = $this->wpmodel->getdatacount($dc1tID,'PPE',$dcID,$dwpID);
                $data['nmk_invmt']  = $this->wpmodel->getdatacount($dc1tID,'Investments',$dcID,$dwpID);
                $data['nmk_invtr']  = $this->wpmodel->getdatacount($dc1tID,'Inventory',$dcID,$dwpID);
                $data['nmk_tr']     = $this->wpmodel->getdatacount($dc1tID,'Trade Receivables',$dcID,$dwpID);
                $data['nmk_or']     = $this->wpmodel->getdatacount($dc1tID,'Other Receivables',$dcID,$dwpID);
                $data['nmk_bac']    = $this->wpmodel->getdatacount($dc1tID,'Bank and Cash',$dcID,$dwpID);
                $data['nmk_tp']     = $this->wpmodel->getdatacount($dc1tID,'Trade Payables',$dcID,$dwpID);
                $data['nmk_op']     = $this->wpmodel->getdatacount($dc1tID,'Other Payables',$dcID,$dwpID);
                $data['nmk_prov']   = $this->wpmodel->getdatacount($dc1tID,'Provisions',$dcID,$dwpID);
                $data['nmk_rev']    = $this->wpmodel->getdatacount($dc1tID,'Revenue',$dcID,$dwpID);
                $data['nmk_cst']    = $this->wpmodel->getdatacount($dc1tID,'Costs',$dcID,$dwpID);
                $data['nmk_pr']     = $this->wpmodel->getdatacount($dc1tID,'Payroll',$dcID,$dwpID);
                $data['vop_tgb']    = $this->wpmodel->getsumation($dc1tID,'Tangibles',$dcID,$dwpID);
                $data['vop_ppe']    = $this->wpmodel->getsumation($dc1tID,'PPE',$dcID,$dwpID);
                $data['vop_invmt']  = $this->wpmodel->getsumation($dc1tID,'Investments',$dcID,$dwpID);
                $data['vop_invtr']  = $this->wpmodel->getsumation($dc1tID,'Inventory',$dcID,$dwpID);
                $data['vop_tr']     = $this->wpmodel->getsumation($dc1tID,'Trade Receivables',$dcID,$dwpID);
                $data['vop_or']     = $this->wpmodel->getsumation($dc1tID,'Other Receivables',$dcID,$dwpID);
                $data['vop_bac']    = $this->wpmodel->getsumation($dc1tID,'Bank and Cash',$dcID,$dwpID);
                $data['vop_tp']     = $this->wpmodel->getsumation($dc1tID,'Trade Payables',$dcID,$dwpID);
                $data['vop_op']     = $this->wpmodel->getsumation($dc1tID,'Other Payables',$dcID,$dwpID);
                $data['vop_prov']   = $this->wpmodel->getsumation($dc1tID,'Provisions',$dcID,$dwpID);
                $data['vop_rev']    = $this->wpmodel->getsumation($dc1tID,'Revenue',$dcID,$dwpID);
                $data['vop_cst']    = $this->wpmodel->getsumation($dc1tID,'Costs',$dcID,$dwpID);
                $data['vop_pr']     = $this->wpmodel->getsumation($dc1tID,'Payroll',$dcID,$dwpID);
                $data['mat']        = $this->wpmodel->getsummarydata($dc1tID,'material',$dcID,$dwpID);
                $rowdata            = ['tgb','ppe','invmt','invtr','tr','or','bac','tp','op','prov','rev','cst','pr'];
                foreach($rowdata as $row){
                    $rdata = $this->wpmodel->getsummarydata($dc1tID, $row,$dcID,$dwpID);
                    $data[$row] = json_decode($rdata['question'], true);
                }
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac10-Summary', $data);
                echo view('includes/Footer');
                break;
            case 'AC11':
                $rdata = $this->wpmodel->getac11data($code,$dc1tID,$dcID,$dwpID);
                $data['ac11'] = json_decode($rdata['question'], true);
                $data['acID'] = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter1/Ac11', $data);
                echo view('includes/Footer');
                break;
            default:
            break;
        }

    }


    /** 
        ----------------------------------------------------------
        WORK PAPER CHAPTER 2 VALUES
        ----------------------------------------------------------
        * @method c2setworkpaper() used view the workpaper values file of Chapter 2
        * @param code consists of file code
        * @param c2tID encrypted of title id
        * @param cID encrypted of client id
        * @param wpID encrypted of work paper id
        * @param name client name
        * @var dc2tID decrypted id of @param c2tID
        * @var dcID decrypted id of @param cID
        * @var dwpID decrypted id of @param wpID
        * @param array-data consist the data from database to display on the page
          THE VIEWS ARE DYNAMICALLY DISPLAYED BASED ON THE @param code RESULT ON THE SWITCH CONDITION
        * @return view
    */
    public function c2setworkpaper($code,$c2tID,$cID,$wpID,$name){

        $data['title']  = $code. ' - Chapter 2 Management';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['wpID']   = $wpID;
        $data['c2tID']  = $c2tID;
        $data['code']   = $code;
        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dwpID          = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID));
        $dc2tID         = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID));
        switch ($code) {
            case '2.1 B2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/21B2', $data);
                echo view('includes/Footer');
                break;
            case '2.2.1 C2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/221C2', $data);
                echo view('includes/Footer');
                break;
            case '2.2.2 C2-1':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/222C21', $data);
                echo view('includes/Footer');
                break;
            case '2.3 D2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/23D2', $data);
                echo view('includes/Footer');
                break;
            case '2.4.1 E2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/241E2', $data);
                echo view('includes/Footer');
                break;
            case '2.4.2 E2-1':
                $data['aicpppa'] = $this->wpmodel->getquestionsaicpppa($code,$dc2tID,$dcID,$dwpID);
                $data['rcicp'] = $this->wpmodel->getquestionsrcicp($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/242E21', $data);
                echo view('includes/Footer');
                break;
            case '2.4.3 E2-2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/243E22', $data);
                echo view('includes/Footer');
                break;
            case '2.4.4 E2-3':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/243E23', $data);
                echo view('includes/Footer');
                break;
            case '2.4.5 E2-4':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/245E24', $data);
                echo view('includes/Footer');
                break;
            case '2.5 F2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/25F2', $data);
                echo view('includes/Footer');
                break;
            case '2.6 H2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/26H2', $data);
                echo view('includes/Footer');
                break;
            case '2.7 I2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/27I2', $data);
                echo view('includes/Footer');
                break;
            case '2.8 J2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/28J2', $data);
                echo view('includes/Footer');
                break;
            case '2.9 K2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/29K2', $data);
                echo view('includes/Footer');
                break;
            case '2.10 L2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/210L2', $data);
                echo view('includes/Footer');
                break;
            case '2.11 M2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/211M2', $data);
                echo view('includes/Footer');
                break;
            case '2.12 N2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/212N2', $data);
                echo view('includes/Footer');
                break;
            case '2.13.1 O2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/2131O2', $data);
                echo view('includes/Footer');
                break;
            case '2.13.2 O2-1':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/2132O21', $data);
                echo view('includes/Footer');
                break;
            case '2.14 P2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/214P2', $data);
                echo view('includes/Footer');
                break;
            case '2.15 Q2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/215Q2', $data);
                echo view('includes/Footer');
                break;  
            case '2.16 R2-1':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/216R21', $data);
                echo view('includes/Footer');
                break;  
            case '2.17 R2-2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/217R22', $data);
                echo view('includes/Footer');
                break;  
            case '2.18.1 S2-1':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/2181S21', $data);
                echo view('includes/Footer');
                break;  
            case '2.18.2 S2-2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/2182S22', $data);
                echo view('includes/Footer');
                break; 
            case '2.18.3 S2-3':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/2183S23', $data);
                echo view('includes/Footer');
                break;  
            case '2.18.4 S2-4':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/2184S24', $data);
                echo view('includes/Footer');
                break; 
            case '2.19.1 U2-1':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/2191U21', $data);
                echo view('includes/Footer');
                break;   
            case '2.19.2 U2-2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/2192U22', $data);
                echo view('includes/Footer');
                break; 
            case '2.19.3 U2-3':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter2/2193U23', $data);
                echo view('includes/Footer');
                break;   
            default:
                break;
        }

    }

    
    /** 
        ----------------------------------------------------------
        WORK PAPER CHAPTER 3 VALUES
        ----------------------------------------------------------
        * @method c3setworkpaper() used view the workpaper values file of Chapter 3
        * @param code consists of file code
        * @param c3tID encrypted of title id
        * @param cID encrypted of client id
        * @param wpID encrypted of work paper id
        * @param name client name
        * @var dc3tID decrypted id of @param c3tID
        * @var dcID decrypted id of @param cID
        * @var dwpID decrypted id of @param wpID
        * @var rdata contains raw json data from database
        * @param array-data consist the data from database to display on the page
          THE VIEWS ARE DYNAMICALLY DISPLAYED BASED ON THE @param code RESULT ON THE SWITCH CONDITION
        * @return view
    */
    public function c3setworkpaper($code,$c3tID,$cID,$wpID,$name){

        $data['title']  = $code. ' - Chapter 3 Management';
        $data['name']   = $name;
        $data['cID']    = $cID;
        $data['wpID']   = $wpID;
        $data['c3tID']  = $c3tID;
        $data['code']   = $code;
        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dwpID          = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID));
        $dc3tID         = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID));
        switch ($code) {
            case '3.1 Aa1':
                $data['datapl'] = $this->wpmodel->getaa1('planning',$code,$dc3tID,$dcID,$dwpID);
                $data['dataaf'] = $this->wpmodel->getaa1('audit finalisation',$code,$dc3tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getaa1s3($code, $dc3tID,$dcID,$dwpID);
                $data['s3']     = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/31Aa1', $data);
                echo view('includes/Footer');
                break;
            case '3.2 Aa2':
                $rdata          = $this->wpmodel->getaa2data($code, $dc3tID,$dcID,$dwpID);
                $data['aa2']    = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/32Aa2', $data);
                echo view('includes/Footer');
                break;
            case '3.3 Aa3a':
                $data['cr']     = $this->wpmodel->getaa3('cr',$code,$dc3tID,$dcID,$dwpID);
                $data['dc']     = $this->wpmodel->getaa3('dc',$code,$dc3tID,$dcID,$dwpID);
                $data['faf']    = $this->wpmodel->getaa3('faf',$code,$dc3tID,$dcID,$dwpID);
                $data['ir']     = $this->wpmodel->getaa3air($code,$dc3tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/33Aa3a', $data);
                echo view('includes/Footer');
                break;
            case '3.4 Aa3b':
                $data['bp1']    = $this->wpmodel->getaa3b('p1',$code,$dc3tID,$dcID,$dwpID);
                $data['bp2']    = $this->wpmodel->getaa3b('p2',$code,$dc3tID,$dcID,$dwpID);
                $data['bp3a']   = $this->wpmodel->getaa3b('p3a',$code,$dc3tID,$dcID,$dwpID);
                $data['bp3b']   = $this->wpmodel->getaa3b('p3b',$code,$dc3tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getaa3bp4($code,$dc3tID,$dcID,$dwpID);
                $data['bp4']    = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/34Aa3b', $data);
                echo view('includes/Footer');
                break;
            case '3.5 Aa4':
                $rdata          = $this->wpmodel->getaa4($code,$dc3tID,$dcID,$dwpID);
                $data['aa4']    = json_decode($rdata['question'], true);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/35Aa4', $data);
                echo view('includes/Footer');
                break;
            case '3.6.1 Aa5a':
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/361Aa5a', $data);
                echo view('includes/Footer');
                break;
            case '3.6.2 Aa5b':
                $data['aa5b'] = $this->wpmodel->getaa5b($code,$dc3tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/362Aa5b', $data);
                echo view('includes/Footer');
                break;  
            case '3.7 Aa7':
                $data['aa7']    = $this->wpmodel->getaa7('isa315',$code,$dc3tID,$dcID,$dwpID);
                $data['cons']   = $this->wpmodel->getaa7('consultation',$code,$dc3tID,$dcID,$dwpID);
                $data['inc']    = $this->wpmodel->getaa7('inconsistencies',$code,$dc3tID,$dcID,$dwpID);
                $data['ref']    = $this->wpmodel->getaa7('refusal',$code,$dc3tID,$dcID,$dwpID);
                $data['dep']    = $this->wpmodel->getaa7('departures',$code,$dc3tID,$dcID,$dwpID);
                $data['oth']    = $this->wpmodel->getaa7('other',$code,$dc3tID,$dcID,$dwpID);
                $data['aepapp'] = $this->wpmodel->getaa7aep('aepapp',$code,$dc3tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getaa7aep('aep',$code,$dc3tID,$dcID,$dwpID);
                $data['aep']    = json_decode($rdata['question'], true);
                $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/37Aa7', $data);
                echo view('includes/Footer');
                break;
            case '3.8 Aa10':
                $rdata = $this->wpmodel->getaa10($code,$dc3tID,$dcID,$dwpID);
                $data['aa10'] = json_decode($rdata['question'], true);
                $data['acID'] = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/38Aa10', $data);
                echo view('includes/Footer');
                break;
            case '3.9':
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/39', $data);
                echo view('includes/Footer');
                break;
            case '3.10 Aa11-un':
                $s = explode('-', $code);
                $data['sectiontitle'] = "SUMMARY OF UNADJUSTED ERRORS";
                $data['aef'] = $this->wpmodel->getaa11p2('aef',$s[0],$dc3tID,$dcID,$dwpID);
                $data['aej'] = $this->wpmodel->getaa11p2('aej',$s[0],$dc3tID,$dcID,$dwpID);
                $data['ee'] = $this->wpmodel->getaa11p2('ee',$s[0],$dc3tID,$dcID,$dwpID);
                $data['de'] = $this->wpmodel->getaa11p2('de',$s[0],$dc3tID,$dcID,$dwpID);
                $rdata = $this->wpmodel->getaa11p('aa11ue',$s[0],$dc3tID,$dcID,$dwpID);
                $data['ue'] = json_decode($rdata['question'], true);    
                $data['ueacID'] = $this->crypt->encrypt($rdata['acID']);
                $rdata2 = $this->wpmodel->getaa11p('con',$s[0],$dc3tID,$dcID,$dwpID);
                $data['con'] = json_decode($rdata2['question'], true);   
                $data['conacID'] = $this->crypt->encrypt($rdata2['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/310Aa11_un', $data); 
                echo view('includes/Footer');
                break;   
            case '3.10 Aa11-ad':
                $s = explode('-', $code);
                $data['sectiontitle'] = "SUMMARY OF ADJUSTMENTS MADE TO THE CLIENT'S FINANCIAL STATEMENTS";
                $data['ad'] = $this->wpmodel->getaa11p2('ad',$s[0],$dc3tID,$dcID,$dwpID);
                $rdata = $this->wpmodel->getaa11p('aa11uead',$s[0],$dc3tID,$dcID,$dwpID);
                $data['ue'] = json_decode($rdata['question'], true);    
                $data['ueacID'] = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/310Aa11_ad', $data);
                echo view('includes/Footer');
                break;   
            case '3.11':
                $rdata          = $this->wpmodel->get311($code,$dc3tID,$dcID,$dwpID);
                $data['arf']    = json_decode($rdata['question'], true);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/311', $data);
                echo view('includes/Footer');
                break;   
            case '3.12':
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/312', $data);
                echo view('includes/Footer');
                break;   
            case '3.13 Ab1':
                $data['ab1'] = $this->wpmodel->getab1($code,$dc3tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/313Ab1', $data);
                echo view('includes/Footer');
                break;   
            case '3.14 Ab3':
                $rdata = $this->wpmodel->getab3($code,$dc3tID,$dcID,$dwpID);
                $data['ab3'] = json_decode($rdata['question'], true);
                $data['acID'] = $this->crypt->encrypt($rdata['acID']);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/314Ab3', $data);
                echo view('includes/Footer');
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
                $s = explode('-', $code);
                switch ($s[1]) {
                    case 'checklist':$data['sectiontitle'] = 'CORPORATE DISCLOSURE CHECKLIST (IFRS)';break;
                    case 'section1':$data['sectiontitle'] = 'Format of the Annual Report and Generic Information';break;
                    case 'section2':$data['sectiontitle'] = 'Directors Report (Review of the Business) ~ Best Practice Disclosures';break;
                    case 'section3':$data['sectiontitle'] = 'Directors Report ~ Best Practice Disclosures';break;
                    case 'section4':$data['sectiontitle'] = 'Statement of Comprehensive Income (SCI) and Related Notes';break;
                    case 'section5':$data['sectiontitle'] = 'Statement of Changes in Equity';break;
                    case 'section6':$data['sectiontitle'] = 'Statement of Financial Position and Related Notes';break;
                    case 'section7':$data['sectiontitle'] = 'Statement of Cash Flows';break;
                    case 'section8':$data['sectiontitle'] = 'Accounting Policies and Estimation Techniques';break;
                    case 'section9':$data['sectiontitle'] = 'Notes and Other Disclosures';break;
                }
                $data['title']      = $code. ' - Chapter 3 Management';
                $data['section']    = $s[1];
                $data['c3tID']      = $c3tID;
                $data['code']       = $code;
                if($s[1] == "checklist"){
                    $rdata          = $this->wpmodel->getab4checklist($s[1],$s[0],$dc3tID,$dcID,$dwpID);
                    $data['sec']    = json_decode($rdata['question'], true);
                    $data['acID']   = $this->crypt->encrypt($rdata['acID']);
                    echo view('includes/Header', $data);
                    echo view('workpaper/chapter3/315Ab4_checklist', $data);
                    echo view('includes/Footer');
                }else{
                    $data['sec'] = $this->wpmodel->getab4($s[1],$s[0],$dc3tID,$dcID,$dwpID);
                    echo view('includes/Header', $data);
                    echo view('workpaper/chapter3/315Ab4_section', $data);
                    echo view('includes/Footer');
                }
                break; 
            case '3.15.1 Ab4a':
                $data['ab4a'] = $this->wpmodel->getab4a('ab4a',$code,$dc3tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/3151Ab4a', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.2 Ab4b':
                $data['ab4b'] = $this->wpmodel->getab4a('ab4b',$code,$dc3tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/3152Ab4b', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.3 Ab4c':
                $data['ab4c'] = $this->wpmodel->getab4a('ab4c',$code,$dc3tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/3153Ab4c', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.4 Ab4d':
                $data['ab4d'] = $this->wpmodel->getab4a('ab4d',$code,$dc3tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/3154Ab4d', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.5 Ab4e':
                $data['ab4e'] = $this->wpmodel->getab4a('ab4e',$code,$dc3tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/3155Ab4e', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.6 Ab4f':
                $data['ab4f'] = $this->wpmodel->getab4a('ab4f',$code,$dc3tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/3156Ab4f', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.7 Ab4g':
                $data['ab4g'] = $this->wpmodel->getab4a('ab4g',$code,$dc3tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/3157Ab4g', $data);
                echo view('includes/Footer');
                break; 
            case '3.15.8 Ab4h':
                $data['ab4h'] = $this->wpmodel->getab4a('ab4h',$code,$dc3tID,$dcID,$dwpID);
                echo view('includes/Header', $data);
                echo view('workpaper/chapter3/3158Ab4h', $data);
                echo view('includes/Footer');
                break; 
            default:
                break;
        }

    }


}


    



  


    












  







    






