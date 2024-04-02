<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\Chapter1Model;

class Chapter1Controller extends BaseController{

    protected $c1model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->c1model = new Chapter1Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        GENERAL FUNCTIONS
        ----------------------------------------------------------
    */
    public function acin($code,$head,$c1tID,$c1ID){

        $req = [
            'code' => $code,
            'c1ID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1ID))
        ];
        $res = $this->c1model->acin($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }








    /**
        ----------------------------------------------------------
        AC1 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac1($code,$head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->c1model->saveac1($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }

    public function saveac1eqr($code,$head,$c1tID){

        $eqr = [
            'nameap' => $this->request->getPost('nameap'),
            'eqr1' => $this->request->getPost('eqr1'),
            'eqr2' => $this->request->getPost('eqr2'),
            'eqrr' => $this->request->getPost('eqrr')
        ];

        $req = [
            'question' => json_encode($eqr),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->c1model->saveeqr($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }










    /**
        ----------------------------------------------------------
        AC2 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac2($code,$head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'corptax' => $this->request->getPost('corptax'),
            'statutory' => $this->request->getPost('statutory'),
            'accountancy' => $this->request->getPost('accountancy'),
            'other' => $this->request->getPost('other'),
            'totalcu' => $this->request->getPost('totalcu'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->c1model->saveac2($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }
    public function saveac2aep($code,$head,$c1tID){

        $req = [
            'eap' => $this->request->getPost('eap'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->c1model->saveac2aep($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }










    /**
        ----------------------------------------------------------
        AC3 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac3($code,$head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->c1model->saveac3($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }










    /**
        ----------------------------------------------------------
        AC4 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac4ppr($code,$head,$c1tID){

        $ppr = [
            'ppr1' => $this->request->getPost('ppr1'),
            'ppr2' => $this->request->getPost('ppr2')
        ];

        $req = [
            'ppr' => json_encode($ppr),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->c1model->saveac4ppr($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }

    public function saveac4($code,$head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'comment' => $this->request->getPost('comment'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->c1model->saveac4($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }
    








    /**
        ----------------------------------------------------------
        AC5 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac5($code,$head,$c1tID){

        $rc = [
            'res' => $this->request->getPost('res'),
            'con' => $this->request->getPost('con')
        ];

        $req = [
            'rescon' => json_encode($rc),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->c1model->saveac5($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }










    /**
        ----------------------------------------------------------
        AC6 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac6ra($code,$head,$c1tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'planning' => $this->request->getPost('planning'),
            'finalization' => $this->request->getPost('finalization'),
            'reference' => $this->request->getPost('reference'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->c1model->saveac6ra($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }
    public function saveac6s12($code,$head,$c1tID){

        $s = [
            's1' => $this->request->getPost('s1'),
            's2a' => $this->request->getPost('s2a'),
            's2b' => $this->request->getPost('s2b')
        ];

        $req = [
            'section' => json_encode($s),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->c1model->saveac6s12($req);

        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }
    public function saveac6s3($code,$head,$c1tID){

        $validationRules = [
            'financialstatement' => 'required',
            'descriptioncontrol' => 'required',
            'controleffective' => 'required',
            'controlimplemented' => 'required',
            'assesed' => 'required',
            'crosstesting' => 'required',
            'reliancecontrol' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'financialstatement' => $this->request->getPost('financialstatement'),
            'descriptioncontrol' => $this->request->getPost('descriptioncontrol'),
            'controleffective' => $this->request->getPost('controleffective'),
            'controlimplemented' => $this->request->getPost('controlimplemented'),
            'assesed' => $this->request->getPost('assesed'),
            'crosstesting' => $this->request->getPost('crosstesting'),
            'reliancecontrol' => $this->request->getPost('reliancecontrol'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->c1model->saveac6s3($req);

        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }
    









    /**
        ----------------------------------------------------------
        AC7 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac7($code,$head,$c1tID){

        $genyn = [
            'y1' => $this->request->getPost('y1'),
            'y2' => $this->request->getPost('y2'),
            'y3' => $this->request->getPost('y3'),
            'y4' => $this->request->getPost('y4'),
            'y5' => $this->request->getPost('y5'),
            'y6' => $this->request->getPost('y6'),
            'gen' => $this->request->getPost('gen'),
            'e1' => $this->request->getPost('e1'),
            'e2' => $this->request->getPost('e2'),
            'e3' => $this->request->getPost('e3'),
            'ro1' => $this->request->getPost('ro1'),
            'ro2' => $this->request->getPost('ro2'),
            'ro3' => $this->request->getPost('ro3'),
            'c1' => $this->request->getPost('c1'),
            'c2' => $this->request->getPost('c2'),
            'c3' => $this->request->getPost('c3'),
            'va1' => $this->request->getPost('va1'),
            'va2' => $this->request->getPost('va2'),
            'va3' => $this->request->getPost('va3'),
            'pd1' => $this->request->getPost('pd1'),
            'pd2' => $this->request->getPost('pd2'),
            'pd3' => $this->request->getPost('pd3'),
        ];

        $req = [
            'genyn' => json_encode($genyn),
            'part' => $this->request->getPost('part'),
            'code' => $code,
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];

        $res = $this->c1model->saveac7($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }

    }










    /**
        ----------------------------------------------------------
        AC8 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac8($code,$head,$c1tID){

        $req = [
            'question' => $this->request->getPost('question'),
            'acid' => $this->request->getPost('acid')
        ];

        $res = $this->c1model->saveac8($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }


    }










    /**
        ----------------------------------------------------------
        AC9 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveac9($code,$head,$c1tID){

        $ac9 = [
            'coss' => $this->request->getPost('coss'),
            'aop1' => $this->request->getPost('aop1'),
            'aop2' => $this->request->getPost('aop2'),
            'bipa' => $this->request->getPost('bipa'),
            'bibo' => $this->request->getPost('bibo'),
            'sffpa' => $this->request->getPost('sffpa'),
            'sosdd' => $this->request->getPost('sosdd'),
            'klar' => $this->request->getPost('klar'),
            'rpi' => $this->request->getPost('rpi'),
            'soae' => $this->request->getPost('soae'),
            'aa1' => $this->request->getPost('aa1'),
            'aa2' => $this->request->getPost('aa2'),
            'frfa' => $this->request->getPost('frfa'),
            'orr' => $this->request->getPost('orr'),
            'tsr' => $this->request->getPost('tsr'),
            'cppm' => $this->request->getPost('cppm'),
            'ic' => $this->request->getPost('ic'),
            'af' => $this->request->getPost('af'),
            'ccm' => $this->request->getPost('ccm'),
            'agm' => $this->request->getPost('agm'),
            'bcl1' => $this->request->getPost('bcl1'),
            'bcl2' => $this->request->getPost('bcl2'),
            'iic1' => $this->request->getPost('iic1'),
            'iic2' => $this->request->getPost('iic2'),
            'rc1' => $this->request->getPost('rc1'),
            'rc2' => $this->request->getPost('rc2'),
            't2r1' => $this->request->getPost('t2r1'),
            't2r2' => $this->request->getPost('t2r2'),
            'pv1' => $this->request->getPost('pv1'),
            'pv2' => $this->request->getPost('pv2'),
            'vfi1' => $this->request->getPost('vfi1'),
            'vfi2' => $this->request->getPost('vfi2'),
            'av1' => $this->request->getPost('av1'),
            'av2' => $this->request->getPost('av2'),
            'lo1' => $this->request->getPost('lo1'),
            'lo2' => $this->request->getPost('lo2')
        ];

        $req = [
            'ac9' => json_encode($ac9),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        
        $res = $this->c1model->saveac9($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'/'.$head.'/'.$c1tID));
        }


    }


    

    




    




    






































}