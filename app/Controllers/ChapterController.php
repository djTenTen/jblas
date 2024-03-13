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

class ChapterController extends BaseController{

    protected $chapterModel;
    protected $ac1model;
    protected $ac2model;
    protected $ac3model;
    protected $ac4model;
    protected $ac5model;
    protected $ac6model;
    protected $ac7model;
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
                // Bank And Cash
                $data['bc1'] = $this->ac7model->getac7data($dc1tID,'bc1');
                $data['bc2'] = $this->ac7model->getac7data($dc1tID,'bc2');
                $data['bc3'] = $this->ac7model->getac7data($dc1tID,'bc3');
                $data['bc4'] = $this->ac7model->getac7data($dc1tID,'bc4');
                $data['bc5'] = $this->ac7model->getac7data($dc1tID,'bc5');
                $data['bc6'] = $this->ac7model->getac7data($dc1tID,'bc6');

                $data['bcgen'] = $this->ac7model->getac7data($dc1tID,'bcgen');
                $data['bce1'] = $this->ac7model->getac7data($dc1tID,'bce1');
                $data['bce2'] = $this->ac7model->getac7data($dc1tID,'bce2');
                $data['bce3'] = $this->ac7model->getac7data($dc1tID,'bce3');

                $data['bcro1'] = $this->ac7model->getac7data($dc1tID,'bcro1');
                $data['bcro2'] = $this->ac7model->getac7data($dc1tID,'bcro2');
                $data['bcro3'] = $this->ac7model->getac7data($dc1tID,'bcro3');

                $data['bcc1'] = $this->ac7model->getac7data($dc1tID,'bcc1');
                $data['bcc2'] = $this->ac7model->getac7data($dc1tID,'bcc2');
                $data['bcc3'] = $this->ac7model->getac7data($dc1tID,'bcc3');

                $data['bcva1'] = $this->ac7model->getac7data($dc1tID,'bcva1');
                $data['bcva2'] = $this->ac7model->getac7data($dc1tID,'bcva2');
                $data['bcva3'] = $this->ac7model->getac7data($dc1tID,'bcva3');

                $data['bcpd1'] = $this->ac7model->getac7data($dc1tID,'bcpd1');
                $data['bcpd2'] = $this->ac7model->getac7data($dc1tID,'bcpd2');
                $data['bcpd3'] = $this->ac7model->getac7data($dc1tID,'bcpd3');

                // Trade Receivables
                $data['tr1'] = $this->ac7model->getac7data($dc1tID,'tr1');
                $data['tr2'] = $this->ac7model->getac7data($dc1tID,'tr2');
                $data['tr3'] = $this->ac7model->getac7data($dc1tID,'tr3');
                $data['tr4'] = $this->ac7model->getac7data($dc1tID,'tr4');
                $data['tr5'] = $this->ac7model->getac7data($dc1tID,'tr5');
                $data['tr6'] = $this->ac7model->getac7data($dc1tID,'tr6');

                $data['trgen'] = $this->ac7model->getac7data($dc1tID,'trgen');
                $data['tre1'] = $this->ac7model->getac7data($dc1tID,'tre1');
                $data['tre2'] = $this->ac7model->getac7data($dc1tID,'tre2');
                $data['tre3'] = $this->ac7model->getac7data($dc1tID,'tre3');

                $data['trro1'] = $this->ac7model->getac7data($dc1tID,'trro1');
                $data['trro2'] = $this->ac7model->getac7data($dc1tID,'trro2');
                $data['trro3'] = $this->ac7model->getac7data($dc1tID,'trro3');

                $data['trc1'] = $this->ac7model->getac7data($dc1tID,'trc1');
                $data['trc2'] = $this->ac7model->getac7data($dc1tID,'trc2');
                $data['trc3'] = $this->ac7model->getac7data($dc1tID,'trc3');

                $data['trva1'] = $this->ac7model->getac7data($dc1tID,'trva1');
                $data['trva2'] = $this->ac7model->getac7data($dc1tID,'trva2');
                $data['trva3'] = $this->ac7model->getac7data($dc1tID,'trva3');

