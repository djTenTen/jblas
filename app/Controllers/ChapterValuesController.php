<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\ChapterValuesModel;

class ChapterValuesController extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL //
        THIS FILE IS USED FOR SUBMITTION OF DATA TO THE DATABASE
        Properties being used on this file
        * @property cvmodel to include the file chapter values model
        * @property crypt to load the encryption file
    */
    protected $cvmodel;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->cvmodel = new ChapterValuesModel();
        $this->crypt   = \Config\Services::encrypter();

    }


    /**
        ALL FUNCTIONS UNDER CHAPTER 1 USES THIS PARAMETERS
        * @param code consist the code of the file name
        * @param c1tID consist the encrypted data of title id from the title file name
        * @param cID consist the encrypted data of client id
        * @param name consist the name of the client 
        ----------------------------------------------------------
        CHAPTER 1
        AC1 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac1() used to save the data of ac1 file
        * @var array-req consist the ac1 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac1($code,$c1tID,$cID,$name){

        $req = [
            'acid'      => $this->request->getPost('acid'),
            'yesno'     => $this->request->getPost('yesno'),
            'comment'   => $this->request->getPost('comment'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->cvmodel->saveac1($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveac1eqr() used to save the data of ac1 file
        * @var array-eqr consist the ac1 eqr file information
        * @var array-req consist the ac1 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac1eqr($code,$c1tID,$cID,$name){

        $eqr = [
            'eqr'       => $this->request->getPost('eqr'),
            'eqr1'      => $this->request->getPost('eqr1'),
            'eqr2'      => $this->request->getPost('eqr2'),
            'eqrr'      => $this->request->getPost('eqrr'),
            'hcc'       => $this->request->getPost('hcc'),
            'iio'       => $this->request->getPost('iio'),
        ];
        $req = [
            'question'  => json_encode($eqr),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->cvmodel->saveac1eqr($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AC2 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac2() used to save the data of ac2 file
        * @var array-req consist the ac2 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac2($code,$c1tID,$cID,$name){

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
        $res = $this->cvmodel->saveac2($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveac2aep() used to save the data of ac2 file
        * @var array-req consist the ac2 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac2aep($code,$c1tID,$cID,$name){

        $req = [
            'eap'       => $this->request->getPost('eap'),
            'concl' => $this->request->getPost('concl'),
            'concl'     => $this->request->getPost('concl'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->cvmodel->saveac2aep($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AC3 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac3() used to save the data of ac3 file
        * @var array-req consist the ac3 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac3($code,$c1tID,$cID,$name){

        $req = [
            'yesno'         => $this->request->getPost('yesno'),
            'comment'       => $this->request->getPost('comment'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->cvmodel->saveac3($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AC4 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac4ppr() used to save the data of ac4 file
        * @var array-ppr consist the ac4 file information and converted into json data
        * @var array-req consist the ac3 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac4ppr($code,$c1tID,$cID,$name){

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
        $res = $this->cvmodel->saveac4ppr($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveac4() used to save the data of ac4 file
        * @var array-req consist the ac4 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac4($code,$c1tID,$cID,$name){

        $req = [
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->cvmodel->saveac4($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AC5 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac5() used to save the data of ac5 file
        * @var array-rc consist the ac5 file information and converted into json data
        * @var array-req consist the ac5 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac5($code,$c1tID,$cID,$name){

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
        $res = $this->cvmodel->saveac5($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AC6 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac6ra() used to save the data of ac6 file
        * @var array-req consist the ac6 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac6ra($code,$c1tID,$cID,$name){

        $req = [
            'planning'          => $this->request->getPost('planning'),
            'finalization'      => $this->request->getPost('finalization'),
            'reference'         => $this->request->getPost('reference'),
            'acid'              => $this->request->getPost('acid'),
            'cID'               => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'             => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'               => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->cvmodel->saveac6ra($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveac6s12() used to save the data of ac6 file
        * @var array-s consist the ac6 file information and converted into json data
        * @var array-req consist the ac6 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac6s12($code,$c1tID,$cID,$name){

        $s = [
            's1'        => $this->request->getPost('s1'),
            's2a'       => $this->request->getPost('s2a'),
            's2b'       => $this->request->getPost('s2b')
        ];
        $req = [
            'section'       => json_encode($s),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
        ];
        $res = $this->cvmodel->saveac6s12($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveac6s3() used to save the data of ac6 file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the ac6 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac6s3($code,$c1tID,$cID,$name){

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
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
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
            'c1tID'                     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'                       => $this->crypt->decrypt(session()->get('userID')),
            'fID'                       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveac6s3($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AC7 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac7() used to save the data of ac7 file
        * @var array-genyn consist the ac7 file information and converted into json data
        * @var array-req consist the ac6 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac7($code,$c1tID,$cID,$name){

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
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveac7($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AC8 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac8() used to save the data of ac8 file
        * @var array-req consist the ac8 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac8($code,$c1tID,$cID,$name){

        $req = [
            'question'      => $this->request->getPost('question'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveac8($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AC9 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac9() used to save the data of ac9 file
        * @var array-ac9 consist the ac9 file information and converted into json data
        * @var array-req consist the ac9 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac9($code,$c1tID,$cID,$name){

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
            'frfayn'    => $this->request->getPost('frfayn'),
            'orr'       => $this->request->getPost('orr'),
            'orryn'     => $this->request->getPost('orryn'),
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
        $res = $this->cvmodel->saveac9($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AC10 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac10summ() used to save the data of ac10 file
        * @param sheet contains sheet name like tangible,bank and cash and other part of AC10
        * @var array-tgb consist the ac10 tangible file information and converted into json data
        * @var array-ppe consist the ac10 property file information and converted into json data
        * @var array-invmt consist the ac10 invesment file information and converted into json data
        * @var array-invtr consist the ac10 inventory file information and converted into json data
        * @var array-tr consist the ac10 trade receivables file information and converted into json data
        * @var array-or consist the ac10 other receivables file information and converted into json data
        * @var array-bac consist the ac10 bank and cash file information and converted into json data
        * @var array-tp consist the ac10 trade payables file information and converted into json data
        * @var array-op consist the ac10 other payables file information and converted into json data
        * @var array-prov consist the ac10 provisions file information and converted into json data
        * @var array-rev consist the ac10 revenue file information and converted into json data
        * @var array-cst consist the ac10 cost file information and converted into json data
        * @var array-pr consist the ac10 payroll file information and converted into json data
        * @var array-req consist the ac9 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac10summ($code,$sheet,$c1tID,$cID,$name){

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
            'invtr_rpac10'      => $this->request->getPost('invtr_rpac10'),
            'invtr_i'           => $this->request->getPost('invtr_i'),
            'invtr_p'           => $this->request->getPost('invtr_p'),
            'invtr_pcnt'        => $this->request->getPost('invtr_pcnt'),
            'invtr_s'           => $this->request->getPost('invtr_s'),
            'invtr_t'           => $this->request->getPost('invtr_t'),
            'invtr_ctrf'        => $this->request->getPost('invtr_ctrf'),
            'invtr_arf'         => $this->request->getPost('invtr_arf'),
            'invtr_rf'          => $this->request->getPost('invtr_rf'),
            'invtr_vop'         => $this->request->getPost('invtr_vop'),
            'invtr_secref'      => $this->request->getPost('invtr_secref'),
            'invtr_rss'         => $this->request->getPost('invtr_rss'),
            'invtr_mki'         => $this->request->getPost('invtr_mki'),
            'invtr_ant'         => $this->request->getPost('invtr_ant'),
            'invtr_tss'         => $this->request->getPost('invtr_tss')
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
            'c1tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveac10summ($req,$ref);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$name));
        }
        
    }


    /**
        * @method saveac10s1() used to save the data of ac10 file
        * @param sheet contains sheet name like tangible,bank and cash and other part of AC10
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the ac10 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac10s1($code,$sheet,$c1tID,$cID,$name){

        $validationRules = [
            'namedesc' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$name));
        }
        $req = [
            'less'      => $this->request->getPost('less'),
            'name'      => $this->request->getPost('namedesc'),
            'balance'   => $this->request->getPost('balance'),
            'type'      => $sheet,
            'code'      => $code,
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveac10s1($req);
        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveac10cu() used to save the data of ac10 file
        * @param sheet contains sheet name like tangible,bank and cash and other part of AC10
        * @var array-req consist the ac10 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac10cu($code,$sheet,$c1tID,$cID,$name){

        $req = [
            'question'      => $this->request->getPost('question'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveac10cu($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveac10cu() used to save the data of ac10 file
        * @var validationRules set to validate the data before saving to database
        * @param sheet contains sheet name like tangible,bank and cash and other part of AC10
        * @var array-req consist the ac10 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac10s2($code,$sheet,$c1tID,$cID,$name){

        $validationRules = [
            'namedesc'      => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$name));
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
        $res = $this->cvmodel->saveac10s2($req);
        if($res){
            session()->setFlashdata('success_registration','success_registration');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_registration','failed_registration');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'-'.$sheet.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AC11 FUNCTIONS
        ----------------------------------------------------------
        * @method saveac11() used to save the data of ac11 file
        * @var array-ac11 consist the ac11 file information and converted into json data
        * @var array-req consist the ac11 file information
        * @var res a return response from the chapter 1 model
        * @return redirect-to-page
    */
    public function saveac11($code,$c1tID,$cID,$name){

        $ac11 = [
            'datem'         => $this->request->getPost('datem'),
            'ape1'          => $this->request->getPost('ape1'),
            'ape2'          => $this->request->getPost('ape2'),
            'ape3'          => $this->request->getPost('ape3'),
            'ieqr1'         => $this->request->getPost('ieqr1'),
            'ieqr2'         => $this->request->getPost('ieqr2'),
            'ieqr3'         => $this->request->getPost('ieqr3'),
            'mngr1'         => $this->request->getPost('mngr1'),
            'mngr2'         => $this->request->getPost('mngr2'),
            'mngr3'         => $this->request->getPost('mngr3'),
            'sup1'          => $this->request->getPost('sup1'),
            'sup2'          => $this->request->getPost('sup2'),
            'sup3'          => $this->request->getPost('sup3'),
            'sr1'           => $this->request->getPost('sr1'),
            'sr2'           => $this->request->getPost('sr2'),
            'sr3'           => $this->request->getPost('sr3'),
            'jra1'          => $this->request->getPost('jra1'),
            'jra2'          => $this->request->getPost('jra2'),
            'jra3'          => $this->request->getPost('jra3'),
            'jrb1'          => $this->request->getPost('jrb1'),
            'jrb2'          => $this->request->getPost('jrb2'),
            'jrb3'          => $this->request->getPost('jrb3'),
            'dcfrrt1'       => $this->request->getPost('dcfrrt1'),
            'dcfrrt2'       => $this->request->getPost('dcfrrt2'),
            'dcfrrt3'       => $this->request->getPost('dcfrrt3'),
            'dcfrrt4'       => $this->request->getPost('dcfrrt4'),
            'dcfrrt5'       => $this->request->getPost('dcfrrt5'),
            'dcfrrt6'       => $this->request->getPost('dcfrrt6'),
            'dcfrrt7'       => $this->request->getPost('dcfrrt7'),
            'dcfrrt8'       => $this->request->getPost('dcfrrt8'),
            'dcfrrt9'       => $this->request->getPost('dcfrrt9'),
            'sacb1'         => $this->request->getPost('sacb1'),
            'sacb2'         => $this->request->getPost('sacb2'),
            'sacb3'         => $this->request->getPost('sacb3'),
            'sacb4'         => $this->request->getPost('sacb4'),
            'sacb5'         => $this->request->getPost('sacb5'),
            'sacb6'         => $this->request->getPost('sacb6'),
            'sacb7'         => $this->request->getPost('sacb7'),
            'sacb8'         => $this->request->getPost('sacb8'),
            'sacb9'         => $this->request->getPost('sacb9'),
        ];
        $req = [
            'ac11'      => json_encode($ac11),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c1tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveac11($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$c1tID.'/'.$cID.'/'.$name));
        }

    }



    /**
        SINCE THE CHAPTER 2 HAS ALMOST SAME FORMAT OF FILE, AND IT USES @method savequestions() 
        TO SAVE ALL QUESTIONS AND VALUES
        * @param code consist the code of the file name
        * @param head consist the name of the file
        * @param c2tID consist the encrypted data of title id from the title file name
        ----------------------------------------------------------
        CHAPTER 2
        AA1 FUNCTIONS
        ----------------------------------------------------------
        * @method savequestions() used to save the data of Chapter 2 file
        * @var array-req consist the Chapter 2 file information
        * @var res a return response from the chapter 2 model
        * @return redirect-to-page
    */
    public function savequestions($code,$c2tID,$cID,$name){

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
        $res = $this->cvmodel->savequestions($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveaicpppa() used to save the data of Chapter 2 file
        * @var array-req consist the Chapter 2 file information
        * @var res a return response from the chapter 2 model
        * @return redirect-to-page
    */
    public function saveaicpppa($code,$c2tID,$cID,$name){

        $req = [
            'comment'       => $this->request->getPost('comment'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaicpppa($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method savercicp() used to save the data of Chapter 2 file
        * @var array-req consist the Chapter 2 file information
        * @var res a return response from the chapter 2 model
        * @return redirect-to-page
    */
    public function savercicp($code,$c2tID,$cID,$name){

        $req = [
            'extent'    => $this->request->getPost('yesno'),
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c1tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c2tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->savercicp($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter2/setvalues/'.$code.'/'.$c2tID.'/'.$cID.'/'.$name));
        }

    }
    


    /**
         ALL FUNCTIONS UNDER CHAPTER 3 USES THIS PARAMETERS
        * @param code consist the code of the file name
        * @param head consist the name of the file
        * @param c3tID consist the encrypted data of title id from the title file name
        ----------------------------------------------------------
        CHAPTER 3
        AA1 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa1plaf() used to save the data of aa1 file
        * @var array-req consist the aa1 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveplaf($code,$c3tID,$cID,$name){

        $req = [
            'extent'        => $this->request->getPost('extent'),
            'reference'     => $this->request->getPost('reference'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveplaf($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveaa1s3() used to save the data of aa1 file
        * @var array-sec consist the aa1 file information and converted into json data
        * @var array-req consist the aa1 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa1s3($code,$c3tID,$cID,$name){

        $sec = [
            'a1' => $this->request->getPost('a1'),
            'a2' => $this->request->getPost('a2'),
            'a3' => $this->request->getPost('a3'),
            'a4' => $this->request->getPost('a4'),
            'a5' => $this->request->getPost('a5'),
            'a6' => $this->request->getPost('a6'),
            'a7' => $this->request->getPost('a7'),
            'a8' => $this->request->getPost('a8'),
            'a9' => $this->request->getPost('a9'),
            'a10' => $this->request->getPost('a10'),
            'a10d' => $this->request->getPost('a10d'),
            'a11' => $this->request->getPost('a11'),
            'a11d' => $this->request->getPost('a11d'),
            'a12' => $this->request->getPost('a12'),
            'a13' => $this->request->getPost('a13'),
            'a14' => $this->request->getPost('a14'),
            'a14d' => $this->request->getPost('a14d'),
            'a15' => $this->request->getPost('a15'),
            'a16' => $this->request->getPost('a16'),
            'a17' => $this->request->getPost('a17'),
            'a18' => $this->request->getPost('a18'),
            'a19' => $this->request->getPost('a19'),
            'a20' => $this->request->getPost('a20'),
            'a21' => $this->request->getPost('a21'),
            'a22' => $this->request->getPost('a22'),
            'a23' => $this->request->getPost('a23'),
            'a24' => $this->request->getPost('a24'),
        ];
        $req = [
            'question'  => json_encode($sec),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa1s3($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saverceap() used to save the data of aa1 file
        * @var array-sec consist the aa1 file information and converted into json data
        * @var array-req consist the aa1 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saverceap($code,$c3tID,$cID,$name){

        $rc = [
            'awp1' => $this->request->getPost('awp1'),
            'awp2' => $this->request->getPost('awp2'),
            'awp3' => $this->request->getPost('awp3'),
            'awp4' => $this->request->getPost('awp4'),
            'awp5' => $this->request->getPost('awp5'),
            'awp6' => $this->request->getPost('awp6'),
            'awp7' => $this->request->getPost('awp7'),
            'rceap1' => $this->request->getPost('rceap1'),
            'rceap2' => $this->request->getPost('rceap2'),
            'rceap3' => $this->request->getPost('rceap3'),
            'rceap4' => $this->request->getPost('rceap4'),
            'rceap5' => $this->request->getPost('rceap5'),
            'rceap6' => $this->request->getPost('rceap6'),
            'rceap7' => $this->request->getPost('rceap7'),
            'rceap8' => $this->request->getPost('rceap8'),
            'rceap9' => $this->request->getPost('rceap9'),
            'rceap10' => $this->request->getPost('rceap10'),
            'details' => $this->request->getPost('details'),
            'datereq' => $this->request->getPost('datereq'),
            'numcop' => $this->request->getPost('numcop'),
        ];
        $req = [
            'question'  => json_encode($rc),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saverceap($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
             return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
             return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
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
    public function saveaa2($code,$c3tID,$cID,$name){

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
        $res = $this->cvmodel->saveaa2($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AA3a FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa3a() used to save the data of aa3a file
        * @var array-req consist the aa3a file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa3a($code,$c3tID,$cID,$name){

        $req = [
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa3a($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveaa3afaf() used to save the data of aa3a file
        * @var array-req consist the aa3a file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa3afaf($code,$c3tID,$cID,$name){

        $req = [
            'extent'        => $this->request->getPost('extent'),
            'reference'     => $this->request->getPost('reference'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa3afaf($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveaa3afaf() used to save the data of aa3a file
        * @var array-req consist the aa3a file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa3air($code,$c3tID,$cID,$name){

        $air = [
            'sia'       => $this->request->getPost('sia'),
            'seh'       => $this->request->getPost('seh'),
            'ir'        => $this->request->getPost('ir'),
            'tird'      => $this->request->getPost('tird'),
            'tfrd'      => $this->request->getPost('tfrd'),
        ];
        $req = [
            'air'       => json_encode($air),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa3air($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AA3b FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa3b() used to save the data of aa3b file
        * @var array-req consist the aa3b file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa3b($code,$c3tID,$cID,$name){

        $req = [
            'reference'     => $this->request->getPost('reference'),
            'acid'          => $this->request->getPost('acid'),
            'cID'           => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa3b($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveaa3bp4() used to save the data of aa3b file
        * @var array-p4 consist the aa3b file information and converted into json data
        * @var array-req consist the aa3b file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa3bp4($code,$c3tID,$cID,$name){

        $p4 = [
            'p41'   => $this->request->getPost('p41'),
            'p42'   => $this->request->getPost('p42'),
            'bwr1'   => $this->request->getPost('bwr1'),
            'bwr2'   => $this->request->getPost('bwr2'),
            'bwr2d'   => $this->request->getPost('bwr2d'),
            'bwr3'   => $this->request->getPost('bwr3'),
            'bwr3d'   => $this->request->getPost('bwr3d'),
            'bwr4'   => $this->request->getPost('bwr4'),
            'bwr4d'   => $this->request->getPost('bwr4d'),
            'bwr5'   => $this->request->getPost('bwr5'),
            'bwr5d'   => $this->request->getPost('bwr5d'),
        ];
        $req = [
            'p4'        => json_encode($p4),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa3bp4($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AA4 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa4() used to save the data of aa4 file
        * @var validationRules set to validate the data before saving to database
        * @var array-req consist the aa5b file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa4($code,$c3tID,$cID,$name){

        $aa4 = [
            'leg1' => $this->request->getPost('leg1'),
            'leg2' => $this->request->getPost('leg2'),
            'isa' => $this->request->getPost('isa'),
            'leg3' => $this->request->getPost('leg3'),
            'num7' => $this->request->getPost('num7'),
            'num10yes' => $this->request->getPost('num10yes'),
            'num11yes' => $this->request->getPost('num11yes'),
            'num11' => $this->request->getPost('num11'),
            'num12yes' => $this->request->getPost('num12yes'),
            'num12' => $this->request->getPost('num12'),
            'num15' => $this->request->getPost('num15'),
            'num16' => $this->request->getPost('num16'),
            'num17' => $this->request->getPost('num17'),
            'imp' => $this->request->getPost('imp'),
            'num22yes1' => $this->request->getPost('num22yes1'),
            'num221' => $this->request->getPost('num221'),
            'num22yes2' => $this->request->getPost('num22yes2'),
            'num222' => $this->request->getPost('num222'),
            'num223' => $this->request->getPost('num223'),
            'num224' => $this->request->getPost('num224'),
            'num23yes1' => $this->request->getPost('num23yes1'),
            'num23d1' => $this->request->getPost('num23d1'),
            'num23d2' => $this->request->getPost('num23d2'),
            'num23yes2' => $this->request->getPost('num23yes2'),
            'num23d' => $this->request->getPost('num23d'),
        ];

        $req = [
            'aa4'       => json_encode($aa4),
            'code'      => $code,
            'part'      => 'aa4',
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'                   => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa4($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
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
    public function saveaa5b($code,$c3tID,$cID,$name){

        $validationRules = [
            'reference' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }
        $req = [
            'reference'             => $this->request->getPost('reference'),
            'issue'                 => $this->request->getPost('issue'),
            'comment'               => $this->request->getPost('comment'),
            'recommendation'        => $this->request->getPost('recommendation'),
            'yesno'                 => $this->request->getPost('yesno'),
            'result'                => $this->request->getPost('result'),
            'code'                  => $code,
            'part'                  => $this->request->getPost('part'),
            'cID'                   => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'                 => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'                   => $this->crypt->decrypt(session()->get('userID')),
            'fID'                   => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa5b($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
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
    public function saveaa7isa($code,$c3tID,$cID,$name){

        $validationRules = [
            'reference' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
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
            'c3tID'             => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'               => $this->crypt->decrypt(session()->get('userID')),
            'fID'               => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa7isa($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }
    

    /**
        * @method saveaa7aepapp() used to save the data of aa7 file
        * @var array-req consist the aa7 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa7aepapp($code,$c3tID,$cID,$name){
        
        $req = [
            'aep'       => $this->request->getPost('question'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa7aepapp($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveaa7aep() used to save the data of aa7 file
        * @var array-aep consist the aa7 file information and converted into json data
        * @var array-req consist the aa7 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa7aep($code,$c3tID,$cID,$name){

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
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa7aep($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
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
    public function saveaa10($code,$c3tID,$cID,$name){

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
        $res = $this->cvmodel->saveaa10($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AA11 FUNCTIONS
        ----------------------------------------------------------
        * @method saveaa11un() used to save the data of aa11 file
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa11un($code,$c3tID,$cID,$name){

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
            'c3tID'         => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'           => $this->crypt->decrypt(session()->get('userID')),
            'fID'           => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa11un($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveaa11ad() used to save the data of aa11 file
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa11ad($code,$c3tID,$cID,$name){

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
        $res = $this->cvmodel->saveaa11ad($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'-ad/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'-ad/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }
    

    /**
        * @method saveaa11ad() used to save the data of aa11 file
        * @var array-aa11 consist the aa11 file information and converted into json data
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa11ue($code,$c3tID,$cID,$name){

        $aa11 = [
            'cta'   => $this->request->getPost('cta'),
            'fpm'   => $this->request->getPost('fpm'),
            'fma'   => $this->request->getPost('fma')
        ];
        $req = [
            'aa11'      => json_encode($aa11),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveaa11ue($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveaa11con() used to save the data of aa11 file
        * @var array-aa11con consist the aa11 file information and converted into json data
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa11con($code,$c3tID,$cID,$name){

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
        $res = $this->cvmodel->saveaa11con($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'-un/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveaa11uead() used to save the data of aa11 file
        * @var array-aa11 consist the aa11 file information and converted into json data
        * @var array-req consist the aa11 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveaa11uead($code,$c3tID,$cID,$name){

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
        $res = $this->cvmodel->saveaa11ue($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'-ad/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'-ad/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }

    
    public function save311($code,$c3tID,$cID,$name){

        $arf = [
            'uqo'    => $this->request->getPost('uqo'),
            'tops'    => $this->request->getPost('tops'),
            'afsd'   => $this->request->getPost('afsd'),
            'cf'   => $this->request->getPost('cf'),
            'leg1'   => $this->request->getPost('leg1'),
            'leg2'   => $this->request->getPost('leg2'),
            'jurleg'   => $this->request->getPost('jurleg'),
            'leg3'   => $this->request->getPost('leg3'),
            'op1'   => $this->request->getPost('op1'),
            'op2'   => $this->request->getPost('op2'),
        ];
        $req = [
            'arf'  => json_encode($arf),
            'code'  => $code,
            'part'  => '311',
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->save311($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('failed_update','failed_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
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
    public function saveab1($code,$c3tID,$cID,$name){

        $req = [
            'yesno'     => $this->request->getPost('yesno'),
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveab1($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
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
    public function saveab3($code,$c3tID,$cID,$name){

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
        $res = $this->cvmodel->saveab3($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }

    
    /**
        ----------------------------------------------------------
        AB4 FUNCTIONS
        ----------------------------------------------------------
        * @method saveab4checklist() used to save data of ab4 file
        * @var array-req consist the ab4 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveab4($code,$c3tID,$cID,$name){

        $req = [
            'yesno'     => $this->request->getPost('yesno'),
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveab4($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        * @method saveab4checklist() used to save data of ab4 file
        * @var array-chlst consist the ab4 file information and converted into json data
        * @var array-req consist the ab4 file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveab4checklist($code,$c3tID,$cID,$name){

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
        $res = $this->cvmodel->saveab4checklist($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


    /**
        ----------------------------------------------------------
        AB4a,b,c,d,e,f,g,h FUNCTIONS
        ----------------------------------------------------------
        * @method saveab4a() used to save data of ab4a file
        * @var array-req consist the ab4a file information
        * @var res a return response from the chapter 3 model
        * @return redirect-to-page
    */
    public function saveab4a($code,$c3tID,$cID,$name){

        $req = [
            'yesno'     => $this->request->getPost('yesno'),
            'comment'   => $this->request->getPost('comment'),
            'acid'      => $this->request->getPost('acid'),
            'cID'       => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)),
            'c3tID'     => $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$c3tID)),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];
        $res = $this->cvmodel->saveab4a($req);
        if($res){
            session()->setFlashdata('success_update','success_update');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }else{
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$c3tID.'/'.$cID.'/'.$name));
        }

    }


}