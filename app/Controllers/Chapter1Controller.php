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










    /**
        ----------------------------------------------------------
        AC10 FUNCTIONS
        ----------------------------------------------------------
    */
    
    public function saveac10summ($code,$sheet,$head,$c1tID){

        $tgb = [
            'tgb_rpac10' => $this->request->getPost('tgb_rpac10'),
            'tgb_i' => $this->request->getPost('tgb_i'),
            'tgb_p' => $this->request->getPost('tgb_p'),
            'tgb_pcnt' => $this->request->getPost('tgb_pcnt'),
            'tgb_s' => $this->request->getPost('tgb_s'),
            'tgb_t' => $this->request->getPost('tgb_t'),
            'tgb_ctrf' => $this->request->getPost('tgb_ctrf'),
            'tgb_arf' => $this->request->getPost('tgb_arf'),
            'tgb_rf' => $this->request->getPost('tgb_rf'),
            'tgb_vop' => $this->request->getPost('tgb_vop'),
            'tgb_secref' => $this->request->getPost('tgb_secref'),
            'tgb_rss' => $this->request->getPost('tgb_rss'),
            'tgb_mki' => $this->request->getPost('tgb_mki'),
            'tgb_ant' => $this->request->getPost('tgb_ant'),
            'tgb_tss' => $this->request->getPost('tgb_tss')
        ];
        $ppe = [
            'ppe_rpac10' => $this->request->getPost('ppe_rpac10'),
            'ppe_i' => $this->request->getPost('ppe_i'),
            'ppe_p' => $this->request->getPost('ppe_p'),
            'ppe_pcnt' => $this->request->getPost('ppe_pcnt'),
            'ppe_s' => $this->request->getPost('ppe_s'),
            'ppe_t' => $this->request->getPost('ppe_t'),
            'ppe_ctrf' => $this->request->getPost('ppe_ctrf'),
            'ppe_arf' => $this->request->getPost('ppe_arf'),
            'ppe_rf' => $this->request->getPost('ppe_rf'),
            'ppe_vop' => $this->request->getPost('ppe_vop'),
            'ppe_secref' => $this->request->getPost('ppe_secref'),
            'ppe_rss' => $this->request->getPost('ppe_rss'),
            'ppe_mki' => $this->request->getPost('ppe_mki'),
            'ppe_ant' => $this->request->getPost('ppe_ant'),
            'ppe_tss' => $this->request->getPost('ppe_tss')
        ];
        $invmt = [
            'invmt_rpac10' => $this->request->getPost('invmt_rpac10'),
            'invmt_i' => $this->request->getPost('invmt_i'),
            'invmt_p' => $this->request->getPost('invmt_p'),
            'invmt_pcnt' => $this->request->getPost('invmt_pcnt'),
            'invmt_s' => $this->request->getPost('invmt_s'),
            'invmt_t' => $this->request->getPost('invmt_t'),
            'invmt_ctrf' => $this->request->getPost('invmt_ctrf'),
            'invmt_arf' => $this->request->getPost('invmt_arf'),
            'invmt_rf' => $this->request->getPost('invmt_rf'),
            'invmt_vop' => $this->request->getPost('invmt_vop'),
            'invmt_secref' => $this->request->getPost('invmt_secref'),
            'invmt_rss' => $this->request->getPost('invmt_rss'),
            'invmt_mki' => $this->request->getPost('invmt_mki'),
            'invmt_ant' => $this->request->getPost('invmt_ant'),
            'invmt_tss' => $this->request->getPost('invmt_tss')
        ];
        $invtr = [
            'invtr_rpac10' => $this->request->getPost('invtr_rpac10'),
            'invtr_i' => $this->request->getPost('invtr_i'),
            'invtr_p' => $this->request->getPost('invtr_p'),
            'invtr_pcnt' => $this->request->getPost('invtr_pcnt'),
            'invtr_s' => $this->request->getPost('invtr_s'),
            'invtr_t' => $this->request->getPost('invtr_t'),
            'invtr_ctrf' => $this->request->getPost('invtr_ctrf'),
            'invtr_arf' => $this->request->getPost('invtr_arf'),
            'invtr_rf' => $this->request->getPost('invtr_rf'),
            'invtr_vop' => $this->request->getPost('invtr_vop'),
            'invtr_secref' => $this->request->getPost('invtr_secref'),
            'invtr_rss' => $this->request->getPost('invtr_rss'),
            'invtr_mki' => $this->request->getPost('invtr_mki'),
            'invtr_ant' => $this->request->getPost('invtr_ant'),
            'invtr_tss' => $this->request->getPost('invtr_tss')
        ];
        $tr = [
            'tr_rpac10' => $this->request->getPost('tr_rpac10'),
            'tr_i' => $this->request->getPost('tr_i'),
            'tr_p' => $this->request->getPost('tr_p'),
            'tr_pcnt' => $this->request->getPost('tr_pcnt'),
            'tr_s' => $this->request->getPost('tr_s'),
            'tr_t' => $this->request->getPost('tr_t'),
            'tr_ctrf' => $this->request->getPost('tr_ctrf'),
            'tr_arf' => $this->request->getPost('tr_arf'),
            'tr_rf' => $this->request->getPost('tr_rf'),
            'tr_vop' => $this->request->getPost('tr_vop'),
            'tr_secref' => $this->request->getPost('tr_secref'),
            'tr_rss' => $this->request->getPost('tr_rss'),
            'tr_mki' => $this->request->getPost('tr_mki'),
            'tr_ant' => $this->request->getPost('tr_ant'),
            'tr_tss' => $this->request->getPost('tr_tss')
        ];
        $or = [
            'or_rpac10' => $this->request->getPost('or_rpac10'),
            'or_i' => $this->request->getPost('or_i'),
            'or_p' => $this->request->getPost('or_p'),
            'or_pcnt' => $this->request->getPost('or_pcnt'),
            'or_s' => $this->request->getPost('or_s'),
            'or_t' => $this->request->getPost('or_t'),
            'or_ctrf' => $this->request->getPost('or_ctrf'),
            'or_arf' => $this->request->getPost('or_arf'),
            'or_rf' => $this->request->getPost('or_rf'),
            'or_vop' => $this->request->getPost('or_vop'),
            'or_secref' => $this->request->getPost('or_secref'),
            'or_rss' => $this->request->getPost('or_rss'),
            'or_mki' => $this->request->getPost('or_mki'),
            'or_ant' => $this->request->getPost('or_ant'),
            'or_tss' => $this->request->getPost('or_tss')
        ];
        $bac = [
            'bac_rpac10' => $this->request->getPost('bac_rpac10'),
            'bac_i' => $this->request->getPost('bac_i'),
            'bac_p' => $this->request->getPost('bac_p'),
            'bac_pcnt' => $this->request->getPost('bac_pcnt'),
            'bac_s' => $this->request->getPost('bac_s'),
            'bac_t' => $this->request->getPost('bac_t'),
            'bac_ctrf' => $this->request->getPost('bac_ctrf'),
            'bac_arf' => $this->request->getPost('bac_arf'),
            'bac_rf' => $this->request->getPost('bac_rf'),
            'bac_vop' => $this->request->getPost('bac_vop'),
            'bac_secref' => $this->request->getPost('bac_secref'),
            'bac_rss' => $this->request->getPost('bac_rss'),
            'bac_mki' => $this->request->getPost('bac_mki'),
            'bac_ant' => $this->request->getPost('bac_ant'),
            'bac_tss' => $this->request->getPost('bac_tss')
        ];
        $tp = [
            'tp_rpac10' => $this->request->getPost('tp_rpac10'),
            'tp_i' => $this->request->getPost('tp_i'),
            'tp_p' => $this->request->getPost('tp_p'),
            'tp_pcnt' => $this->request->getPost('tp_pcnt'),
            'tp_s' => $this->request->getPost('tp_s'),
            'tp_t' => $this->request->getPost('tp_t'),
            'tp_ctrf' => $this->request->getPost('tp_ctrf'),
            'tp_arf' => $this->request->getPost('tp_arf'),
            'tp_rf' => $this->request->getPost('tp_rf'),
            'tp_vop' => $this->request->getPost('tp_vop'),
            'tp_secref' => $this->request->getPost('tp_secref'),
            'tp_rss' => $this->request->getPost('tp_rss'),
            'tp_mki' => $this->request->getPost('tp_mki'),
            'tp_ant' => $this->request->getPost('tp_ant'),
            'tp_tss' => $this->request->getPost('tp_tss')
        ];
        $op = [
            'op_rpac10' => $this->request->getPost('op_rpac10'),
            'op_i' => $this->request->getPost('op_i'),
            'op_p' => $this->request->getPost('op_p'),
            'op_pcnt' => $this->request->getPost('op_pcnt'),
            'op_s' => $this->request->getPost('op_s'),
            'op_t' => $this->request->getPost('op_t'),
            'op_ctrf' => $this->request->getPost('op_ctrf'),
            'op_arf' => $this->request->getPost('op_arf'),
            'op_rf' => $this->request->getPost('op_rf'),
            'op_vop' => $this->request->getPost('op_vop'),
            'op_secref' => $this->request->getPost('op_secref'),
            'op_rss' => $this->request->getPost('op_rss'),
            'op_mki' => $this->request->getPost('op_mki'),
            'op_ant' => $this->request->getPost('op_ant'),
            'op_tss' => $this->request->getPost('op_tss')
        ];
        $prov = [
            'prov_rpac10' => $this->request->getPost('prov_rpac10'),
            'prov_i' => $this->request->getPost('prov_i'),
            'prov_p' => $this->request->getPost('prov_p'),
            'prov_pcnt' => $this->request->getPost('prov_pcnt'),
            'prov_s' => $this->request->getPost('prov_s'),
            'prov_t' => $this->request->getPost('prov_t'),
            'prov_ctrf' => $this->request->getPost('prov_ctrf'),
            'prov_arf' => $this->request->getPost('prov_arf'),
            'prov_rf' => $this->request->getPost('prov_rf'),
            'prov_vop' => $this->request->getPost('prov_vop'),
            'prov_secref' => $this->request->getPost('prov_secref'),
            'prov_rss' => $this->request->getPost('prov_rss'),
            'prov_mki' => $this->request->getPost('prov_mki'),
            'prov_ant' => $this->request->getPost('prov_ant'),
            'prov_tss' => $this->request->getPost('prov_tss')
        ];
        $rev = [
            'rev_rpac10' => $this->request->getPost('rev_rpac10'),
            'rev_i' => $this->request->getPost('rev_i'),
            'rev_p' => $this->request->getPost('rev_p'),
            'rev_pcnt' => $this->request->getPost('rev_pcnt'),
            'rev_s' => $this->request->getPost('rev_s'),
            'rev_t' => $this->request->getPost('rev_t'),
            'rev_ctrf' => $this->request->getPost('rev_ctrf'),
            'rev_arf' => $this->request->getPost('rev_arf'),
            'rev_rf' => $this->request->getPost('rev_rf'),
            'rev_vop' => $this->request->getPost('rev_vop'),
            'rev_secref' => $this->request->getPost('rev_secref'),
            'rev_rss' => $this->request->getPost('rev_rss'),
            'rev_mki' => $this->request->getPost('rev_mki'),
            'rev_ant' => $this->request->getPost('rev_ant'),
            'rev_tss' => $this->request->getPost('rev_tss')
        ];
        $cst = [
            'cst_rpac10' => $this->request->getPost('cst_rpac10'),
            'cst_i' => $this->request->getPost('cst_i'),
            'cst_p' => $this->request->getPost('cst_p'),
            'cst_pcnt' => $this->request->getPost('cst_pcnt'),
            'cst_s' => $this->request->getPost('cst_s'),
            'cst_t' => $this->request->getPost('cst_t'),
            'cst_ctrf' => $this->request->getPost('cst_ctrf'),
            'cst_arf' => $this->request->getPost('cst_arf'),
            'cst_rf' => $this->request->getPost('cst_rf'),
            'cst_vop' => $this->request->getPost('cst_vop'),
            'cst_secref' => $this->request->getPost('cst_secref'),
            'cst_rss' => $this->request->getPost('cst_rss'),
            'cst_mki' => $this->request->getPost('cst_mki'),
            'cst_ant' => $this->request->getPost('cst_ant'),
            'cst_tss' => $this->request->getPost('cst_tss')
        ];
        $pr = [
            'pr_rpac10' => $this->request->getPost('pr_rpac10'),
            'pr_i' => $this->request->getPost('pr_i'),
            'pr_p' => $this->request->getPost('pr_p'),
            'pr_pcnt' => $this->request->getPost('pr_pcnt'),
            'pr_s' => $this->request->getPost('pr_s'),
            'pr_t' => $this->request->getPost('pr_t'),
            'pr_ctrf' => $this->request->getPost('pr_ctrf'),
            'pr_arf' => $this->request->getPost('pr_arf'),
            'pr_rf' => $this->request->getPost('pr_rf'),
            'pr_vop' => $this->request->getPost('pr_vop'),
            'pr_secref' => $this->request->getPost('pr_secref'),
            'pr_rss' => $this->request->getPost('pr_rss'),
            'pr_mki' => $this->request->getPost('pr_mki'),
            'pr_ant' => $this->request->getPost('pr_ant'),
            'pr_tss' => $this->request->getPost('pr_tss')
        ];
         
        $req = [
            'tgb' => json_encode($tgb),
            'ppe' => json_encode($ppe),
            'invmt' => json_encode($invmt),
            'invtr' => json_encode($invtr),
            'tr' => json_encode($tr),
            'or' => json_encode($or),
            'bac' => json_encode($bac),
            'tp' => json_encode($tp),
            'op' => json_encode($op),
            'prov' => json_encode($prov),
            'rev' => json_encode($rev),
            'cst' => json_encode($cst),
            'pr' => json_encode($pr),
        ];
        
        $ref = [
            'materiality' => $this->request->getPost('materiality'),
            'code' => 'AC10',
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        
        $res = $this->c1model->saveac10summ($req,$ref);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'-'.$sheet.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'-'.$sheet.'/'.$head.'/'.$c1tID));
        }
        
    }
    public function saveac10s1($code,$sheet,$head,$c1tID){

        $validationRules = [
            'namedesc' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'-'.$sheet.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'less' => $this->request->getPost('less'),
            'name' => $this->request->getPost('namedesc'),
            'balance' => $this->request->getPost('balance'),
            'type' => $sheet,
            'code' => $code,
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->c1model->saves1ac10($req);
        
        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'-'.$sheet.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'-'.$sheet.'/'.$head.'/'.$c1tID));
        }

    }
    public function saveac10cu($code,$sheet,$head,$c1tID){

        $req = [
            'acid' => $this->request->getPost('acid'),
            'question' => $this->request->getPost('question')
        ];
        $res = $this->c1model->saveac10cu($req);
        
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'-'.$sheet.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'-'.$sheet.'/'.$head.'/'.$c1tID));
        }

    }
    public function saveac10s2($code,$sheet,$head,$c1tID){

        $validationRules = [
            'namedesc' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'-'.$sheet.'/'.$head.'/'.$c1tID));
        }

        $req = [
            'less' => $this->request->getPost('less'),
            'name' => $this->request->getPost('namedesc'),
            'reason' => $this->request->getPost('reason'),
            'balance' => $this->request->getPost('balance'),
            'type' => $sheet,
            'code' => $code,
            'c1tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID))
        ];
        $res = $this->c1model->saveac10s2($req);
        
        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'-'.$sheet.'/'.$head.'/'.$c1tID));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/c1/manage/'.$code.'-'.$sheet.'/'.$head.'/'.$c1tID));
        }

    }

    

    




    




    













    
























}