<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\DashModel;
use App\Controllers\LogsController;

class DashController extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL // 
        THIS FILE IS USED FOR DASHBOARD VIEWS
        Properties being used on this file
        * @property dmodel to include the file dashboard model
        * @property crypt to load the encryption file
        * @property lc to load the log controller
    */
    protected $dmodel;
    protected $crypt;
    protected $lc;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->dmodel   = new DashModel();
        $this->lc       = new LogsController;
        $this->crypt    = \Config\Services::encrypter();

    }


    /**
        * @method getwpp() get the work paper progress
        * @param year consist of year
        * @var fID decrypted data of firm id
        * @var res a return response from the dashboard model
        * @return json
    */
    public function getwpp($year){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        $res = $this->dmodel->getwpp($year,$fID);
        return $res;

    }


    /**
        * @method getnumwpp() get the number of work paper progress
        * @param year consist of year
        * @var fID decrypted data of firm id
        * @var prep returns number of preparing workpaper
        * @var rev returns number of reviewing workpaper
        * @var done returns number of done workpaper
        * @var check returns number of checking workpaper
        * @var array-data consist of all data needed to display on the page
        * @return json
    */
    public function getnumwpp($year){

        $fID    = $this->crypt->decrypt(session()->get('firmID'));
        $prep   = $this->dmodel->getnumwpp($fID,'Preparing',$year);
        $rev    = $this->dmodel->getnumwpp($fID,'Reviewing',$year);
        $done   = $this->dmodel->getnumwpp($fID,'Done',$year);
        $check  = $this->dmodel->getnumwpp($fID,'Checking',$year);
        $data   = ['prep' => $prep, 'rev' => $rev,'done' => $done, 'check' => $check];
        return json_encode($data);

    }


    /**
        * @method dashboard() view the dashboard
        * @var array-data consist of all data needed to display on the page
        * @return view
    */
    public function dashboard(){

        $data['title'] = 'Dashboard';
        echo view('dashboard/Dashboard', $data);
    
    }


    /**
        * @method auditsystem() view the audit dashboard
        * @var fID decrypted data of firm id
        * @var logs contains system logs
        * @var array-data consist of all data needed to display on the page
        * @return view
    */
    public function auditsystem(){

        $data['title']      = session()->get('firm'). ' - Dashboard';
        $fID                = $this->crypt->decrypt(session()->get('firmID'));
        $data['numcli']     = $this->dmodel->getnumclients($fID);
        $data['prep']       = $this->dmodel->getnumwp($fID,'Preparing');
        $data['rev']        = $this->dmodel->getnumwp($fID,'Reviewing');
        $data['approved']   = $this->dmodel->getnumwp($fID,'Approved');
        $data['aud']        = $this->dmodel->getmyauditors($fID);
        $data['prog']       = $this->dmodel->getwpprogress($fID);
        $logs               = $this->lc->viewlogs(5);
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
