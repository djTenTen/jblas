<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\DashModel;

class DashController extends BaseController{


    protected $dmodel;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->dmodel   = new DashModel();
        $this->crypt    = \Config\Services::encrypter();

    }

    public function dashboard(){

        $data['title'] = 'Dashboard';
        echo view('dashboard/Dashboard', $data);
    
    }

    public function auditsystem(){

        $data['title']      = session()->get('firm'). ' - Dashboard';
        $fID                = $this->crypt->decrypt(session()->get('firmID'));
        $data['numcli']     = $this->dmodel->getnumclients($fID);
        $data['prep']       = $this->dmodel->getnumwp($fID,'Preparing');
        $data['rev']        = $this->dmodel->getnumwp($fID,'Reviewing');
        $data['check']      = $this->dmodel->getnumwp($fID,'Checking');
        $data['aud']        = $this->dmodel->getmyauditors($fID);
        echo view('includes/Header', $data);
        echo view('dashboard/DashboardAudit', $data);
        echo view('includes/Footer');

    }


}
