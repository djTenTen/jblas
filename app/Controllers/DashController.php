<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\DashModel;
use App\Controllers\LogsController;

class DashController extends BaseController{


    /**
        * @property
    */
    protected $dmodel;
    protected $crypt;
    protected $lc;


    /**
        * Load the methods on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->dmodel   = new DashModel();
        $this->lc       = new LogsController;
        $this->crypt    = \Config\Services::encrypter();

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
        * @param year
        * get the workpaper information based on @param year and firmID
        * @return json
    */
    public function getwpp($year){

        $fID = $this->decr(session()->get('firmID'));
        $res = $this->dmodel->getwpp($year,$fID);
        return $res;

    }


    /**
        * @param year
        * get the count of the work paper progress based on @param year and firmID
        * @return json
    */
    public function getnumwpp($year){

        $fID    = $this->decr(session()->get('firmID'));
        $prep   = $this->dmodel->getnumwpp($fID,'Preparing',$year);
        $rev    = $this->dmodel->getnumwpp($fID,'Reviewing',$year);
        $done   = $this->dmodel->getnumwpp($fID,'Done',$year);
        $check  = $this->dmodel->getnumwpp($fID,'Checking',$year);
        $data   = ['prep' => $prep, 'rev' => $rev,'done' => $done, 'check' => $check];
        return json_encode($data);

    }


    /**
        * View the System Documentation 
        * @return view
    */
    public function documentation(){

        $data['title']  = 'Process - Documentation';
        echo view('includes/Header', $data);
        echo view('dashboard/Documentation', $data);
        echo view('includes/Footer');

    }


    /**
        * View the audit system dashboard 
        * All inside the @var array-$data will be called as variable on the views ex: $title, $name
        * @return view
    */
    public function auditsystem(){

        
        $data['title']      = session()->get('firm'). ' - Dashboard';
        $fID                = $this->decr(session()->get('firmID'));
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