                $data['trpd1'] = $this->ac7model->getac7data($dc1tID,'trpd1');
                $data['trpd2'] = $this->ac7model->getac7data($dc1tID,'trpd2');
                $data['trpd3'] = $this->ac7model->getac7data($dc1tID,'trpd3');

                // Other Receivables
                $data['or1'] = $this->ac7model->getac7data($dc1tID,'or1');
                $data['or2'] = $this->ac7model->getac7data($dc1tID,'or2');
                $data['or3'] = $this->ac7model->getac7data($dc1tID,'or3');
                $data['or4'] = $this->ac7model->getac7data($dc1tID,'or4');
                $data['or5'] = $this->ac7model->getac7data($dc1tID,'or5');
                $data['or6'] = $this->ac7model->getac7data($dc1tID,'or6');

                $data['orgen'] = $this->ac7model->getac7data($dc1tID,'orgen');
                $data['ore1'] = $this->ac7model->getac7data($dc1tID,'ore1');
                $data['ore2'] = $this->ac7model->getac7data($dc1tID,'ore2');
                $data['ore3'] = $this->ac7model->getac7data($dc1tID,'ore3');

                $data['orro1'] = $this->ac7model->getac7data($dc1tID,'orro1');
                $data['orro2'] = $this->ac7model->getac7data($dc1tID,'orro2');
                $data['orro3'] = $this->ac7model->getac7data($dc1tID,'orro3');

                $data['orc1'] = $this->ac7model->getac7data($dc1tID,'orc1');
                $data['orc2'] = $this->ac7model->getac7data($dc1tID,'orc2');
                $data['orc3'] = $this->ac7model->getac7data($dc1tID,'orc3');

                $data['orva1'] = $this->ac7model->getac7data($dc1tID,'orva1');
                $data['orva2'] = $this->ac7model->getac7data($dc1tID,'orva2');
                $data['orva3'] = $this->ac7model->getac7data($dc1tID,'orva3');

                $data['orpd1'] = $this->ac7model->getac7data($dc1tID,'orpd1');
                $data['orpd2'] = $this->ac7model->getac7data($dc1tID,'orpd2');
                $data['orpd3'] = $this->ac7model->getac7data($dc1tID,'orpd3');

                // Inventory
                $data['inv1'] = $this->ac7model->getac7data($dc1tID,'inv1');
                $data['inv2'] = $this->ac7model->getac7data($dc1tID,'inv2');
                $data['inv3'] = $this->ac7model->getac7data($dc1tID,'inv3');
                $data['inv4'] = $this->ac7model->getac7data($dc1tID,'inv4');
                $data['inv5'] = $this->ac7model->getac7data($dc1tID,'inv5');
                $data['inv6'] = $this->ac7model->getac7data($dc1tID,'inv6');

                $data['invgen'] = $this->ac7model->getac7data($dc1tID,'invgen');
                $data['inve1'] = $this->ac7model->getac7data($dc1tID,'inve1');
                $data['inve2'] = $this->ac7model->getac7data($dc1tID,'inve2');
                $data['inve3'] = $this->ac7model->getac7data($dc1tID,'inve3');

                $data['invro1'] = $this->ac7model->getac7data($dc1tID,'invro1');
                $data['invro2'] = $this->ac7model->getac7data($dc1tID,'invro2');
                $data['invro3'] = $this->ac7model->getac7data($dc1tID,'invro3');

                $data['invc1'] = $this->ac7model->getac7data($dc1tID,'invc1');
                $data['invc2'] = $this->ac7model->getac7data($dc1tID,'invc2');
                $data['invc3'] = $this->ac7model->getac7data($dc1tID,'invc3');

                $data['invva1'] = $this->ac7model->getac7data($dc1tID,'invva1');
                $data['invva2'] = $this->ac7model->getac7data($dc1tID,'invva2');
                $data['invva3'] = $this->ac7model->getac7data($dc1tID,'invva3');

                $data['invpd1'] = $this->ac7model->getac7data($dc1tID,'invpd1');
                $data['invpd2'] = $this->ac7model->getac7data($dc1tID,'invpd2');
                $data['invpd3'] = $this->ac7model->getac7data($dc1tID,'invpd3');

