<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\FirmsModel;

class FirmsController extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL // 
        THIS FILE IS USED FOR FIRM MANAGEMENT
        Properties being used on this file
        * @property fmodel to include the firm model
        * @property crypt to load the encryption file
    */
    protected $fmodel;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->fmodel = new FirmsModel();
        $this->crypt  = \Config\Services::encrypter();

    }


    /**
        * @method viewfirms() view the firms registered
        * @param name name of the client
        * @var array-data consist of data and display it on the page
        * @return view
    */
    public function viewfirms(){

        $data['title'] = 'Auditing Firms Management';
        $data['firm']  = $this->fmodel->getfirms();
        echo view('includes/Header', $data);
        echo view('firms/Firms', $data);
        echo view('includes/Footer');

    }


    /**
        * @method verifyfirm() verify the firm
        * @param euID encypted data of user id
        * @var uID decrypted data of user id
        * @var res a return response from the firms model
        * @return view
    */
    public function verifyfirm($euID){

        $uID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$euID));
        $res = $this->fmodel->verifyfirm($uID);
        if($res){
            session()->setFlashdata('verified','verified');
            return redirect()->to(site_url('auditsystem/firms'));
        }else{
            session()->setFlashdata('failed','failed');
            return redirect()->to(site_url('auditsystem/firms'));
        }

    }


}