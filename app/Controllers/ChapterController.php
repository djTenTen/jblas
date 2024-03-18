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
                    'bc1','bc2','bc3','bc4','bc5','bc6','bcgen','bce1','bce2','bce3','bcro1','bcro2','bcro3','bcc1','bcc2','bcc3','bcva1','bcva2','bcva3','bcpd1','bcpd2','bcpd3',
                    'tr1','tr2','tr3','tr4','tr5','tr6','trgen','tre1','tre2','tre3','trro1','trro2','trro3','trc1','trc2','trc3','trva1','trva2','trva3','trpd1','trpd2','trpd3',
                    'or1','or2','or3','or4','or5','or6','orgen','ore1','ore2','ore3','orro1','orro2','orro3','orc1','orc2','orc3','orva1','orva2','orva3','orpd1','orpd2','orpd3',
                    'inv1','inv2','inv3','inv4','inv5','inv6','invgen','inve1','inve2','inve3','invro1','invro2','invro3','invc1','invc2','invc3','invva1','invva2','invva3','invpd1','invpd2','invpd3',
                    'invst1','invst2','invst3','invst4','invst5','invst6','invstgen','invste1','invste2','invste3','invstro1','invstro2','invstro3','invstc1','invstc2','invstc3','invstva1','invstva2','invstva3','invstpd1','invstpd2','invstpd3',
                    'ppe1','ppe2','ppe3','ppe4','ppe5','ppe6','ppegen','ppee1','ppee2','ppee3','ppero1','ppero2','ppero3','ppec1','ppec2','ppec3','ppeva1','ppeva2','ppeva3','ppepd1','ppepd2','ppepd3',
                    'inca1','inca2','inca3','inca4','inca5','inca6','incagen','incae1','incae2','incae3','incaro1','incaro2','incaro3','incac1','incac2','incac3','incava1','incava2','incava3','incapd1','incapd2','incapd3',
                    'tp1','tp2','tp3','tp4','tp5','tp6','tpgen','tpe1','tpe2','tpe3','tpro1','tpro2','tpro3','tpc1','tpc2','tpc3','tpva1','tpva2','tpva3','tppd1','tppd2','tppd3',
                    'op1','op2','op3','op4','op5','op6','opgen','ope1','ope2','ope3','opro1','opro2','opro3','opc1','opc2','opc3','opva1','opva2','opva3','oppd1','oppd2','oppd3',
                    'tax1','tax2','tax3','tax4','tax5','tax6','taxgen','taxe1','taxe2','taxe3','taxro1','taxro2','taxro3','taxc1','taxc2','taxc3','taxva1','taxva2','taxva3','taxpd1','taxpd2','taxpd3',
                    'pfl1','pfl2','pfl3','pfl4','pfl5','pfl6','pflgen','pfle1','pfle2','pfle3','pflro1','pflro2','pflro3','pflc1','pflc2','pflc3','pflva1','pflva2','pflva3','pflpd1','pflpd2','pflpd3',
                    'roi1','roi2','roi3','roi4','roi5','roi6','roigen','roie1','roie2','roie3','roiro1','roiro2','roiro3','roic1','roic2','roic3','roiva1','roiva2','roiva3','roipd1','roipd2','roipd3',
                    'dcoe1','dcoe2','dcoe3','dcoe4','dcoe5','dcoe6','dcoegen','dcoee1','dcoee2','dcoee3','dcoero1','dcoero2','dcoero3','dcoec1','dcoec2','dcoec3','dcoeva1','dcoeva2','dcoeva3','dcoepd1','dcoepd2','dcoepd3',
                    'pr1','pr2','pr3','pr4','pr5','pr6','prgen','pre1','pre2','pre3','prro1','prro2','prro3','prc1','prc2','prc3','prva1','prva2','prva3','prpd1','prpd2','prpd3',
                    'oa1','oa2','oa3','oa4','oa5','oa6','oagen','oae1','oae2','oae3','oaro1','oaro2','oaro3','oac1','oac2','oac3','oava1','oava2','oava3','oapd1','oapd2','oapd3'
                ];
                foreach($rowdata as $row){
                    $data[$row] = $this->ac7model->getac9data($dc1tID, $row);
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
                //$data['ac6'] = $this->chapterModel->getac6($dc1tID);
                $s = explode('-', $code);
                $data ['sheet'] = $s[1];
                $data['code'] = $s[0];
                echo view('includes/Header', $data);
                echo view('chapter1/Ac10', $data);
                echo view('includes/Footer');
                break;
            case 'AC10-Summary':
                //$data['ac6'] = $this->chapterModel->getac6($dc1tID);
                $s = explode('-', $code);
                $data ['sheet'] = $s[1];
                $data['code'] = $s[0];
                echo view('includes/Header', $data);
                echo view('chapter1/Ac10-Summary', $data);
                echo view('includes/Footer');
                break;

            case 'AC11':
                //$data['ac6'] = $this->chapterModel->getac6($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/Ac11', $data);
                echo view('includes/Footer');
                break;


            default:
                # code...
            break;

        }

    }

}


    



  


    












  







    






