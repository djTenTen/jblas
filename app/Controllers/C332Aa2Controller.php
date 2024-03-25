<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C332Aa2Model;

class C332Aa2Controller extends BaseController{

    protected $c332aa2model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->c332aa2model = new C332Aa2Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        Chapter 3 AC9 POST FUNCTIONS
        ----------------------------------------------------------
    */
   
    public function saveaa2($code,$head,$c3tID){

        $aa2 = [
            'rat' => $this->request->getPost('rat'),
            'rcae' => $this->request->getPost('rcae'),
            'atriaq' => $this->request->getPost('atriaq'),
            'kcapet' => $this->request->getPost('kcapet'),
            'fd' => $this->request->getPost('fd'),
            'fs' => $this->request->getPost('fs'),
            'oi' => $this->request->getPost('oi')
        ];

        $req = [
            'aa2' => json_encode($aa2),
            'code' => $code,
            'part' => 'aa2',
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];

        $res = $this->c332aa2model->saveaa2($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }


    }





    







    





}
