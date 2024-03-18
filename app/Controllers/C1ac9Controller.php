<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C1ac9Model;

class C1ac9Controller extends BaseController{

    protected $ac9model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->ac9model = new C1ac9Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        Chapter 1 AC9 POST FUNCTIONS
        ----------------------------------------------------------
    */
   


    public function updatesec1ac9($head,$c1tID){

        $req = [
            'acid' => $this->request->getPost('acid'),
            'question' => $this->request->getPost('question')
        ];
        $res = $this->ac9model->updatesec1ac9($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC9/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC9/'.$head.'/'.$c1tID));
        }


    }


    public function updatesec2ac9($head,$c1tID){

        $req = [
            'acid' => $this->request->getPost('acid'),
            'date' => $this->request->getPost('date')
        ];
        $res = $this->ac9model->updatesec2ac9($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC9/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC9/'.$head.'/'.$c1tID));
        }


    }


    public function updatesec3ac9($head,$c1tID){

        $req = [
            'acid' => $this->request->getPost('acid'),
            'date' => $this->request->getPost('date'),
            'question' => $this->request->getPost('question'),
        ];
        $res = $this->ac9model->updatesec3ac9($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC9/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC9/'.$head.'/'.$c1tID));
        }


    }

    





    







    





}
