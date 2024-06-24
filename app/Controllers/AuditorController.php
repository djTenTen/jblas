<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\AuditorModel;

class AuditorController extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL //
        THIS FILE IS USED TO AUDITOR MANAGEMENT
        Properties being used on this file
        * @property audmodel to include the file auditor model
        * @property crypt to load the encryption file
    */
    protected $audmodel;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->audmodel     = new AuditorModel();
        $this->crypt        = \Config\Services::encrypter();

    }


    /**
        * @method editauditor() used to load the data of auditor for editing
        * @param uID encrypted data of user id
        * @var duID decrypted data of user id
        * @return json
    */
    public function editauditor($uID){

        $duID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$uID));
        return $this->audmodel->editauditor($duID);
        
    }


    /**
        * @method viewauditor() used to display the auditor page
        * @return view
    */
    public function viewauditor(){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        $uID = $this->crypt->decrypt(session()->get('userID'));
        $data['title']  = 'Auditor Management';
        $data['aud']    = $this->audmodel->getauditor($fID,$uID);
        echo view('includes/Header', $data);
        echo view('auditor/Auditor', $data);
        echo view('includes/Footer');
    
    }


    /**
        * @method addauditor() used to add or register a auditor
        * @var validationRules set to validate the data before submitting to the database
        * @var genpass consist of generated password given to the auditor
        * @var array-req array data that consist the auditor information
        * @var res a return response from the auditor model if it succeeded
        * @return redirect-to-page
    */
    public function addauditor(){

        $validationRules = [
            'name'  => 'required',
            'email' => 'required',
            'type'  => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/auditor'));
        }
        switch ($this->request->getPost('type')) {
            case 'Preparer'     : $pos = 2; break;
            case 'Reviewer'     : $pos = 4; break;
            case 'Audit Manager': $pos = 5; break;
            default             : $pos = 2;break;
        }
        $genpass = substr(bin2hex(random_bytes(10)), 0, 10);
        $req = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'address'   => $this->request->getPost('address'),
            'contact'   => $this->request->getPost('contact'),
            'pass'      => $this->crypt->encrypt($genpass), //Should be generated and emailed to the user
            'genpass'   => $genpass,
            'type'      => $this->request->getPost('type'),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
            'firm'      => session()->get('firm'),
            'signature' => $this->request->getFile('signature'),
            'pos'       => $pos,
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


    /**
        * @method updateauditor() used to update the information of auditor
        * @param uID consist the encrypted id of auditor
        * @var duID consist the decrypted id of auditor
        * @var validationRules set to validate the data before submitting to the database
        * @var array-req array data that consist the auditor information
        * @var res a return response from the auditor model if it succeeded
        * @return redirect-to-page
    */
    public function updateauditor($uID){

        $duID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$uID));
        $validationRules = [
            'name'  => 'required',
            'email' => 'required',
            'type'  => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/auditor'));
        }
        switch ($this->request->getPost('type')) {
            case 'Preparer'     : $pos = 2; break;
            case 'Reviewer'     : $pos = 4; break;
            case 'Audit Manager': $pos = 5; break;
            default             : $pos = 2;break;
        }
        $req = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'type'  => $this->request->getPost('type'),
            'pos'   => $pos,
            'uID'   => $duID,
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


    /**
        * @method acin() used to set inactive and active the information of auditor
        * @param uID consist the encrypted id of auditor
        * @var duID consist the decrypted id of auditor
        * @var array-req array data that consist the auditor information
        * @var res a return response from the auditor model if it succeeded
        * @return redirect-to-page
    */
    public function acin($uID){

        $duID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$uID));
        $res  = $this->audmodel->acin($duID);
        if($res){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/auditor'));
        }else{
            session()->setFlashdata('failed','failed');
            return redirect()->to(site_url('auditsystem/auditor'));
        }

    }


}
