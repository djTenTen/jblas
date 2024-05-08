<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\Chapter2Model;

class Chapter2Controller extends BaseController{


    protected $c2model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->c2model = new Chapter2Model();
        $this->crypt   = \Config\Services::encrypter();

    }

    public function savequestions($code,$head,$c2tID){

        $validationRules = [
            'question'   => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c2/manage/'.$code.'/'.$head.'/'.$c2tID));
        }
        $req = [
            'question'      => $this->request->getPost('question'),
            'extent'        => $this->request->getPost('extent'),
            'reference'     => $this->request->getPost('reference'),
            'initials'      => $this->request->getPost('initials'),
            'code'          => $code,
            'part'          => $code,
            'c2tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID))
        ];
        $res = $this->c2model->savequestions($req);
        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c2/manage/'.$code.'/'.$head.'/'.$c2tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c2/manage/'.$code.'/'.$head.'/'.$c2tID));
        }

    }

    public function saveaicpppa($code,$head,$c2tID){

        $validationRules = [
            'question'   => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c2/manage/'.$code.'/'.$head.'/'.$c2tID));
        }
        $req = [
            'question'      => $this->request->getPost('question'),
            'comment'       => $this->request->getPost('comment'),
            'code'          => $code,
            'part'          => 'aicpppa',
            'c2tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID))
        ];
        $res = $this->c2model->saveaicpppa($req);
        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c2/manage/'.$code.'/'.$head.'/'.$c2tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c2/manage/'.$code.'/'.$head.'/'.$c2tID));
        }

    }

    public function savercicp($code,$head,$c2tID){

        $validationRules = [
            'question'   => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c2/manage/'.$code.'/'.$head.'/'.$c2tID));
        }
        $req = [
            'question'      => $this->request->getPost('question'),
            'extent'        => $this->request->getPost('yesno'),
            'comment'       => $this->request->getPost('comment'),
            'code'          => $code,
            'part'          => 'rcicp',
            'c2tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID))
        ];
        $res = $this->c2model->savercicp($req);
        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c2/manage/'.$code.'/'.$head.'/'.$c2tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c2/manage/'.$code.'/'.$head.'/'.$c2tID));
        }

    }

    public function acin($code,$head,$c2tID,$c2ID){

        $req = [
            'code' => $code,
            'c2ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2ID))
        ];
        $res = $this->c2model->acin($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c2/manage/'.$code.'/'.$head.'/'.$c2tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c2/manage/'.$code.'/'.$head.'/'.$c2tID));
        }

    }


}