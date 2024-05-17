<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\FirmsModel;

class FirmsController extends BaseController{

    protected $fmodel;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->fmodel = new FirmsModel();
        $this->crypt  = \Config\Services::encrypter();

    }

    public function viewfirms(){

        $data['title'] = 'Auditing Firms Management';
        $data['firm']  = $this->fmodel->getfirms();
        echo view('includes/Header', $data);
        echo view('firms/Firms', $data);
        echo view('includes/Footer');

    }

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