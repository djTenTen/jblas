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
            session()->setFlashdata('access_denied','access_denied');
            return redirect()->to(site_url());
        }

        $req = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ];

        
        $res = $this->authModel->authenticate($req);

        switch ($res) {
            case 'usernotexist':
                session()->setFlashdata('accountnotexist','accountnotexist');
                return redirect()->to(site_url());
            break;
            case 'userinactive':
                session()->setFlashdata('accountinactive','accountinactive');
                return redirect()->to(site_url());
            break;
            case 'userunverified':
                session()->setFlashdata('accountunverified','accountunverified');
                return redirect()->to(site_url());
            break;
            case 'wrongpassword':
                session()->setFlashdata('access_denied','access_denied');
                return redirect()->to(site_url());
            break;
        }

        if(!empty($res)){
            $user_data = [
                'authentication' => true,
                'userID' => $this->crypt->encrypt($res['userID']),
                'name' => $res['name'],
                'email' => $res['email'],
                'firm' => $res['firm'],
                'firmID' => $this->crypt->encrypt($res['firmID']),
                'pos' => $res['pos'],
                'posID' => $this->crypt->encrypt($res['posID']),
                'allowed' => $res['allowed'],
            ];
            session()->set($user_data);

            return redirect()->to(site_url('dashboard'));
        }else{

            session()->setFlashdata('access_denied','access_denied');
            return redirect()->to(site_url());

        }

    }

    public function logout(){

        session_destroy();
        return redirect()->to(site_url());

    }




}
