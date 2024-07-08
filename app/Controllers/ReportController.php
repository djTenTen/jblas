<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\ReportModel;

class ReportController extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL // 
        THIS FILE IS USED FOR REPORT GENERATION
        Properties being used on this file
        * @property pmodel to include the file position model
        * @property crypt to load the encryption file
    */
    protected $rpmodel;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->rpmodel   = new ReportModel();
        $this->crypt     = \Config\Services::encrypter();

    }


    public function generatepdf($cID,$wpID,$cname,$aud,$sup,$audm,$fy,$efy){

        $dwpID          = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID));
        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $a              = explode('-', $aud);
        $s              = explode('-', $sup);
        $am             = explode('-', $audm);
        $data['aud']    = $a[0];
        $data['sup']    = $s[0];
        $data['audm']   = $am[0];
        $data['fy']     = $fy;
        $data['efy']    = $efy;
        $data['firm']   = session()->get('firm');
        $data['client'] = strtoupper($cname);
        $data['wpID']   = $dwpID;
        $data['cID']    = $dcID;
        $data['c1']     = $this->rpmodel->getc1values($dcID,$dwpID);
        $data['c2']     = $this->rpmodel->getc2values($dcID,$dwpID);
        $data['c3']     = $this->rpmodel->getc3values($dcID,$dwpID);
        $data['fi']     = $this->rpmodel->getfileindex($dcID,$dwpID);
        $data['cfi']    = $this->rpmodel->getlatestupload($dcID,$dwpID);
        $data['tb']     = $this->rpmodel->gettrialbalance($dcID,$dwpID);
        $data['cl']     = $this->rpmodel->getclientinfo($dwpID,$dcID);
        $data['fl']     = $this->rpmodel->getfileinfoc1($dwpID,$dcID);
        echo view('workpaper/Report', $data);

    }


}