<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\HomeModel;
use \App\Models\AuthModel;

class HomeController extends BaseController{


    /**
        * @property
    */
    protected $homeModel;
    protected $crypt;


    /**
        * Load the methods on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->homeModel = new HomeModel();
        $this->crypt  = \Config\Services::encrypter();

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
        * view the home page or login page
        * it check if the db exist
        * @return redirect page
    */
    public function homepage(){

        $res = $this->homeModel->getdbexist();
        if($res){
            if(session()->get('authentication')){
                return redirect()->to(site_url('auditsystem/dashboard')); 
            }else{
                $data['title'] = 'Login';
                return view('index/Login', $data);
            }
        }else{
            return redirect()->to(site_url('500'));
        }

    }


    /**
        * forgot password page
        * @return view
    */
    public function forgotpass(){

        $data['title'] = 'Forgot Password';
        return view('index/Forgot', $data);

    }


    /**
        * @param email
        * set new password page
        * @return view
    */
    public function setpass($email){

        $page = 'Setpass';
        $data['email'] = $email;
        $data['title'] = 'Set New Password';
        return view('index/'.$page, $data);

    }


    /**
        * validate the email for reset password
        * @return redirection
    */
    public function resetpass(){

        $validationRules = [
            'email'     => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_email','invalid_email');
            return redirect()->to(site_url('forgot'));
        }
        $email = $this->request->getPost('email');
        $res = $this->homeModel->resetpass($email);
        if($res){
            return redirect()->to(site_url('setpass/'.$email));
        }else{
            session()->setFlashdata('emailnotexist','emailnotexist');
            return redirect()->to(site_url('forgot'));
        }

    }


    /**
        * save the new password
        * @return redirection
    */
    public function savepass($email){

        $validationRules = [
            'otp'       => 'required',
            'password'  => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_otp','invalid_otp');
            return redirect()->to(site_url('setpass/'.$email));
        }
        $req = [
            'email'     => $email,
            'otp'       => $this->request->getPost('otp'),
            'password'  => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
        ];
        $res = $this->homeModel->savepass($req);
        if($res){
            session()->setFlashdata('pass_changed','pass_changed');
            return redirect()->to(site_url());
        }else{
            session()->setFlashdata('wrong_otp','wrong_otp');
            return redirect()->to(site_url('setpass/'.$email));
        }

    }




}
