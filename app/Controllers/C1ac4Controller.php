<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C1ac4Model;

class C1ac4Controller extends BaseController{

    protected $ac4model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->ac4model = new C1ac4Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        Chapter 1 AC1 AJAX FUNCTIONS
        ----------------------------------------------------------
    */
    public function editac4question($c1ID){

        $cID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID));
        return $this->ac4model->editac4question($cID);

    }

    /**
        ----------------------------------------------------------
        Chapter 1 AC1 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function addac4questions($head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'comment' => $this->request->getPost('comment'),
            'code' => 'AC4',
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->ac4model->saveac4questions($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }

    }

    public function updateac4questions($head,$c1tID,$c1ID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'comment' => $this->request->getPost('comment'),
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac4model->updateac4questions($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }


    }


    public function activeinactiveac4($head,$c1tID,$c1ID){

        $req = [
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac4model->activeinactiveac4($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }

    }



    public function updateppr($head,$c1tID,$c1ID){

        $req = [
            'ppr' => $this->request->getPost('ppr'),
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac4model->updateppr($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }


    }





    





}
