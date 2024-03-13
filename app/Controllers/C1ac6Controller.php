<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C1ac6Model;

class C1ac6Controller extends BaseController{

    protected $ac6model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->ac6model = new C1ac6Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        Chapter 1 AC1 AJAX FUNCTIONS
        ----------------------------------------------------------
    */
    public function editac6question($c1ID){

        $cID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID));
        return $this->ac6model->editac6question($cID);

    }

    public function editacsection3($c1ID){

        $cID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID));
        return $this->ac6model->editacsection3($cID);

    }



    

    /**
        ----------------------------------------------------------
        Chapter 1 AC1 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function addac6questions($head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'planning' => $this->request->getPost('planning'),
            'finalization' => $this->request->getPost('finalization'),
            'reference' => $this->request->getPost('reference'),
            'code' => 'AC6',
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->ac6model->saveac6questions($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }

    }

    public function updateac6questions($head,$c1tID,$c1ID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'planning' => $this->request->getPost('planning'),
            'finalization' => $this->request->getPost('finalization'),
            'reference' => $this->request->getPost('reference'),
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac6model->updateac6questions($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }


    }


    public function activeinactiveac6($head,$c1tID,$c1ID){

        $req = [
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac6model->activeinactiveac6($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }

    }

    public function udpatesection($head,$c1tID,$c1ID){

        $req = [
            'section' => $this->request->getPost('section'),
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac6model->udpatesection($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }


    }

    public function savesection3($head,$c1tID){

        $validationRules = [
            'financialstatement' => 'required',
            'descriptioncontrol' => 'required',
            'controleffective' => 'required',
            'controlimplemented' => 'required',
            'assesed' => 'required',
            'crosstesting' => 'required',
            'reliancecontrol' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }

        
        $req = [
            'financialstatement' => $this->request->getPost('financialstatement'),
            'descriptioncontrol' => $this->request->getPost('descriptioncontrol'),
            'controleffective' => $this->request->getPost('controleffective'),
            'controlimplemented' => $this->request->getPost('controlimplemented'),
            'assesed' => $this->request->getPost('assesed'),
            'crosstesting' => $this->request->getPost('crosstesting'),
            'reliancecontrol' => $this->request->getPost('reliancecontrol'),
            'code' => 'AC6',
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->ac6model->savesection3($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }

    }


    public function udpatesection3($head,$c1tID,$c1ID){

        $validationRules = [
            'financialstatement' => 'required',
            'descriptioncontrol' => 'required',
            'controleffective' => 'required',
            'controlimplemented' => 'required',
            'assesed' => 'required',
            'crosstesting' => 'required',
            'reliancecontrol' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }

        $req = [
            'financialstatement' => $this->request->getPost('financialstatement'),
            'descriptioncontrol' => $this->request->getPost('descriptioncontrol'),
            'controleffective' => $this->request->getPost('controleffective'),
            'controlimplemented' => $this->request->getPost('controlimplemented'),
            'assesed' => $this->request->getPost('assesed'),
            'crosstesting' => $this->request->getPost('crosstesting'),
            'reliancecontrol' => $this->request->getPost('reliancecontrol'),
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];

        $res = $this->ac6model->udpatesection3($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC6/'.$head.'/'.$c1tID));
        }


    }





    





}
