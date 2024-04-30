<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\AuditorModel;

class AuditorController extends BaseController{

    protected $audmodel;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->audmodel = new AuditorModel();
        $this->crypt = \Config\Services::encrypter();

    }

    public function editauditor($uID){

        $duID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$uID));
        return $this->audmodel->editauditor($duID);
    }
    
    public function viewauditor(){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        $uID = $this->crypt->decrypt(session()->get('userID'));
        // main content
        $data['title'] = 'Auditor Management';

        $data['aud'] = $this->audmodel->getauditor($fID,$uID);

        echo view('includes/Header', $data);
        echo view('auditor/Auditor', $data);
        echo view('includes/Footer');
    
    }

    public function addauditor(){

        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'type' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/auditor'));
        }

        $req = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
            'contact' => $this->request->getPost('contact'),
            'pass' => $this->crypt->encrypt('password'), //Should be generated and emailed to the user
            'type' => $this->request->getPost('type'),
            'fID' => $this->crypt->decrypt(session()->get('firmID')),
            'signature' => $this->request->getFile('signature'),
            'pos' => 2,
        ];

        $res = $this->audmodel->saveauditor($req);

        if($res == 'exist'){
            session()->setFlashdata('exist','exist');
            return redirect()->to(site_url('auditsystem/auditor'));
        }else if($res == "registered"){
            session()->setFlashdata('added','added');
            return redirect()->to(site_url('auditsystem/auditor'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/auditor'));
        }


    }

    public function updateauditor($uID){

        $duID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$uID));

        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'type' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/auditor'));
        }

        $req = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'type' => $this->request->getPost('type'),
            'uID' =>  $duID,
        ];

        $res = $this->audmodel->updateauditor($req);

        if($res == "updated"){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/auditor'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/auditor'));
        }

    }


    public function acin($uID){

        $duID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$uID));

        $res = $this->audmodel->acin($duID);

        if($res){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/auditor'));
        }else{
            session()->setFlashdata('failed','failed');
            return redirect()->to(site_url('auditsystem/auditor'));
        }



    }





}
