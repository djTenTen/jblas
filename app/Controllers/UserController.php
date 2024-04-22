<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Config\UploadConfig;

use \App\Models\UserModel;

class UserController extends BaseController{
    
    use ResponseTrait;

    protected $usermodel;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->usermodel = new UserModel();
        $this->crypt = \Config\Services::encrypter();

    }


    public function register(){

        $data['title'] = 'Sign-up';

        echo view('users/Signup', $data);

    }

    public function viewusers(){

        $uID = $this->crypt->decrypt(session()->get('userID'));

        $data['title'] = 'User Management';

        $data['usr'] = $this->usermodel->getusers($uID);
        $data['pos'] = $this->usermodel->getposition();
        $data['firm'] = $this->usermodel->getfirm();
        
        echo view('includes/Header', $data);
        echo view('users/Users', $data);    
        echo view('includes/Footer');

    }

    public function edituser($uID){

        $duID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$uID));
        return $this->usermodel->edituser($duID);

    }

    public function signup(){
        // $maxsize = 5 * 1024 * 1024;
        // $validimg = [
        //     'logo' => 'uploaded[image]|max_size[image,'.$maxsize.']|is_image[image,jpeg,png]'
        // ];
        // if (!$this->validate($validimg)) {
        //     session()->setFlashdata('invalidimage','invalidimage');
        //     return redirect()->to(site_url('register'));
        // }

        $validationRules = [
            'fname' => 'required',
            'firm' => 'required',
            'email' => 'required',
            'pass' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('register'));
        }
        $pss = $this->request->getPost('pass');
        $req = [
            'fname' => $this->request->getPost('fname'),
            'firm' => $this->request->getPost('firm'),
            'address' => $this->request->getPost('address'),
            'contact' => $this->request->getPost('contact'),
            'noemployee' => $this->request->getPost('noemployee'),
            'noclient' => $this->request->getPost('noclient'),
            'email' => $this->request->getPost('email'),
            'logo' => $this->request->getFile('logo'),
            'pass' => $this->crypt->encrypt($pss)
        ];

        if($this->request->getPost('pass') == $this->request->getPost('cpass')){

            $res = $this->usermodel->signin($req);

            if($res == 'exist'){
                session()->setFlashdata('exist','exist');
                return redirect()->to(site_url('register'));
            }else if($res == "registered"){
                session()->setFlashdata('success_registration','success_registration');
                return redirect()->to(site_url('register'));
            }else{
                session()->setFlashdata('failed_registration','failed_registration');
                return redirect()->to(site_url('register'));
            }

        }else{
            session()->setFlashdata('passnotmatch','passnotmatch');
            return redirect()->to(site_url('register'));
        }

    }
    public function adduser(){
        
        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'type' => 'required',
            'pos' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/user'));
        }

        $req = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'pass' => $this->crypt->encrypt('password'),
            'firm' => $this->crypt->decrypt($this->request->getPost('firm')),
            'type' => $this->request->getPost('type'),
            'pos' => $this->crypt->decrypt($this->request->getPost('pos'))
        ];

        $res = $this->usermodel->adduser($req);

        if($res == 'exist'){
            session()->setFlashdata('exist','exist');
            return redirect()->to(site_url('auditsystem/user'));
        }else if($res == "added"){
            session()->setFlashdata('added','added');
            return redirect()->to(site_url('auditsystem/user'));
        }else{
            session()->setFlashdata('failed','failed');
            return redirect()->to(site_url('auditsystem/user'));
        }

    }
    public function udpateuser($uID){

        $duID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$uID));

        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'type' => 'required',
            'pos' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/user'));
        }

        $req = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'type' => $this->request->getPost('type'),
            'pos' => $this->crypt->decrypt($this->request->getPost('pos')),
            'uID' => $duID,
        ];

        $res = $this->usermodel->udpateuser($req);

        if($res == "updated"){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/user'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/user'));
        }




        
    }




    public function acin($uID){

        $duID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$uID));

        $res = $this->usermodel->acin($duID);

        if($res){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/user'));
        }else{
            session()->setFlashdata('failed','failed');
            return redirect()->to(site_url('auditsystem/user'));
        }



    }




}