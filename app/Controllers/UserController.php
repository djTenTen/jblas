<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Config\UploadConfig;
use \App\Models\UserModel;

class UserController extends BaseController{
    
    /**
        * @property
    */
    protected $usermodel;
    protected $crypt;
    protected $token = 'Anti-CSRF tokens';



    public function __construct(){

        \Config\Services::session();
        $this->usermodel    = new UserModel();
        $this->crypt = \Config\Services::encrypter();

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
        * view the registration page
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        * @return view-page
    */
    public function register(){

        $data['token'] = 1;
        $data['title'] = 'Sign-up';
        echo view('users/Signup', $data);

    }

    /**
        * @param email
        * email verification page
        * @return view
    */
    public function aud($email){

        $data['email'] = $email;
        return view('users/Aud', $data);

    }

    /**
        * view the account information of the user
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        * @return view
    */
    public function myaccount(){

        $uID = $this->decr(session()->get('userID'));
        $data['title'] = 'My Account';
        $data['u'] = $this->usermodel->getmyinfo($uID);
        echo view('includes/Header', $data);
        echo view('users/MyAccount', $data);    
        echo view('includes/Footer');

    }

    /**
        * firm's initial registration
        * @return resultpage
    */
    public function signup(){

        // if( $this->decr($this->request->getpost('token')) != $this->token){
        //     session()->setFlashdata('error','There is something wrong with your request, Please try again.');
        //     return redirect()->to(site_url('register'));
        // }
        // $validationRules = [
        //     'fname'     => 'required|string|max:255',
        //     'firm'      => 'required|string|max:255',
        //     'email'     => 'required',
        //     'pass'      => 'required',
        // ];
        // if (!$this->validate($validationRules)) {
        //     session()->setFlashdata('error','There is something wrong with your request, Please try again.');
        //     return redirect()->to(site_url('register'));
        // }
        $pss = $this->request->getPost('pass');
        $req = [
            'fname'         => $this->request->getPost('fname'),
            'firm'          => $this->request->getPost('firm'),
            'address'       => $this->request->getPost('address'),
            'contact'       => $this->request->getPost('contact'),
            'noemployee'    => $this->request->getPost('noemployee'),
            'noclient'      => $this->request->getPost('noclient'),
            'email'         => $this->request->getPost('email'),
            'logo'          => $this->request->getFile('logo'),
            'pass'          => password_hash($pss,PASSWORD_DEFAULT)
        ];
        if($this->request->getPost('pass') == $this->request->getPost('cpass')){
            $res = $this->usermodel->signin($req);
            if($res == 'exist'){
                session()->setFlashdata('error','Account already exist.');
                return redirect()->to(site_url('register'));
            }else if($res == "registered"){
                session()->setFlashdata('success','We have received your registration, PLease wait a email confirmation before signing in.');
                return redirect()->to(site_url('register'));
            }else{
                session()->setFlashdata('error','There is something wrong with your request, Please try again.');
                return redirect()->to(site_url('register'));
            }
        }else{
            session()->setFlashdata('error','The password confirmation did not match, please try again.');
            return redirect()->to(site_url('register'));
        }

    }

    /**
        * @param email
        * accepts the firm's registration
        * @return resultpage
    */
    public function acceptaud($email){

        $validationRules = [
            'refid'     => 'required',
            'password'  => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('aud/'.$email));
        }
        $req = [
            'email' => $email,
            'refID' => $this->request->getPost('refid'),
            'password' => $this->request->getPost('password'),
        ];
        $res = $this->usermodel->acceptaud($req);
        if($res == 'confirmed'){
            session()->setFlashdata('confirmed','confirmed');
            return redirect()->to(site_url());
        }else{
            session()->setFlashdata('infonotfound','infonotfound');
            return redirect()->to(site_url('aud/'.$email));
        }

    }

    /**
        * @param userID
        * updates the user information
        * @return resultpage
    */
    public function updatemyinfo($uID){

        $duID = $this->decr($uID);
        $fID  = $this->decr(session()->get('firmID'));
        $npss = '';
        if(!empty($this->request->getPost('pass'))){
            $npss = password_hash($this->request->getPost('pass'),PASSWORD_DEFAULT);
        }else{
            $npss = session()->get('pass');
        }
        $req = [
            'name'          => $this->request->getPost('fname'),
            'address'       => $this->request->getPost('address'),
            'contact'       => $this->request->getPost('contact'),
            'email'         => $this->request->getPost('email'),
            'pass'          => $npss,
            'logo'          => $this->request->getFile('logo'),
            'photo'         => $this->request->getFile('photo'),
            'signature'     => $this->request->getFile('signature'),
            'mylogo'        => session()->get('logo'),
            'myphoto'       => session()->get('photo'),
            'mysignature'   => session()->get('signature'),
            'uID'           => $duID,
            'fID'           => $fID,
        ];
        $res = $this->usermodel->updatemyinfo($req);
        if($res == "updated"){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/myaccount'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/myaccount'));
        }

    }

}