                // Invesment
                $data['invst1'] = $this->ac7model->getac7data($dc1tID,'invst1');
                $data['invst2'] = $this->ac7model->getac7data($dc1tID,'invst2');
                $data['invst3'] = $this->ac7model->getac7data($dc1tID,'invst3');
                $data['invst4'] = $this->ac7model->getac7data($dc1tID,'invst4');
                $data['invst5'] = $this->ac7model->getac7data($dc1tID,'invst5');
                $data['invst6'] = $this->ac7model->getac7data($dc1tID,'invst6');

                $data['invstgen'] = $this->ac7model->getac7data($dc1tID,'invstgen');
                $data['invste1'] = $this->ac7model->getac7data($dc1tID,'invste1');
                $data['invste2'] = $this->ac7model->getac7data($dc1tID,'invste2');
                $data['invste3'] = $this->ac7model->getac7data($dc1tID,'invste3');

                $data['invstro1'] = $this->ac7model->getac7data($dc1tID,'invstro1');
                $data['invstro2'] = $this->ac7model->getac7data($dc1tID,'invstro2');
                $data['invstro3'] = $this->ac7model->getac7data($dc1tID,'invstro3');

                $data['invstc1'] = $this->ac7model->getac7data($dc1tID,'invstc1');
                $data['invstc2'] = $this->ac7model->getac7data($dc1tID,'invstc2');
                $data['invstc3'] = $this->ac7model->getac7data($dc1tID,'invstc3');

                $data['invstva1'] = $this->ac7model->getac7data($dc1tID,'invstva1');
                $data['invstva2'] = $this->ac7model->getac7data($dc1tID,'invstva2');
                $data['invstva3'] = $this->ac7model->getac7data($dc1tID,'invstva3');

                $data['invstpd1'] = $this->ac7model->getac7data($dc1tID,'invstpd1');
                $data['invstpd2'] = $this->ac7model->getac7data($dc1tID,'invstpd2');
                $data['invstpd3'] = $this->ac7model->getac7data($dc1tID,'invstpd3');


                //  PROPERTY, PLANT AND EQUIPMENT
                $data['ppe1'] = $this->ac7model->getac7data($dc1tID,'ppe1');
                $data['ppe2'] = $this->ac7model->getac7data($dc1tID,'ppe2');
                $data['ppe3'] = $this->ac7model->getac7data($dc1tID,'ppe3');
                $data['ppe4'] = $this->ac7model->getac7data($dc1tID,'ppe4');
                $data['ppe5'] = $this->ac7model->getac7data($dc1tID,'ppe5');
                $data['ppe6'] = $this->ac7model->getac7data($dc1tID,'ppe6');

                $data['ppegen'] = $this->ac7model->getac7data($dc1tID,'ppegen');
                $data['ppee1'] = $this->ac7model->getac7data($dc1tID,'ppee1');
                $data['ppee2'] = $this->ac7model->getac7data($dc1tID,'ppee2');
                $data['ppee3'] = $this->ac7model->getac7data($dc1tID,'ppee3');

                $data['ppero1'] = $this->ac7model->getac7data($dc1tID,'ppero1');
                $data['ppero2'] = $this->ac7model->getac7data($dc1tID,'ppero2');
                $data['ppero3'] = $this->ac7model->getac7data($dc1tID,'ppero3');

                $data['ppec1'] = $this->ac7model->getac7data($dc1tID,'ppec1');
                $data['ppec2'] = $this->ac7model->getac7data($dc1tID,'ppec2');
                $data['ppec3'] = $this->ac7model->getac7data($dc1tID,'ppec3');

                $data['ppeva1'] = $this->ac7model->getac7data($dc1tID,'ppeva1');
                $data['ppeva2'] = $this->ac7model->getac7data($dc1tID,'ppeva2');
                $data['ppeva3'] = $this->ac7model->getac7data($dc1tID,'ppeva3');

                $data['ppepd1'] = $this->ac7model->getac7data($dc1tID,'ppepd1');
                $data['ppepd2'] = $this->ac7model->getac7data($dc1tID,'ppepd2');
                $data['ppepd3'] = $this->ac7model->getac7data($dc1tID,'ppepd3');


