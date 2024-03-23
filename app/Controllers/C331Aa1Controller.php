<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C331Aa1Model;

class C331Aa1Controller extends BaseController{

    protected $c331aa1model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->c331aa1model = new C331Aa1Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        Chapter 3 AC9 POST FUNCTIONS
        ----------------------------------------------------------
    */
   
    public function savequestions($code,$head,$c3tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'extent' => $this->request->getPost('extent'),
            'reference' => $this->request->getPost('reference'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];

        $res = $this->c331aa1model->savequestions($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }


    }


    public function savesection3($code,$head,$c3tID){

        $sec = [
            'a1' => $this->request->getPost('a1'),
            'a2' => $this->request->getPost('a2'),
            'a3' => $this->request->getPost('a3'),
            'a4' => $this->request->getPost('a4'),
            'a5' => $this->request->getPost('a5'),
            'a6' => $this->request->getPost('a6'),
            'a7' => $this->request->getPost('a7')
        ];

        $req = [
            'question' => json_encode($sec),
            'code' => $code,
            'part' => 'section3',
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];

        $res = $this->c331aa1model->savesection3($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }


    }

    

    public function activeinactiveac3($code,$head,$c3tID,$c3ID){

        $req = [
            'code' => $code,
            'c3ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3ID))
        ];
        $res = $this->c331aa1model->activeinactiveac3($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }




    







    





}
