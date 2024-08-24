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
        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $fID            = $this->crypt->decrypt(session()->get('firmID'));
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
        $data['fID']    = $fID;
        $data['c1']     = $this->rpmodel->getc1values($dcID,$dwpID);
        $data['c2']     = $this->rpmodel->getc2values($dcID,$dwpID);
        $data['c3']     = $this->rpmodel->getc3values($dcID,$dwpID);
        $data['fi']     = $this->rpmodel->getfileindex($dcID,$dwpID);
        // $data['cfi']    = $this->rpmodel->getlatestupload($dcID,$dwpID);
        $data['tb']     = $this->rpmodel->gettrialbalance($dcID,$dwpID);
        $data['cl']     = $this->rpmodel->getclientinfo($dwpID,$dcID);
        $data['fl']     = $this->rpmodel->getfileinfoc1($dwpID,$dcID);

        $q1e            = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'1st','EWT');
        $data['q1e']    = (empty($q1e['file'])) ? '' : $q1e['file'];
        $q1v            = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'1st','VAT');
        $data['q1v']    = (empty($q1v['file'])) ? '' : $q1v['file'];
        $q16            = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'1st','1601C');
        $data['q16']    = (empty($q16['file'])) ? '' : $q16['file'];
        $q17            = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'1st','1701/1702');
        $data['q17']    = (empty($q17['file'])) ? '' : $q17['file'];
       
        $q2e   = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'2nd','EWT');
        $data['q2e']    = (empty($q2e['file'])) ? '' : $q2e['file'];
        $q2v            = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'2nd','VAT');
        $data['q2v']    = (empty($q2v['file'])) ? '' : $q2v['file'];
        $q26    = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'2nd','1601C');
        $data['q26']    = (empty($q26['file'])) ? '' : $q26['file'];
        $q27    = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'2nd','1701/1702');
        $data['q27']    = (empty($q27['file'])) ? '' : $q27['file'];
       
        $q3e            = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'2nd','1701/1702');
        $data['q3e']    = (empty($q3e['file'])) ? '' : $q3e['file'];
        $q3e    = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'3rd','EWT');
        $data['q3e']    = (empty($q3e['file'])) ? '' : $q3e['file'];
        $q3v    = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'3rd','VAT');
        $data['q3v']    = (empty($q3v['file'])) ? '' : $q3v['file'];
        $q36    = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'3rd','1601C');
        $data['q36']    = (empty($q36['file'])) ? '' : $q36['file'];
        $q37   = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'3rd','1701/1702');
        $data['q37']    = (empty($q37['file'])) ? '' : $q37['file'];
        
        $q4e    = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'4th','EWT');
        $data['q4e']    = (empty($q4e['file'])) ? '' : $q4e['file'];
        $q4v    = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'4th','VAT');
        $data['q4v']    = (empty($q4v['file'])) ? '' : $q4v['file'];
        $q46    = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'4th','1601C');
        $data['q46']    = (empty($q46['file'])) ? '' : $q46['file'];
        $q47   = $this->rpmodel->getfstax($dcID,$dwpID,$fID ,'4th','1701/1702');
        $data['q47']    = (empty($q47['file'])) ? '' : $q47['file'];

        $data['fst']   = $this->rpmodel->getfstaxgen($dcID,$dwpID,$fID);
        

        echo view('workpaper/Report', $data);

    }


}