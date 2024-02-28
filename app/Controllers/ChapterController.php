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
    
    // Chapter 1
    public function viewchapter1(){

        // main content
        $page = 'ViewChapter1';
        $data['title'] = 'Chapter 1 Management';
        $state = 'active';
        $data['chptr1'] = $this->chapterModel->viewchapter1($state);
    
        echo view('chapter1/'.$page, $data);

    }

    public function addchapter1(){

        $page = 'AddChapter1';
        $data['title'] = 'Chapter 1 Management';
        echo view('chapter1/'.$page, $data);

    }


    public function savechapter1(){

        $validationRules = [
            'code' => 'required',
            'title' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            return 'error';
        }

        $req = [
            'code' => $this->request->getPost('code'),
            'title' => $this->request->getPost('title')
        ];

        $res = $this->chapterModel->savechapter1($req);

        if($res){
            return redirect()->to(site_url('chapter1/view'));
        }else{
            return 'error';
        }

        

    }








    // Chapter 2
    public function viewchapter2(){

        // main content
        $page = 'ViewChapter2';
        $data['title'] = 'Chapter 2 Management';
        $state = 'active';
        $data['chptr2'] = $this->chapterModel->viewchapter2($state);
    
        echo view('chapter2/'.$page, $data);

    }

    public function addchapter2(){

        $page = 'AddChapter2';
        $data['title'] = 'Chapter 2 Management';
        echo view('chapter2/'.$page, $data);

    }


    public function savechapter2(){

        $validationRules = [
            'code' => 'required',
            'title' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            return 'error';
        }

        $req = [
            'code' => $this->request->getPost('code'),
            'title' => $this->request->getPost('title')
        ];

        $res = $this->chapterModel->savechapter2($req);

        if($res){
            return redirect()->to(site_url('chapter2/view'));
        }else{
            return 'error';
        }

        

    }



    // Chapter 2
    public function viewchapter3(){

        // main content
        $page = 'ViewChapter3';
        $data['title'] = 'Chapter 3 Management';
        $state = 'active';
        $data['chptr3'] = $this->chapterModel->viewchapter3($state);
    
        echo view('chapter3/'.$page, $data);

    }

    public function addchapter3(){

        $page = 'AddChapter3';
        $data['title'] = 'Chapter 3 Management';
        echo view('chapter3/'.$page, $data);

    }


    public function savechapter3(){

        $validationRules = [
            'code' => 'required',
            'title' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            return 'error';
        }

        $req = [
            'code' => $this->request->getPost('code'),
            'title' => $this->request->getPost('title')
        ];

        $res = $this->chapterModel->savechapter3($req);

        if($res){
            return redirect()->to(site_url('chapter3/view'));
        }else{
            return 'error';
        }

        

    }










}
