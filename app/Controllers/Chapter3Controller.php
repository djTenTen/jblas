<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\Chapter3Model;

class Chapter3Controller extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL //
        THIS FILE IS USED FOR CHAPTER 3 MANAGMENT
        Properties being used on this file
        * @property c3model to include the file chapter 1 model
        * @property crypt to load the encryption file
    */
    protected $c3model;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->c3model = new Chapter3Model();
        $this->crypt = \Config\Services::encrypter();

    }


    /**
        * @method acin() used to set active/inactive the data from chapter 3 files
        * @param code consist the code of the file name
        * @param head consist the name of the file
        * @param c3tID consist the encrypted data of title id from the title file name
        * @param c3ID consist the encrypted data of chapter 2 id data
        * @var array-req consist the chapter 3 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function acin($code,$head,$c3tID,$c3ID){

        $req = [
            'code' => $code,
            'c3ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3ID))
        ];
        $res = $this->c3model->acin($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        ALL FUNCTIONS HERE USES THIS PARAMETERS
        * @param code consist the code of the file name
        * @param head consist the name of the file
        * @param c3tID consist the encrypted data of title id from the title file name
        ----------------------------------------------------------
        AA1 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa1plaf() used to save the data of aa1 file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the aa1 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa1plaf($code,$head,$c3tID){

        $validationRules = [
            'question'   => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }
        $req = [
            'question'      => $this->request->getPost('question'),
            'extent'        => $this->request->getPost('extent'),
            'reference'     => $this->request->getPost('reference'),
            'code'          => $code,
            'part'          => $this->request->getPost('part'),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->savequestions($req);
        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }

    /**
        * @method saveaa1s3() used to save the data of aa1 file
        * @var array-sec consist the aa1 file information and converted into json data
        * @var array-req consist the aa1 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa1s3($code,$head,$c3tID){

        $sec = [
            'a1' => $this->request->getPost('a1'),
            'a2' => $this->request->getPost('a2'),
            'a3' => $this->request->getPost('a3'),
            'a4' => $this->request->getPost('a4'),
            'a5' => $this->request->getPost('a5'),
            'a6' => $this->request->getPost('a6'),
            'a7' => $this->request->getPost('a7')
        ];
        $req = [
            'question'  => json_encode($sec),
            'code'      => $code,
            'part'      => 'section3',
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa1s3($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        ----------------------------------------------------------
        AA2 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa2() used to save the data of aa2 file
        * @var array-aa2 consist the aa2 file information and converted into json data
        * @var array-req consist the aa2 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa2($code,$head,$c3tID){

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
            'code'      => $code,
            'part'      => 'aa2',
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa2($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        ----------------------------------------------------------
        AA3a FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa3a() used to save the data of aa3a file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the aa3a file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa3a($code,$head,$c3tID){

        $validationRules = [
            'question'   => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }
        $req = [
            'question'      => $this->request->getPost('question'),
            'comment'       => $this->request->getPost('comment'),
            'code'          => $code,
            'part'          => $this->request->getPost('part'),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa3a($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }

    /**
        * @method saveaa3afaf() used to save the data of aa3a file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the aa3a file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa3afaf($code,$head,$c3tID){

        $validationRules = [
            'question'   => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }
        $req = [
            'question'      => $this->request->getPost('question'),
            'extent'        => $this->request->getPost('extent'),
            'reference'     => $this->request->getPost('reference'),
            'code'          => $code,
            'part'          => $this->request->getPost('part'),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa3afaf($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        * @method saveaa3afaf() used to save the data of aa3a file
        * @var array-req consist the aa3a file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa3air($code,$head,$c3tID){

        $req = [
            'ir'        => $this->request->getPost('ir'),
            'code'      => $code,
            'part'      => 'ir',
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa3air($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        ----------------------------------------------------------
        AA3b FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa3b() used to save the data of aa3b file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the aa3b file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa3b($code,$head,$c3tID){

        $validationRules = [
            'question'   => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }
        $req = [
            'question'      => $this->request->getPost('question'),
            'reference'     => $this->request->getPost('reference'),
            'code'          => $code,
            'part'          => $this->request->getPost('part'),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa3b($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        * @method saveaa3bp4() used to save the data of aa3b file
        * @var array-p4 consist the aa3b file information and converted into json data
        * @var array-req consist the aa3b file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa3bp4($code,$head,$c3tID){

        $p4 = [
            'p41'   => $this->request->getPost('p41'),
            'p42'   => $this->request->getPost('p42')
        ];
        $req = [
            'p4'        => json_encode($p4),
            'code'      => $code,
            'part'      => 'p4',
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa3bp4($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        ----------------------------------------------------------
        AA5b FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa5b() used to save the data of aa5b file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the aa5b file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa5b($code,$head,$c3tID){

        $validationRules = [
            'reference'  => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
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
            'c3tID'             => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa5b($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        ----------------------------------------------------------
        AA7 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa7isa() used to save the data of aa7 file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the aa7 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa7isa($code,$head,$c3tID){

        $validationRules = [
            'reference'  => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }
        $req = [
            'reference'         => $this->request->getPost('reference'),
            'issue'             => $this->request->getPost('issue'),
            'comment'           => $this->request->getPost('comment'),
            'recommendation'    => $this->request->getPost('recommendation'),
            'result'            => $this->request->getPost('result'),
            'code'              => $code,
            'part'              => $this->request->getPost('part'),
            'c3tID'             => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa7isa($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }
    

    /**
        * @method saveaa7aepapp() used to save the data of aa7 file
        * @var array-req consist the aa7 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa7aepapp($code,$head,$c3tID){
        
        $req = [
            'aep'       => $this->request->getPost('question'),
            'code'      => $code,
            'part'      => 'aepapp',
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa7aepapp($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }

    /**
        * @method saveaa7aep() used to save the data of aa7 file
        * @var array-aep consist the aa7 file information and converted into json data
        * @var array-req consist the aa7 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa7aep($code,$head,$c3tID){

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
            'aep'       => json_encode($aep),
            'code'      => $code,
            'part'      => 'aep',
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa7aep($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        ----------------------------------------------------------
        AA10 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa10() used to save the data of aa10 file
        * @var array-aa10 consist the aa10 file information and converted into json data
        * @var array-req consist the aa10 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa10($code,$head,$c3tID){

        $aa10 = [
            'sum'       => $this->request->getPost('sum'),
            'comp'      => $this->request->getPost('comp'),
            'exp'       => $this->request->getPost('exp')
        ];
        $req = [
            'aa10'      => json_encode($aa10),
            'code'      => $code,
            'part'      => 'aa10',
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa10($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        ----------------------------------------------------------
        AA11 FUNCTIONS
        ----------------------------------------------------------
        * @method viewa11() used to view the of aa11 file
        * @param sheet consist the sheet name of the file if adjusted or unadjusted
        * @var dc3tID decrypted id of @param c3tID
        * @var array-data consist of data needed to display on the page
        * @var rdata consist of json formated data from database
        * @return view
    */
    public function viewa11($sheet,$code,$head,$c3tID){

        $dc3tID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID));
        switch ($sheet) {
            case 'un':$data['sectiontitle'] = "SUMMARY OF UNADJUSTED ERRORS";break;
            case 'ad':$data['sectiontitle'] = "SUMMARY OF ADJUSTMENTS MADE TO THE CLIENT'S FINANCIAL STATEMENTS";break;
        }
        $data['title']      = $code. ' - Chapter 3 Management';
        $data['header']     = $head;
        $data['section']    = $sheet;
        $data['c3tID']      = $c3tID;
        $data['code']       = $code;
        if($sheet == "un"){
            $data['aef']    = $this->c3model->getaa11p2('aef',$code,$dc3tID);
            $data['aej']    = $this->c3model->getaa11p2('aej',$code,$dc3tID);
            $data['ee']     = $this->c3model->getaa11p2('ee',$code,$dc3tID);
            $data['de']     = $this->c3model->getaa11p2('de',$code,$dc3tID);
            $rdata          = $this->c3model->getaa11p1('aa11ue',$code,$dc3tID);
            $data['ue']     = json_decode($rdata['question'], true);    
            $rdata2         = $this->c3model->getaa11con('con',$code,$dc3tID);
            $data['con']    = json_decode($rdata2['question'], true);   
            echo view('includes/Header', $data);
            echo view('chapter3/310Aa11_un', $data);
            echo view('includes/Footer');
        }else{
            $data['ad']     = $this->c3model->getaa11p2('ad',$code,$dc3tID);
            $rdata          = $this->c3model->getaa11p1('aa11uead',$code,$dc3tID);
            $data['ue']     = json_decode($rdata['question'], true);    
            echo view('includes/Header', $data);
            echo view('chapter3/310Aa11_ad', $data);
            echo view('includes/Footer');
        }

    }

    /**
        * @method saveaa11un() used to save the data of aa11 file
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa11un($code,$head,$c3tID){

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
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa11un($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manageaa11/un/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manageaa11/un/'.$code.'/'.$head.'/'.$c3tID));
        }

    }

    /**
        * @method saveaa11ad() used to save the data of aa11 file
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa11ad($code,$head,$c3tID){

        $req = [
            'reference'     => $this->request->getPost('reference'),
            'desc'          => $this->request->getPost('desc'),
            'drps'          => $this->request->getPost('drps'),
            'crps'          => $this->request->getPost('crps'),
            'drfp'          => $this->request->getPost('drfp'),
            'crfp'          => $this->request->getPost('crfp'),
            'code'          => $code,
            'part'          => 'ad',
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa11ad($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manageaa11/ad/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manageaa11/ad/'.$code.'/'.$head.'/'.$c3tID));
        }

    }
    

    /**
        * @method saveaa11ad() used to save the data of aa11 file
        * @var array-aa11 consist the aa11 file information and converted into json data
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa11ue($code,$head,$c3tID){

        $aa11 = [
            'cta' => $this->request->getPost('cta'),
            'fpm' => $this->request->getPost('fpm'),
            'fma' => $this->request->getPost('fma')
        ];
        $req = [
            'aa11'  => json_encode($aa11),
            'code'  => $code,
            'part'  => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa11ue($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manageaa11/un/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manageaa11/un/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        * @method saveaa11con() used to save the data of aa11 file
        * @var array-aa11con consist the aa11 file information and converted into json data
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa11con($code,$head,$c3tID){

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
            'code'      => $code,
            'part'      => $this->request->getPost('part'),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa11con($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manageaa11/un/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manageaa11/un/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        * @method saveaa11uead() used to save the data of aa11 file
        * @var array-aa11 consist the aa11 file information and converted into json data
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa11uead($code,$head,$c3tID){

        $aa11 = [
            'pl'    => $this->request->getPost('pl'),
            'na'    => $this->request->getPost('na'),
            'pl2'   => $this->request->getPost('pl2')
        ];
        $req = [
            'aa11'  => json_encode($aa11),
            'code'  => $code,
            'part'  => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveaa11ue($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manageaa11/ad/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manageaa11/ad/'.$code.'/'.$head.'/'.$c3tID));
        }

    }

    /**
        ----------------------------------------------------------
        AB1 FUNCTIONS
        ----------------------------------------------------------
        * @method saveab1() used to save the data of ab1 file
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveab1($code,$head,$c3tID){

        $req = [
            'question'      => $this->request->getPost('question'),
            'yesno'         => $this->request->getPost('yesno'),
            'comment'       => $this->request->getPost('comment'),
            'code'          => $code,
            'part'          => 'ab1',
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveab1($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        ----------------------------------------------------------
        AB3 FUNCTIONS
        ----------------------------------------------------------
        * @method saveab3() used to save the data of ab3 file
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveab3($code,$head,$c3tID){

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
            'code'      => $code,
            'part'      => 'ab3',
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveab3($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


    /**
        ----------------------------------------------------------
        AB4 FUNCTIONS
        ----------------------------------------------------------
        * @method viewab4() used to view the ab4 file
        * @param sheet consist the section name of the file
        * @var dc3tID decrypted id of @param c3tID
        * @var array-data consist of data needed to display on the page
        * @var rdata consist of json formated data from database
        * @return view
    */
    public function viewab4($sheet,$code,$head,$c3tID){

        $dc3tID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID));
        switch ($sheet) {
            case 'checklist':$data['sectiontitle'] = 'CORPORATE DISCLOSURE CHECKLIST (IFRS)';break;
            case 'section1':$data['sectiontitle'] = 'Format of the Annual Report and Generic Information';break;
            case 'section2':$data['sectiontitle'] = 'Directors Report (Review of the Business) ~ Best Practice Disclosures';break;
            case 'section3':$data['sectiontitle'] = 'Directors Report ~ Best Practice Disclosures';break;
            case 'section4':$data['sectiontitle'] = 'Statement of Comprehensive Income (SCI) and Related Notes';break;
            case 'section5':$data['sectiontitle'] = 'Statement of Changes in Equity';break;
            case 'section6':$data['sectiontitle'] = 'Statement of Financial Position and Related Notes';break;
            case 'section7':$data['sectiontitle'] = 'Statement of Cash Flows';break;
            case 'section8':$data['sectiontitle'] = 'Accounting Policies and Estimation Techniques';break;
            case 'section9':$data['sectiontitle'] = 'Notes and Other Disclosures';break;
        }
        $data['title']   = $code. ' - Chapter 3 Management';
        $data['header']  = $head;
        $data['section'] = $sheet;
        $data['c3tID']   = $c3tID;
        $data['code']    = $code;
        if($sheet == "checklist"){
            $rdata        = $this->c3model->getab4checklist($sheet,$code,$dc3tID);
            $data['sec']  = json_decode($rdata['question'], true);
            echo view('includes/Header', $data);
            echo view('chapter3/315Ab4_checklist', $data);
            echo view('includes/Footer');
        }else{
            $data['sec'] = $this->c3model->getab4($sheet,$code,$dc3tID);
            echo view('includes/Header', $data);
            echo view('chapter3/315Ab4_section', $data);
            echo view('includes/Footer');
        }

    }

    /**
        * @method saveab4() used to save data of ab4 file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveab4($code,$head,$c3tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }
        $req = [
            'reference'  => $this->request->getPost('reference'),
            'num'        => $this->request->getPost('num'),
            'question'   => $this->request->getPost('question'),
            'yesno'      => $this->request->getPost('yesno'),
            'comment'    => $this->request->getPost('comment'),
            'code'       => $code,
            'part'       => $this->request->getPost('part'),
            'c3tID'      => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveab4($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manageab4/'.$this->request->getPost('part').'/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manageab4/'.$this->request->getPost('part').'/'.$code.'/'.$head.'/'.$c3tID));
        }

    }

    /**
        * @method saveab4checklist() used to save data of ab4 file
        * @var array-chlst consist the ab4 file information and converted into json data
        * @var array-req consist the ab4 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveab4checklist($code,$head,$c3tID){

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
            'code'      => $code,
            'part'      => $this->request->getPost('part'),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveab4checklist($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manageab4/'.$this->request->getPost('part').'/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manageab4/'.$this->request->getPost('part').'/'.$code.'/'.$head.'/'.$c3tID));
        }

    }

    /**
        ----------------------------------------------------------
        AB4a FUNCTIONS
        ----------------------------------------------------------
        * @method saveab4a() used to save data of ab4a file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the ab4a file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveab4a($code,$head,$c3tID){

        $validationRules = [
            'question'   => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }
        $req = [
            'reference'     => $this->request->getPost('reference'),
            'num'           => $this->request->getPost('num'),
            'question'      => $this->request->getPost('question'),
            'yesno'         => $this->request->getPost('yesno'),
            'comment'       => $this->request->getPost('comment'),
            'code'          => $code,
            'part'          => $this->request->getPost('part'),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
        ];
        $res = $this->c3model->saveab4a($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

    }


}