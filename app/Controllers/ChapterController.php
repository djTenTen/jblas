<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\ChapterModel;
use \App\Models\C1ac1Model;
use \App\Models\C1ac2Model;
use \App\Models\C1ac3Model;
use \App\Models\C1ac4Model;
use \App\Models\C1ac5Model;
use \App\Models\C1ac6Model;
use \App\Models\C1ac7Model;
use \App\Models\C1ac8Model;
use \App\Models\C1ac9Model;
use \App\Models\C1ac10Model;
use \App\Models\C1ac11Model;
use \App\Models\C2B2Model;

class ChapterController extends BaseController{

    protected $chapterModel;
    protected $ac1model;
    protected $ac2model;
    protected $ac3model;
    protected $ac4model;
    protected $ac5model;
    protected $ac6model;
    protected $ac7model;
    protected $ac8model;
    protected $ac9model;
    protected $ac10model;
    protected $c2b2model;

    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->chapterModel = new ChapterModel();
        $this->ac1model = new C1ac1Model();
        $this->ac2model = new C1ac2Model();
        $this->ac3model = new C1ac3Model();
        $this->ac4model = new C1ac4Model();
        $this->ac5model = new C1ac5Model();
        $this->ac6model = new C1ac6Model();
        $this->ac7model = new C1ac7Model();
        $this->ac8model = new C1ac8Model();
        $this->ac9model = new C1ac9Model();
        $this->ac10model = new C1ac10Model();
        $this->ac11model = new C1ac11Model();
        $this->c2b2model = new C2B2Model();
        
