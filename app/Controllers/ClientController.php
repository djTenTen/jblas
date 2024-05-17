<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\ClientModel;

class ClientController extends BaseController{


    protected $cmodel;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->cmodel   = new ClientModel();
        $this->crypt    = \Config\Services::encrypter();

    }
    
    public function editclient($cID){

        $dcID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        return $this->cmodel->editclient($dcID);

    }

    public function getdefaultfiles($cID){

        $dcID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        return $this->cmodel->getdefaultfiles($dcID);

    }

    public function viewfiles($cID,$name){

        $data['title']  = 'HAT Audit Files for '. $name;
        $data['cID']    = $cID;
        $data['name']   = $name;
        $data['c1']     = $this->cmodel->getc1();
        $data['c2']     = $this->cmodel->getc2();
        $data['c3']     = $this->cmodel->getc3();
        echo view('includes/Header', $data);
        echo view('client/ViewFiles', $data);
        echo view('includes/Footer');

    }

    public function getfiles($cID,$name){

        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $data['title']  = 'Files of '. $name;
        $data['cID']    = $cID;
        $data['name']   = $name;
        $data['c1']     = $this->cmodel->getc1values($dcID);
        $data['c2']     = $this->cmodel->getc2values($dcID);
        $data['c3']     = $this->cmodel->getc3values($dcID);
        echo view('includes/Header', $data);
        echo view('client/ViewFilesValues', $data);
        echo view('includes/Footer');

    }

    public function viewclient(){

        $fID            = $this->crypt->decrypt(session()->get('firmID'));
        $data['title']  = 'Client Management';
        $data['client'] = $this->cmodel->getclients($fID);
        echo view('includes/Header', $data);
        echo view('client/Client', $data);
        echo view('includes/Footer');
    
    }

    public function viewclientset(){

        $fID            = $this->crypt->decrypt(session()->get('firmID'));
        $data['title']  = 'Client Management Set Defaults';
        $data['client'] = $this->cmodel->getclients($fID);
        echo view('includes/Header', $data);
        echo view('client/ClientDefaults', $data);
        echo view('includes/Footer');

    }

    public function addclient(){

        $validationRules = [
            'name'      => 'required',
            'org'       => 'required',
            'email'     => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client'));
        }
        $req = [
            'name'      => $this->request->getPost('name'),
            'org'       => $this->request->getPost('org'),
            'email'     => $this->request->getPost('email'),
            'contact'   => $this->request->getPost('contact'),
            'address'   => $this->request->getPost('address'),
            'orgtype'   => $this->request->getPost('orgtype'),
            'industry'  => $this->request->getPost('industry'),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cmodel->saveclient($req);
        if($res == 'exist'){
            session()->setFlashdata('exist','exist');
            return redirect()->to(site_url('auditsystem/client'));
        }else if($res == "registered"){
            session()->setFlashdata('added','added');
            return redirect()->to(site_url('auditsystem/client'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client'));
        }

    }

    public function updateclient($cID){

        $dcID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $validationRules = [
            'name'      => 'required',
            'org'       => 'required',
            'email'     => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client'));
        }
        $req = [
            'name'      => $this->request->getPost('name'),
            'org'       => $this->request->getPost('org'),
            'email'     => $this->request->getPost('email'),
            'contact'   => $this->request->getPost('contact'),
            'address'   => $this->request->getPost('address'),
            'orgtype'   => $this->request->getPost('orgtype'),
            'industry'  => $this->request->getPost('industry'),
            'cID'       =>  $dcID,
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cmodel->updateclient($req);
        if($res == "updated"){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/client'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client'));
        }

    }

    public function setfiles($cID){

        $dcID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $req = [
            'c1'        => $this->request->getPost('c1'),
            'c2'        => $this->request->getPost('c2'),
            'c3'        => $this->request->getPost('c3'),
            'clientID'  => $dcID,
            'firmID'    => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cmodel->setfiles($req);

        if($res == "files_added"){
            session()->setFlashdata('files_added','files_added');
            return redirect()->to(site_url('auditsystem/client/set'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/set'));
        }
        
    }

    public function acin($cID){

        $dcID  = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $res   = $this->cmodel->acin($dcID);
        if($res){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/client'));
        }else{
            session()->setFlashdata('failed','failed');
            return redirect()->to(site_url('auditsystem/client'));
        }

    }


}