                //  INTANGIBLE NON-CURRENT ASSETS
                $data['inca1'] = $this->ac7model->getac7data($dc1tID,'inca1');
                $data['inca2'] = $this->ac7model->getac7data($dc1tID,'inca2');
                $data['inca3'] = $this->ac7model->getac7data($dc1tID,'inca3');
                $data['inca4'] = $this->ac7model->getac7data($dc1tID,'inca4');
                $data['inca5'] = $this->ac7model->getac7data($dc1tID,'inca5');
                $data['inca6'] = $this->ac7model->getac7data($dc1tID,'inca6');

                $data['incagen'] = $this->ac7model->getac7data($dc1tID,'incagen');
                $data['incae1'] = $this->ac7model->getac7data($dc1tID,'incae1');
                $data['incae2'] = $this->ac7model->getac7data($dc1tID,'incae2');
                $data['incae3'] = $this->ac7model->getac7data($dc1tID,'incae3');

                $data['incaro1'] = $this->ac7model->getac7data($dc1tID,'incaro1');
                $data['incaro2'] = $this->ac7model->getac7data($dc1tID,'incaro2');
                $data['incaro3'] = $this->ac7model->getac7data($dc1tID,'incaro3');

                $data['incac1'] = $this->ac7model->getac7data($dc1tID,'incac1');
                $data['incac2'] = $this->ac7model->getac7data($dc1tID,'incac2');
                $data['incac3'] = $this->ac7model->getac7data($dc1tID,'incac3');

                $data['incava1'] = $this->ac7model->getac7data($dc1tID,'incava1');
                $data['incava2'] = $this->ac7model->getac7data($dc1tID,'incava2');
                $data['incava3'] = $this->ac7model->getac7data($dc1tID,'incava3');

                $data['incapd1'] = $this->ac7model->getac7data($dc1tID,'incapd1');
                $data['incapd2'] = $this->ac7model->getac7data($dc1tID,'incapd2');
                $data['incapd3'] = $this->ac7model->getac7data($dc1tID,'incapd3');

                //  INTANGIBLE NON-CURRENT ASSETS
                $data['tp1'] = $this->ac7model->getac7data($dc1tID,'tp1');
                $data['tp2'] = $this->ac7model->getac7data($dc1tID,'tp2');
                $data['tp3'] = $this->ac7model->getac7data($dc1tID,'tp3');
                $data['tp4'] = $this->ac7model->getac7data($dc1tID,'tp4');
                $data['tp5'] = $this->ac7model->getac7data($dc1tID,'tp5');
                $data['tp6'] = $this->ac7model->getac7data($dc1tID,'tp6');

                $data['tpgen'] = $this->ac7model->getac7data($dc1tID,'tpgen');
                $data['tpe1'] = $this->ac7model->getac7data($dc1tID,'tpe1');
                $data['tpe2'] = $this->ac7model->getac7data($dc1tID,'tpe2');
                $data['tpe3'] = $this->ac7model->getac7data($dc1tID,'tpe3');

                $data['tpro1'] = $this->ac7model->getac7data($dc1tID,'tpro1');
                $data['tpro2'] = $this->ac7model->getac7data($dc1tID,'tpro2');
                $data['tpro3'] = $this->ac7model->getac7data($dc1tID,'tpro3');

                $data['tpc1'] = $this->ac7model->getac7data($dc1tID,'tpc1');
                $data['tpc2'] = $this->ac7model->getac7data($dc1tID,'tpc2');
                $data['tpc3'] = $this->ac7model->getac7data($dc1tID,'tpc3');

                $data['tpva1'] = $this->ac7model->getac7data($dc1tID,'tpva1');
                $data['tpva2'] = $this->ac7model->getac7data($dc1tID,'tpva2');
                $data['tpva3'] = $this->ac7model->getac7data($dc1tID,'tpva3');

                $data['tppd1'] = $this->ac7model->getac7data($dc1tID,'tppd1');
                $data['tppd2'] = $this->ac7model->getac7data($dc1tID,'tppd2');
                $data['tppd3'] = $this->ac7model->getac7data($dc1tID,'tppd3');

