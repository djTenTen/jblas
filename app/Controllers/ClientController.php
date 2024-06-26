<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\ClientModel;

class ClientController extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL // 
        THIS FILE IS USED FOR CLIENT MANAGMENT
        Properties being used on this file
        * @property cmodel to include the file client model
        * @property crypt to load the encryption file
    */
    protected $cmodel;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->cmodel   = new ClientModel();
        $this->crypt    = \Config\Services::encrypter();

    }
    

    /**
        * @method editclient() used to load the data of client for editing
        * @param cID encrypted data of client id
        * @var dcID decrypted data of client id
        * @return json
    */
    public function editclient($cID){

        $dcID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        return $this->cmodel->editclient($dcID);

    }


    /**
        * @method getdefaultfiles() used to load the data of default files assigned to the client
        * @param cID encrypted data of client id
        * @var dcID decrypted data of client id
        * @return json
    */
    public function getdefaultfiles($cID){

        $dcID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        return $this->cmodel->getdefaultfiles($dcID);

    }


    /**
        * @method viewfiles() view the HAT files to be assign to client
        * @param cID encrypted data of client id
        * @param name name of the client
        * @var dcID decrypted data of client id
        * @var array-data consist of data and display it on the page
        * @return view
    */
    public function viewfiles($cID,$name){

        $dcID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $data['title']  = 'HAT Audit Files';
        $data['subt']   = 'Select HAT files for '.$name;
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
        * @method getfiles() get the files assigned to the client
        * @param cID encrypted data of client id
        * @param name name of the client
        * @var array-data consist of data and display it on the page
        * @return view
    */
    public function getfiles($cID,$name){

        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $data['title']  = 'HAT Audit Files';
        $data['subt']   = 'Set default data on '.$name;
        $data['cID']    = $cID;
        $data['name']   = $name;
        $data['c1']     = $this->cmodel->getc1values($dcID);
        $data['c2']     = $this->cmodel->getc2values($dcID);
        $data['c3']     = $this->cmodel->getc3values($dcID);
        echo view('includes/Header', $data);
        echo view('client/ViewFilesValues', $data);
        echo view('includes/Footer');

    }


    /**
        * @method viewclient() view the client information
        * @var fID decrypted data of firm id
        * @var array-data consist of data and display it on the page
        * @return view
    */
    public function viewclient(){

        $fID            = $this->crypt->decrypt(session()->get('firmID'));
        $data['title']  = 'Client Management';
        $data['client'] = $this->cmodel->getclients($fID);
        echo view('includes/Header', $data);
        echo view('client/Client', $data);
        echo view('includes/Footer');
    
    }


    /**
        * @method viewclientset() view the client default values
        * @var fID decrypted data of firm id
        * @var array-data consist of data and display it on the page
        * @return view
    */
    public function viewclientset(){

        $fID            = $this->crypt->decrypt(session()->get('firmID'));
        $data['title']  = 'Client Management Set Defaults';
        $data['client'] = $this->cmodel->getclients($fID);
        echo view('includes/Header', $data);
        echo view('client/ClientDefaults', $data);
        echo view('includes/Footer');

    }


    /**
        * @method addclient() add the client information to the database
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the client information
        * @var res a return response from the client model
        * @return redirect-to-page
    */
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


    /**
        * @method updateclient() update the client information to the database
        * @param cID encrypted data of client id
        * @var dcID decrypted data of client id
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the client information
        * @var res a return response from the client model
        * @return redirect-to-page
    */
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


    /**
        * @method setfiles() set default files to the client
        * @param cID encrypted data of client id
        * @var dcID decrypted data of client id
        * @var array-req consist the client information
        * @var res a return response from the client model
        * @return redirect-to-page
    */
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


    /**
        * @method acin() used to set active/inactive the client
        * @param cID encrypted data of client id
        * @var dcID decrypted data of client id
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
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