        $this->crypt = \Config\Services::encrypter();
        

    }

    /**
        ----------------------------------------------------------
        Chapter 1 area
        ----------------------------------------------------------
    */
    public function viewchapter1(){

        // main content
        $data['title'] = 'Chapter 1 Management';

        $data['c1'] = $this->chapterModel->getc1();

        echo view('includes/Header', $data);
        echo view('chapter1/ViewChapter1', $data);
        echo view('includes/Footer');
    
    }

    public function managechapter1($code,$head,$c1tID){

        $data['title'] = $code. ' - Chapter 1 Management';
        $data['header'] = $head;
        $data['c1tID'] = $c1tID;
        $data['code'] = $code;

        $dc1tID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID));

        switch ($code) {
            case 'AC1':
                $data['ac1'] = $this->ac1model->getac1($dc1tID);
                $data['nap'] = $this->ac1model->getnameap($dc1tID);
                $data['eqr1'] = $this->ac1model->geteqr1($dc1tID);
                $data['eqr2'] = $this->ac1model->geteqr2($dc1tID);
                $data['eqrr'] = $this->ac1model->geteqrreason($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac1', $data);
                echo view('includes/Footer');
                break;
            
            case 'AC2':
                $data['ac2'] = $this->ac2model->getac2($dc1tID);
                $data['aep'] = $this->ac2model->getaep($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac2', $data);
                echo view('includes/Footer');
                break;

            case 'AC3':
                $data['ac3genmat'] = $this->ac3model->getac3genmat($dc1tID);
                $data['ac3doccors'] = $this->ac3model->getac3doccors($dc1tID);
                $data['ac3statutory'] = $this->ac3model->getac3statutory($dc1tID);
                $data['ac3accsys'] = $this->ac3model->getac3accsys($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac3', $data);
                echo view('includes/Footer');
                break;

            case 'AC4':
                $data['ac4'] = $this->ac4model->getac4($dc1tID);
                $data['ppr1'] = $this->ac4model->getppr1($dc1tID);
                $data['ppr2'] = $this->ac4model->getppr2($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac4', $data);
                echo view('includes/Footer');
                break;

            case 'AC5':
                $data['res'] = $this->ac5model->getresult($dc1tID);
                $data['con'] = $this->ac5model->getconclusion($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac5', $data);
                echo view('includes/Footer');
                break;

            case 'AC6':
                $data['ac6'] = $this->ac6model->getac6($dc1tID);
                $data['s1'] = $this->ac6model->gets1($dc1tID);
                $data['s2a'] = $this->ac6model->gets2a($dc1tID);
                $data['s2b'] = $this->ac6model->gets2b($dc1tID);
                $data['s3'] = $this->ac6model->gets3($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac6', $data);
                echo view('includes/Footer');
                break;

            case 'AC7':

                
                $rowdata = [
                    'bacdata','trdata','ordata','invtrdata','invmtdata','ppedata','incadata','tpdata','opdata','taxdata','provdata',
                    'roidata','dcodata','prdata','oadata'
                ];

                foreach($rowdata as $row){
                    $rdata = $this->ac7model->getac7data($dc1tID, $row);
                    $data[$row] = json_decode($rdata['question'], true);
                }
                echo view('includes/Header', $data);
                echo view('chapter1/ac7', $data);
                echo view('includes/Footer');
                break;

            case 'AC8':
                $rowdata = [
                    'revp','revf','prop','prof','grop','grof','revpr','revfr','propr','profr','gropr','grofr','pcu','fcu','adjap','adjbp','adjcp','adjaf','adjbf','adjcf',
                    'aomp','aomf','justn45','pcur','fcur','mlpinfo','conplst','confnst','oirp','oirf','pmpp','pmpf','apmp','apmf','conplst2','confnst2',
                    'rsp','confnst','ctp','ctf','aest','aestp','aestf','rptp','rptf',
                    'itbd1','itbd1p','itbd1f','itbd2','itbd2p','itbd2f','itbd3','itbd3p','itbd3f','adja','adjb','adjc'
                ];
                foreach($rowdata as $row){
                    $data[$row] = $this->ac8model->getac8data($dc1tID, $row);
                }
                echo view('includes/Header', $data);
                echo view('chapter1/ac8', $data);
                echo view('includes/Footer');
                break;

            case 'AC9':

                $rowdata = [
                    'coss','aop1','aop2','bipa','bibo','sffpa','sosdd','klar','rpi','soae','aa1','aa2','frfa','orr','tsr','cppm','ic','af','ccm','agm',
                    'bcl','iic','rc','t2r','pv','vfi','av','lo'
                ];

                foreach($rowdata as $row){
                    $data[$row] = $this->ac9model->getac9data($dc1tID, $row);
                }
    
                echo view('includes/Header', $data);
                echo view('chapter1/ac9', $data);
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
                $data ['sheet'] = $s[1];
                $data['code'] = $s[0];

                $data['cu'] = $this->ac10model->getac10cu($dc1tID,$s[1].'cu');
                $data['ac10s1'] = $this->ac10model->getac10s1data($dc1tID,$s[1]);
                $data['ac10s2'] = $this->ac10model->getac10s2data($dc1tID,$s[1]);
                echo view('includes/Header', $data);
                echo view('chapter1/Ac10', $data);
                echo view('includes/Footer');
                break;
            case 'AC10-Summary':
                $s = explode('-', $code);
                $data ['sheet'] = $s[1];
                $data['code'] = $s[0];

                $data['nmk_tgb'] = $this->ac10model->getdatacount($dc1tID,'Tangibles');
                $data['nmk_ppe'] = $this->ac10model->getdatacount($dc1tID,'PPE');
                $data['nmk_invmt'] = $this->ac10model->getdatacount($dc1tID,'Investments');
                $data['nmk_invtr'] = $this->ac10model->getdatacount($dc1tID,'Inventory');
                $data['nmk_tr'] = $this->ac10model->getdatacount($dc1tID,'Trade Receivables');
                $data['nmk_or'] = $this->ac10model->getdatacount($dc1tID,'Other Receivables');
                $data['nmk_bac'] = $this->ac10model->getdatacount($dc1tID,'Bank and Cash');
                $data['nmk_tp'] = $this->ac10model->getdatacount($dc1tID,'Trade Payables');
                $data['nmk_op'] = $this->ac10model->getdatacount($dc1tID,'Other Payables');
                $data['nmk_prov'] = $this->ac10model->getdatacount($dc1tID,'Provisions');
                $data['nmk_rev'] = $this->ac10model->getdatacount($dc1tID,'Revenue');
                $data['nmk_cst'] = $this->ac10model->getdatacount($dc1tID,'Costs');
                $data['nmk_pr'] = $this->ac10model->getdatacount($dc1tID,'Payroll');
                
                $data['vop_tgb'] = $this->ac10model->getsumation($dc1tID,'Tangibles');
                $data['vop_ppe'] = $this->ac10model->getsumation($dc1tID,'PPE');
                $data['vop_invmt'] = $this->ac10model->getsumation($dc1tID,'Investments');
                $data['vop_invtr'] = $this->ac10model->getsumation($dc1tID,'Inventory');
                $data['vop_tr'] = $this->ac10model->getsumation($dc1tID,'Trade Receivables');
                $data['vop_or'] = $this->ac10model->getsumation($dc1tID,'Other Receivables');
                $data['vop_bac'] = $this->ac10model->getsumation($dc1tID,'Bank and Cash');
                $data['vop_tp'] = $this->ac10model->getsumation($dc1tID,'Trade Payables');
                $data['vop_op'] = $this->ac10model->getsumation($dc1tID,'Other Payables');
                $data['vop_prov'] = $this->ac10model->getsumation($dc1tID,'Provisions');
                $data['vop_rev'] = $this->ac10model->getsumation($dc1tID,'Revenue');
                $data['vop_cst'] = $this->ac10model->getsumation($dc1tID,'Costs');
                $data['vop_pr'] = $this->ac10model->getsumation($dc1tID,'Payroll');
                
                $data['mat'] = $this->ac10model->getsummarydata($dc1tID,'material');

                $rowdata = ['tgb','ppe','invmt','invtr','tr','or','bac','tp','op','prov','rev','cst','pr'];

                foreach($rowdata as $row){
                    $rdata = $this->ac10model->getsummarydata($dc1tID, $row);
                    $data[$row] = json_decode($rdata['question'], true);
                }

                echo view('includes/Header', $data);
                echo view('chapter1/Ac10-Summary', $data);
                echo view('includes/Footer');
                break;

            case 'AC11':

                $rdata = $this->ac11model->getac11data($dc1tID);
                $data['ac11'] = json_decode($rdata['question'], true);
                
                echo view('includes/Header', $data);
                echo view('chapter1/Ac11', $data);
                echo view('includes/Footer');
                break;


            default:
                # code...
            break;

        }

    }






    /**
        ----------------------------------------------------------
        Chapter 2 area
        ----------------------------------------------------------
    */
    public function viewchapter2(){

        // main content
        $data['title'] = 'Chapter 2 Management';

        $data['c2'] = $this->chapterModel->getc2();

        echo view('includes/Header', $data);
        echo view('chapter2/ViewChapter2', $data);
        echo view('includes/Footer');
    
    }

    public function managechapter2($code,$head,$c2tID){

        $data['title'] = $code. ' - Chapter 2 Management';
        $data['header'] = $head;
        $data['c2tID'] = $c2tID;
        $data['code'] = $code;

        $dc2tID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID));

        switch ($code) {

            case '2.1 B2':

                $data['qdata'] = $this->c2b2model->getquestionsdata($code,$dc2tID);

                echo view('includes/Header', $data);
                echo view('chapter2/21B2', $data);
                echo view('includes/Footer');
                break;
            
            default:
                # code...
                break;
        }


    }





























}


    



  


    












  







    






