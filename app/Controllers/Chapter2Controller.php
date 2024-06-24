<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\Chapter2Model;

class Chapter2Controller extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL //    
        THIS FILE IS USED FOR CHAPTER 2 MANAGMENT
        Properties being used on this file
        * @property c2model to include the file chapter 2 model
        * @property crypt to load the encryption file
    */
    protected $c2model;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->c2model = new Chapter2Model();
        $this->crypt   = \Config\Services::encrypter();

    }


    /**
        SINCE THE CHAPTER 2 HAS ALMOST SAME FORMAT OF FILE, AND IT USES @method savequestions() 
        TO SAVE ALL QUESTIONS AND VALUES
        * @param code consist the code of the file name
        * @param head consist the name of the file
        * @param c2tID consist the encrypted data of title id from the title file name
        * @method savequestions() used to save the data of Chapter 2 file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the Chapter 2 file information
        * @var res a return response from the chapter 2 model
        * @return redirect-to-page
    */
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


    /**
        * @method saveaicpppa() used to save the data of Chapter 2 file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the Chapter 2 file information
        * @var res a return response from the chapter 2 model
        * @return redirect-to-page
    */
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


    /**
        * @method savercicp() used to save the data of Chapter 2 file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the Chapter 2 file information
        * @var res a return response from the chapter 2 model
        * @return redirect-to-page
    */
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


    /**
        * @method acin() used to set active/inactive the data from chapter 2 files
        * @param code consist the code of the file name
        * @param head consist the name of the file
        * @param c2tID consist the encrypted data of title id from the title file name
        * @param c2ID consist the encrypted data of chapter 2 id data
        * @var array-req consist the chapter 2 file information
        * @var res a return response from the chapter 2 model
        * @return redirect-to-page
    */
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