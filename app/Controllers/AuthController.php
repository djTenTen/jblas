<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\HomeModel;
use \App\Models\AuthModel;
use App\Libraries\Logs;

class AuthController extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL //
        THIS FILE IS USED FOR AUTHENTICATION
        Properties being used on this file
        * @property authModel to include the file authentication model
        * @property crypt to load the encryption file
        * @property logs to load the logs files
    */
    protected $authModel;
    protected $crypt;
    protected $logs;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->authModel    = new AuthModel();
        $this->crypt        = \Config\Services::encrypter();
        $this->logs         = new Logs();

    }


    /**
        * @method auth() used to authenticate the user on the system
        * @var validationRules set to validate the data before searching to the database
        * @var array-req consist login information
        * @var res a return response from the authentication model if it succeeded
        * @var user_data contains the user information and setting-up the user information through out the system.
        * @return redirect-to-page
    */
    public function auth(){

        $validationRules = [
            'email'     => 'required',
            'password'  => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('access_denied','access_denied');
            return redirect()->to(site_url());
        }
        $req = [
            'email'     => $this->request->getPost('email'),
            'password'  => $this->request->getPost('password')
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
                'authentication'    => true,
                'userID'            => $this->crypt->encrypt($res['userID']),
                'name'              => $res['name'],
                'email'             => $res['email'],
                'pass'              => $res['pass'],
                'firm'              => $res['firm'],
                'firmID'            => $this->crypt->encrypt($res['firmID']),
                'pos'               => $res['pos'],
                'type'              => $res['type'],
                'photo'             => $res['photo'],
                'signature'         => $res['signature'],
                'logo'              => $res['logo'],
                'posID'             => $this->crypt->encrypt($res['posID']),
                'allowed'           => $res['allowed'],
            ];
            session()->set($user_data);
            $this->logs->log($user_data['name']. " has just Logged-in");
            return redirect()->to(site_url('/auditsystem/dashboard'));
        }else{
            session()->setFlashdata('access_denied','access_denied');
            return redirect()->to(site_url());
        }

    }


    /**
        * @method logout() used to log out from the system and destroy all the session used by the user
        * @return redirect-to-page
    */
    public function logout(){

        session_destroy();
        return redirect()->to(site_url());

    }


}
