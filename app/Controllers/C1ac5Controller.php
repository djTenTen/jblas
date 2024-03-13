<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C1ac5Model;

class C1ac5Controller extends BaseController{


    protected $ac5model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->ac5model = new C1ac5Model();
        $this->crypt = \Config\Services::encrypter();

    }



    public function updateres($head,$c1tID,$c1ID){

        $req = [
            'res' => $this->request->getPost('res'),
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];

        $res = $this->ac5model->updateres($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC5/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/AC5/'.$head.'/'.$c1tID));
        }


    }














}