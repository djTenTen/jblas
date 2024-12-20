<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\ClientModel;

class ClientController extends BaseController{


    /**
        * @property
    */
    protected $cmodel;
    protected $crypt;


    /**
        * Load the methods on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->cmodel   = new ClientModel();
        $this->crypt    = \Config\Services::encrypter();

    }


    /**
        * @param result
        * dynamic resultpage for Client Management
        return as redirect
    */
    public function resultpage($res){

        if($res === 'exist'){
            session()->setFlashdata('failed','Client already exist.');
        }elseif($res === 'updated'){
            session()->setFlashdata('success','Client has been successfully Updated.');
        }elseif($res){
            session()->setFlashdata('success','Client has been successfully registered');
        }else{
            session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
        }
        return redirect()->to(site_url('auditsystem/client'));

    }

    /**
        * Replacing characters then Decrypting a Data @param ecr
    */
    public function decr($ecr){
        return $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ecr));
    }

    /**
        * Encypting a Data @param ecr then Replacing the characters
    */
    public function encr($ecr){
        return str_ireplace(['/','+'],['~','$'],$this->crypt->encrypt($ecr));
    }
    
    /**
        * fetch and edit the client information
        * fetch reference based on @param clientID
        * @return json
    */
    public function editclient($cID){

        $dcID = $this->decr($cID);
        return $this->cmodel->editclient($dcID);

    }

    /**
        * fetch the client files information
        * fetch reference based on @param clientID
        * @return json
    */
    public function getdefaultfiles($cID){

        $dcID = $this->decr($cID);
        return $this->cmodel->getdefaultfiles($dcID);

    }

    /** 
        --------------------------------------------------------------------------------------------------------------------
        VIEW AND SELECT FILES FROM CHAPTER 1,2,3
        --------------------------------------------------------------------------------------------------------------------
        * @param clientID,name
        * view and select default files for client from chapter 1, 2, and 3
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        return as views
    */
    public function viewfiles($cID,$name){

        $dcID = $this->decr($cID);
        $data['title']  = 'Audit Files';
        $data['subt']   = 'Select Audit files for '.$name;
        $data['cID']    = $cID;
        $data['name']   = $name;
        $data['c1']     = $this->cmodel->getc1($dcID);
        $data['c2']     = $this->cmodel->getc2($dcID);
        $data['c3']     = $this->cmodel->getc3($dcID);
        echo view('includes/Header', $data);
        echo view('client/ViewFiles', $data);
        echo view('includes/Footer');

    }



    /**
        --------------------------------------------------------------------------------------------------------------------
        VIEW AND SET DEFAULT FILES FROM CHAPTER 1,2,3
        --------------------------------------------------------------------------------------------------------------------
        * @param cliendID,name
        * view and set values the assigned files for the client from chapter 1,2, and 3
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        return as views
    */
    public function getfiles($cID,$name){

        $dcID           = $this->decr($cID);
        $data['title']  = 'Audit Files';
        $data['subt']   = 'Set default data on '.$name;
        $data['cID']    = $cID;
        $data['name']   = $name;
        $data['c1']     = $this->cmodel->getchaptervalues('c1',$dcID);
        $data['c2']     = $this->cmodel->getchaptervalues('c2',$dcID);
        $data['c3']     = $this->cmodel->getchaptervalues('c3',$dcID);
        echo view('includes/Header', $data);
        echo view('client/ViewFilesValues', $data);
        echo view('includes/Footer');

    }
    /**
        * @param clientID,moduletitleID
        * add files to the client
    */
    public function setfiles($cID,$mtID){
        $req = [
            'cval'      => $this->request->getPost('checked'),
            'cID'       => $this->decr($cID),
            'mtID'      => $this->decr($mtID),
            'fID'       => $this->decr(session()->get('firmID')),
        ];
        $res = $this->cmodel->setfiles($req);
        return $this->response->setJSON(['message' => $res]);
    }
    /**
        * @param clientID,moduletitleID
        * remove files to the client
    */
    public function removefiles($cID,$mtID){

        $req = [
            'cval'      => $this->request->getPost('checked'),
            'cID'       => $this->decr($cID),
            'mtID'      => $this->decr($mtID),
            'fID'       => $this->decr(session()->get('firmID')),
        ];
        $res = $this->cmodel->removefiles($req);
        return $this->response->setJSON(['message' => $res]);
        
    }



    /**
        --------------------------------------------------------------------------------------------------------------------
        CLIENT MANAGEMENT
        --------------------------------------------------------------------------------------------------------------------
        * view the firm's client information
        return as views
    */
    public function viewclient(){

        $fID            = $this->decr(session()->get('firmID'));
        $data['title']  = 'Client Management';
        $data['client'] = $this->cmodel->getclients($fID);
        echo view('includes/Header', $data);
        echo view('client/Client', $data);
        echo view('includes/Footer');
    
    }
    /**
        * view and select the client for files set defaults
        return as views
    */
    public function viewclientset(){

        $fID            = $this->decr(session()->get('firmID'));
        $data['title']  = 'Client Management Set Defaults';
        $data['client'] = $this->cmodel->getclients($fID);
        echo view('includes/Header', $data);
        echo view('client/ClientDefaults', $data);
        echo view('includes/Footer');

    }
    /**
        * Client Registration
        return as resultpage
    */
    public function addclient(){

        $validationRules = [
            'name'      => 'required',
            'org'       => 'required',
            'email'     => 'required'
        ];
        if (!$this->validate($validationRules)) {
            return $this->resultpage(false);
        }
        $req = [
            'name'      => $this->request->getPost('name'),
            'org'       => $this->request->getPost('org'),
            'email'     => $this->request->getPost('email'),
            'contact'   => $this->request->getPost('contact'),
            'address'   => $this->request->getPost('address'),
            'orgtype'   => $this->request->getPost('orgtype'),
            'industry'  => $this->request->getPost('industry'),
            'fID'       => $this->decr(session()->get('firmID')),
        ];
        $res = $this->cmodel->saveclient($req);
        return $this->resultpage($res);

    }
    /**
        * @param clientID
        * Update Client Information
        return as resultpage
    */
    public function updateclient($cID){

        $dcID = $this->decr($cID);
        $validationRules = [
            'name'      => 'required',
            'org'       => 'required',
            'email'     => 'required'
        ];
        if (!$this->validate($validationRules)) {
            return $this->resultpage(false);
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
            'fID'       => $this->decr(session()->get('firmID')),
        ];
        $res = $this->cmodel->updateclient($req);
        return $this->resultpage($res);

    }


    /**
        * @param clientID
        * Set to active & Inactive the Auditor's information
        * @return redirect-to-page
    */
    public function acin($cID){

        $dcID  = $this->decr($cID);
        $res   = $this->cmodel->acin($dcID);
        return $this->resultpage($res);

    }


}
