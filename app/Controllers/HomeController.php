<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\HomeModel;
use \App\Models\AuthModel;

class HomeController extends BaseController{

    protected $homeModel;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->homeModel = new HomeModel();
        $this->crypt  = \Config\Services::encrypter();

    }

    public function homepage(){

        $res = $this->homeModel->getdbexist();
        if($res->getNumRows() > 0){
            if(session()->get('authentication')){
                return redirect()->to(site_url('auditsystem')); 
            }else{
                $page = 'Login';
                $data['title'] = 'Login';
                return view('index/'.$page, $data);
            }
        }else{
            return redirect()->to(site_url('500'));
        }

    }

    public function forgotpass(){

        $page = 'Forgot';
        $data['title'] = 'Forgot Password';
        return view('index/'.$page, $data);

    }

    public function setpass($email){

        $page = 'Setpass';
        $data['email'] = $email;
        $data['title'] = 'Set New Password';
        return view('index/'.$page, $data);

    }

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
            'password'  => $this->crypt->encrypt($this->request->getPost('password')),
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
