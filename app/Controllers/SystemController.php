<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\SystemModel;

class SystemController extends BaseController{
    

    /**
        * @property
    */
    protected $sm;
    protected $crypt;


    /**
        * Load the methods on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->sm    = new SystemModel();
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
        * Cron Task of the system
        * This is Being executed on the settings of the CPANEL
        * @return json
    */
    public function crontask(){

        $res = $this->sm->crontask();
        return $res;

    }


    /**
        --------------------------------------------------------------------------------------------------------------------
        NOTIFICATION MANAGEMENT
        --------------------------------------------------------------------------------------------------------------------
        * View the notifications
        * @return view
    */
    public function notif(){
        
        $data['not'] = $this->sm->getnotif();
        $data['title'] = 'Notification Center';
        echo view('includes/Header', $data);
        echo view('system/Notif', $data);
        echo view('includes/Footer');

    }

    /**
        * Removes the notifications
        * View the notification
        * @return json
    */
    public function removenotif($nID){

        $dnID = $this->decr($nID);
        $res = $this->sm->removenotif($dnID);
        return $res;

    }



    /**
        --------------------------------------------------------------------------------------------------------------------
        SYSTEM OF QUALITY MANAGEMENT MANUAL
        --------------------------------------------------------------------------------------------------------------------
        * view the soqm manual
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        * @return view
    */
    public function viewsoqm(){

        $data['title'] = 'System of Quality Management Manual';
        $data['soqm'] = $this->sm->getfirmsoqm();
        $data['sd'] = json_decode($data['soqm']['soqm_data'], true);
        echo view('includes/Header', $data);
        echo view('system/soqm', $data);
        echo view('includes/Footer');

    }

    /**
        * view the sample pdf soqm manual
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        * @return pdf-view
    */
    public function viewsoqmpdf(){

        $data['title'] = 'System of Quality Management Manual';
        $soqm = $this->sm->getsoqm();
        $data['sd'] = json_decode($soqm['data'], true);
        echo view('system/soqmpdf', $data);

    }

    /**
        * view the firm's pdf soqm manual if the firm's uses the default system's soqm
        * All inside the @var array.$data will be called as variable on the views ex: $title, $name
        * @return pdf-view
    */
    public function viewmysoqmpdf(){

        $data['title'] = 'System of Quality Management Manual';
        $soqm = $this->sm->getfirmsoqm();
        $data['sd'] = json_decode($soqm['soqm_data'], true);
        echo view('system/mysoqmpdf', $data);

    }


    /**
        * upload firm's own soqm manual
        * @return result-page
    */
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

    /**
        * firm's using the default SQOM Manual
        * @return result-page
    */
    public function usesoqm(){

        $res = $this->sm->usesoqm();
        if($res){
            session()->setFlashdata('success','You are now using the System\'s System of Quality Management Manual');
        }else{
            session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
        }
        return redirect()->to(site_url('auditsystem/soqm'));

    }

    /**
        * Filling up the firm's information for the SOQM Manual
        * @return result-page
    */
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