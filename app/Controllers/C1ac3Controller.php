<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C1ac3Model;

class C1ac3Controller extends BaseController{

    protected $ac3model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->ac3model = new C1ac3Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        Chapter 1 AC1 AJAX FUNCTIONS
        ----------------------------------------------------------
    */
    public function editac3question($c1ID){

        $cID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID));
        return $this->ac3model->editac3question($cID);

    }

    /**
        ----------------------------------------------------------
        Chapter 1 AC1 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function addac3questions($head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/AC3/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment'),
            'part' => $this->request->getPost('part'),
            'code' => 'AC3',
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->ac3model->saveac3questions($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/AC3/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/AC3/'.$head.'/'.$c1tID));
        }

    }

    public function updateac3questions($head,$c1tID,$c1ID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/AC3/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment'),
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac3model->updateac3questions($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC3/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC3/'.$head.'/'.$c1tID));
        }


    }


    public function activeinactiveac3($head,$c1tID,$c1ID){

        $req = [
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac3model->activeinactiveac3($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC3/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC3/'.$head.'/'.$c1tID));
        }

    }

    public function updateaep($head,$c1tID,$c1ID){
        
        $req = [
            'eap' => $this->request->getPost('eap'),
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac3model->updateaep($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC3/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC3/'.$head.'/'.$c1tID));
        }

    }



    







}