                //  OTHER PAYABLES
                $data['op1'] = $this->ac7model->getac7data($dc1tID,'op1');
                $data['op2'] = $this->ac7model->getac7data($dc1tID,'op2');
                $data['op3'] = $this->ac7model->getac7data($dc1tID,'op3');
                $data['op4'] = $this->ac7model->getac7data($dc1tID,'op4');
                $data['op5'] = $this->ac7model->getac7data($dc1tID,'op5');
                $data['op6'] = $this->ac7model->getac7data($dc1tID,'op6');

                $data['opgen'] = $this->ac7model->getac7data($dc1tID,'opgen');
                $data['ope1'] = $this->ac7model->getac7data($dc1tID,'ope1');
                $data['ope2'] = $this->ac7model->getac7data($dc1tID,'ope2');
                $data['ope3'] = $this->ac7model->getac7data($dc1tID,'ope3');

                $data['opro1'] = $this->ac7model->getac7data($dc1tID,'opro1');
                $data['opro2'] = $this->ac7model->getac7data($dc1tID,'opro2');
                $data['opro3'] = $this->ac7model->getac7data($dc1tID,'opro3');

                $data['opc1'] = $this->ac7model->getac7data($dc1tID,'opc1');
                $data['opc2'] = $this->ac7model->getac7data($dc1tID,'opc2');
                $data['opc3'] = $this->ac7model->getac7data($dc1tID,'opc3');

                $data['opva1'] = $this->ac7model->getac7data($dc1tID,'opva1');
                $data['opva2'] = $this->ac7model->getac7data($dc1tID,'opva2');
                $data['opva3'] = $this->ac7model->getac7data($dc1tID,'opva3');

                $data['oppd1'] = $this->ac7model->getac7data($dc1tID,'oppd1');
                $data['oppd2'] = $this->ac7model->getac7data($dc1tID,'oppd2');
                $data['oppd3'] = $this->ac7model->getac7data($dc1tID,'oppd3');

                //  TAXATION
                $data['tax1'] = $this->ac7model->getac7data($dc1tID,'tax1');
                $data['tax2'] = $this->ac7model->getac7data($dc1tID,'tax2');
                $data['tax3'] = $this->ac7model->getac7data($dc1tID,'tax3');
                $data['tax4'] = $this->ac7model->getac7data($dc1tID,'tax4');
                $data['tax5'] = $this->ac7model->getac7data($dc1tID,'tax5');
                $data['tax6'] = $this->ac7model->getac7data($dc1tID,'tax6');

                $data['taxgen'] = $this->ac7model->getac7data($dc1tID,'taxgen');
                $data['taxe1'] = $this->ac7model->getac7data($dc1tID,'taxe1');
                $data['taxe2'] = $this->ac7model->getac7data($dc1tID,'taxe2');
                $data['taxe3'] = $this->ac7model->getac7data($dc1tID,'taxe3');

                $data['taxro1'] = $this->ac7model->getac7data($dc1tID,'taxro1');
                $data['taxro2'] = $this->ac7model->getac7data($dc1tID,'taxro2');
                $data['taxro3'] = $this->ac7model->getac7data($dc1tID,'taxro3');

                $data['taxc1'] = $this->ac7model->getac7data($dc1tID,'taxc1');
                $data['taxc2'] = $this->ac7model->getac7data($dc1tID,'taxc2');
                $data['taxc3'] = $this->ac7model->getac7data($dc1tID,'taxc3');

                $data['taxva1'] = $this->ac7model->getac7data($dc1tID,'taxva1');
                $data['taxva2'] = $this->ac7model->getac7data($dc1tID,'taxva2');
                $data['taxva3'] = $this->ac7model->getac7data($dc1tID,'taxva3');

                $data['taxpd1'] = $this->ac7model->getac7data($dc1tID,'taxpd1');
                $data['taxpd2'] = $this->ac7model->getac7data($dc1tID,'taxpd2');
                $data['taxpd3'] = $this->ac7model->getac7data($dc1tID,'taxpd3');
                

                //  PROVISIONS FOR LIABILITIES
                $data['pfl1'] = $this->ac7model->getac7data($dc1tID,'pfl1');
                $data['pfl2'] = $this->ac7model->getac7data($dc1tID,'pfl2');
                $data['pfl3'] = $this->ac7model->getac7data($dc1tID,'pfl3');
                $data['pfl4'] = $this->ac7model->getac7data($dc1tID,'pfl4');
                $data['pfl5'] = $this->ac7model->getac7data($dc1tID,'pfl5');
                $data['pfl6'] = $this->ac7model->getac7data($dc1tID,'pfl6');

