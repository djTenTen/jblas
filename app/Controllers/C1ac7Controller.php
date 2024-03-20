<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C1ac7Model;

class C1ac7Controller extends BaseController{

    protected $ac7model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->ac7model = new C1ac7Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        Chapter 1 AC1 AJAX FUNCTIONS
        ----------------------------------------------------------
    */
    public function editac4question($c1ID){

        $cID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID));
        return $this->ac7model->editac4question($cID);

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

        $res = $this->ac7model->saveac4questions($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/AC4/'.$head.'/'.$c1tID));
        }

    }

    public function updates1($head,$c1tID){

        $genyn = [
            'y1' => $this->request->getPost('y1'),
            'y2' => $this->request->getPost('y2'),
            'y3' => $this->request->getPost('y3'),
            'y4' => $this->request->getPost('y4'),
            'y5' => $this->request->getPost('y5'),
            'y6' => $this->request->getPost('y6'),
            'gen' => $this->request->getPost('gen'),
            'e1' => $this->request->getPost('e1'),
            'e2' => $this->request->getPost('e2'),
            'e3' => $this->request->getPost('e3'),
            'ro1' => $this->request->getPost('ro1'),
            'ro2' => $this->request->getPost('ro2'),
            'ro3' => $this->request->getPost('ro3'),
            'c1' => $this->request->getPost('c1'),
            'c2' => $this->request->getPost('c2'),
            'c3' => $this->request->getPost('c3'),
            'va1' => $this->request->getPost('va1'),
            'va2' => $this->request->getPost('va2'),
            'va3' => $this->request->getPost('va3'),
            'pd1' => $this->request->getPost('pd1'),
            'pd2' => $this->request->getPost('pd2'),
            'pd3' => $this->request->getPost('pd3'),
        ];

        $req = [
            'genyn' => json_encode($genyn),
        ];

        $ref = [
            'part' => $this->request->getPost('part'),
            'code' => 'AC7',
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];


        $res = $this->ac7model->updates1($req,$ref);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC7/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC7/'.$head.'/'.$c1tID));
        }


    }

    public function updates2($head,$c1tID){

        $req = [
            'acid' => $this->request->getPost('acid'),
            'question' => $this->request->getPost('question')
        ];
        $res = $this->ac7model->updates2($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC7/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC7/'.$head.'/'.$c1tID));
        }


    }





    







    





}
