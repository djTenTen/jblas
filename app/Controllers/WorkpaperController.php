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
        $this->wpmodel  = new WorkpaperModel();
        $this->cmodel   = new ClientModel();
        $this->crypt    = \Config\Services::encrypter();

    }

    public function initiate(){

        $data['title']  = "Work Paper";
        $data['subt']   = "Initiate your work paper";
        $fID            = $this->crypt->decrypt(session()->get('firmID'));
        $data['aud']    = $this->wpmodel->getauditors($fID,'Preparer');
        $data['sup']    = $this->wpmodel->getauditors($fID,'Reviewer');
        $data['mgr']    = $this->wpmodel->getauditors($fID,'Audit Manager');
        $data['cl']     = $this->cmodel->getclients($fID);
        $data['wp']     = $this->wpmodel->getworkpaper($fID,'');
        echo view('includes/Header', $data);
        echo view('workpaper/Initiate', $data);    
        echo view('includes/Footer');

    }

    public function prepare(){

        $data['title']  = "Prepare Work Paper";
        $data['subt']   = "Prepare your work paper";
        $fID            = $this->crypt->decrypt(session()->get('firmID'));
        $uID            = $this->crypt->decrypt(session()->get('userID'));
        $data['wp']     = $this->wpmodel->getworkpaperspe('auditor',$fID,$uID,'Preparing');
        echo view('includes/Header', $data);
        echo view('workpaper/Prepare', $data);    
        echo view('includes/Footer');

    }

    public function review(){

        $data['title']  = "Review Work Paper";
        $data['subt']   = "Review your work paper";
        $fID            = $this->crypt->decrypt(session()->get('firmID'));
        $uID            = $this->crypt->decrypt(session()->get('userID'));
        $data['wp']     = $this->wpmodel->getworkpaperspe('supervisor',$fID,$uID,'Reviewing');
        echo view('includes/Header', $data);
        echo view('workpaper/Review', $data);    
        echo view('includes/Footer');

    }

    public function getfiles($cID,$wpID,$name){

        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dwpID          = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID));
        $type           = session()->get('type');
        switch ($type) {
            case 'Auditing Firm':
            case 'Audit Manager':
            case 'Admin':
                $status = 'All';
            break;
            case 'Preparer':
                $status = 'Preparing';
            break;
            case 'Reviewer':
                $status = 'Reviewing';
            break;
        }
        $data['type']   = $type;
        $data['title']  = 'Work Paper';
        $data['subt']   = 'Work paper file of '. $name;
        $data['cID']    = $cID;
        $data['wpID']   = $wpID;
        $data['name']   = $name;  
        $data['c1']     = $this->wpmodel->getc1values($dcID,$dwpID,$status);
        $data['c2']     = $this->wpmodel->getc2values($dcID,$dwpID,$status);
        $data['c3']     = $this->wpmodel->getc3values($dcID,$dwpID,$status);
        $data['fi']     = $this->wpmodel->getfileindex($dcID,$dwpID,$status);
        $data['cfi']    = $this->wpmodel->getlatestupload($dcID,$dwpID);
        $data['tb']     = $this->wpmodel->gettrialbalance($dcID,$dwpID);
        $data['if']     = $this->wpmodel->getindexfile();
        echo view('includes/Header', $data);
        echo view('workpaper/ViewFilesValues', $data);
        echo view('includes/Footer');

    }

    public function saveworkpaper(){

        $fID                = $this->crypt->decrypt(session()->get('firmID'));
        $uID                = $this->crypt->decrypt(session()->get('userID'));
        $validationRules    = [
            'client'        => 'required',
            'fy'            => 'required',
            'efy'           => 'required',
            'jobdur'        => 'required',
            'auditor'       => 'required',
            'reviewer'      => 'required',
            'audmanager'    => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/workpaper/initiate'));
        }
        $req = [
            'client'        => $this->crypt->decrypt($this->request->getPost('client')),
            'fy'            => $this->request->getPost('fy'),
            'efy'           => $this->request->getPost('efy'),
            'jobdur'        => $this->request->getPost('jobdur'),
            'auditor'       => $this->crypt->decrypt($this->request->getPost('auditor')),
            'reviewer'      => $this->crypt->decrypt($this->request->getPost('reviewer')),
            'audmanager'    => $this->crypt->decrypt($this->request->getPost('audmanager')),
            'firm'          => $fID,
            'uID'           => $uID,
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

    public function importtb($cID,$wpID,$name){

        $dcID               = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dwpID              = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID));
        $fID                = $this->crypt->decrypt(session()->get('firmID'));
        $uID                = $this->crypt->decrypt(session()->get('userID'));
        $validationRules    = [
            'fileindex'     => 'required',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/getfiles/'.$cID.'/'.$wpID.'/'.$name));
        }
        $req = [
            'client'        => $dcID,
            'firm'          => $fID,
            'workpaper'     => $dwpID,
            'fileindex'     => $this->request->getPost('fileindex'),
            'account_code'  => $this->request->getPost('account_code'),
            'account'       => $this->request->getPost('account'),
            'account_type'  => $this->request->getPost('account_type'),
            'debit'         => $this->request->getPost('debit'),
            'credit'        => $this->request->getPost('credit'),
            'uID'           => $uID,
        ];
        $res = $this->wpmodel->importtb($req);
        if($res == "uploaded"){
            session()->setFlashdata('excel_upload','excel_upload');
            return redirect()->to(site_url('auditsystem/wp/getfiles/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/getfiles/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function updateindex($cfiID){

        $dcfiID     = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cfiID));
        $yn         = $this->request->getPost('checked');
        $req        = [
            'cfiID'     => $dcfiID,
            'acquired'  => $yn
        ];  
        $res = $this->wpmodel->updateindex($req);
        return $this->response->setJSON(['message' => $res]);

    }

    public function updatetb($code,$cfiID,$cID,$wpID,$index,$desc){

        $req = [
            'tbID'  => $this->request->getPost('tbID'),
            'sb'    => $this->request->getPost('sb'),
            'uID'   => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->wpmodel->updatetb($req);
        if($res == "updated"){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/wp/index/setvalues/'.$code.'/'.$cfiID.'/'.$cID.'/'.$wpID.'/'.$index.'/'.$desc));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/index/setvalues/'.$code.'/'.$cfiID.'/'.$cID.'/'.$wpID.'/'.$index.'/'.$desc));
        }

    }

    public function uploadtbfiles($code,$cfiID,$cID,$wpID,$index,$desc){

        $dcfiID     = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cfiID));
        $dcID       = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dwpID      = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID));
        $dindex     = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$index));
        $req = [
            'pdf'       => $this->request->getFile('pdffile'),
            'remarks'   => $this->request->getPost('remarks'),
            'cfiID'     => $dcfiID,
            'cID'       => $dcID,
            'wpID'      => $dwpID,
            'index'     => $dindex,
        ];
        $res = $this->wpmodel->uploadtbfiles($req);
        if($res == "uploaded"){
            session()->setFlashdata('uploaded','uploaded');
            return redirect()->to(site_url('auditsystem/wp/index/setvalues/'.$code.'/'.$cfiID.'/'.$cID.'/'.$wpID.'/'.$index.'/'.$desc));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/index/setvalues/'.$code.'/'.$cfiID.'/'.$cID.'/'.$wpID.'/'.$index.'/'.$desc));
        }

    }

    public function sendtoreview($c,$ctID,$cID,$wpID,$name){

        $req = [
            'ctID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ctID)),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'wpID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'remarks'   => $this->request->getPost('remarks'),
            'c'         => $c,
        ];
        $res = $this->wpmodel->sendtoreview($req);
        if($res == "sent"){
            session()->setFlashdata('senttosup','senttosup');
            return redirect()->to(site_url('auditsystem/wp/getfiles/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/getfiles/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function sendtoauditor($c,$ctID,$cID,$wpID,$name){

        $req = [
            'ctID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ctID)),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'wpID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'remarks'   => $this->request->getPost('remarks'),
            'c'         => $c,
        ];
        $res = $this->wpmodel->sendtoauditor($req);
        if($res == "sent"){
            session()->setFlashdata('senttoaud','senttoaud');
            return redirect()->to(site_url('auditsystem/wp/getfiles/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/getfiles/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function sendtomanager($c,$ctID,$cID,$wpID,$name){

        $req = [
            'ctID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ctID)),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'wpID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'remarks'   => $this->request->getPost('remarks'),
            'c'         => $c,
        ];
        $res = $this->wpmodel->sendtomanager($req);
        if($res == "sent"){
            session()->setFlashdata('sentoman','sentoman');
            return redirect()->to(site_url('auditsystem/wp/getfiles/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/getfiles/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function sendtoreviewer($wpID){

        $req = [
            'wpID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'remarks'   => $this->request->getPost('remarks'),
        ];
        $res = $this->wpmodel->sendtoreviewer($req);
        if($res == "sent"){
            session()->setFlashdata('sent','sent');
            return redirect()->to(site_url('auditsystem/workpaper/prepare'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/workpaper/prepare'));
        }

    }

    public function sendtopreparer($wpID){

        $req = [
            'wpID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'remarks'   => $this->request->getPost('remarks'),
        ];
        $res = $this->wpmodel->sendtopreparer($req);
        if($res == "sent"){
            session()->setFlashdata('senttoaud','senttoaud');
            return redirect()->to(site_url('auditsystem/workpaper/review'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/workpaper/review'));
        }

    }

    public function sendtoapprover($wpID){

        $req = [
            'wpID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'remarks'   => $this->request->getPost('remarks'),
        ];
        $res = $this->wpmodel->sendtoapprover($req);
        if($res == "sent"){
            session()->setFlashdata('senttoaud','senttoaud');
            return redirect()->to(site_url('auditsystem/workpaper/review'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/workpaper/review'));
        }

    }

    public function sendbacktoreviewer($wpID){

        $req = [
            'wpID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'remarks'   => $this->request->getPost('remarks'),
        ];
        $res = $this->wpmodel->sendtoreviewer($req);
        if($res == "sent"){
            session()->setFlashdata('senttorev','senttorev');
            return redirect()->to(site_url('auditsystem/workpaper/initiate'));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/workpaper/initiate'));
        }

    }

    /**
        ----------------------------------------------------------
        AC1 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac1($code,$c1tID,$cID,$wpID,$name){

        $req = [
            'acid'      => $this->request->getPost('acid'),
            'yesno'     => $this->request->getPost('yesno'),
            'comment'   => $this->request->getPost('comment'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->wpmodel->saveac1($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveac1eqr($code,$c1tID,$cID,$wpID,$name){

        $eqr = [
            'nameap'    => $this->request->getPost('nameap'),
            'eqr1'      => $this->request->getPost('eqr1'),
            'eqr2'      => $this->request->getPost('eqr2'),
            'eqrr'      => $this->request->getPost('eqrr')
        ];
        $req = [
            'question'  => json_encode($eqr),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->wpmodel->saveac1eqr($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AC2 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac2($code,$c1tID,$cID,$wpID,$name){

        $req = [
            'corptax'       => $this->request->getPost('corptax'),
            'statutory'     => $this->request->getPost('statutory'),
            'accountancy'   => $this->request->getPost('accountancy'),
            'other'         => $this->request->getPost('other'),
            'totalcu'       => $this->request->getPost('totalcu'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->wpmodel->saveac2($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveac2aep($code,$c1tID,$cID,$wpID,$name){

        $req = [
            'eap'       => $this->request->getPost('eap'),
            'concl'     => $this->request->getPost('concl'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->wpmodel->saveac2aep($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AC3 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac3($code,$c1tID,$cID,$wpID,$name){

        $req = [
            'yesno'     => $this->request->getPost('yesno'),
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->wpmodel->saveac3($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AC4 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac4ppr($code,$c1tID,$cID,$wpID,$name){

        $ppr = [
            'ppr1'  => $this->request->getPost('ppr1'),
            'ppr2'  => $this->request->getPost('ppr2')
        ];
        $req = [
            'ppr'       => json_encode($ppr),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->wpmodel->saveac4ppr($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveac4($code,$c1tID,$cID,$wpID,$name){

        $req = [
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->wpmodel->saveac4($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AC5 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac5($code,$c1tID,$cID,$wpID,$name){

        $rc = [
            'res'   => $this->request->getPost('res'),
            'con'   => $this->request->getPost('con')
        ];
        $req = [
            'rescon'    => json_encode($rc),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->wpmodel->saveac5($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AC6 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac6ra($code,$c1tID,$cID,$wpID,$name){

        $req = [
            'planning'          => $this->request->getPost('planning'),
            'finalization'      => $this->request->getPost('finalization'),
            'reference'         => $this->request->getPost('reference'),
            'acid'              => $this->request->getPost('acid'),
            'cID'               => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'             => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'               => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->wpmodel->saveac6ra($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveac6s12($code,$c1tID,$cID,$wpID,$name){

        $s = [
            's1'    => $this->request->getPost('s1'),
            's2a'   => $this->request->getPost('s2a'),
            's2b'   => $this->request->getPost('s2b')
        ];
        $req = [
            'section'   => json_encode($s),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->wpmodel->saveac6s12($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveac6s3($code,$c1tID,$cID,$wpID,$name){

        $validationRules = [
            'financialstatement'    => 'required',
            'descriptioncontrol'    => 'required',
            'controleffective'      => 'required',
            'controlimplemented'    => 'required',
            'assesed'               => 'required',
            'crosstesting'          => 'required',
            'reliancecontrol'       => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }
        $req = [
            'financialstatement'        => $this->request->getPost('financialstatement'),
            'descriptioncontrol'        => $this->request->getPost('descriptioncontrol'),
            'controleffective'          => $this->request->getPost('controleffective'),
            'controlimplemented'        => $this->request->getPost('controlimplemented'),
            'assesed'                   => $this->request->getPost('assesed'),
            'crosstesting'              => $this->request->getPost('crosstesting'),
            'reliancecontrol'           => $this->request->getPost('reliancecontrol'),
            'code'                      => $code,
            'part'                      => $this->request->getPost('part'),
            'cID'                       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'wpID'                      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'c1tID'                     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'                       => $this->crypt->decrypt(session()->get('userID')),
            'fID'                       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveac6s3($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }
    
    /**
        ----------------------------------------------------------
        AC7 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac7($code,$c1tID,$cID,$wpID,$name){

        $genyn = [
            'y1'    => $this->request->getPost('y1'),
            'y2'    => $this->request->getPost('y2'),
            'y3'    => $this->request->getPost('y3'),
            'y4'    => $this->request->getPost('y4'),
            'y5'    => $this->request->getPost('y5'),
            'y6'    => $this->request->getPost('y6'),
            'gen'   => $this->request->getPost('gen'),
            'e1'    => $this->request->getPost('e1'),
            'e2'    => $this->request->getPost('e2'),
            'e3'    => $this->request->getPost('e3'),
            'ro1'   => $this->request->getPost('ro1'),
            'ro2'   => $this->request->getPost('ro2'),
            'ro3'   => $this->request->getPost('ro3'),
            'c1'    => $this->request->getPost('c1'),
            'c2'    => $this->request->getPost('c2'),
            'c3'    => $this->request->getPost('c3'),
            'va1'   => $this->request->getPost('va1'),
            'va2'   => $this->request->getPost('va2'),
            'va3'   => $this->request->getPost('va3'),
            'pd1'   => $this->request->getPost('pd1'),
            'pd2'   => $this->request->getPost('pd2'),
            'pd3'   => $this->request->getPost('pd3'),
        ];
        $req = [
            'genyn'     => json_encode($genyn),
            'part'      => $this->request->getPost('part'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'wpID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveac7($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AC8 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac8($code,$c1tID,$cID,$wpID,$name){

        $req = [
            'question'  => $this->request->getPost('question'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveac8($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AC9 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac9($code,$c1tID,$cID,$wpID,$name){

        $ac9 = [
            'coss'      => $this->request->getPost('coss'),
            'aop1'      => $this->request->getPost('aop1'),
            'aop2'      => $this->request->getPost('aop2'),
            'bipa'      => $this->request->getPost('bipa'),
            'bibo'      => $this->request->getPost('bibo'),
            'sffpa'     => $this->request->getPost('sffpa'),
            'sosdd'     => $this->request->getPost('sosdd'),
            'klar'      => $this->request->getPost('klar'),
            'rpi'       => $this->request->getPost('rpi'),
            'soae'      => $this->request->getPost('soae'),
            'aa1'       => $this->request->getPost('aa1'),
            'aa2'       => $this->request->getPost('aa2'),
            'frfa'      => $this->request->getPost('frfa'),
            'orr'       => $this->request->getPost('orr'),
            'tsr'       => $this->request->getPost('tsr'),
            'cppm'      => $this->request->getPost('cppm'),
            'ic'        => $this->request->getPost('ic'),
            'af'        => $this->request->getPost('af'),
            'ccm'       => $this->request->getPost('ccm'),
            'agm'       => $this->request->getPost('agm'),
            'bcl1'      => $this->request->getPost('bcl1'),
            'bcl2'      => $this->request->getPost('bcl2'),
            'iic1'      => $this->request->getPost('iic1'),
            'iic2'      => $this->request->getPost('iic2'),
            'rc1'       => $this->request->getPost('rc1'),
            'rc2'       => $this->request->getPost('rc2'),
            't2r1'      => $this->request->getPost('t2r1'),
            't2r2'      => $this->request->getPost('t2r2'),
            'pv1'       => $this->request->getPost('pv1'),
            'pv2'       => $this->request->getPost('pv2'),
            'vfi1'      => $this->request->getPost('vfi1'),
            'vfi2'      => $this->request->getPost('vfi2'),
            'av1'       => $this->request->getPost('av1'),
            'av2'       => $this->request->getPost('av2'),
            'lo1'       => $this->request->getPost('lo1'),
            'lo2'       => $this->request->getPost('lo2')
        ];
        $req = [
            'ac9'       => json_encode($ac9),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveac9($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AC10 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac10summ($code,$sheet,$c1tID,$cID,$wpID,$name){

        $tgb = [
            'tgb_rpac10'    => $this->request->getPost('tgb_rpac10'),
            'tgb_i'         => $this->request->getPost('tgb_i'),
            'tgb_p'         => $this->request->getPost('tgb_p'),
            'tgb_pcnt'      => $this->request->getPost('tgb_pcnt'),
            'tgb_s'         => $this->request->getPost('tgb_s'),
            'tgb_t'         => $this->request->getPost('tgb_t'),
            'tgb_ctrf'      => $this->request->getPost('tgb_ctrf'),
            'tgb_arf'       => $this->request->getPost('tgb_arf'),
            'tgb_rf'        => $this->request->getPost('tgb_rf'),
            'tgb_vop'       => $this->request->getPost('tgb_vop'),
            'tgb_secref'    => $this->request->getPost('tgb_secref'),
            'tgb_rss'       => $this->request->getPost('tgb_rss'),
            'tgb_mki'       => $this->request->getPost('tgb_mki'),
            'tgb_ant'       => $this->request->getPost('tgb_ant'),
            'tgb_tss'       => $this->request->getPost('tgb_tss')
        ];
        $ppe = [
            'ppe_rpac10'    => $this->request->getPost('ppe_rpac10'),
            'ppe_i'         => $this->request->getPost('ppe_i'),
            'ppe_p'         => $this->request->getPost('ppe_p'),
            'ppe_pcnt'      => $this->request->getPost('ppe_pcnt'),
            'ppe_s'         => $this->request->getPost('ppe_s'),
            'ppe_t'         => $this->request->getPost('ppe_t'),
            'ppe_ctrf'      => $this->request->getPost('ppe_ctrf'),
            'ppe_arf'       => $this->request->getPost('ppe_arf'),
            'ppe_rf'        => $this->request->getPost('ppe_rf'),
            'ppe_vop'       => $this->request->getPost('ppe_vop'),
            'ppe_secref'    => $this->request->getPost('ppe_secref'),
            'ppe_rss'       => $this->request->getPost('ppe_rss'),
            'ppe_mki'       => $this->request->getPost('ppe_mki'),
            'ppe_ant'       => $this->request->getPost('ppe_ant'),
            'ppe_tss'       => $this->request->getPost('ppe_tss')
        ];
        $invmt = [
            'invmt_rpac10'  => $this->request->getPost('invmt_rpac10'),
            'invmt_i'       => $this->request->getPost('invmt_i'),
            'invmt_p'       => $this->request->getPost('invmt_p'),
            'invmt_pcnt'    => $this->request->getPost('invmt_pcnt'),
            'invmt_s'       => $this->request->getPost('invmt_s'),
            'invmt_t'       => $this->request->getPost('invmt_t'),
            'invmt_ctrf'    => $this->request->getPost('invmt_ctrf'),
            'invmt_arf'     => $this->request->getPost('invmt_arf'),
            'invmt_rf'      => $this->request->getPost('invmt_rf'),
            'invmt_vop'     => $this->request->getPost('invmt_vop'),
            'invmt_secref'  => $this->request->getPost('invmt_secref'),
            'invmt_rss'     => $this->request->getPost('invmt_rss'),
            'invmt_mki'     => $this->request->getPost('invmt_mki'),
            'invmt_ant'     => $this->request->getPost('invmt_ant'),
            'invmt_tss'     => $this->request->getPost('invmt_tss')
        ];
        $invtr = [
            'invtr_rpac10'  => $this->request->getPost('invtr_rpac10'),
            'invtr_i'       => $this->request->getPost('invtr_i'),
            'invtr_p'       => $this->request->getPost('invtr_p'),
            'invtr_pcnt'    => $this->request->getPost('invtr_pcnt'),
            'invtr_s'       => $this->request->getPost('invtr_s'),
            'invtr_t'       => $this->request->getPost('invtr_t'),
            'invtr_ctrf'    => $this->request->getPost('invtr_ctrf'),
            'invtr_arf'     => $this->request->getPost('invtr_arf'),
            'invtr_rf'      => $this->request->getPost('invtr_rf'),
            'invtr_vop'     => $this->request->getPost('invtr_vop'),
            'invtr_secref'  => $this->request->getPost('invtr_secref'),
            'invtr_rss'     => $this->request->getPost('invtr_rss'),
            'invtr_mki'     => $this->request->getPost('invtr_mki'),
            'invtr_ant'     => $this->request->getPost('invtr_ant'),
            'invtr_tss'     => $this->request->getPost('invtr_tss')
        ];
        $tr = [
            'tr_rpac10'     => $this->request->getPost('tr_rpac10'),
            'tr_i'          => $this->request->getPost('tr_i'),
            'tr_p'          => $this->request->getPost('tr_p'),
            'tr_pcnt'       => $this->request->getPost('tr_pcnt'),
            'tr_s'          => $this->request->getPost('tr_s'),
            'tr_t'          => $this->request->getPost('tr_t'),
            'tr_ctrf'       => $this->request->getPost('tr_ctrf'),
            'tr_arf'        => $this->request->getPost('tr_arf'),
            'tr_rf'         => $this->request->getPost('tr_rf'),
            'tr_vop'        => $this->request->getPost('tr_vop'),
            'tr_secref'     => $this->request->getPost('tr_secref'),
            'tr_rss'        => $this->request->getPost('tr_rss'),
            'tr_mki'        => $this->request->getPost('tr_mki'),
            'tr_ant'        => $this->request->getPost('tr_ant'),
            'tr_tss'        => $this->request->getPost('tr_tss')
        ];
        $or = [
            'or_rpac10'     => $this->request->getPost('or_rpac10'),
            'or_i'          => $this->request->getPost('or_i'),
            'or_p'          => $this->request->getPost('or_p'),
            'or_pcnt'       => $this->request->getPost('or_pcnt'),
            'or_s'          => $this->request->getPost('or_s'),
            'or_t'          => $this->request->getPost('or_t'),
            'or_ctrf'       => $this->request->getPost('or_ctrf'),
            'or_arf'        => $this->request->getPost('or_arf'),
            'or_rf'         => $this->request->getPost('or_rf'),
            'or_vop'        => $this->request->getPost('or_vop'),
            'or_secref'     => $this->request->getPost('or_secref'),
            'or_rss'        => $this->request->getPost('or_rss'),
            'or_mki'        => $this->request->getPost('or_mki'),
            'or_ant'        => $this->request->getPost('or_ant'),
            'or_tss'        => $this->request->getPost('or_tss')
        ];
        $bac = [
            'bac_rpac10'    => $this->request->getPost('bac_rpac10'),
            'bac_i'         => $this->request->getPost('bac_i'),
            'bac_p'         => $this->request->getPost('bac_p'),
            'bac_pcnt'      => $this->request->getPost('bac_pcnt'),
            'bac_s'         => $this->request->getPost('bac_s'),
            'bac_t'         => $this->request->getPost('bac_t'),
            'bac_ctrf'      => $this->request->getPost('bac_ctrf'),
            'bac_arf'       => $this->request->getPost('bac_arf'),
            'bac_rf'        => $this->request->getPost('bac_rf'),
            'bac_vop'       => $this->request->getPost('bac_vop'),
            'bac_secref'    => $this->request->getPost('bac_secref'),
            'bac_rss'       => $this->request->getPost('bac_rss'),
            'bac_mki'       => $this->request->getPost('bac_mki'),
            'bac_ant'       => $this->request->getPost('bac_ant'),
            'bac_tss'       => $this->request->getPost('bac_tss')
        ];
        $tp = [
            'tp_rpac10'     => $this->request->getPost('tp_rpac10'),
            'tp_i'          => $this->request->getPost('tp_i'),
            'tp_p'          => $this->request->getPost('tp_p'),
            'tp_pcnt'       => $this->request->getPost('tp_pcnt'),
            'tp_s'          => $this->request->getPost('tp_s'),
            'tp_t'          => $this->request->getPost('tp_t'),
            'tp_ctrf'       => $this->request->getPost('tp_ctrf'),
            'tp_arf'        => $this->request->getPost('tp_arf'),
            'tp_rf'         => $this->request->getPost('tp_rf'),
            'tp_vop'        => $this->request->getPost('tp_vop'),
            'tp_secref'     => $this->request->getPost('tp_secref'),
            'tp_rss'        => $this->request->getPost('tp_rss'),
            'tp_mki'        => $this->request->getPost('tp_mki'),
            'tp_ant'        => $this->request->getPost('tp_ant'),
            'tp_tss'        => $this->request->getPost('tp_tss')
        ];
        $op = [
            'op_rpac10'     => $this->request->getPost('op_rpac10'),
            'op_i'          => $this->request->getPost('op_i'),
            'op_p'          => $this->request->getPost('op_p'),
            'op_pcnt'       => $this->request->getPost('op_pcnt'),
            'op_s'          => $this->request->getPost('op_s'),
            'op_t'          => $this->request->getPost('op_t'),
            'op_ctrf'       => $this->request->getPost('op_ctrf'),
            'op_arf'        => $this->request->getPost('op_arf'),
            'op_rf'         => $this->request->getPost('op_rf'),
            'op_vop'        => $this->request->getPost('op_vop'),
            'op_secref'     => $this->request->getPost('op_secref'),
            'op_rss'        => $this->request->getPost('op_rss'),
            'op_mki'        => $this->request->getPost('op_mki'),
            'op_ant'        => $this->request->getPost('op_ant'),
            'op_tss'        => $this->request->getPost('op_tss')
        ];
        $prov = [
            'prov_rpac10'   => $this->request->getPost('prov_rpac10'),
            'prov_i'        => $this->request->getPost('prov_i'),
            'prov_p'        => $this->request->getPost('prov_p'),
            'prov_pcnt'     => $this->request->getPost('prov_pcnt'),
            'prov_s'        => $this->request->getPost('prov_s'),
            'prov_t'        => $this->request->getPost('prov_t'),
            'prov_ctrf'     => $this->request->getPost('prov_ctrf'),
            'prov_arf'      => $this->request->getPost('prov_arf'),
            'prov_rf'       => $this->request->getPost('prov_rf'),
            'prov_vop'      => $this->request->getPost('prov_vop'),
            'prov_secref'   => $this->request->getPost('prov_secref'),
            'prov_rss'      => $this->request->getPost('prov_rss'),
            'prov_mki'      => $this->request->getPost('prov_mki'),
            'prov_ant'      => $this->request->getPost('prov_ant'),
            'prov_tss'      => $this->request->getPost('prov_tss')
        ];
        $rev = [
            'rev_rpac10'    => $this->request->getPost('rev_rpac10'),
            'rev_i'         => $this->request->getPost('rev_i'),
            'rev_p'         => $this->request->getPost('rev_p'),
            'rev_pcnt'      => $this->request->getPost('rev_pcnt'),
            'rev_s'         => $this->request->getPost('rev_s'),
            'rev_t'         => $this->request->getPost('rev_t'),
            'rev_ctrf'      => $this->request->getPost('rev_ctrf'),
            'rev_arf'       => $this->request->getPost('rev_arf'),
            'rev_rf'        => $this->request->getPost('rev_rf'),
            'rev_vop'       => $this->request->getPost('rev_vop'),
            'rev_secref'    => $this->request->getPost('rev_secref'),
            'rev_rss'       => $this->request->getPost('rev_rss'),
            'rev_mki'       => $this->request->getPost('rev_mki'),
            'rev_ant'       => $this->request->getPost('rev_ant'),
            'rev_tss'       => $this->request->getPost('rev_tss')
        ];
        $cst = [
            'cst_rpac10'    => $this->request->getPost('cst_rpac10'),
            'cst_i'         => $this->request->getPost('cst_i'),
            'cst_p'         => $this->request->getPost('cst_p'),
            'cst_pcnt'      => $this->request->getPost('cst_pcnt'),
            'cst_s'         => $this->request->getPost('cst_s'),
            'cst_t'         => $this->request->getPost('cst_t'),
            'cst_ctrf'      => $this->request->getPost('cst_ctrf'),
            'cst_arf'       => $this->request->getPost('cst_arf'),
            'cst_rf'        => $this->request->getPost('cst_rf'),
            'cst_vop'       => $this->request->getPost('cst_vop'),
            'cst_secref'    => $this->request->getPost('cst_secref'),
            'cst_rss'       => $this->request->getPost('cst_rss'),
            'cst_mki'       => $this->request->getPost('cst_mki'),
            'cst_ant'       => $this->request->getPost('cst_ant'),
            'cst_tss'       => $this->request->getPost('cst_tss')
        ];
        $pr = [
            'pr_rpac10'     => $this->request->getPost('pr_rpac10'),
            'pr_i'          => $this->request->getPost('pr_i'),
            'pr_p'          => $this->request->getPost('pr_p'),
            'pr_pcnt'       => $this->request->getPost('pr_pcnt'),
            'pr_s'          => $this->request->getPost('pr_s'),
            'pr_t'          => $this->request->getPost('pr_t'),
            'pr_ctrf'       => $this->request->getPost('pr_ctrf'),
            'pr_arf'        => $this->request->getPost('pr_arf'),
            'pr_rf'         => $this->request->getPost('pr_rf'),
            'pr_vop'        => $this->request->getPost('pr_vop'),
            'pr_secref'     => $this->request->getPost('pr_secref'),
            'pr_rss'        => $this->request->getPost('pr_rss'),
            'pr_mki'        => $this->request->getPost('pr_mki'),
            'pr_ant'        => $this->request->getPost('pr_ant'),
            'pr_tss'        => $this->request->getPost('pr_tss')
        ];
        $req = [
            'tgb'       => json_encode($tgb),
            'ppe'       => json_encode($ppe),
            'invmt'     => json_encode($invmt),
            'invtr'     => json_encode($invtr),
            'tr'        => json_encode($tr),
            'or'        => json_encode($or),
            'bac'       => json_encode($bac),
            'tp'        => json_encode($tp),
            'op'        => json_encode($op),
            'prov'      => json_encode($prov),
            'rev'       => json_encode($rev),
            'cst'       => json_encode($cst),
            'pr'        => json_encode($pr),
        ];
        $ref = [
            'materiality'   => $this->request->getPost('materiality'),
            'code'          => 'AC10',
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'wpID'          => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'c1tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveac10summ($req,$ref);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveac10s1($code,$sheet,$c1tID,$cID,$wpID,$name){

        $validationRules = [
            'namedesc' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }
        $req = [
            'less'      => $this->request->getPost('less'),
            'name'      => $this->request->getPost('namedesc'),
            'balance'   => $this->request->getPost('balance'),
            'type'      => $sheet,
            'code'      => $code,
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'wpID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveac10s1($req);
        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveac10cu($code,$sheet,$c1tID,$cID,$wpID,$name){

        $req = [
            'question'  => $this->request->getPost('question'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'wpID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveac10cu($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveac10s2($code,$sheet,$c1tID,$cID,$wpID,$name){

        $validationRules = [
            'namedesc' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }
        $req = [
            'less'      => $this->request->getPost('less'),
            'name'      => $this->request->getPost('namedesc'),
            'reason'    => $this->request->getPost('reason'),
            'balance'   => $this->request->getPost('balance'),
            'type'      => $sheet,
            'code'      => $code,
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveac10s2($req);
        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AC11 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac11($code,$c1tID,$cID,$wpID,$name){

        $ac11 = [
            'datem'     => $this->request->getPost('datem'),
            'ape1'      => $this->request->getPost('ape1'),
            'ape2'      => $this->request->getPost('ape2'),
            'ape3'      => $this->request->getPost('ape3'),
            'ieqr1'     => $this->request->getPost('ieqr1'),
            'ieqr2'     => $this->request->getPost('ieqr2'),
            'ieqr3'     => $this->request->getPost('ieqr3'),
            'mngr1'     => $this->request->getPost('mngr1'),
            'mngr2'     => $this->request->getPost('mngr2'),
            'mngr3'     => $this->request->getPost('mngr3'),
            'sup1'      => $this->request->getPost('sup1'),
            'sup2'      => $this->request->getPost('sup2'),
            'sup3'      => $this->request->getPost('sup3'),
            'sr1'       => $this->request->getPost('sr1'),
            'sr2'       => $this->request->getPost('sr2'),
            'sr3'       => $this->request->getPost('sr3'),
            'jra1'      => $this->request->getPost('jra1'),
            'jra2'      => $this->request->getPost('jra2'),
            'jra3'      => $this->request->getPost('jra3'),
            'jrb1'      => $this->request->getPost('jrb1'),
            'jrb2'      => $this->request->getPost('jrb2'),
            'jrb3'      => $this->request->getPost('jrb3'),
            'dcfrrt1'   => $this->request->getPost('dcfrrt1'),
            'dcfrrt2'   => $this->request->getPost('dcfrrt2'),
            'dcfrrt3'   => $this->request->getPost('dcfrrt3'),
            'dcfrrt4'   => $this->request->getPost('dcfrrt4'),
            'dcfrrt5'   => $this->request->getPost('dcfrrt5'),
            'dcfrrt6'   => $this->request->getPost('dcfrrt6'),
            'dcfrrt7'   => $this->request->getPost('dcfrrt7'),
            'dcfrrt8'   => $this->request->getPost('dcfrrt8'),
            'dcfrrt9'   => $this->request->getPost('dcfrrt9'),
            'sacb1'     => $this->request->getPost('sacb1'),
            'sacb2'     => $this->request->getPost('sacb2'),
            'sacb3'     => $this->request->getPost('sacb3'),
            'sacb4'     => $this->request->getPost('sacb4'),
            'sacb5'     => $this->request->getPost('sacb5'),
            'sacb6'     => $this->request->getPost('sacb6'),
            'sacb7'     => $this->request->getPost('sacb7'),
            'sacb8'     => $this->request->getPost('sacb8'),
            'sacb9'     => $this->request->getPost('sacb9'),
        ];
        $req = [
            'ac11'      => json_encode($ac11),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveac11($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        CHAPTER 2
        AA1 FUNCTIONS
        ----------------------------------------------------------
    */
    public function savequestions($code,$c2tID,$cID,$wpID,$name){

        $req = [
            'extent'        => $this->request->getPost('extent'),
            'reference'     => $this->request->getPost('reference'),
            'initials'      => $this->request->getPost('initials'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->savequestions($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveaicpppa($code,$c2tID,$cID,$wpID,$name){

        $req = [
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaicpppa($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function savercicp($code,$c2tID,$cID,$wpID,$name){

        $req = [
            'extent'    => $this->request->getPost('yesno'),
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->savercicp($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }
    
    /**
        ----------------------------------------------------------
        CHAPTER 3
        AA1 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveplaf($code,$c3tID,$cID,$wpID,$name){

        $req = [
            'extent'        => $this->request->getPost('extent'),
            'reference'     => $this->request->getPost('reference'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveplaf($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveaa1s3($code,$c3tID,$cID,$wpID,$name){

        $sec = [
            'a1'    => $this->request->getPost('a1'),
            'a2'    => $this->request->getPost('a2'),
            'a3'    => $this->request->getPost('a3'),
            'a4'    => $this->request->getPost('a4'),
            'a5'    => $this->request->getPost('a5'),
            'a6'    => $this->request->getPost('a6'),
            'a7'    => $this->request->getPost('a7')
        ];
        $req = [
            'question'  => json_encode($sec),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa1s3($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AA2 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveaa2($code,$c3tID,$cID,$wpID,$name){

        $aa2 = [
            'rat'       => $this->request->getPost('rat'),
            'rcae'      => $this->request->getPost('rcae'),
            'atriaq'    => $this->request->getPost('atriaq'),
            'kcapet'    => $this->request->getPost('kcapet'),
            'fd'        => $this->request->getPost('fd'),
            'fs'        => $this->request->getPost('fs'),
            'oi'        => $this->request->getPost('oi')
        ];
        $req = [
            'aa2'       => json_encode($aa2),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa2($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AA3a FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveaa3a($code,$c3tID,$cID,$wpID,$name){

        $req = [
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa3a($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveaa3afaf($code,$c3tID,$cID,$wpID,$name){

        $req = [
            'extent'        => $this->request->getPost('extent'),
            'reference'     => $this->request->getPost('reference'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa3afaf($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveaa3air($code,$c3tID,$cID,$wpID,$name){

        $req = [
            'ir'        => $this->request->getPost('ir'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa3air($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AA3b FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveaa3b($code,$c3tID,$cID,$wpID,$name){

        $req = [
            'reference'     => $this->request->getPost('reference'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa3b($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveaa3bp4($code,$c3tID,$cID,$wpID,$name){

        $p4 = [
            'p41'   => $this->request->getPost('p41'),
            'p42'   => $this->request->getPost('p42')
        ];
        $req = [
            'p4'        => json_encode($p4),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa3bp4($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AA5b FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveaa5b($code,$c3tID,$cID,$wpID,$name){

        $validationRules = [
            'reference' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }
        $req = [
            'reference'         => $this->request->getPost('reference'),
            'issue'             => $this->request->getPost('issue'),
            'comment'           => $this->request->getPost('comment'),
            'recommendation'    => $this->request->getPost('recommendation'),
            'yesno'             => $this->request->getPost('yesno'),
            'result'            => $this->request->getPost('result'),
            'code'              => $code,
            'part'              => $this->request->getPost('part'),
            'cID'               => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'wpID'              => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'c3tID'             => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'               => $this->crypt->decrypt(session()->get('userID')),
            'fID'               => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa5b($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AA7 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveaa7isa($code,$c3tID,$cID,$wpID,$name){

        $validationRules = [
            'reference' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }
        $req = [
            'reference'         => $this->request->getPost('reference'),
            'issue'             => $this->request->getPost('issue'),
            'comment'           => $this->request->getPost('comment'),
            'recommendation'    => $this->request->getPost('recommendation'),
            'result'            => $this->request->getPost('result'),
            'code'              => $code,
            'part'              => $this->request->getPost('part'),
            'cID'               => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'wpID'              => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'c3tID'             => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'               => $this->crypt->decrypt(session()->get('userID')),
            'fID'               => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa7isa($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }
    
    public function saveaa7aepapp($code,$c3tID,$cID,$wpID,$name){
        
        $req = [
            'aep'       => $this->request->getPost('question'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa7aepapp($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveaa7aep($code,$c3tID,$cID,$wpID,$name){

        $aep = [
            'ch1'   => $this->request->getPost('ch1'),
            'ch2'   => $this->request->getPost('ch2'),
            'dev1'  => $this->request->getPost('dev1'),
            'dev2'  => $this->request->getPost('dev2'),
            'fut1'  => $this->request->getPost('fut1'),
            'fut2'  => $this->request->getPost('fut2'),
            'cst1'  => $this->request->getPost('cst1'),
            'cst2'  => $this->request->getPost('cst2')
        ];
        $req = [
            'aep'   => json_encode($aep),
            'acid'  => $this->request->getPost('acid'),
            'cID'   => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'   => $this->crypt->decrypt(session()->get('userID')),
            'fID'   => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa7aep($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AA10 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveaa10($code,$c3tID,$cID,$wpID,$name){

        $aa10 = [
            'sum'   => $this->request->getPost('sum'),
            'comp'  => $this->request->getPost('comp'),
            'exp'   => $this->request->getPost('exp')
        ];
        $req = [
            'aa10'      => json_encode($aa10),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa10($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AA11 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveaa11un($code,$c3tID,$cID,$wpID,$name){

        $req = [
            'reference'     => $this->request->getPost('reference'),
            'desc'          => $this->request->getPost('desc'),
            'drps'          => $this->request->getPost('drps'),
            'crps'          => $this->request->getPost('crps'),
            'drfp'          => $this->request->getPost('drfp'),
            'crfp'          => $this->request->getPost('crfp'),
            'yesno'         => $this->request->getPost('yesno'),
            'code'          => $code,
            'part'          => $this->request->getPost('part'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'wpID'          => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID)),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa11un($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveaa11ad($code,$c3tID,$cID,$wpID,$name){

        $req = [
            'reference'     => $this->request->getPost('reference'),
            'desc'          => $this->request->getPost('desc'),
            'drps'          => $this->request->getPost('drps'),
            'crps'          => $this->request->getPost('crps'),
            'drfp'          => $this->request->getPost('drfp'),
            'crfp'          => $this->request->getPost('crfp'),
            'code'          => $code,
            'part'          => 'ad',
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa11ad($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'-ad/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'-ad/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }
    
    public function saveaa11ue($code,$c3tID,$cID,$wpID,$name){

        $aa11 = [
            'cta'   => $this->request->getPost('cta'),
            'fpm'   => $this->request->getPost('fpm'),
            'fma'   => $this->request->getPost('fma')
        ];
        $req = [
            'aa11'  => json_encode($aa11),
            'acid'  => $this->request->getPost('acid'),
            'cID'   => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'   => $this->crypt->decrypt(session()->get('userID')),
            'fID'   => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa11ue($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveaa11con($code,$c3tID,$cID,$wpID,$name){

        $aa11con = [
            'bdr1'      => $this->request->getPost('bdr1'),
            'bcr1'      => $this->request->getPost('bcr1'),
            'bdr2'      => $this->request->getPost('bdr2'),
            'bcr2'      => $this->request->getPost('bcr2'),
            'cdr1'      => $this->request->getPost('cdr1'),
            'ccr1'      => $this->request->getPost('ccr1'),
            'cdr2'      => $this->request->getPost('cdr2'),
            'ccr2'      => $this->request->getPost('ccr2'),
            'ddr1'      => $this->request->getPost('ddr1'),
            'dcr1'      => $this->request->getPost('dcr1'),
            'ddr2'      => $this->request->getPost('ddr2'),
            'dcr2'      => $this->request->getPost('dcr2'),
            'edr1'      => $this->request->getPost('edr1'),
            'ecr1'      => $this->request->getPost('ecr1'),
            'edr2'      => $this->request->getPost('edr2'),
            'ecr2'      => $this->request->getPost('ecr2'),
            'fdr1'      => $this->request->getPost('fdr1'),
            'fcr1'      => $this->request->getPost('fcr1'),
            'fdr2'      => $this->request->getPost('fdr2'),
            'fcr2'      => $this->request->getPost('fcr2'),
            'hdr1'      => $this->request->getPost('hdr1'),
            'hcr1'      => $this->request->getPost('hcr1'),
            'hdr2'      => $this->request->getPost('hdr2'),
            'hcr2'      => $this->request->getPost('hcr2'),
            'idr1'      => $this->request->getPost('idr1'),
            'icr1'      => $this->request->getPost('icr1'),
            'idr2'      => $this->request->getPost('idr2'),
            'icr2'      => $this->request->getPost('icr2'),
            'jdr1'      => $this->request->getPost('jdr1'),
            'jcr1'      => $this->request->getPost('jcr1'),
            'jdr2'      => $this->request->getPost('jdr2'),
            'jcr2'      => $this->request->getPost('jcr2'),
            'ldr1'      => $this->request->getPost('ldr1'),
            'lcr1'      => $this->request->getPost('lcr1'),
            'ldr2'      => $this->request->getPost('ldr2'),
            'lcr2'      => $this->request->getPost('lcr2'),
            'mdr1'      => $this->request->getPost('mdr1'),
            'mcr1'      => $this->request->getPost('mcr1'),
            'mdr2'      => $this->request->getPost('mdr2'),
            'mcr2'      => $this->request->getPost('mcr2'),
            'odr1'      => $this->request->getPost('odr1'),
            'ocr1'      => $this->request->getPost('ocr1'),
            'odr2'      => $this->request->getPost('odr2'),
            'ocr2'      => $this->request->getPost('ocr2'),
            'pdr1'      => $this->request->getPost('pdr1'),
            'pcr1'      => $this->request->getPost('pcr1'),
            'pdr2'      => $this->request->getPost('pdr2'),
            'pcr2'      => $this->request->getPost('pcr2'),
            'qdr1'      => $this->request->getPost('qdr1'),
            'qcr1'      => $this->request->getPost('qcr1'),
            'qdr2'      => $this->request->getPost('qdr2'),
            'qcr2'      => $this->request->getPost('qcr2'),
            'rdr1'      => $this->request->getPost('rdr1'),
            'rcr1'      => $this->request->getPost('rcr1'),
            'rdr2'      => $this->request->getPost('rdr2'),
            'rcr2'      => $this->request->getPost('rcr2'),
        ];
        $req = [
            'aa11'      => json_encode($aa11con),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa11con($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveaa11uead($code,$c3tID,$cID,$wpID,$name){

        $aa11 = [
            'pl'    => $this->request->getPost('pl'),
            'na'    => $this->request->getPost('na'),
            'pl2'   => $this->request->getPost('pl2')
        ];
        $req = [
            'aa11'      => json_encode($aa11),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveaa11ue($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'-ad/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'-ad/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AB1 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveab1($code,$c3tID,$cID,$wpID,$name){

        $req = [
            'yesno'     => $this->request->getPost('yesno'),
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveab1($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AB3 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveab3($code,$c3tID,$cID,$wpID,$name){

        $ab3 = [
            'aby1'      => $this->request->getPost('aby1'),
            'aby2'      => $this->request->getPost('aby2'),
            'aby3'      => $this->request->getPost('aby3'),
            'aby4'      => $this->request->getPost('aby4'),
            'frs1'      => $this->request->getPost('frs1'),
            'ed1'       => $this->request->getPost('ed1'),
            'frs2'      => $this->request->getPost('frs2'),
            'ed2'       => $this->request->getPost('ed2'),
            'frs3'      => $this->request->getPost('frs3'),
            'ed3'       => $this->request->getPost('ed3'),
            'frs4'      => $this->request->getPost('frs4'),
            'ed4'       => $this->request->getPost('ed4'),
            'frs5'      => $this->request->getPost('frs5'),
            'ed5'       => $this->request->getPost('ed5')
        ];
        $req = [
            'question'  => json_encode($ab3),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveab3($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    /**
        ----------------------------------------------------------
        AB4 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveab4($code,$c3tID,$cID,$wpID,$name){

        $req = [
            'yesno'     => $this->request->getPost('yesno'),
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveab4($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function saveab4checklist($code,$c3tID,$cID,$wpID,$name){

        $chlst = [
            'y1'    => $this->request->getPost('y1'),
            'y2'    => $this->request->getPost('y2'),
            'y3'    => $this->request->getPost('y3'),
            'y4'    => $this->request->getPost('y4'),
            'y5'    => $this->request->getPost('y5'),
            'y6'    => $this->request->getPost('y6'),
            'y7'    => $this->request->getPost('y7'),
            'y8'    => $this->request->getPost('y8'),
            'y9'    => $this->request->getPost('y9'),
            'y10'   => $this->request->getPost('y10'),
            'y11'   => $this->request->getPost('y11'),
            'y12'   => $this->request->getPost('y12'),
            'y13'   => $this->request->getPost('y13'),
            'y14'   => $this->request->getPost('y14'),
            'y15'   => $this->request->getPost('y15'),
            'y16'   => $this->request->getPost('y16')
        ];
        $req = [
            'chlst'     => json_encode($chlst),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveab4checklist($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }
    
    /**
        ----------------------------------------------------------
        AB4a,b,c,d,e,f,g,h FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveab4a($code,$c3tID,$cID,$wpID,$name){

        $req = [
            'yesno'     => $this->request->getPost('yesno'),
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->wpmodel->saveab4a($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/wp/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$wpID.'/'.$name));
        }

    }

    public function viewindexfiles($code,$cfiID,$cID,$wpID,$index,$desc,$name){

        $data['code']   = $code;
        $data['cID']    = $cID;
        $data['cfiID']  = $cfiID;
        $data['wpID']   = $wpID;
        $data['index']  = $index;
        $data['desc']   = $desc;
        $dcID       = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dcfiID     = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cfiID));
        $dwpID      = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID));
        $dindex     = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$index));
        $data['title'] = $name;
        $data['subt']  = $code.' : '.$desc;
        switch ($code) {
            case 'Aa':
                echo view('includes/Header', $data);
                echo view('workpaper/index/Aa', $data);
                echo view('includes/Footer');
            break;
            case 'Ab':
                echo view('includes/Header', $data);
                echo view('workpaper/index/Ab', $data);
                echo view('includes/Footer');
            break;
            case 'Ac':
                echo view('includes/Header', $data);
                echo view('workpaper/index/Ac', $data);
                echo view('includes/Footer');
            break;
            case 'Acd':
                echo view('includes/Header', $data);
                echo view('workpaper/index/Ad', $data);
                echo view('includes/Footer');
            break;
            case 'B':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/B', $data);
                echo view('includes/Footer');
            break;
            case 'C':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/C', $data);
                echo view('includes/Footer');
            break;
            case 'DG':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/DG', $data);
                echo view('includes/Footer');
            break;
            case 'E':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/E', $data);
                echo view('includes/Footer');
            break;
            case 'F':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/F', $data);
                echo view('includes/Footer');
            break;
            case 'H':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/H', $data);
                echo view('includes/Footer');
            break;
            case 'I':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/I', $data);
                echo view('includes/Footer');
            break;
            case 'J':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/J', $data);
                echo view('includes/Footer');
            break;
            case 'K':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/K', $data);
                echo view('includes/Footer');
            break;
            case 'L':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/L', $data);
                echo view('includes/Footer');
            break;
            case 'M':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/M', $data);
                echo view('includes/Footer');
            break;
            case 'N':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/N', $data);
                echo view('includes/Footer');
            break;
            case 'O':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/O', $data);
                echo view('includes/Footer');
            break;
            case 'P':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/P', $data);
                echo view('includes/Footer');
            break;
            case 'Q':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/Q', $data);
                echo view('includes/Footer');
            break;
            case 'R':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/R', $data);
                echo view('includes/Footer');
            break;
            case 'S':
                $data['ind'] = $this->wpmodel->gettbindex($dcID,$dwpID,$dindex);
                echo view('includes/Header', $data);
                echo view('workpaper/index/S', $data);
                echo view('includes/Footer');
            break;
            case 'T':

                echo view('includes/Header', $data);
                echo view('workpaper/index/T', $data);
                echo view('includes/Footer');
            break;
            case 'U':

                echo view('includes/Header', $data);
                echo view('workpaper/index/U', $data);
                echo view('includes/Footer');
            break;
            case 'V':
                echo view('includes/Header', $data);
                echo view('workpaper/index/V', $data);
                echo view('includes/Footer');
            break;
        }

    }

    /** 
        ----------------------------------------------------------
        PDF Chapter 1 area
        ----------------------------------------------------------
    */
    public function viewpdfc1($code,$c1tID,$cID,$wpID){

        $data['title']      = $code;
        $data['c1tID']      = $c1tID;
        $data['code']       = $code;
        $dcID               = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dwpID              = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID));
        $dc1tID             = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID));
        $data['cl']         = $this->wpmodel->getclientinfo($dwpID,$dcID);
        $data['fl']         = $this->wpmodel->getfileinfoc1($dwpID,$dcID,$dc1tID);
        switch ($code) {
            case 'AC1':
                $data['ac1']    = $this->wpmodel->getac1($code,$dc1tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getac1eqr($code,$dc1tID,$dcID,$dwpID);
                $data['eqr']    = json_decode($rdata['question'], true);
                echo view('workpaper/pdfc1/AC1', $data);
                break;
            case 'AC2':
                $data['ac2']    = $this->wpmodel->getac2($code,$dc1tID,$dcID,$dwpID);
                $data['aep']    = $this->wpmodel->getac2aep($code,$dc1tID,$dcID,$dwpID);
                echo view('workpaper/pdfc1/AC2', $data);
                break;
            case 'AC3':
                $data['ac3genmat']      = $this->wpmodel->getac3('genmat',$code,$dc1tID,$dcID,$dwpID);
                $data['ac3doccors']     = $this->wpmodel->getac3('doccors',$code,$dc1tID,$dcID,$dwpID);
                $data['ac3statutory']   = $this->wpmodel->getac3('statutory',$code,$dc1tID,$dcID,$dwpID);
                $data['ac3accsys']      = $this->wpmodel->getac3('accsys',$code,$dc1tID,$dcID,$dwpID);
                echo view('workpaper/pdfc1/AC3', $data);
                break;
            case 'AC4':
                $data['ac4']    = $this->wpmodel->getac4($code,$dc1tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getac4ppr($code,$dc1tID,$dcID,$dwpID);
                $data['ppr']    = json_decode($rdata['question'], true);
                echo view('workpaper/pdfc1/AC4', $data);
                break;
            case 'AC5':
                $rdata          = $this->wpmodel->getac5($code,$dc1tID,$dcID,$dwpID);
                $data['rc']     = json_decode($rdata['question'], true);
                echo view('workpaper/pdfc1/AC5', $data);
                break;
            case 'AC6':
                $data['ac6']    = $this->wpmodel->getac6('ac6ra',$code,$dc1tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->gets12($code,$dc1tID,$dcID,$dwpID);
                $data['s']      = json_decode($rdata['question'], true);
                $data['s3']     = $this->wpmodel->getac6('ac6s3',$code,$dc1tID,$dcID,$dwpID);
                echo view('workpaper/pdfc1/AC6', $data);
                break;
            case 'AC7':
                $rowdata = [
                    'bacdata','trdata','ordata','invtrdata','invmtdata','ppedata','incadata','tpdata','opdata','taxdata','provdata',
                    'roidata','dcodata','prdata','oadata'
                ];
                foreach($rowdata as $row){
                    $rdata = $this->wpmodel->getac7($code,$dc1tID, $row,$dcID,$dwpID);
                    $data[$row] = json_decode($rdata['question'], true);
                }
                echo view('workpaper/pdfc1/AC7', $data);
                break;
            case 'AC8':
                $rowdata = [
                    'revp','revf','prop','prof','grop','grof','revpr','revfr','propr','profr','gropr','grofr','pcu','fcu','adjap','adjbp','adjcp','adjaf','adjbf','adjcf',
                    'aomp','aomf','justn45','pcur','fcur','mlpinfo','conplst','confnst','oirp','oirf','pmpp','pmpf','apmp','apmf','conplst2','confnst2',
                    'rsp','confnst','ctp','ctf','aest','aestp','aestf','rptp','rptf',
                    'itbd1','itbd1p','itbd1f','itbd2','itbd2p','itbd2f','itbd3','itbd3p','itbd3f','adja','adjb','adjc','itbdae1','itbdae2','itbdae3'
                ];
                foreach($rowdata as $row){
                    $data[$row] = $this->wpmodel->getac8($code,$dc1tID,$row,$dcID,$dwpID);
                }
                echo view('workpaper/pdfc1/AC8', $data);
                break;
            case 'AC9':
                $rdata = $this->wpmodel->getac9data($code,$dc1tID,$dcID,$dwpID);
                $data['ac9'] = json_decode($rdata['question'], true);
                echo view('workpaper/pdfc1/AC9', $data);
                break;
            case 'AC10-Tangibles':
            case 'AC10-PPE':
            case 'AC10-Investments':
            case 'AC10-Inventory':
            case 'AC10-Trade Receivables':
            case 'AC10-Other Receivables':
            case 'AC10-Bank and Cash':
            case 'AC10-Trade Payables':
            case 'AC10-Other Payables':
            case 'AC10-Provisions':
            case 'AC10-Revenue':
            case 'AC10-Costs':
            case 'AC10-Payroll':
                $s                  = explode('-', $code);
                $data ['sheet']     = $s[1];
                $data['code']       = $s[0];
                $data['cu']         = $this->wpmodel->getac10cu($dc1tID,$s[1].'cu',$dcID,$dwpID);
                $data['ac10s1']     = $this->wpmodel->getac10s1data($dc1tID,$s[1],$dcID,$dwpID);
                $data['ac10s2']     = $this->wpmodel->getac10s2data($dc1tID,$s[1],$dcID,$dwpID);
                echo view('workpaper/pdfc1/AC10', $data);
                break;
            case 'AC10-Summary':
                $s                  = explode('-', $code);
                $data ['sheet']     = $s[1];
                $data['code']       = $s[0];
                $data['nmk_tgb']    = $this->wpmodel->getdatacount($dc1tID,'Tangibles',$dcID,$dwpID);
                $data['nmk_ppe']    = $this->wpmodel->getdatacount($dc1tID,'PPE',$dcID,$dwpID);
                $data['nmk_invmt']  = $this->wpmodel->getdatacount($dc1tID,'Investments',$dcID,$dwpID);
                $data['nmk_invtr']  = $this->wpmodel->getdatacount($dc1tID,'Inventory',$dcID,$dwpID);
                $data['nmk_tr']     = $this->wpmodel->getdatacount($dc1tID,'Trade Receivables',$dcID,$dwpID);
                $data['nmk_or']     = $this->wpmodel->getdatacount($dc1tID,'Other Receivables',$dcID,$dwpID);
                $data['nmk_bac']    = $this->wpmodel->getdatacount($dc1tID,'Bank and Cash',$dcID,$dwpID);
                $data['nmk_tp']     = $this->wpmodel->getdatacount($dc1tID,'Trade Payables',$dcID,$dwpID);
                $data['nmk_op']     = $this->wpmodel->getdatacount($dc1tID,'Other Payables',$dcID,$dwpID);
                $data['nmk_prov']   = $this->wpmodel->getdatacount($dc1tID,'Provisions',$dcID,$dwpID);
                $data['nmk_rev']    = $this->wpmodel->getdatacount($dc1tID,'Revenue',$dcID,$dwpID);
                $data['nmk_cst']    = $this->wpmodel->getdatacount($dc1tID,'Costs',$dcID,$dwpID);
                $data['nmk_pr']     = $this->wpmodel->getdatacount($dc1tID,'Payroll',$dcID,$dwpID);
                $data['vop_tgb']    = $this->wpmodel->getsumation($dc1tID,'Tangibles',$dcID,$dwpID);
                $data['vop_ppe']    = $this->wpmodel->getsumation($dc1tID,'PPE',$dcID,$dwpID);
                $data['vop_invmt']  = $this->wpmodel->getsumation($dc1tID,'Investments',$dcID,$dwpID);
                $data['vop_invtr']  = $this->wpmodel->getsumation($dc1tID,'Inventory',$dcID,$dwpID);
                $data['vop_tr']     = $this->wpmodel->getsumation($dc1tID,'Trade Receivables',$dcID,$dwpID);
                $data['vop_or']     = $this->wpmodel->getsumation($dc1tID,'Other Receivables',$dcID,$dwpID);
                $data['vop_bac']    = $this->wpmodel->getsumation($dc1tID,'Bank and Cash',$dcID,$dwpID);
                $data['vop_tp']     = $this->wpmodel->getsumation($dc1tID,'Trade Payables',$dcID,$dwpID);
                $data['vop_op']     = $this->wpmodel->getsumation($dc1tID,'Other Payables',$dcID,$dwpID);
                $data['vop_prov']   = $this->wpmodel->getsumation($dc1tID,'Provisions',$dcID,$dwpID);
                $data['vop_rev']    = $this->wpmodel->getsumation($dc1tID,'Revenue',$dcID,$dwpID);
                $data['vop_cst']    = $this->wpmodel->getsumation($dc1tID,'Costs',$dcID,$dwpID);
                $data['vop_pr']     = $this->wpmodel->getsumation($dc1tID,'Payroll',$dcID,$dwpID);
                $data['mat']        = $this->wpmodel->getsummarydata($dc1tID,'material',$dcID,$dwpID);
                $rowdata            = ['tgb','ppe','invmt','invtr','tr','or','bac','tp','op','prov','rev','cst','pr'];
                foreach($rowdata as $row){
                    $rdata          = $this->wpmodel->getsummarydata($dc1tID, $row,$dcID,$dwpID);
                    $data[$row]     = json_decode($rdata['question'], true);
                }
                echo view('workpaper/pdfc1/AC10Summ', $data);
                break;
            case 'AC11':
                $rdata = $this->wpmodel->getac11data($code,$dc1tID,$dcID,$dwpID);
                $data['ac11'] = json_decode($rdata['question'], true);
                echo view('workpaper/pdfc1/AC11', $data);
                break;
            default:
            break;
        }

    }

    /** 
        ----------------------------------------------------------
        PDF Chapter 2 area
        ----------------------------------------------------------
    */
    public function viewpdfc2($code,$c2tID,$cID,$wpID){

        $data['title']  = $code;
        $data['c2tID']  = $c2tID;
        $data['code']   = $code;
        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dwpID          = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID));
        $dc2tID         = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID));
        $data['cl']     = $this->wpmodel->getclientinfo($dwpID,$dcID);
        $data['fl']     = $this->wpmodel->getfileinfoc2($dwpID,$dcID,$dc2tID);
        switch ($code) {
            case '2.1 B2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/B2', $data);
                break;
            case '2.2.1 C2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/C2', $data);
                break;
            case '2.2.2 C2-1':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/C2-1', $data);
                break;
            case '2.3 D2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/D2', $data);
                break;
            case '2.4.1 E2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/E2', $data);
                break;
            case '2.4.2 E2-1':
                $data['aicpppa'] = $this->wpmodel->getquestionsaicpppa($code,$dc2tID,$dcID,$dwpID);
                $data['rcicp'] = $this->wpmodel->getquestionsrcicp($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/E2-1', $data);
                break;
            case '2.4.3 E2-2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/E2-2', $data);
                break;
            case '2.4.4 E2-3':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/E2-3', $data);
                break;
            case '2.4.5 E2-4':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/E2-4', $data);
                break;
            case '2.5 F2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/F2', $data);
                break;
            case '2.6 H2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/H2', $data);
                break;
            case '2.7 I2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/I2', $data);
                break;
            case '2.8 J2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/J2', $data);
                break;
            case '2.9 K2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/K2', $data);
                break;
            case '2.10 L2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/L2', $data);
                break;
            case '2.11 M2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/M2', $data);
                break;
            case '2.12 N2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/N2', $data);
                break;
            case '2.13.1 O2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/O2', $data);
                break;
            case '2.13.2 O2-1':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/O2-1', $data);
                break;
            case '2.14 P2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/P2', $data);
                break;
            case '2.15 Q2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/Q2', $data);
                break;  
            case '2.16 R2-1':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/R2-1', $data);
                break;  
            case '2.17 R2-2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/R2-2', $data);
                break;  
            case '2.18.1 S2-1':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/S2-1', $data);
                break;  
            case '2.18.2 S2-2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/S2-2', $data);
                break; 
            case '2.18.3 S2-3':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/S2-3', $data);
                break;  
            case '2.18.4 S2-4':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/S2-4', $data);
                break; 
            case '2.19.1 U2-1':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/U2-1', $data);
                break;   
            case '2.19.2 U2-2':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/U2-2', $data);
                break; 
            case '2.19.3 U2-3':
                $data['qdata'] = $this->wpmodel->getquestionsdata($code,$dc2tID,$dcID,$dwpID);
                echo view('workpaper/pdfc2/U2-3', $data);
                break;   
            default:
                break;
        }

    }

    /** 
        ----------------------------------------------------------
        PDF Chapter 3 area
        ----------------------------------------------------------
    */
    public function viewpdfc3($code,$c3tID,$cID,$wpID){

        $data['title']  = $code;
        $data['c3tID']  = $c3tID;
        $data['code']   = $code;
        $dcID           = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID));
        $dwpID          = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID));
        $dc3tID         = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID));
        $data['cl']     = $this->wpmodel->getclientinfo($dwpID,$dcID);
        $data['fl']     = $this->wpmodel->getfileinfoc3($dwpID,$dcID,$dc3tID);
        switch ($code) {
            case '3.1 Aa1':
                $data['datapl']     = $this->wpmodel->getaa1('planning',$code,$dc3tID,$dcID,$dwpID);
                $data['dataaf']     = $this->wpmodel->getaa1('audit finalisation',$code,$dc3tID,$dcID,$dwpID);
                $rdata              = $this->wpmodel->getaa1s3($code, $dc3tID,$dcID,$dwpID);
                $data['s3']         = json_decode($rdata['question'], true);
                echo view('workpaper/pdfc3/AA1', $data);
                break;
            case '3.2 Aa2':
                $rdata          = $this->wpmodel->getaa2data($code, $dc3tID,$dcID,$dwpID);
                $data['aa2']    = json_decode($rdata['question'], true);
                echo view('workpaper/pdfc3/AA2', $data);
                break;
            case '3.3 Aa3a':
                $data['cr']     = $this->wpmodel->getaa3('cr',$code,$dc3tID,$dcID,$dwpID);
                $data['dc']     = $this->wpmodel->getaa3('dc',$code,$dc3tID,$dcID,$dwpID);
                $data['faf']    = $this->wpmodel->getaa3('faf',$code,$dc3tID,$dcID,$dwpID);
                $data['ir']     = $this->wpmodel->getaa3air($code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AA3A', $data);
                break;
            case '3.4 Aa3b':
                $data['bp1']    = $this->wpmodel->getaa3b('p1',$code,$dc3tID,$dcID,$dwpID);
                $data['bp2']    = $this->wpmodel->getaa3b('p2',$code,$dc3tID,$dcID,$dwpID);
                $data['bp3a']   = $this->wpmodel->getaa3b('p3a',$code,$dc3tID,$dcID,$dwpID);
                $data['bp3b']   = $this->wpmodel->getaa3b('p3b',$code,$dc3tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getaa3bp4($code,$dc3tID,$dcID,$dwpID);
                $data['bp4']    = json_decode($rdata['question'], true);
                echo view('workpaper/pdfc3/AA3B', $data);
                break;
            case '3.5 Aa4':
                echo view('workpaper/pdfc3/AA4', $data);
                break;
            case '3.6.1 Aa5a':
                echo view('workpaper/pdfc3/AA5A', $data);
                break;
            case '3.6.2 Aa5b':
                $data['aa5b'] = $this->wpmodel->getaa5b($code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AA5B', $data);
                break;  
            case '3.7 Aa7':
                $data['aa7']    = $this->wpmodel->getaa7('isa315',$code,$dc3tID,$dcID,$dwpID);
                $data['cons']   = $this->wpmodel->getaa7('consultation',$code,$dc3tID,$dcID,$dwpID);
                $data['inc']    = $this->wpmodel->getaa7('inconsistencies',$code,$dc3tID,$dcID,$dwpID);
                $data['ref']    = $this->wpmodel->getaa7('refusal',$code,$dc3tID,$dcID,$dwpID);
                $data['dep']    = $this->wpmodel->getaa7('departures',$code,$dc3tID,$dcID,$dwpID);
                $data['oth']    = $this->wpmodel->getaa7('other',$code,$dc3tID,$dcID,$dwpID);
                $data['aepapp'] = $this->wpmodel->getaa7aep('aepapp',$code,$dc3tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getaa7aep('aep',$code,$dc3tID,$dcID,$dwpID);
                $data['aep']    = json_decode($rdata['question'], true);
                echo view('workpaper/pdfc3/AA7', $data);
                break;
            case '3.8 Aa10':
                $rdata = $this->wpmodel->getaa10($code,$dc3tID,$dcID,$dwpID);
                $data['aa10'] = json_decode($rdata['question'], true);
                echo view('workpaper/pdfc3/AA10', $data);
                break;
            case '3.9':
                echo view('workpaper/pdfc3/39', $data);
                break;
            case '3.10 Aa11-un':
                $s              = explode('-', $code);
                $data['aef']    = $this->wpmodel->getaa11p2('aef',$s[0],$dc3tID,$dcID,$dwpID);
                $data['aej']    = $this->wpmodel->getaa11p2('aej',$s[0],$dc3tID,$dcID,$dwpID);
                $data['ee']     = $this->wpmodel->getaa11p2('ee',$s[0],$dc3tID,$dcID,$dwpID);
                $data['de']     = $this->wpmodel->getaa11p2('de',$s[0],$dc3tID,$dcID,$dwpID);
                $rdata          = $this->wpmodel->getaa11p('aa11ue',$s[0],$dc3tID,$dcID,$dwpID);
                $data['ue']     = json_decode($rdata['question'], true);
                $rdata2         = $this->wpmodel->getaa11con('con',$s[0],$dc3tID,$dcID,$dwpID);
                $data['con']    = json_decode($rdata2['question'], true);    
                echo view('workpaper/pdfc3/AA11-un', $data);
            case '3.10 Aa11-ad':
                $s = explode('-', $code);
                $data['ad'] = $this->wpmodel->getaa11p2('ad',$s[0],$dc3tID,$dcID,$dwpID);
                $rdata = $this->wpmodel->getaa11p('aa11uead',$s[0],$dc3tID,$dcID,$dwpID);
                $data['ue'] = json_decode($rdata['question'], true);   
                $s = explode('-', $code);
                echo view('workpaper/pdfc3/AA11-ad', $data);
                break;   
            case '3.11':
                echo view('workpaper/pdfc3/311', $data);
                break;   
            case '3.12':
                echo view('workpaper/pdfc3/312', $data);
                break;   
            case '3.13 Ab1':
                $data['ab1'] = $this->wpmodel->getab1($code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AB1', $data);
                break;   
            case '3.14 Ab3':
                $rdata = $this->wpmodel->getab3($code,$dc3tID,$dcID,$dwpID);
                $data['ab3'] = json_decode($rdata['question'], true);
                echo view('workpaper/pdfc3/AB3', $data);
                break; 
            case '3.15 Ab4':
                $rdata = $this->wpmodel->getab4checklist('checklist',$code,$dc3tID,$dcID,$dwpID);
                $data['sec']    = json_decode($rdata['question'], true);
                $data['sec1']   = $this->wpmodel->getab4('section1',$code,$dc3tID,$dcID,$dwpID);
                $data['sec2']   = $this->wpmodel->getab4('section2',$code,$dc3tID,$dcID,$dwpID);
                $data['sec3']   = $this->wpmodel->getab4('section3',$code,$dc3tID,$dcID,$dwpID);
                $data['sec4']   = $this->wpmodel->getab4('section4',$code,$dc3tID,$dcID,$dwpID);
                $data['sec5']   = $this->wpmodel->getab4('section5',$code,$dc3tID,$dcID,$dwpID);
                $data['sec6']   = $this->wpmodel->getab4('section6',$code,$dc3tID,$dcID,$dwpID);
                $data['sec7']   = $this->wpmodel->getab4('section7',$code,$dc3tID,$dcID,$dwpID);
                $data['sec8']   = $this->wpmodel->getab4('section8',$code,$dc3tID,$dcID,$dwpID);
                $data['sec9']   = $this->wpmodel->getab4('section9',$code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AB4', $data);
                break; 
            case '3.15.1 Ab4a':
                $data['ab4a'] = $this->wpmodel->getab4a('ab4a',$code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AB4A', $data);
                break; 
            case '3.15.2 Ab4b':
                $data['ab4b'] = $this->wpmodel->getab4a('ab4b',$code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AB4B', $data);
                break; 
            case '3.15.3 Ab4c':
                $data['ab4c'] = $this->wpmodel->getab4a('ab4c',$code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AB4C', $data);
                break; 
            case '3.15.4 Ab4d':
                $data['ab4d'] = $this->wpmodel->getab4a('ab4d',$code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AB4D', $data);
                break; 
            case '3.15.5 Ab4e':
                $data['ab4e'] = $this->wpmodel->getab4a('ab4e',$code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AB4E', $data);
                break; 
            case '3.15.6 Ab4f':
                $data['ab4f'] = $this->wpmodel->getab4a('ab4f',$code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AB4F', $data);
                break; 
            case '3.15.7 Ab4g':
                $data['ab4g'] = $this->wpmodel->getab4a('ab4g',$code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AB4G', $data);
                break; 
            case '3.15.8 Ab4h':
                $data['ab4h'] = $this->wpmodel->getab4a('ab4h',$code,$dc3tID,$dcID,$dwpID);
                echo view('workpaper/pdfc3/AB4H', $data);
                break; 
            default:
                break;
        }

    }


}