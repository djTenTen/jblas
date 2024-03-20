<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C1ac11Model;

class C1ac11Controller extends BaseController{

    protected $ac11model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->ac11model = new C1ac11Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        Chapter 1 AC9 POST FUNCTIONS
        ----------------------------------------------------------
    */
   


    public function updateac11($head,$c1tID){

        $ac11 = [
            'datem' => $this->request->getPost('datem'),
            'ape1' => $this->request->getPost('ape1'),
            'ape2' => $this->request->getPost('ape2'),
            'ape3' => $this->request->getPost('ape3'),
            'ieqr1' => $this->request->getPost('ieqr1'),
            'ieqr2' => $this->request->getPost('ieqr2'),
            'ieqr3' => $this->request->getPost('ieqr3'),
            'mngr1' => $this->request->getPost('mngr1'),
            'mngr2' => $this->request->getPost('mngr2'),
            'mngr3' => $this->request->getPost('mngr3'),
            'sup1' => $this->request->getPost('sup1'),
            'sup2' => $this->request->getPost('sup2'),
            'sup3' => $this->request->getPost('sup3'),
            'sr1' => $this->request->getPost('sr1'),
            'sr2' => $this->request->getPost('sr2'),
            'sr3' => $this->request->getPost('sr3'),
            'jra1' => $this->request->getPost('jra1'),
            'jra2' => $this->request->getPost('jra2'),
            'jra3' => $this->request->getPost('jra3'),
            'jrb1' => $this->request->getPost('jrb1'),
            'jrb2' => $this->request->getPost('jrb2'),
            'jrb3' => $this->request->getPost('jrb3'),
            'dcfrrt1' => $this->request->getPost('dcfrrt1'),
            'dcfrrt2' => $this->request->getPost('dcfrrt2'),
            'dcfrrt3' => $this->request->getPost('dcfrrt3'),
            'dcfrrt4' => $this->request->getPost('dcfrrt4'),
            'dcfrrt5' => $this->request->getPost('dcfrrt5'),
            'dcfrrt6' => $this->request->getPost('dcfrrt6'),
            'dcfrrt7' => $this->request->getPost('dcfrrt7'),
            'dcfrrt8' => $this->request->getPost('dcfrrt8'),
            'dcfrrt9' => $this->request->getPost('dcfrrt9'),
            'sacb1' => $this->request->getPost('sacb1'),
            'sacb2' => $this->request->getPost('sacb2'),
            'sacb3' => $this->request->getPost('sacb3'),
            'sacb4' => $this->request->getPost('sacb4'),
            'sacb5' => $this->request->getPost('sacb5'),
            'sacb6' => $this->request->getPost('sacb6'),
            'sacb7' => $this->request->getPost('sacb7'),
            'sacb8' => $this->request->getPost('sacb8'),
            'sacb9' => $this->request->getPost('sacb9'),
        ];

        $req = [
            'ac11' => json_encode($ac11)
        ];

        $ref = [
            'code' => 'AC11',
            'part' => 'ac11data',
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->ac11model->updateac11($req,$ref);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC11/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC11/'.$head.'/'.$c1tID));
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
