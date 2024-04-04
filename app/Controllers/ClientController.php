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
        $this->cmodel = new ClientModel();
        $this->crypt = \Config\Services::encrypter();

    }
    
    public function editclient($cID){

        $dcID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        return $this->cmodel->editclient($dcID);

    }

    public function viewclient(){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        // main content
        $data['title'] = 'Client Management';

        $data['client'] = $this->cmodel->getclients($fID);

        echo view('includes/Header', $data);
        echo view('client/Client', $data);
        echo view('includes/Footer');
    
    }

    public function clientdefaults($cID){

        $data['title'] = 'Client Default Management';
        $res = $this->cmodel->getclientname($this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)));
        $data['header'] = $res['name'];
        $data['c1'] = $this->cmodel->getc1();

        echo view('includes/Header', $data);
        echo view('client/ClientDefaults', $data);
        echo view('includes/Footer');

    }

    public function addclient(){

        $validationRules = [
            'name' => 'required',
            'org' => 'required',
            'email' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client'));
        }

        $req = [
            'name' => $this->request->getPost('name'),
            'org' => $this->request->getPost('org'),
            'email' => $this->request->getPost('email'),
            'fID' => $this->crypt->decrypt(session()->get('firmID')),
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
            'name' => 'required',
            'org' => 'required',
            'email' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client'));
        }

        $req = [
            'name' => $this->request->getPost('name'),
            'org' => $this->request->getPost('org'),
            'email' => $this->request->getPost('email'),
            'cID' =>  $dcID,
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



    public function acin($cID){

        $dcID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));

        $res = $this->cmodel->acin($dcID);

        if($res){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/client'));
        }else{
            session()->setFlashdata('failed','failed');
            return redirect()->to(site_url('auditsystem/client'));
        }



    }






}
