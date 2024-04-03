<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\UserModel;

class UserController extends BaseController{

    protected $usermodel;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->usermodel = new UserModel();
        $this->crypt = \Config\Services::encrypter();

    }



    public function register(){

        $data['title'] = 'Sign-up';

        echo view('users/signup', $data);

    }

    public function signup(){

        $validationRules = [
            'fname' => 'required',
            'firm' => 'required',
            'email' => 'required',
            'pass' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('register'));
        }
        $pss = $this->request->getPost('pass');
        $req = [
            'fname' => $this->request->getPost('fname'),
            'firm' => $this->request->getPost('firm'),
            'email' => $this->request->getPost('email'),
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




}