                $data['pflgen'] = $this->ac7model->getac7data($dc1tID,'pflgen');
                $data['pfle1'] = $this->ac7model->getac7data($dc1tID,'pfle1');
                $data['pfle2'] = $this->ac7model->getac7data($dc1tID,'pfle2');
                $data['pfle3'] = $this->ac7model->getac7data($dc1tID,'pfle3');

                $data['pflro1'] = $this->ac7model->getac7data($dc1tID,'pflro1');
                $data['pflro2'] = $this->ac7model->getac7data($dc1tID,'pflro2');
                $data['pflro3'] = $this->ac7model->getac7data($dc1tID,'pflro3');

                $data['pflc1'] = $this->ac7model->getac7data($dc1tID,'pflc1');
                $data['pflc2'] = $this->ac7model->getac7data($dc1tID,'pflc2');
                $data['pflc3'] = $this->ac7model->getac7data($dc1tID,'pflc3');

                $data['pflva1'] = $this->ac7model->getac7data($dc1tID,'pflva1');
                $data['pflva2'] = $this->ac7model->getac7data($dc1tID,'pflva2');
                $data['pflva3'] = $this->ac7model->getac7data($dc1tID,'pflva3');

                $data['pflpd1'] = $this->ac7model->getac7data($dc1tID,'pflpd1');
                $data['pflpd2'] = $this->ac7model->getac7data($dc1tID,'pflpd2');
                $data['pflpd3'] = $this->ac7model->getac7data($dc1tID,'pflpd3');


                //  REVENUE / OTHER INCOME
                $data['roi1'] = $this->ac7model->getac7data($dc1tID,'roi1');
                $data['roi2'] = $this->ac7model->getac7data($dc1tID,'roi2');
                $data['roi3'] = $this->ac7model->getac7data($dc1tID,'roi3');
                $data['roi4'] = $this->ac7model->getac7data($dc1tID,'roi4');
                $data['roi5'] = $this->ac7model->getac7data($dc1tID,'roi5');
                $data['roi6'] = $this->ac7model->getac7data($dc1tID,'roi6');

                $data['roigen'] = $this->ac7model->getac7data($dc1tID,'roigen');
                $data['roie1'] = $this->ac7model->getac7data($dc1tID,'roie1');
                $data['roie2'] = $this->ac7model->getac7data($dc1tID,'roie2');
                $data['roie3'] = $this->ac7model->getac7data($dc1tID,'roie3');

                $data['roiro1'] = $this->ac7model->getac7data($dc1tID,'roiro1');
                $data['roiro2'] = $this->ac7model->getac7data($dc1tID,'roiro2');
                $data['roiro3'] = $this->ac7model->getac7data($dc1tID,'roiro3');

                $data['roic1'] = $this->ac7model->getac7data($dc1tID,'roic1');
                $data['roic2'] = $this->ac7model->getac7data($dc1tID,'roic2');
                $data['roic3'] = $this->ac7model->getac7data($dc1tID,'roic3');

                $data['roiva1'] = $this->ac7model->getac7data($dc1tID,'roiva1');
                $data['roiva2'] = $this->ac7model->getac7data($dc1tID,'roiva2');
                $data['roiva3'] = $this->ac7model->getac7data($dc1tID,'roiva3');

                $data['roipd1'] = $this->ac7model->getac7data($dc1tID,'roipd1');
                $data['roipd2'] = $this->ac7model->getac7data($dc1tID,'roipd2');
                $data['roipd3'] = $this->ac7model->getac7data($dc1tID,'roipd3');


                //  DIRECT COSTS / OTHER EXPENSES
                $data['dcoe1'] = $this->ac7model->getac7data($dc1tID,'dcoe1');
                $data['dcoe2'] = $this->ac7model->getac7data($dc1tID,'dcoe2');
                $data['dcoe3'] = $this->ac7model->getac7data($dc1tID,'dcoe3');
                $data['dcoe4'] = $this->ac7model->getac7data($dc1tID,'dcoe4');
                $data['dcoe5'] = $this->ac7model->getac7data($dc1tID,'dcoe5');
                $data['dcoe6'] = $this->ac7model->getac7data($dc1tID,'dcoe6');

