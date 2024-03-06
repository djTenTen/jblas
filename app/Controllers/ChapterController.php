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

        switch ($code) {
            case 'AC1':
                $data['ac1'] = $this->chapterModel->getac1($this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)));
                echo view('includes/Header', $data);
                echo view('chapter1/ac1', $data);
                echo view('includes/Footer');
                break;
            
            case 'AC2':
                $data['ac2'] = $this->chapterModel->getac2($this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)));
                echo view('includes/Header', $data);
                echo view('chapter1/ac2', $data);
                echo view('includes/Footer');
                break;
            case 'AC3':
                $data['ac3genmat'] = $this->chapterModel->getac3genmat();
                $data['ac3doccors'] = $this->chapterModel->getac3doccors();
                $data['ac3statutory'] = $this->chapterModel->getac3statutory();
                $data['ac3accsys'] = $this->chapterModel->getac3accsys();
                echo view('includes/Header', $data);
                echo view('chapter1/ac3', $data);
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





















   
    
    
    public function addac3genmat($head){

        $validationRules = [
            'question' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment')
        ];

        $res = $this->chapterModel->saveac3genmat($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }else{

            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }
        
    }

    public function addac3doccors($head){


        $validationRules = [
            'question' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment')
        ];

        $res = $this->chapterModel->saveac3doccors($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }
        
    }

    public function addac3statutory($head){

        $validationRules = [
            'question' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment')
        ];

        $res = $this->chapterModel->saveac3statutory($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }
        
    }

    public function addac3accsys($head){

        $validationRules = [
            'question' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment')
        ];

        $res = $this->chapterModel->saveac3accsys($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/chapter1/manage/ac3/'.$head));
        }
        
    }








}
