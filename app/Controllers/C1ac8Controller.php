<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C1ac8Model;

class C1ac8Controller extends BaseController{

    protected $ac8model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->ac8model = new C1ac8Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        Chapter 1 AC8 POST FUNCTIONS
        ----------------------------------------------------------
    */
   


    public function updateac8questions($head,$c1tID){

        $req = [
            'acid' => $this->request->getPost('acid'),
            'question' => $this->request->getPost('question')
        ];
        $res = $this->ac8model->updateac8questions($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC8/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC8/'.$head.'/'.$c1tID));
        }


    }





    







    





}
