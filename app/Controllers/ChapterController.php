<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\ChapterModel;

class ChapterController extends BaseController{

    protected $chapterModel;

    public function __construct(){

        \Config\Services::session();
        $this->chapterModel = new ChapterModel();
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
                $data['ac1'] = $this->chapterModel->getac1($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac1', $data);
                echo view('includes/Footer');
                break;
            
            case 'AC2':
                $data['ac2'] = $this->chapterModel->getac2($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac2', $data);
                echo view('includes/Footer');
                break;

            case 'AC3':
                $data['ac3genmat'] = $this->chapterModel->getac3genmat($dc1tID);
                $data['ac3doccors'] = $this->chapterModel->getac3doccors($dc1tID);
                $data['ac3statutory'] = $this->chapterModel->getac3statutory($dc1tID);
                $data['ac3accsys'] = $this->chapterModel->getac3accsys($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac3', $data);
                echo view('includes/Footer');
                break;

            case 'AC4':
                $data['ac4'] = $this->chapterModel->getac4($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac4', $data);
                echo view('includes/Footer');
                break;

            case 'AC5':
                //$data['ac4'] = $this->chapterModel->getac4($dc1tID);
                echo view('includes/Header', $data);
                echo view('chapter1/ac5', $data);
                echo view('includes/Footer');
                break;

            case 'AC6':
                $data['ac6'] = $this->chapterModel->getac6($dc1tID);
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


    public function addchaper1($code,$head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/chapter1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

        switch ($code) {
            case 'AC1':
                $req = [
                    'question' => $this->request->getPost('question'),
                    'yesno' => $this->request->getPost('yesno'),
                    'comment' => $this->request->getPost('comment'),
                    'code' => $code,
                    'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
                ];
                $res = $this->chapterModel->savechapter1($req);
                break;

            case 'AC2':
                $req = [
                    'question' => $this->request->getPost('question'),
                    'corptax' => $this->request->getPost('corptax'),
                    'statutory' => $this->request->getPost('statutory'),
                    'accountancy' => $this->request->getPost('accountancy'),
                    'other' => $this->request->getPost('other'),
                    'totalcu' => $this->request->getPost('totalcu'),
                    'code' => $code,
                    'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
                ];
                $res = $this->chapterModel->savechapter1($req);
                break;

            case 'AC3':
                $req = [
                    'question' => $this->request->getPost('question'),
                    'yesno' => $this->request->getPost('yesno'),
                    'comment' => $this->request->getPost('comment'),
                    'part' => $this->request->getPost('part'),
                    'code' => $code,
                    'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
                ];
                $res = $this->chapterModel->savechapter1($req);
                break;

            case 'AC4':
                $req = [
                    'question' => $this->request->getPost('question'),
                    'comment' => $this->request->getPost('comment'),
                    'code' => $code,
                    'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
                ];
                $res = $this->chapterModel->savechapter1($req);
                break;

            case 'AC5':
                // $req = [
                //     'question' => $this->request->getPost('question'),
                //     'comment' => $this->request->getPost('comment'),
                //     'code' => $code,
                //     'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
                // ];
                // $res = $this->chapterModel->savechapter1($req);
                break;


            case 'AC6':
                $req = [
                    'question' => $this->request->getPost('question'),
                    'planning' => $this->request->getPost('planning'),
                    'finalization' => $this->request->getPost('finalization'),
                    'reference' => $this->request->getPost('reference'),
                    'code' => $code,
                    'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
                ];
                $res = $this->chapterModel->savechapter1($req);
                break;
    
            default:
                # code...
                break;
        }

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/chapter1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/chapter1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }






}
