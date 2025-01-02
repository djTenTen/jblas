<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\HomeModel;
use \App\Models\AuthModel;
use App\Libraries\Logs;

class AuthController extends BaseController{


    // Properties
    protected $authModel;
    protected $crypt;
    protected $logs;

    // Load the method on the properties
    public function __construct(){

        \Config\Services::session();
        $this->authModel    = new AuthModel();
        $this->crypt        = \Config\Services::encrypter();
        $this->logs         = new Logs();

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

    // User Authentitcation 
    public function auth(){
        // Validation rules
        $validationRules = [
            'email'     => 'required|valid_email',
            'password'  => 'required|min_length[8]'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('access_denied','access_denied');
            return redirect()->to(site_url());
        }
        // user input credentials
        $req = [
            'email'     => $this->request->getPost('email'),
            'password'  => $this->request->getPost('password')
        ];
        //result from the model
        $res = $this->authModel->authenticate($req);
        // check if the account was locked
        if($res === "Locked"){
            session()->setFlashdata('Locked','Locked');
            return redirect()->to(site_url());
        }
        // check if the result from the model was false
        if(!$res) {
            session()->setFlashdata('access_denied','access_denied');
            return redirect()->to(site_url());
        }else{
            // user data
            $user_data = [
                'authentication'    => true,
                'userID'            => $this->encr($res['userID']),
                'name'              => $res['name'],
                'email'             => $res['email'],
                'pass'              => $res['pass'],
                'firm'              => $res['firm'],
                'fstat'             => $res['fstat'],
                'firmID'            => $this->encr($res['firmID']),
                'pos'               => $res['pos'],
                'type'              => $res['type'],
                'photo'             => $res['photo'],
                'signature'         => $res['signature'],
                'logo'              => $res['logo'],
                'posID'             => $this->encr($res['posID']),
                'allowed'           => $res['allowed'],
            ];
            // set the user session
            session()->set($user_data);
            // log the action
            $this->logs->log($user_data['name']. " has just Logged-in");
            // redirect to the dashboard
            return redirect()->to(site_url('/auditsystem/dashboard'));
        }
    }

    // User Logout
    public function logout(){
        // destroy all sessions
        session_destroy();
        // return to login page
        return redirect()->to(site_url());
    }


}
