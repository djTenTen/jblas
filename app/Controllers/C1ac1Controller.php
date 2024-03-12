<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C1ac1Model;

class C1ac1Controller extends BaseController{

    protected $ac1model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->ac1model = new C1ac1Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        Chapter 1 AC1 AJAX FUNCTIONS
        ----------------------------------------------------------
    */
    public function editac1question($c1ID){

        $cID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID));
        return $this->ac1model->editac1question($cID);

    }


    
    /**
        ----------------------------------------------------------
        Chapter 1 AC1 VIEW FUNCTIONS
        ----------------------------------------------------------
    */
    public function viewac1($head,$c1tID){

        $data['title'] = 'Chapter 1 Management';
        $data['header'] = $head;
        $data['c1tID'] = $c1tID;
        $data['code'] = 'AC1';

        $dc1tID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID));

        $data['ac1'] = $this->ac1model->getac1($dc1tID);
        $data['nap'] = $this->ac1model->getnameap($dc1tID);
        $data['eqr1'] = $this->ac1model->geteqr1($dc1tID);
        $data['eqr2'] = $this->ac1model->geteqr2($dc1tID);
        $data['eqrr'] = $this->ac1model->geteqrreason($dc1tID);
        

        echo view('includes/Header', $data);
        echo view('chapter1/ac1', $data);
        echo view('includes/Footer');
    
    }



    /**
        ----------------------------------------------------------
        Chapter 1 AC1 POST FUNCTIONS
        ----------------------------------------------------------
    */
    public function addac1questions($head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment'),
            'code' => 'AC1',
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->ac1model->saveac1questions($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }

    }

    public function updateac1questions($head,$c1tID,$c1ID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment'),
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac1model->updateac1questions($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }


    }


    public function activeinactiveac1($head,$c1tID,$c1ID){

        $req = [
            'code' => 'AC1',
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac1model->activeinactiveac1($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }

    }

    public function updatenameap($head,$c1tID,$c1ID){
        
        $req = [
            'nameap' => $this->request->getPost('nameap'),
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac1model->updatenameap($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }

    }

    public function updateeqr($head,$c1tID,$c1ID){
        
        $req = [
            'eqr' => $this->request->getPost('eqr'),
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->ac1model->updateeqr($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC1/'.$head.'/'.$c1tID));
        }

    }



    







}
