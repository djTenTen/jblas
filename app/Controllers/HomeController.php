<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\HomeModel;
use \App\Models\AuthModel;

class HomeController extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES// 
        THIS FILE IS USED FOR FIRM MANAGEMENT
        Properties being used on this file
        * @property homeModel to include the Home model
        * @property crypt to load the encryption file
    */
    protected $homeModel;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->homeModel = new HomeModel();
        $this->crypt  = \Config\Services::encrypter();

    }


    /**
        * @method homepage() view page of login/home page
        * @var res a return response from the home model
        * @var array-data consist of data and display it on the page
        * @return view if success @return redirect-to-error if false
    */
    public function homepage(){

        $res = $this->homeModel->getdbexist();
        if($res->getNumRows() > 0){
            if(session()->get('authentication')){
                return redirect()->to(site_url('auditsystem')); 
            }else{
                $data['title'] = 'Login';
                return view('index/Login', $data);
            }
        }else{
            return redirect()->to(site_url('500'));
        }

    }


    /**
        * @method forgotpass() view page forgot password
        * @var array-data consist of data and display it on the page
        * @return view 
    */
    public function forgotpass(){

        $data['title'] = 'Forgot Password';
        return view('index/Forgot', $data);

    }


    /**
        * @method setpass() set new password page
        * @param email consist of email of user for reset password
        * @var array-data consist of data and display it on the page
        * @return view 
    */
    public function setpass($email){

        $page = 'Setpass';
        $data['email'] = $email;
        $data['title'] = 'Set New Password';
        return view('index/'.$page, $data);

    }


    /**
        * @method resetpass() reset the password
        * @var validationRules set to validate the data before saving to database
        * @var email contains email
        * @var res a return response from the home model
        * @return redirect-to-page
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
        * @method savepass() save the new password
        * @var validationRules set to validate the data before saving to database
        * @var req contains the user new password information and otp
        * @var res a return response from the home model
        * @return redirect-to-page
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