                $data['dcoegen'] = $this->ac7model->getac7data($dc1tID,'dcoegen');
                $data['dcoee1'] = $this->ac7model->getac7data($dc1tID,'dcoee1');
                $data['dcoee2'] = $this->ac7model->getac7data($dc1tID,'dcoee2');
                $data['dcoee3'] = $this->ac7model->getac7data($dc1tID,'dcoee3');

                $data['dcoero1'] = $this->ac7model->getac7data($dc1tID,'dcoero1');
                $data['dcoero2'] = $this->ac7model->getac7data($dc1tID,'dcoero2');
                $data['dcoero3'] = $this->ac7model->getac7data($dc1tID,'dcoero3');

                $data['dcoec1'] = $this->ac7model->getac7data($dc1tID,'dcoec1');
                $data['dcoec2'] = $this->ac7model->getac7data($dc1tID,'dcoec2');
                $data['dcoec3'] = $this->ac7model->getac7data($dc1tID,'dcoec3');

                $data['dcoeva1'] = $this->ac7model->getac7data($dc1tID,'dcoeva1');
                $data['dcoeva2'] = $this->ac7model->getac7data($dc1tID,'dcoeva2');
                $data['dcoeva3'] = $this->ac7model->getac7data($dc1tID,'dcoeva3');

                $data['dcoepd1'] = $this->ac7model->getac7data($dc1tID,'dcoepd1');
                $data['dcoepd2'] = $this->ac7model->getac7data($dc1tID,'dcoepd2');
                $data['dcoepd3'] = $this->ac7model->getac7data($dc1tID,'dcoepd3');

                //  DIRECT COSTS / OTHER EXPENSES
                $data['dcoe1'] = $this->ac7model->getac7data($dc1tID,'dcoe1');
                $data['dcoe2'] = $this->ac7model->getac7data($dc1tID,'dcoe2');
                $data['dcoe3'] = $this->ac7model->getac7data($dc1tID,'dcoe3');
                $data['dcoe4'] = $this->ac7model->getac7data($dc1tID,'dcoe4');
                $data['dcoe5'] = $this->ac7model->getac7data($dc1tID,'dcoe5');
                $data['dcoe6'] = $this->ac7model->getac7data($dc1tID,'dcoe6');

                $data['dcoegen'] = $this->ac7model->getac7data($dc1tID,'dcoegen');
                $data['dcoee1'] = $this->ac7model->getac7data($dc1tID,'dcoee1');
                $data['dcoee2'] = $this->ac7model->getac7data($dc1tID,'dcoee2');
                $data['dcoee3'] = $this->ac7model->getac7data($dc1tID,'dcoee3');

                $data['dcoero1'] = $this->ac7model->getac7data($dc1tID,'dcoero1');
                $data['dcoero2'] = $this->ac7model->getac7data($dc1tID,'dcoero2');
                $data['dcoero3'] = $this->ac7model->getac7data($dc1tID,'dcoero3');

                $data['dcoec1'] = $this->ac7model->getac7data($dc1tID,'dcoec1');
                $data['dcoec2'] = $this->ac7model->getac7data($dc1tID,'dcoec2');
                $data['dcoec3'] = $this->ac7model->getac7data($dc1tID,'dcoec3');

                $data['dcoeva1'] = $this->ac7model->getac7data($dc1tID,'dcoeva1');
                $data['dcoeva2'] = $this->ac7model->getac7data($dc1tID,'dcoeva2');
                $data['dcoeva3'] = $this->ac7model->getac7data($dc1tID,'dcoeva3');

                $data['dcoepd1'] = $this->ac7model->getac7data($dc1tID,'dcoepd1');
                $data['dcoepd2'] = $this->ac7model->getac7data($dc1tID,'dcoepd2');
                $data['dcoepd3'] = $this->ac7model->getac7data($dc1tID,'dcoepd3');

