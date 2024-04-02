<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\Chapter1Model;

class Chapter1Controller extends BaseController{

    protected $c1model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->c1model = new Chapter1Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        GENERAL FUNCTIONS
        ----------------------------------------------------------
    */
    public function acin($code,$head,$c1tID,$c1ID){

        $req = [
            'code' => $code,
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->c1model->acin($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }








    /**
        ----------------------------------------------------------
        AC1 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac1($code,$head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->c1model->saveac1($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }

    public function saveac1eqr($code,$head,$c1tID){

        $eqr = [
            'nameap' => $this->request->getPost('nameap'),
            'eqr1' => $this->request->getPost('eqr1'),
            'eqr2' => $this->request->getPost('eqr2'),
            'eqrr' => $this->request->getPost('eqrr')
        ];

        $req = [
            'question' => json_encode($eqr),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->c1model->saveeqr($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }










    /**
        ----------------------------------------------------------
        AC2 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac2($code,$head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'corptax' => $this->request->getPost('corptax'),
            'statutory' => $this->request->getPost('statutory'),
            'accountancy' => $this->request->getPost('accountancy'),
            'other' => $this->request->getPost('other'),
            'totalcu' => $this->request->getPost('totalcu'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->c1model->saveac2($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }
    public function saveac2aep($code,$head,$c1tID){

        $req = [
            'eap' => $this->request->getPost('eap'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->c1model->saveac2aep($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }










    /**
        ----------------------------------------------------------
        AC3 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac3($code,$head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->c1model->saveac3($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }










    /**
        ----------------------------------------------------------
        AC4 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac4ppr($code,$head,$c1tID){

        $ppr = [
            'ppr1' => $this->request->getPost('ppr1'),
            'ppr2' => $this->request->getPost('ppr2')
        ];

        $req = [
            'ppr' => json_encode($ppr),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->c1model->saveac4ppr($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }

    public function saveac4($code,$head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'comment' => $this->request->getPost('comment'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->c1model->saveac4($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }
    








    /**
        ----------------------------------------------------------
        AC5 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac5($code,$head,$c1tID){

        $rc = [
            'res' => $this->request->getPost('res'),
            'con' => $this->request->getPost('con')
        ];

        $req = [
            'rescon' => json_encode($rc),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->c1model->saveac5($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }






















































}