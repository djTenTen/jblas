<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Config\UploadConfig;

use \App\Models\WorkpaperModel;
use \App\Models\ClientModel;

class WorkpaperController extends BaseController{
    
    use ResponseTrait;

    protected $wpmodel;
    protected $cmodel;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->wpmodel = new WorkpaperModel();
        $this->cmodel = new ClientModel();
        $this->crypt = \Config\Services::encrypter();

    }


    public function initiate(){

        $data['title'] = "Initiate Working Paper";

        $fID = $this->crypt->decrypt(session()->get('firmID'));

        $data['aud'] = $this->wpmodel->getauditors($fID,'Preparer');
        $data['sup'] = $this->wpmodel->getauditors($fID,'Reviewer');
        $data['mgr'] = $this->wpmodel->getauditors($fID,'Audit Manager');
        $data['cl'] = $this->cmodel->getclients($fID);
        $data['wp'] = $this->wpmodel->getworkpaper($fID);

        echo view('includes/Header', $data);
        echo view('workpaper/Initiate', $data);    
        echo view('includes/Footer');

    }

    public function saveworkpaper(){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        $uID = $this->crypt->decrypt(session()->get('userID'));

        $validationRules = [
            'client' => 'required',
            'fy' => 'required',
            'efy' => 'required',
            'jobdur' => 'required',
            'auditor' => 'required',
            'reviewer' => 'required',
            'audmanager' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/workpaper/initiate'));
        }

        $req = [
            'client' => $this->crypt->decrypt($this->request->getPost('client')),
            'fy' => $this->request->getPost('fy'),
            'efy' => $this->request->getPost('efy'),
            'jobdur' => $this->request->getPost('jobdur'),
            'auditor' => $this->crypt->decrypt($this->request->getPost('auditor')),
            'reviewer' => $this->crypt->decrypt($this->request->getPost('reviewer')),
            'audmanager' => $this->crypt->decrypt($this->request->getPost('audmanager')),
            'firm' => $fID,
            'uID' => $uID,
        ];

        $res = $this->wpmodel->saveworkpaper($req);

        if($res == "exist"){
            session()->setFlashdata('exist','exist');
            return redirect()->to(site_url('auditsystem/workpaper/initiate'));
        }elseif($res == "added"){
            session()->setFlashdata('added','added');
            return redirect()->to(site_url('auditsystem/workpaper/initiate'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/workpaper/initiate'));
        }



    }






}