                //  PAYROLL
                $data['pr1'] = $this->ac7model->getac7data($dc1tID,'pr1');
                $data['pr2'] = $this->ac7model->getac7data($dc1tID,'pr2');
                $data['pr3'] = $this->ac7model->getac7data($dc1tID,'pr3');
                $data['pr4'] = $this->ac7model->getac7data($dc1tID,'pr4');
                $data['pr5'] = $this->ac7model->getac7data($dc1tID,'pr5');
                $data['pr6'] = $this->ac7model->getac7data($dc1tID,'pr6');

                $data['prgen'] = $this->ac7model->getac7data($dc1tID,'prgen');
                $data['pre1'] = $this->ac7model->getac7data($dc1tID,'pre1');
                $data['pre2'] = $this->ac7model->getac7data($dc1tID,'pre2');
                $data['pre3'] = $this->ac7model->getac7data($dc1tID,'pre3');

                $data['prro1'] = $this->ac7model->getac7data($dc1tID,'prro1');
                $data['prro2'] = $this->ac7model->getac7data($dc1tID,'prro2');
                $data['prro3'] = $this->ac7model->getac7data($dc1tID,'prro3');

                $data['prc1'] = $this->ac7model->getac7data($dc1tID,'prc1');
                $data['prc2'] = $this->ac7model->getac7data($dc1tID,'prc2');
                $data['prc3'] = $this->ac7model->getac7data($dc1tID,'prc3');

                $data['prva1'] = $this->ac7model->getac7data($dc1tID,'prva1');
                $data['prva2'] = $this->ac7model->getac7data($dc1tID,'prva2');
                $data['prva3'] = $this->ac7model->getac7data($dc1tID,'prva3');

                $data['prpd1'] = $this->ac7model->getac7data($dc1tID,'prpd1');
                $data['prpd2'] = $this->ac7model->getac7data($dc1tID,'prpd2');
                $data['prpd3'] = $this->ac7model->getac7data($dc1tID,'prpd3');

                //  OTHER AREA
                $data['oa1'] = $this->ac7model->getac7data($dc1tID,'oa1');
                $data['oa2'] = $this->ac7model->getac7data($dc1tID,'oa2');
                $data['oa3'] = $this->ac7model->getac7data($dc1tID,'oa3');
                $data['oa4'] = $this->ac7model->getac7data($dc1tID,'oa4');
                $data['oa5'] = $this->ac7model->getac7data($dc1tID,'oa5');
                $data['oa6'] = $this->ac7model->getac7data($dc1tID,'oa6');

                $data['oagen'] = $this->ac7model->getac7data($dc1tID,'oagen');
                $data['oae1'] = $this->ac7model->getac7data($dc1tID,'oae1');
                $data['oae2'] = $this->ac7model->getac7data($dc1tID,'oae2');
                $data['oae3'] = $this->ac7model->getac7data($dc1tID,'oae3');

                $data['oaro1'] = $this->ac7model->getac7data($dc1tID,'oaro1');
                $data['oaro2'] = $this->ac7model->getac7data($dc1tID,'oaro2');
                $data['oaro3'] = $this->ac7model->getac7data($dc1tID,'oaro3');

                $data['oac1'] = $this->ac7model->getac7data($dc1tID,'oac1');
                $data['oac2'] = $this->ac7model->getac7data($dc1tID,'oac2');
                $data['oac3'] = $this->ac7model->getac7data($dc1tID,'oac3');

                $data['oava1'] = $this->ac7model->getac7data($dc1tID,'oava1');
                $data['oava2'] = $this->ac7model->getac7data($dc1tID,'oava2');
                $data['oava3'] = $this->ac7model->getac7data($dc1tID,'oava3');

                $data['oapd1'] = $this->ac7model->getac7data($dc1tID,'oapd1');
                $data['oapd2'] = $this->ac7model->getac7data($dc1tID,'oapd2');
                $data['oapd3'] = $this->ac7model->getac7data($dc1tID,'oapd3');

                echo view('includes/Header', $data);
                echo view('chapter1/ac7', $data);
                echo view('includes/Footer');
                break;

            case 'AC8':
                //$data['ac6'] = $this->chapterModel->getac6($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac8', $data);
                echo view('includes/Footer');
                break;

            case 'AC9':
                //$data['ac6'] = $this->chapterModel->getac6($dc1tID);
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


    



  


    












  







    






