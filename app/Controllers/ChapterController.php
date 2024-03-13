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

class ChapterController extends BaseController{

    protected $chapterModel;
    protected $ac1model;
    protected $ac2model;
    protected $ac3model;
    protected $ac4model;
    protected $ac5model;
    protected $ac6model;
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

        $data['title'] = 'Chapter 1 Management';
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
                //$data['ac6'] = $this->chapterModel->getac6($dc1tID);
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


    



  


    












  







    






