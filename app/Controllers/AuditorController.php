<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\AuditorModel;

class AuditorController extends BaseController{

    // Properties
    protected $audmodel;
    protected $crypt;

    // Load the method on the properties
    public function __construct(){

        \Config\Services::session();
        $this->audmodel     = new AuditorModel();
        $this->crypt        = \Config\Services::encrypter();

    }

    // Dynamic result page for Auditor Management
    public function resultpage($res){

        // setFlashdata are used for result notification
        if($res == 'exist'){
            session()->setFlashdata('failed','Auditor already exist.');
        }elseif($res == 'updated'){
            session()->setFlashdata('success','Auditor has been successfully Updated.');
        }elseif($res){
            session()->setFlashdata('success','Auditor has been successfully registered');
        }else{
            session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
        }
        // return to it's original page;
        return redirect()->to(site_url('auditsystem/auditor'));

    }

    // Decrypting a Data
    public function decr($ecr){
        // return replace back the character that been changed and decrypt to its original form
        return $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ecr));
    }

    // Encrypting a Data
    public function encr($ecr){
        // return encrypt the data and replaced some characters
        return str_ireplace(['/','+'],['~','$'],$this->crypt->encrypt($ecr));
    }

    // Getting and editing the information of auditor based on id
    public function editauditor($uID){
        // Decrypted userID
        $duID = $this->decr($uID);
        // Return result from editauditor()
        return $this->audmodel->editauditor($duID);
    }

    // view Auditor Management Page
    public function viewauditor(){

        // Decrypted firmID
        $fID = $this->decr(session()->get('firmID'));
        // Decrypted userID
        $uID = $this->decr(session()->get('userID'));
        // all array inside the $data will be called as variable on the views ex: $title
        $data['title']  = 'Auditor Management';
        // result from method getauditor()
        $data['aud']    = $this->audmodel->getauditor($fID,$uID);
        //views
        echo view('includes/Header', $data);
        echo view('auditor/Auditor', $data);
        echo view('includes/Footer');
    
    }

    // Registering Auditors information
    public function addauditor(){

        // validation rules
        $validationRules = [
            'name'  => 'required',
            'email' => 'required',
            'type'  => 'required'
        ];
        if (!$this->validate($validationRules)) {
            return $this->resultpage(false);
        }
        // determine which type the auditor should fall on and it corresponds positions
        switch ($this->request->getPost('type')) {
            case 'Preparer'     : $pos = 2; break;
            case 'Reviewer'     : $pos = 4; break;
            case 'Audit Manager': $pos = 5; break;
            default             : $pos = 2;break;
        }
        // generate a password for auditor
        $genpass = substr(bin2hex(random_bytes(10)), 0, 10);
        // data container of auditor
        $req = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'address'   => $this->request->getPost('address'),
            'contact'   => $this->request->getPost('contact'),
            'pass'      => password_hash($genpass,PASSWORD_DEFAULT), //password encryption
            'genpass'   => $genpass,
            'type'      => $this->request->getPost('type'),
            'fID'       => $this->decr(session()->get('firmID')), // decryption of firmID
            'firm'      => session()->get('firm'),
            'signature' => $this->request->getFile('signature'),
            'pos'       => $pos,
        ];
        // result from the model
        $res = $this->audmodel->saveauditor($req);
        // return result
        return $this->resultpage($res);

    }

    // Update Auditors Information
    public function updateauditor($uID){

        // decypted userID
        $duID = $this->decr($uID);
        // validation rules
        $validationRules = [
            'name'  => 'required',
            'email' => 'required',
            'type'  => 'required'
        ];
        if(!$this->validate($validationRules)) {
            return $this->resultpage(false);
        }
        // determine which type the auditor should fall on and it corresponds positions
        switch ($this->request->getPost('type')) {
            case 'Preparer'     : $pos = 2; break;
            case 'Reviewer'     : $pos = 4; break;
            case 'Audit Manager': $pos = 5; break;
            default             : $pos = 2;break;
        }
        // data container of auditor
        $req = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'type'  => $this->request->getPost('type'),
            'pos'   => $pos,
            'uID'   => $duID,
        ];
        // result from the model
        $res = $this->audmodel->updateauditor($req);
        // return result
        return $this->resultpage($res);

    }

    // Set to active & Inactive the Auditor's information
    public function acin($uID){

        // decypted userID
        $duID = $this->decr($uID);
        // result from the model
        $res  = $this->audmodel->acin($duID);
        // return result
        return $this->resultpage($res);

    }


}
