<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\Chapter3Model;

class Chapter3Controller extends BaseController{

    protected $c3model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->c3model = new Chapter3Model();
        $this->crypt = \Config\Services::encrypter();

    }
    /**
        ----------------------------------------------------------
        GENERAL FUNCTIONS
        ----------------------------------------------------------
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
        ----------------------------------------------------------
        AA1 FUNCTIONS
        ----------------------------------------------------------
    */
    public function saveaa1plaf($code,$head,$c3tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'extent' => $this->request->getPost('extent'),
            'reference' => $this->request->getPost('reference'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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
            'question' => json_encode($sec),
            'code' => $code,
            'part' => 'section3',
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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
    */
    public function saveaa2($code,$head,$c3tID){

        $aa2 = [
            'rat' => $this->request->getPost('rat'),
            'rcae' => $this->request->getPost('rcae'),
            'atriaq' => $this->request->getPost('atriaq'),
            'kcapet' => $this->request->getPost('kcapet'),
            'fd' => $this->request->getPost('fd'),
            'fs' => $this->request->getPost('fs'),
            'oi' => $this->request->getPost('oi')
        ];

        $req = [
            'aa2' => json_encode($aa2),
            'code' => $code,
            'part' => 'aa2',
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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
    */
    public function saveaa3a($code,$head,$c3tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'comment' => $this->request->getPost('comment'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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

    public function saveaa3afaf($code,$head,$c3tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'extent' => $this->request->getPost('extent'),
            'reference' => $this->request->getPost('reference'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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

    public function saveaa3air($code,$head,$c3tID){

        $req = [
            'ir' => $this->request->getPost('ir'),
            'code' => $code,
            'part' => 'ir',
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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
    */

    public function saveaa3b($code,$head,$c3tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

        $req = [
            'question' => $this->request->getPost('question'),
            'reference' => $this->request->getPost('reference'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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


    public function saveaa3bp4($code,$head,$c3tID){

        $p4 = [
            'p41' => $this->request->getPost('p41'),
            'p42' => $this->request->getPost('p42')
        ];

        $req = [
            'p4' => json_encode($p4),
            'code' => $code,
            'part' => 'p4',
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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
    */
    public function saveaa5b($code,$head,$c3tID){

        $validationRules = [
            'reference' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

        $req = [
            'reference' => $this->request->getPost('reference'),
            'issue' => $this->request->getPost('issue'),
            'comment' => $this->request->getPost('comment'),
            'recommendation' => $this->request->getPost('recommendation'),
            'yesno' => $this->request->getPost('yesno'),
            'result' => $this->request->getPost('result'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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
    */
    public function saveaa7isa($code,$head,$c3tID){

        $validationRules = [
            'reference' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

        $req = [
            'reference' => $this->request->getPost('reference'),
            'issue' => $this->request->getPost('issue'),
            'comment' => $this->request->getPost('comment'),
            'recommendation' => $this->request->getPost('recommendation'),
            'result' => $this->request->getPost('result'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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

    public function saveaa7aep($code,$head,$c3tID){

        $aep = [
            'ch1' => $this->request->getPost('ch1'),
            'ch2' => $this->request->getPost('ch2'),
            'dev1' => $this->request->getPost('dev1'),
            'dev2' => $this->request->getPost('dev2'),
            'fut1' => $this->request->getPost('fut1'),
            'fut2' => $this->request->getPost('fut2'),
            'cst1' => $this->request->getPost('cst1'),
            'cst2' => $this->request->getPost('cst2')
        ];

        $req = [
            'aep' => json_encode($aep),
            'code' => $code,
            'part' => 'aep',
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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
    */
    public function saveaa10($code,$head,$c3tID){

        $aa10 = [
            'sum' => $this->request->getPost('sum'),
            'comp' => $this->request->getPost('comp'),
            'exp' => $this->request->getPost('exp')
        ];

        $req = [
            'aa10' => json_encode($aa10),
            'code' => $code,
            'part' => 'aa10',
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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
    */

    public function viewa11($sheet,$code,$head,$c3tID){

        $dc3tID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID));

        switch ($sheet) {
            case 'un':$data['sectiontitle'] = "SUMMARY OF UNADJUSTED ERRORS";break;
            case 'ad':$data['sectiontitle'] = "SUMMARY OF ADJUSTMENTS MADE TO THE CLIENT'S FINANCIAL STATEMENTS";break;
        }

        $data['title'] = $code. ' - Chapter 3 Management';
        $data['header'] = $head;
        $data['section'] = $sheet;
        $data['c3tID'] = $c3tID;
        $data['code'] = $code;

        
        if($sheet == "un"){

            // $rdata = $this->c3model->getab4checklist($sheet,$code,$dc3tID);
            // $data['sec'] = json_decode($rdata['question'], true);

            $data['aef'] = $this->c3model->getaa11p2('aef',$code,$dc3tID);
            $data['aej'] = $this->c3model->getaa11p2('aej',$code,$dc3tID);
            $data['ee'] = $this->c3model->getaa11p2('ee',$code,$dc3tID);
            $data['de'] = $this->c3model->getaa11p2('de',$code,$dc3tID);
            $rdata = $this->c3model->getaa11p1('aa11ue',$code,$dc3tID);
            $data['ue'] = json_decode($rdata['question'], true);    

            echo view('includes/Header', $data);
            echo view('chapter3/310Aa11_un', $data);
            echo view('includes/Footer');
        }else{

            $data['ad'] = $this->c3model->getaa11p2('ad',$code,$dc3tID);
            $rdata = $this->c3model->getaa11p1('aa11uead',$code,$dc3tID);
            $data['ue'] = json_decode($rdata['question'], true);    
            
            echo view('includes/Header', $data);
            echo view('chapter3/310Aa11_ad', $data);
            echo view('includes/Footer');
        }

    }
    public function saveaa11un($code,$head,$c3tID){

        $req = [
            'reference' => $this->request->getPost('reference'),
            'desc' => $this->request->getPost('desc'),
            'drps' => $this->request->getPost('drps'),
            'crps' => $this->request->getPost('crps'),
            'drfp' => $this->request->getPost('drfp'),
            'crfp' => $this->request->getPost('crfp'),
            'yesno' => $this->request->getPost('yesno'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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

    public function saveaa11ad($code,$head,$c3tID){

        $req = [
            'reference' => $this->request->getPost('reference'),
            'desc' => $this->request->getPost('desc'),
            'drps' => $this->request->getPost('drps'),
            'crps' => $this->request->getPost('crps'),
            'drfp' => $this->request->getPost('drfp'),
            'crfp' => $this->request->getPost('crfp'),
            'code' => $code,
            'part' => 'ad',
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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
    

    public function saveaa11ue($code,$head,$c3tID){

        $aa11 = [
            'cta' => $this->request->getPost('cta'),
            'fpm' => $this->request->getPost('fpm'),
            'fma' => $this->request->getPost('fma')
        ];

        $req = [
            'aa11' => json_encode($aa11),
            'code' => $code,
            'part' => $this->request->getPost('part'),
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

    public function saveaa11uead($code,$head,$c3tID){

        $aa11 = [
            'pl' => $this->request->getPost('pl'),
            'na' => $this->request->getPost('na'),
            'pl2' => $this->request->getPost('pl2')
        ];

        $req = [
            'aa11' => json_encode($aa11),
            'code' => $code,
            'part' => $this->request->getPost('part'),
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
    */
    public function saveab1($code,$head,$c3tID){

        $req = [
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment'),
            'code' => $code,
            'part' => 'ab1',
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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
    */
    public function saveab3($code,$head,$c3tID){

        $ab3 = [
            'aby1' => $this->request->getPost('aby1'),
            'aby2' => $this->request->getPost('aby2'),
            'aby3' => $this->request->getPost('aby3'),
            'aby4' => $this->request->getPost('aby4'),
            'frs1' => $this->request->getPost('frs1'),
            'ed1' => $this->request->getPost('ed1'),
            'frs2' => $this->request->getPost('frs2'),
            'ed2' => $this->request->getPost('ed2'),
            'frs3' => $this->request->getPost('frs3'),
            'ed3' => $this->request->getPost('ed3'),
            'frs4' => $this->request->getPost('frs4'),
            'ed4' => $this->request->getPost('ed4'),
            'frs5' => $this->request->getPost('frs5'),
            'ed5' => $this->request->getPost('ed5')
        ];

        $req = [
            'question' => json_encode($ab3),
            'code' => $code,
            'part' => 'ab3',
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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
        $data['title'] = $code. ' - Chapter 3 Management';
        $data['header'] = $head;
        $data['section'] = $sheet;
        $data['c3tID'] = $c3tID;
        $data['code'] = $code;

        
        if($sheet == "checklist"){

            $rdata = $this->c3model->getab4checklist($sheet,$code,$dc3tID);
            $data['sec'] = json_decode($rdata['question'], true);

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

    public function saveab4($code,$head,$c3tID){

        $validationRules = [
            'question' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/c3/manage/'.$code.'/'.$head.'/'.$c3tID));
        }

        $req = [
            'reference' => $this->request->getPost('reference'),
            'num' => $this->request->getPost('num'),
            'question' => $this->request->getPost('question'),
            'yesno' => $this->request->getPost('yesno'),
            'comment' => $this->request->getPost('comment'),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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

    public function saveab4checklist($code,$head,$c3tID){

        $chlst = [
            'y1' => $this->request->getPost('y1'),
            'y2' => $this->request->getPost('y2'),
            'y3' => $this->request->getPost('y3'),
            'y4' => $this->request->getPost('y4'),
            'y5' => $this->request->getPost('y5'),
            'y6' => $this->request->getPost('y6'),
            'y7' => $this->request->getPost('y7'),
            'y8' => $this->request->getPost('y8'),
            'y9' => $this->request->getPost('y9'),
            'y10' => $this->request->getPost('y10'),
            'y11' => $this->request->getPost('y11'),
            'y12' => $this->request->getPost('y12'),
            'y13' => $this->request->getPost('y13'),
            'y14' => $this->request->getPost('y14'),
            'y15' => $this->request->getPost('y15'),
            'y16' => $this->request->getPost('y16')
        ];

        $req = [
            'chlst' => json_encode($chlst),
            'code' => $code,
            'part' => $this->request->getPost('part'),
            'c3tID' => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID))
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

    
    

    


    




}