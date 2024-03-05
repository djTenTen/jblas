<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\HomeModel;
use \App\Models\AuthModel;

class AuthController extends BaseController{

    protected $authModel;
    protected $crypt;
    protected $userdata;

    public function __construct(){

        \Config\Services::session();
        $this->authModel = new AuthModel();
        $this->crypt = \Config\Services::encrypter();

    }


    public function auth(){

        $validationRules = [
            'email' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            session()->setFlashdata('access_denied',
            '<div class="alert alert-danger alert-icon" role="alert">
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-icon-aside">
                    <i class="far fa-flag"></i>
                </div>
                <div class="alert-icon-content">
                    <h6 class="alert-heading">Access Denied</h6>
                    Invalid email or password, Please try again.
                </div>
            </div>');

            return redirect()->to(site_url());
        }

        $req = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ];

        $res = $this->authModel->authenticate($req);

        if(!empty($res)){
            return redirect()->to(site_url('dashboard'));
        }else{

            session()->setFlashdata('access_denied',
            '<div class="alert alert-danger alert-icon" role="alert">
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-icon-aside">
                    <i class="far fa-flag"></i>
                </div>
                <div class="alert-icon-content">
                    <h6 class="alert-heading">Access Denied</h6>
                    Invalid email or password, Please try again.
                </div>
            </div>');
            return redirect()->to(site_url());

        }

    }




}
