<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\SystemModel;

class SystemController extends BaseController{
    

    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL // 
        THIS FILE IS USED FOR POSITION MANAGEMENT
        Properties being used on this file
        * @property sm to include the file system model
        * @property crypt to load the encryption file
    */
    protected $sm;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->sm    = new SystemModel();
        $this->crypt = \Config\Services::encrypter();

    }

    
    public function crontask(){

        $res = $this->sm->crontask();
        return $res;

    }

    public function notif(){
        
        $data['not'] = $this->sm->getnotif();
        $data['title'] = 'Notification Center';
        echo view('includes/Header', $data);
        echo view('system/Notif', $data);
        echo view('includes/Footer');

    }


    public function removenotif($nID){

        $dnID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$nID));
        $res = $this->sm->removenotif($dnID);
        return $res;

    }


    public function viewsoqm(){

        $data['title'] = 'System of Quality Management Manual';
        $data['soqm'] = $this->sm->getfirmsoqm();
        $data['sd'] = json_decode($data['soqm']['soqm_data'], true);

        echo view('includes/Header', $data);
        echo view('system/soqm', $data);
        echo view('includes/Footer');

    }


    public function viewsoqmpdf(){

        $data['title'] = 'System of Quality Management Manual';
        $soqm = $this->sm->getsoqm();
        $data['sd'] = json_decode($soqm['data'], true);
        echo view('system/soqmpdf', $data);

    }


    public function viewmysoqmpdf(){

        $data['title'] = 'System of Quality Management Manual';
        $soqm = $this->sm->getfirmsoqm();
        $data['sd'] = json_decode($soqm['soqm_data'], true);
        echo view('system/mysoqmpdf', $data);

    }

    public function uploadsoqm(){

        $req = [
            'file' => $this->request->getFile('soqmfile'),
        ];
        $res = $this->sm->uploadsoqm($req);
        if($res){
            session()->setFlashdata('success','You have successfully uploaded your System of Quality Management Manual');
        }else{
            session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
        }
        return redirect()->to(site_url('auditsystem/soqm'));

    }

    public function usesoqm(){

        $res = $this->sm->usesoqm();
        if($res){
            session()->setFlashdata('success','You are now using the System\'s System of Quality Management Manual');
        }else{
            session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
        }
        return redirect()->to(site_url('auditsystem/soqm'));

    }


    public function savesoqm(){

        $soqm = [
            'prac'  => $this->request->getPost('prac'),
            'bg'    => $this->request->getPost('bg'),
            'cs'    => $this->request->getPost('cs'),
            'cq'    => $this->request->getPost('cq'),
            'cp'    => $this->request->getPost('cp'),
            'phil'  => $this->request->getPost('phil'),
            'miss'  => $this->request->getPost('miss'),
            'viss'  => $this->request->getPost('viss'),
            'fg'    => $this->request->getPost('fg'),
            'rwt'   => $this->request->getPost('rwt'),
            'appr'  => $this->request->getPost('appr'),
            'fs'    => $this->request->getPost('fs'),
            'cr'    => $this->request->getPost('cr'),
            'csa'   => $this->request->getPost('csa'),
            'gd'    => $this->request->getPost('gd'),
        ];

        $req = [
            'soqm' => json_encode($soqm),
        ];

        $res = $this->sm->savesoqm($req);
        if($res){
            session()->setFlashdata('success','You Information has been successfully saved');
        }else{
            session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
        }
        return redirect()->to(site_url('auditsystem/soqm'));


    }


    

    
    


}