<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\DashModel;
use App\Controllers\LogsController;

class DashController extends BaseController{


    protected $dmodel;
    protected $crypt;
    protected $lc;

    public function __construct(){

        \Config\Services::session();
        $this->dmodel   = new DashModel();
        $this->lc       = new LogsController;
        $this->crypt    = \Config\Services::encrypter();

    }

    public function getwpp($year){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        $res = $this->dmodel->getwpp($year,$fID);
        return $res;

    }

    public function getnumwpp($year){

        $fID    = $this->crypt->decrypt(session()->get('firmID'));
        $prep   = $this->dmodel->getnumwpp($fID,'Preparing',$year);
        $rev    = $this->dmodel->getnumwpp($fID,'Reviewing',$year);
        $done   = $this->dmodel->getnumwpp($fID,'Done',$year);
        $check  = $this->dmodel->getnumwpp($fID,'Checking',$year);
        $data   = ['prep' => $prep, 'rev' => $rev,'done' => $done, 'check' => $check];
        return json_encode($data);

    }


    public function dashboard(){

        $data['title'] = 'Dashboard';
        echo view('dashboard/Dashboard', $data);
    
    }

    public function auditsystem(){

        $data['title']      = session()->get('firm'). ' - Dashboard';
        $fID                = $this->crypt->decrypt(session()->get('firmID'));
        $data['numcli']     = $this->dmodel->getnumclients($fID);
        $data['auds']       = $this->dmodel->getnumauds($fID);
        $data['prep']       = $this->dmodel->getnumwp($fID,'Preparing');
        $data['rev']        = $this->dmodel->getnumwp($fID,'Reviewing');
        $data['done']       = $this->dmodel->getnumwp($fID,'Done');
        $data['check']      = $this->dmodel->getnumwp($fID,'Checking');
        $data['aud']        = $this->dmodel->getmyauditors($fID);
        $data['prog']       = $this->dmodel->getwpprogress($fID);

        
        $logs               = $this->lc->viewlogs();

        if($logs == 'no logs'){
            $data['logs'] = 'No Logs';
        }else{
            $data['logs'] = $logs;
        }

        echo view('includes/Header', $data);
        echo view('dashboard/DashboardAudit', $data);
        echo view('includes/Footer');

    }


    

}
