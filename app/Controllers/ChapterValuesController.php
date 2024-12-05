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

    public function decr($ecr){
        return $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ecr));
    }

    public function encr($ecr){
        return str_ireplace(['/','+'],['~','$'],$this->crypt->encrypt($ecr));
    }


    public function resultpage($c,$res,$code,$mtID,$cID,$name){

        switch ($c) {
            case 'c1':
                if($res){
                    session()->setFlashdata('success','The update on file '.$code.' has been successfully posted');
                }else{
                    session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
                }
                return redirect()->to(site_url('auditsystem/client/chapter1/setvalues/'.$code.'/'.$mtID.'/'.$cID.'/'.$name));
            break;
            case 'c2':
                if($res){
                    session()->setFlashdata('success','The update on file '.$code.' has been successfully posted');
                }else{
                    session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
                }
                return redirect()->to(site_url('auditsystem/client/chapter2/setvalues/'.$code.'/'.$mtID.'/'.$cID.'/'.$name));
            break;
            case 'c3':
                if($res){
                    session()->setFlashdata('success','The update on file '.$code.' has been successfully posted');
                }else{
                    session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
                }
                return redirect()->to(site_url('auditsystem/client/chapter3/setvalues/'.$code.'/'.$mtID.'/'.$cID.'/'.$name));
            break;
        }

    }

    public function savevalues($chapter,$save,$code,$mtID,$cID,$name){

        $param = [
            'chapter'   => $chapter,
            'save'      => $save,
            'code'      => $code,
            'cID'       => $this->decr($cID),
            'mtID'      => $this->decr($mtID),
            'uID'       => $this->crypt->decrypt(session()->get('userID')),
            'fID'       => $this->crypt->decrypt(session()->get('firmID')),
        ];

        switch ($chapter) {
            case 'c1': 
                switch ($code) {
                    case 'AC1':
                        switch ($save) {
                            case 'saveac1':
                                $req = [
                                    'acid'      => $this->request->getPost('acid'),
                                    'yesno'     => $this->request->getPost('yesno'),
                                    'comment'   => $this->request->getPost('comment'),
                                ];
                            break;
                            case 'saveac1eqr':
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
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case 'AC2':
                        switch ($save) {
                            case 'saveac2':
                                $req = [
                                    'corptax'       => $this->request->getPost('corptax'),
                                    'statutory'     => $this->request->getPost('statutory'),
                                    'accountancy'   => $this->request->getPost('accountancy'),
                                    'other'         => $this->request->getPost('other'),
                                    'totalcu'       => $this->request->getPost('totalcu'),
                                    'acid'          => $this->request->getPost('acid'),
                                ];
                            break;
                            case 'saveac2aep':
                                $req = [
                                    'eap'       => $this->request->getPost('eap'),
                                    'concl'     => $this->request->getPost('concl'),
                                    'acid'      => $this->request->getPost('acid'),
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    
                }
            break;
           
            case 'c2':
                switch ($code) {
                    case 'AB4':
                        switch ($save) {
                            case 'saveac3':
                                $req = [
                                    'yesno'         => $this->request->getPost('yesno'),
                                    'comment'       => $this->request->getPost('comment'),
                                    'acid'          => $this->request->getPost('acid'),
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case 'AB4A':
                        switch ($save) {
                            case 'saveab4a':
                                $req = [
                                    'yearto'        => $this->request->getPost('yearto'),
                                    'preparedby'    => $this->request->getPost('preparedby'),
                                    'date1'         => $this->request->getPost('date1'),
                                    'reviewedby'    => $this->request->getPost('reviewedby'),
                                    'date2'         => $this->request->getPost('date2'),
                                    'part'          => $this->request->getPost('part'),
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case 'AC3':
                        switch ($save) {
                            case 'saveac4':
                                $req = [
                                    'comment'   => $this->request->getPost('comment'),
                                    'acid'      => $this->request->getPost('acid'),
                                ];
                            break;
                            case 'saveac4ppr':
                                $ppr = [
                                    'ppr1'      => $this->request->getPost('ppr1'),
                                    'ppr2'      => $this->request->getPost('ppr2')
                                ];
                                $req = [
                                    'ppr'       => json_encode($ppr),
                                    'acid'      => $this->request->getPost('acid'),
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case 'AC4':
                        switch ($save) {
                            case 'saveac5':
                                $rc = [
                                    'res'   => $this->request->getPost('res'),
                                    'con'   => $this->request->getPost('con')
                                ];
                                $req = [
                                    'rescon'    => json_encode($rc),
                                    'acid'      => $this->request->getPost('acid'),
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case 'AC5':
                        switch ($save) {
                            case 'savetdabm':
                                $td = [
                                    'dom'       => $this->request->getPost('dom'),
                                    'aepname'   => $this->request->getPost('aepname'),
                                    'aepca'     => $this->request->getPost('aepca'),
                                    'aepcup'    => $this->request->getPost('aepcup'),
                                    'eqrname'   => $this->request->getPost('eqrname'),
                                    'eqrca'     => $this->request->getPost('eqrca'),
                                    'eqrcup'    => $this->request->getPost('eqrcup'),
                                    'manname'   => $this->request->getPost('manname'),
                                    'manca'     => $this->request->getPost('manca'),
                                    'mancup'    => $this->request->getPost('mancup'),
                                    'supname'   => $this->request->getPost('supname'),
                                    'supca'     => $this->request->getPost('supca'),
                                    'supcup'    => $this->request->getPost('supcup'),
                                    'senname'   => $this->request->getPost('senname'),
                                    'senca'     => $this->request->getPost('senca'),
                                    'sencup'    => $this->request->getPost('sencup'),
                                    'j1name'    => $this->request->getPost('j1name'),
                                    'j1ca'      => $this->request->getPost('j1ca'),
                                    'j1cup'     => $this->request->getPost('j1cup'),
                                    'j2name'    => $this->request->getPost('j2name'),
                                    'j2ca'      => $this->request->getPost('j2ca'),
                                    'j2cup'     => $this->request->getPost('j2cup'),
                                    'dsfr1'     => $this->request->getPost('dsfr1'),
                                    'dsfr2'     => $this->request->getPost('dsfr2'),
                                    'dsfr3'     => $this->request->getPost('dsfr3'),
                                    'dsfr4'     => $this->request->getPost('dsfr4'),
                                    'dsfr5'     => $this->request->getPost('dsfr5'),
                                    'dsfr6'     => $this->request->getPost('dsfr6'),
                                    'dsfr7'     => $this->request->getPost('dsfr7'),
                                    'dsfr8'     => $this->request->getPost('dsfr8'),
                                    'dsfr9'     => $this->request->getPost('dsfr9'),
                                    'sacb1yn1'  => $this->request->getPost('sacb1yn1'),
                                    'sacb1yn2'  => $this->request->getPost('sacb1yn2'),
                                    'sacb1yn3'  => $this->request->getPost('sacb1yn3'),
                                    'sacb1yn4'  => $this->request->getPost('sacb1yn4'),
                                    'sacb2yn'   => $this->request->getPost('sacb2yn'),
                                    'sacb3'     => $this->request->getPost('sacb3'),
                                    'sacb4'     => $this->request->getPost('sacb4'),
                                    'sacb5'     => $this->request->getPost('sacb5'),
                                    'sacb6'     => $this->request->getPost('sacb6'),
                                ];
                                $req = [
                                    'td'        => json_encode($td),
                                    'acid'      => $this->request->getPost('acid'),
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case 'AC6':
                        switch ($save) {
                            case 'saveac8':
                                $req = [
                                    'question'      => $this->request->getPost('question'),
                                    'acid'          => $this->request->getPost('acid'),
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case 'AC7':
                        switch ($save) {
                            case 'saveac6ra':
                                $req = [
                                    'planning'          => $this->request->getPost('planning'),
                                    'finalization'      => $this->request->getPost('finalization'),
                                    'reference'         => $this->request->getPost('reference'),
                                    'acid'              => $this->request->getPost('acid'),
                                ];
                            break;
                            case 'saveac6s12':
                                $s = [
                                    's1'        => $this->request->getPost('s1'),
                                    's2a'       => $this->request->getPost('s2a'),
                                    's2b'       => $this->request->getPost('s2b')
                                ];
                                $req = [
                                    'section'       => json_encode($s),
                                    'acid'          => $this->request->getPost('acid'),
                                ];
                            break;
                            case 'saveac6s3':
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
                                    return $this->resultpage($chapter,false,$code,$mtID,$cID,$name);
                                }
                                $req = [
                                    'financialstatement'        => $this->request->getPost('financialstatement'),
                                    'descriptioncontrol'        => $this->request->getPost('descriptioncontrol'),
                                    'controleffective'          => $this->request->getPost('controleffective'),
                                    'controlimplemented'        => $this->request->getPost('controlimplemented'),
                                    'assesed'                   => $this->request->getPost('assesed'),
                                    'crosstesting'              => $this->request->getPost('crosstesting'),
                                    'reliancecontrol'           => $this->request->getPost('reliancecontrol'),
                                    'part'                      => $this->request->getPost('part'),
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case 'AC8':
                        switch ($save) {
                            case 'saveac7':
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
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    
                    // case 'AC9':
                    //     switch ($save) {
                    //         case 'saveac9':
                    //             $ac9 = [
                    //                 'coss'      => $this->request->getPost('coss'),
                    //                 'aop1'      => $this->request->getPost('aop1'),
                    //                 'aop2'      => $this->request->getPost('aop2'),
                    //                 'bipa'      => $this->request->getPost('bipa'),
                    //                 'bibo'      => $this->request->getPost('bibo'),
                    //                 'sffpa'     => $this->request->getPost('sffpa'),
                    //                 'sosdd'     => $this->request->getPost('sosdd'),
                    //                 'klar'      => $this->request->getPost('klar'),
                    //                 'rpi'       => $this->request->getPost('rpi'),
                    //                 'soae'      => $this->request->getPost('soae'),
                    //                 'aa1'       => $this->request->getPost('aa1'),
                    //                 'aa2'       => $this->request->getPost('aa2'),
                    //                 'frfa'      => $this->request->getPost('frfa'),
                    //                 'frfayn'    => $this->request->getPost('frfayn'),
                    //                 'orr'       => $this->request->getPost('orr'),
                    //                 'orryn'     => $this->request->getPost('orryn'),
                    //                 'tsr'       => $this->request->getPost('tsr'),
                    //                 'cppm'      => $this->request->getPost('cppm'),
                    //                 'ic'        => $this->request->getPost('ic'),
                    //                 'af'        => $this->request->getPost('af'),
                    //                 'ccm'       => $this->request->getPost('ccm'),
                    //                 'agm'       => $this->request->getPost('agm'),
                    //                 'bcl1'      => $this->request->getPost('bcl1'),
                    //                 'bcl2'      => $this->request->getPost('bcl2'),
                    //                 'iic1'      => $this->request->getPost('iic1'),
                    //                 'iic2'      => $this->request->getPost('iic2'),
                    //                 'rc1'       => $this->request->getPost('rc1'),
                    //                 'rc2'       => $this->request->getPost('rc2'),
                    //                 't2r1'      => $this->request->getPost('t2r1'),
                    //                 't2r2'      => $this->request->getPost('t2r2'),
                    //                 'pv1'       => $this->request->getPost('pv1'),
                    //                 'pv2'       => $this->request->getPost('pv2'),
                    //                 'vfi1'      => $this->request->getPost('vfi1'),
                    //                 'vfi2'      => $this->request->getPost('vfi2'),
                    //                 'av1'       => $this->request->getPost('av1'),
                    //                 'av2'       => $this->request->getPost('av2'),
                    //                 'lo1'       => $this->request->getPost('lo1'),
                    //                 'lo2'       => $this->request->getPost('lo2')
                    //             ];
                    //             $req = [
                    //                 'ac9'       => json_encode($ac9),
                    //                 'acid'      => $this->request->getPost('acid'),
                    //                 'mtID'     => $param['mtID'],
                    //             ];
                    //         break;
                    //     }
                    //     $res = $this->cvmodel->savevalues($param,$req);
                    //     return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    // break;
                    // case 'AC10-Tangibles':
                    // case 'AC10-PPE':
                    // case 'AC10-Investments':
                    // case 'AC10-Inventory':
                    // case 'AC10-Trade Receivables':
                    // case 'AC10-Other Receivables':
                    // case 'AC10-Bank and Cash':
                    // case 'AC10-Other Payables':
                    // case 'AC10-Provisions':        
                    // case 'AC10-Revenue':
                    // case 'AC10-Costs':
                    // case 'AC10-Payroll':
                    // case 'AC10-Summary':
                    //     $s = explode('-', $code);
                    //     switch ($save) {
                    //         case 'saveac10summ':
                    //             $tgb = [
                    //                 'tgb_rpac10'    => $this->request->getPost('tgb_rpac10'),
                    //                 'tgb_i'         => $this->request->getPost('tgb_i'),
                    //                 'tgb_p'         => $this->request->getPost('tgb_p'),
                    //                 'tgb_pcnt'      => $this->request->getPost('tgb_pcnt'),
                    //                 'tgb_s'         => $this->request->getPost('tgb_s'),
                    //                 'tgb_t'         => $this->request->getPost('tgb_t'),
                    //                 'tgb_ctrf'      => $this->request->getPost('tgb_ctrf'),
                    //                 'tgb_arf'       => $this->request->getPost('tgb_arf'),
                    //                 'tgb_rf'        => $this->request->getPost('tgb_rf'),
                    //                 'tgb_vop'       => $this->request->getPost('tgb_vop'),
                    //                 'tgb_secref'    => $this->request->getPost('tgb_secref'),
                    //                 'tgb_rss'       => $this->request->getPost('tgb_rss'),
                    //                 'tgb_mki'       => $this->request->getPost('tgb_mki'),
                    //                 'tgb_ant'       => $this->request->getPost('tgb_ant'),
                    //                 'tgb_tss'       => $this->request->getPost('tgb_tss')
                    //             ];
                    //             $ppe = [
                    //                 'ppe_rpac10'    => $this->request->getPost('ppe_rpac10'),
                    //                 'ppe_i'         => $this->request->getPost('ppe_i'),
                    //                 'ppe_p'         => $this->request->getPost('ppe_p'),
                    //                 'ppe_pcnt'      => $this->request->getPost('ppe_pcnt'),
                    //                 'ppe_s'         => $this->request->getPost('ppe_s'),
                    //                 'ppe_t'         => $this->request->getPost('ppe_t'),
                    //                 'ppe_ctrf'      => $this->request->getPost('ppe_ctrf'),
                    //                 'ppe_arf'       => $this->request->getPost('ppe_arf'),
                    //                 'ppe_rf'        => $this->request->getPost('ppe_rf'),
                    //                 'ppe_vop'       => $this->request->getPost('ppe_vop'),
                    //                 'ppe_secref'    => $this->request->getPost('ppe_secref'),
                    //                 'ppe_rss'       => $this->request->getPost('ppe_rss'),
                    //                 'ppe_mki'       => $this->request->getPost('ppe_mki'),
                    //                 'ppe_ant'       => $this->request->getPost('ppe_ant'),
                    //                 'ppe_tss'       => $this->request->getPost('ppe_tss')
                    //             ];
                    //             $invmt = [
                    //                 'invmt_rpac10'  => $this->request->getPost('invmt_rpac10'),
                    //                 'invmt_i'       => $this->request->getPost('invmt_i'),
                    //                 'invmt_p'       => $this->request->getPost('invmt_p'),
                    //                 'invmt_pcnt'    => $this->request->getPost('invmt_pcnt'),
                    //                 'invmt_s'       => $this->request->getPost('invmt_s'),
                    //                 'invmt_t'       => $this->request->getPost('invmt_t'),
                    //                 'invmt_ctrf'    => $this->request->getPost('invmt_ctrf'),
                    //                 'invmt_arf'     => $this->request->getPost('invmt_arf'),
                    //                 'invmt_rf'      => $this->request->getPost('invmt_rf'),
                    //                 'invmt_vop'     => $this->request->getPost('invmt_vop'),
                    //                 'invmt_secref'  => $this->request->getPost('invmt_secref'),
                    //                 'invmt_rss'     => $this->request->getPost('invmt_rss'),
                    //                 'invmt_mki'     => $this->request->getPost('invmt_mki'),
                    //                 'invmt_ant'     => $this->request->getPost('invmt_ant'),
                    //                 'invmt_tss'     => $this->request->getPost('invmt_tss')
                    //             ];
                    //             $invtr = [
                    //                 'invtr_rpac10'      => $this->request->getPost('invtr_rpac10'),
                    //                 'invtr_i'           => $this->request->getPost('invtr_i'),
                    //                 'invtr_p'           => $this->request->getPost('invtr_p'),
                    //                 'invtr_pcnt'        => $this->request->getPost('invtr_pcnt'),
                    //                 'invtr_s'           => $this->request->getPost('invtr_s'),
                    //                 'invtr_t'           => $this->request->getPost('invtr_t'),
                    //                 'invtr_ctrf'        => $this->request->getPost('invtr_ctrf'),
                    //                 'invtr_arf'         => $this->request->getPost('invtr_arf'),
                    //                 'invtr_rf'          => $this->request->getPost('invtr_rf'),
                    //                 'invtr_vop'         => $this->request->getPost('invtr_vop'),
                    //                 'invtr_secref'      => $this->request->getPost('invtr_secref'),
                    //                 'invtr_rss'         => $this->request->getPost('invtr_rss'),
                    //                 'invtr_mki'         => $this->request->getPost('invtr_mki'),
                    //                 'invtr_ant'         => $this->request->getPost('invtr_ant'),
                    //                 'invtr_tss'         => $this->request->getPost('invtr_tss')
                    //             ];
                    //             $tr = [
                    //                 'tr_rpac10'     => $this->request->getPost('tr_rpac10'),
                    //                 'tr_i'          => $this->request->getPost('tr_i'),
                    //                 'tr_p'          => $this->request->getPost('tr_p'),
                    //                 'tr_pcnt'       => $this->request->getPost('tr_pcnt'),
                    //                 'tr_s'          => $this->request->getPost('tr_s'),
                    //                 'tr_t'          => $this->request->getPost('tr_t'),
                    //                 'tr_ctrf'       => $this->request->getPost('tr_ctrf'),
                    //                 'tr_arf'        => $this->request->getPost('tr_arf'),
                    //                 'tr_rf'         => $this->request->getPost('tr_rf'),
                    //                 'tr_vop'        => $this->request->getPost('tr_vop'),
                    //                 'tr_secref'     => $this->request->getPost('tr_secref'),
                    //                 'tr_rss'        => $this->request->getPost('tr_rss'),
                    //                 'tr_mki'        => $this->request->getPost('tr_mki'),
                    //                 'tr_ant'        => $this->request->getPost('tr_ant'),
                    //                 'tr_tss'        => $this->request->getPost('tr_tss')
                    //             ];
                    //             $or = [
                    //                 'or_rpac10'     => $this->request->getPost('or_rpac10'),
                    //                 'or_i'          => $this->request->getPost('or_i'),
                    //                 'or_p'          => $this->request->getPost('or_p'),
                    //                 'or_pcnt'       => $this->request->getPost('or_pcnt'),
                    //                 'or_s'          => $this->request->getPost('or_s'),
                    //                 'or_t'          => $this->request->getPost('or_t'),
                    //                 'or_ctrf'       => $this->request->getPost('or_ctrf'),
                    //                 'or_arf'        => $this->request->getPost('or_arf'),
                    //                 'or_rf'         => $this->request->getPost('or_rf'),
                    //                 'or_vop'        => $this->request->getPost('or_vop'),
                    //                 'or_secref'     => $this->request->getPost('or_secref'),
                    //                 'or_rss'        => $this->request->getPost('or_rss'),
                    //                 'or_mki'        => $this->request->getPost('or_mki'),
                    //                 'or_ant'        => $this->request->getPost('or_ant'),
                    //                 'or_tss'        => $this->request->getPost('or_tss')
                    //             ];
                    //             $bac = [
                    //                 'bac_rpac10'    => $this->request->getPost('bac_rpac10'),
                    //                 'bac_i'         => $this->request->getPost('bac_i'),
                    //                 'bac_p'         => $this->request->getPost('bac_p'),
                    //                 'bac_pcnt'      => $this->request->getPost('bac_pcnt'),
                    //                 'bac_s'         => $this->request->getPost('bac_s'),
                    //                 'bac_t'         => $this->request->getPost('bac_t'),
                    //                 'bac_ctrf'      => $this->request->getPost('bac_ctrf'),
                    //                 'bac_arf'       => $this->request->getPost('bac_arf'),
                    //                 'bac_rf'        => $this->request->getPost('bac_rf'),
                    //                 'bac_vop'       => $this->request->getPost('bac_vop'),
                    //                 'bac_secref'    => $this->request->getPost('bac_secref'),
                    //                 'bac_rss'       => $this->request->getPost('bac_rss'),
                    //                 'bac_mki'       => $this->request->getPost('bac_mki'),
                    //                 'bac_ant'       => $this->request->getPost('bac_ant'),
                    //                 'bac_tss'       => $this->request->getPost('bac_tss')
                    //             ];
                    //             $tp = [
                    //                 'tp_rpac10'     => $this->request->getPost('tp_rpac10'),
                    //                 'tp_i'          => $this->request->getPost('tp_i'),
                    //                 'tp_p'          => $this->request->getPost('tp_p'),
                    //                 'tp_pcnt'       => $this->request->getPost('tp_pcnt'),
                    //                 'tp_s'          => $this->request->getPost('tp_s'),
                    //                 'tp_t'          => $this->request->getPost('tp_t'),
                    //                 'tp_ctrf'       => $this->request->getPost('tp_ctrf'),
                    //                 'tp_arf'        => $this->request->getPost('tp_arf'),
                    //                 'tp_rf'         => $this->request->getPost('tp_rf'),
                    //                 'tp_vop'        => $this->request->getPost('tp_vop'),
                    //                 'tp_secref'     => $this->request->getPost('tp_secref'),
                    //                 'tp_rss'        => $this->request->getPost('tp_rss'),
                    //                 'tp_mki'        => $this->request->getPost('tp_mki'),
                    //                 'tp_ant'        => $this->request->getPost('tp_ant'),
                    //                 'tp_tss'        => $this->request->getPost('tp_tss')
                    //             ];
                    //             $op = [
                    //                 'op_rpac10'     => $this->request->getPost('op_rpac10'),
                    //                 'op_i'          => $this->request->getPost('op_i'),
                    //                 'op_p'          => $this->request->getPost('op_p'),
                    //                 'op_pcnt'       => $this->request->getPost('op_pcnt'),
                    //                 'op_s'          => $this->request->getPost('op_s'),
                    //                 'op_t'          => $this->request->getPost('op_t'),
                    //                 'op_ctrf'       => $this->request->getPost('op_ctrf'),
                    //                 'op_arf'        => $this->request->getPost('op_arf'),
                    //                 'op_rf'         => $this->request->getPost('op_rf'),
                    //                 'op_vop'        => $this->request->getPost('op_vop'),
                    //                 'op_secref'     => $this->request->getPost('op_secref'),
                    //                 'op_rss'        => $this->request->getPost('op_rss'),
                    //                 'op_mki'        => $this->request->getPost('op_mki'),
                    //                 'op_ant'        => $this->request->getPost('op_ant'),
                    //                 'op_tss'        => $this->request->getPost('op_tss')
                    //             ];
                    //             $prov = [
                    //                 'prov_rpac10'   => $this->request->getPost('prov_rpac10'),
                    //                 'prov_i'        => $this->request->getPost('prov_i'),
                    //                 'prov_p'        => $this->request->getPost('prov_p'),
                    //                 'prov_pcnt'     => $this->request->getPost('prov_pcnt'),
                    //                 'prov_s'        => $this->request->getPost('prov_s'),
                    //                 'prov_t'        => $this->request->getPost('prov_t'),
                    //                 'prov_ctrf'     => $this->request->getPost('prov_ctrf'),
                    //                 'prov_arf'      => $this->request->getPost('prov_arf'),
                    //                 'prov_rf'       => $this->request->getPost('prov_rf'),
                    //                 'prov_vop'      => $this->request->getPost('prov_vop'),
                    //                 'prov_secref'   => $this->request->getPost('prov_secref'),
                    //                 'prov_rss'      => $this->request->getPost('prov_rss'),
                    //                 'prov_mki'      => $this->request->getPost('prov_mki'),
                    //                 'prov_ant'      => $this->request->getPost('prov_ant'),
                    //                 'prov_tss'      => $this->request->getPost('prov_tss')
                    //             ];
                    //             $rev = [
                    //                 'rev_rpac10'    => $this->request->getPost('rev_rpac10'),
                    //                 'rev_i'         => $this->request->getPost('rev_i'),
                    //                 'rev_p'         => $this->request->getPost('rev_p'),
                    //                 'rev_pcnt'      => $this->request->getPost('rev_pcnt'),
                    //                 'rev_s'         => $this->request->getPost('rev_s'),
                    //                 'rev_t'         => $this->request->getPost('rev_t'),
                    //                 'rev_ctrf'      => $this->request->getPost('rev_ctrf'),
                    //                 'rev_arf'       => $this->request->getPost('rev_arf'),
                    //                 'rev_rf'        => $this->request->getPost('rev_rf'),
                    //                 'rev_vop'       => $this->request->getPost('rev_vop'),
                    //                 'rev_secref'    => $this->request->getPost('rev_secref'),
                    //                 'rev_rss'       => $this->request->getPost('rev_rss'),
                    //                 'rev_mki'       => $this->request->getPost('rev_mki'),
                    //                 'rev_ant'       => $this->request->getPost('rev_ant'),
                    //                 'rev_tss'       => $this->request->getPost('rev_tss')
                    //             ];
                    //             $cst = [
                    //                 'cst_rpac10'    => $this->request->getPost('cst_rpac10'),
                    //                 'cst_i'         => $this->request->getPost('cst_i'),
                    //                 'cst_p'         => $this->request->getPost('cst_p'),
                    //                 'cst_pcnt'      => $this->request->getPost('cst_pcnt'),
                    //                 'cst_s'         => $this->request->getPost('cst_s'),
                    //                 'cst_t'         => $this->request->getPost('cst_t'),
                    //                 'cst_ctrf'      => $this->request->getPost('cst_ctrf'),
                    //                 'cst_arf'       => $this->request->getPost('cst_arf'),
                    //                 'cst_rf'        => $this->request->getPost('cst_rf'),
                    //                 'cst_vop'       => $this->request->getPost('cst_vop'),
                    //                 'cst_secref'    => $this->request->getPost('cst_secref'),
                    //                 'cst_rss'       => $this->request->getPost('cst_rss'),
                    //                 'cst_mki'       => $this->request->getPost('cst_mki'),
                    //                 'cst_ant'       => $this->request->getPost('cst_ant'),
                    //                 'cst_tss'       => $this->request->getPost('cst_tss')
                    //             ];
                    //             $pr = [
                    //                 'pr_rpac10'     => $this->request->getPost('pr_rpac10'),
                    //                 'pr_i'          => $this->request->getPost('pr_i'),
                    //                 'pr_p'          => $this->request->getPost('pr_p'),
                    //                 'pr_pcnt'       => $this->request->getPost('pr_pcnt'),
                    //                 'pr_s'          => $this->request->getPost('pr_s'),
                    //                 'pr_t'          => $this->request->getPost('pr_t'),
                    //                 'pr_ctrf'       => $this->request->getPost('pr_ctrf'),
                    //                 'pr_arf'        => $this->request->getPost('pr_arf'),
                    //                 'pr_rf'         => $this->request->getPost('pr_rf'),
                    //                 'pr_vop'        => $this->request->getPost('pr_vop'),
                    //                 'pr_secref'     => $this->request->getPost('pr_secref'),
                    //                 'pr_rss'        => $this->request->getPost('pr_rss'),
                    //                 'pr_mki'        => $this->request->getPost('pr_mki'),
                    //                 'pr_ant'        => $this->request->getPost('pr_ant'),
                    //                 'pr_tss'        => $this->request->getPost('pr_tss')
                    //             ];
                    //             $req = [
                    //                 'tgb'       => json_encode($tgb),
                    //                 'ppe'       => json_encode($ppe),
                    //                 'invmt'     => json_encode($invmt),
                    //                 'invtr'     => json_encode($invtr),
                    //                 'tr'        => json_encode($tr),
                    //                 'or'        => json_encode($or),
                    //                 'bac'       => json_encode($bac),
                    //                 'tp'        => json_encode($tp),
                    //                 'op'        => json_encode($op),
                    //                 'prov'      => json_encode($prov),
                    //                 'rev'       => json_encode($rev),
                    //                 'cst'       => json_encode($cst),
                    //                 'pr'        => json_encode($pr),
                    //                 'materiality'   => $this->request->getPost('materiality'),
                    //                 'code'          => 'AC10',
                    //                 'mtID'         => $param['mtID'],
                    //             ];
                                
                    //         break;
                    //         case 'saveac10s1':
                    //             $validationRules = [
                    //                 'namedesc' => 'required'
                    //             ];
                    //             if (!$this->validate($validationRules)) {
                    //                 session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
                    //                 return $this->resultpage($chapter,false,$code,$mtID,$cID,$name);
                    //             }
                    //             $req = [
                    //                 'less'      => $this->request->getPost('less'),
                    //                 'name'      => $this->request->getPost('namedesc'),
                    //                 'balance'   => $this->request->getPost('balance'),
                    //                 'type'      => $s[1],
                    //                 'code'      => $s[0],
                    //                 'mtID'     => $param['mtID'],
                    //             ];
                    //         break;
                    //         case 'saveac10s2':
                    //             $validationRules = [
                    //                 'namedesc'      => 'required'
                    //             ];
                    //             if (!$this->validate($validationRules)) {
                    //                 session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
                    //                 return $this->resultpage($chapter,false,$code,$mtID,$cID,$name);
                    //             }
                    //             $req = [
                    //                 'less'      => $this->request->getPost('less'),
                    //                 'name'      => $this->request->getPost('namedesc'),
                    //                 'reason'    => $this->request->getPost('reason'),
                    //                 'balance'   => $this->request->getPost('balance'),
                    //                 'type'      => $s[1],
                    //                 'code'      => $s[0],
                    //                 'mtID'     => $param['mtID'],
                    //             ];
                    //         break;
                    //         case 'saveac10cu':
                    //             $req = [
                    //                 'question'      => $this->request->getPost('question'),
                    //                 'acid'          => $this->request->getPost('acid'),
                    //                 'mtID'         => $param['mtID'],
                    //             ];
                    //         break;
                    //     }
                    //     $res = $this->cvmodel->savevalues($param,$req);
                    //     return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    // break;
                    // case 'AC11':
                    //     switch ($save) {
                    //         case 'saveac11':
                    //             $ac11 = [
                    //                 'datem'         => $this->request->getPost('datem'),
                    //                 'ape1'          => $this->request->getPost('ape1'),
                    //                 'ape2'          => $this->request->getPost('ape2'),
                    //                 'ape3'          => $this->request->getPost('ape3'),
                    //                 'ieqr1'         => $this->request->getPost('ieqr1'),
                    //                 'ieqr2'         => $this->request->getPost('ieqr2'),
                    //                 'ieqr3'         => $this->request->getPost('ieqr3'),
                    //                 'mngr1'         => $this->request->getPost('mngr1'),
                    //                 'mngr2'         => $this->request->getPost('mngr2'),
                    //                 'mngr3'         => $this->request->getPost('mngr3'),
                    //                 'sup1'          => $this->request->getPost('sup1'),
                    //                 'sup2'          => $this->request->getPost('sup2'),
                    //                 'sup3'          => $this->request->getPost('sup3'),
                    //                 'sr1'           => $this->request->getPost('sr1'),
                    //                 'sr2'           => $this->request->getPost('sr2'),
                    //                 'sr3'           => $this->request->getPost('sr3'),
                    //                 'jra1'          => $this->request->getPost('jra1'),
                    //                 'jra2'          => $this->request->getPost('jra2'),
                    //                 'jra3'          => $this->request->getPost('jra3'),
                    //                 'jrb1'          => $this->request->getPost('jrb1'),
                    //                 'jrb2'          => $this->request->getPost('jrb2'),
                    //                 'jrb3'          => $this->request->getPost('jrb3'),
                    //                 'dcfrrt1'       => $this->request->getPost('dcfrrt1'),
                    //                 'dcfrrt2'       => $this->request->getPost('dcfrrt2'),
                    //                 'dcfrrt3'       => $this->request->getPost('dcfrrt3'),
                    //                 'dcfrrt4'       => $this->request->getPost('dcfrrt4'),
                    //                 'dcfrrt5'       => $this->request->getPost('dcfrrt5'),
                    //                 'dcfrrt6'       => $this->request->getPost('dcfrrt6'),
                    //                 'dcfrrt7'       => $this->request->getPost('dcfrrt7'),
                    //                 'dcfrrt8'       => $this->request->getPost('dcfrrt8'),
                    //                 'dcfrrt9'       => $this->request->getPost('dcfrrt9'),
                    //                 'sacb1'         => $this->request->getPost('sacb1'),
                    //                 'sacb2'         => $this->request->getPost('sacb2'),
                    //                 'sacb3'         => $this->request->getPost('sacb3'),
                    //                 'sacb4'         => $this->request->getPost('sacb4'),
                    //                 'sacb5'         => $this->request->getPost('sacb5'),
                    //                 'sacb6'         => $this->request->getPost('sacb6'),
                    //                 'sacb7'         => $this->request->getPost('sacb7'),
                    //                 'sacb8'         => $this->request->getPost('sacb8'),
                    //                 'sacb9'         => $this->request->getPost('sacb9'),
                    //             ];
                    //             $req = [
                    //                 'ac11'      => json_encode($ac11),
                    //                 'acid'      => $this->request->getPost('acid'),
                    //                 'mtID'     => $param['mtID'],
                    //             ];
                    //         break;
                    //     }
                    //     $res = $this->cvmodel->savevalues($param,$req);
                    //     return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    // break;
                }
            break;

            case 'c3':
                switch ($code) {
                    case '3.1 Aa1':
                        switch ($save) {
                            case 'saveplaf' :
                                $req = [
                                    'extent'        => $this->request->getPost('extent'),
                                    'reference'     => $this->request->getPost('reference'),
                                    'acid'          => $this->request->getPost('acid'),
                                    'c3tID'         => $param['mtID'],
                                ];
                            break;
                            case 'saveaa1s3' :
                                $sec = [
                                    'a1'    => $this->request->getPost('a1'),
                                    'a2'    => $this->request->getPost('a2'),
                                    'a3'    => $this->request->getPost('a3'),
                                    'a4'    => $this->request->getPost('a4'),
                                    'a5'    => $this->request->getPost('a5'),
                                    'a6'    => $this->request->getPost('a6'),
                                    'a7'    => $this->request->getPost('a7'),
                                    'a8'    => $this->request->getPost('a8'),
                                    'a9'    => $this->request->getPost('a9'),
                                    'a10'   => $this->request->getPost('a10'),
                                    'a10d'  => $this->request->getPost('a10d'),
                                    'a11'   => $this->request->getPost('a11'),
                                    'a11d'  => $this->request->getPost('a11d'),
                                    'a12'   => $this->request->getPost('a12'),
                                    'a13'   => $this->request->getPost('a13'),
                                    'a14'   => $this->request->getPost('a14'),
                                    'a14d'  => $this->request->getPost('a14d'),
                                    'a15'   => $this->request->getPost('a15'),
                                    'a16'   => $this->request->getPost('a16'),
                                    'a17'   => $this->request->getPost('a17'),
                                    'a18'   => $this->request->getPost('a18'),
                                    'a19'   => $this->request->getPost('a19'),
                                    'a20'   => $this->request->getPost('a20'),
                                    'a21'   => $this->request->getPost('a21'),
                                    'a22'   => $this->request->getPost('a22'),
                                    'a23'   => $this->request->getPost('a23'),
                                    'a24'   => $this->request->getPost('a24'),
                                ];
                                $req = [
                                    'question'  => json_encode($sec),
                                    'acid'      => $this->request->getPost('acid'),
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                            case 'saverceap' :
                                $rc = [
                                    'awp1'      => $this->request->getPost('awp1'),
                                    'awp2'      => $this->request->getPost('awp2'),
                                    'awp3'      => $this->request->getPost('awp3'),
                                    'awp4'      => $this->request->getPost('awp4'),
                                    'awp5'      => $this->request->getPost('awp5'),
                                    'awp6'      => $this->request->getPost('awp6'),
                                    'awp7'      => $this->request->getPost('awp7'),
                                    'rceap1'    => $this->request->getPost('rceap1'),
                                    'rceap2'    => $this->request->getPost('rceap2'),
                                    'rceap3'    => $this->request->getPost('rceap3'),
                                    'rceap4'    => $this->request->getPost('rceap4'),
                                    'rceap5'    => $this->request->getPost('rceap5'),
                                    'rceap6'    => $this->request->getPost('rceap6'),
                                    'rceap7'    => $this->request->getPost('rceap7'),
                                    'rceap8'    => $this->request->getPost('rceap8'),
                                    'rceap9'    => $this->request->getPost('rceap9'),
                                    'rceap10'   => $this->request->getPost('rceap10'),
                                    'details'   => $this->request->getPost('details'),
                                    'datereq'   => $this->request->getPost('datereq'),
                                    'numcop'    => $this->request->getPost('numcop'),
                                ];
                                $req = [
                                    'question'  => json_encode($rc),
                                    'acid'      => $this->request->getPost('acid'),
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.2 Aa2':
                        switch ($save) {
                            case 'saveaa2' :
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
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.3 Aa3a':
                        switch ($save) {
                            case 'saveaa3a' :
                                $req = [
                                    'comment'   => $this->request->getPost('comment'),
                                    'acid'      => $this->request->getPost('acid'),
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                            case 'saveaa3afaf' :
                                $req = [
                                    'extent'        => $this->request->getPost('extent'),
                                    'reference'     => $this->request->getPost('reference'),
                                    'acid'          => $this->request->getPost('acid'),
                                    'c3tID'         => $param['mtID'],
                                ];
                            break;
                            case 'saveaa3air' :
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
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.4 Aa3b':
                        switch ($save) {
                            case 'saveaa3b' :
                                $req = [
                                    'reference'     => $this->request->getPost('reference'),
                                    'acid'          => $this->request->getPost('acid'),
                                    'c3tID'         => $param['mtID'],
                                ];
                            break;
                            case 'saveaa3bp4' :
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
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.5 Aa4':
                        switch ($save) {
                            case 'saveaa4' :
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
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.6.1 Aa5a':
                        switch ($save) {
                            case 'saveaa5a' :
                                $aa5 = [
                                    'aa51d' => $this->request->getPost('aa51d'),
                                    'ml1' => $this->request->getPost('ml1'),
                                    'ml1d' => $this->request->getPost('ml1d'),
                                    'ml2' => $this->request->getPost('ml2'),
                                    'ml3' => $this->request->getPost('ml3'),
                                    'ml4' => $this->request->getPost('ml4'),
                                    'ml4d' => $this->request->getPost('ml4d'),
                                    'ml5' => $this->request->getPost('ml5'),
                                    'ml5d' => $this->request->getPost('ml5d'),
                                    'ml6' => $this->request->getPost('ml6'),
                                    'ml6d' => $this->request->getPost('ml6d'),
                                    'ml7' => $this->request->getPost('ml7'),
                                    'ml7d' => $this->request->getPost('ml7d'),
                                    'ml8' => $this->request->getPost('ml8'),
                                ];
                                $req = [
                                    'aa5a'       => json_encode($aa5),
                                    'code'      => $code,
                                    'part'      => 'aa5a',
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.6.2 Aa5b':
                        switch ($save) {
                            case 'saveaa5b' :
                                $validationRules = [
                                    'reference' => 'required'
                                ];
                                if (!$this->validate($validationRules)) {
                                    session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
                                    return $this->resultpage($chapter,false,$code,$mtID,$cID,$name);
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
                                    'c3tID'                 => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.7 Aa7':
                        switch ($save) {
                            case 'saveaa7isa' :
                                $validationRules = [
                                    'reference' => 'required'
                                ];
                                if (!$this->validate($validationRules)) {
                                    session()->setFlashdata('failed','There\'s something wrong with your input, Please try again');
                                    return $this->resultpage($chapter,false,$code,$mtID,$cID,$name);
                                }
                                $req = [
                                    'reference'         => $this->request->getPost('reference'),
                                    'issue'             => $this->request->getPost('issue'),
                                    'comment'           => $this->request->getPost('comment'),
                                    'recommendation'    => $this->request->getPost('recommendation'),
                                    'result'            => $this->request->getPost('result'),
                                    'code'              => $code,
                                    'part'              => $this->request->getPost('part'),
                                    'c3tID'             => $param['mtID'],
                                ];
                            break;
                            case 'saveaa7aepapp' :
                                $req = [
                                    'aep'       => $this->request->getPost('question'),
                                    'acid'      => $this->request->getPost('acid'),
                                    'cID'       => $param['cID'],
                                    'c3tID'     => $param['mtID'],
                                    'uID'       => $param['uID'],
                                    'fID'       => $param['fID'],
                                ];
                            break;
                            case 'saveaa7aep' :
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
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.8 Aa10':
                        switch ($save) {
                            case 'saveaa10' :
                                $aa10 = [
                                    'sum'   => $this->request->getPost('sum'),
                                    'comp'  => $this->request->getPost('comp'),
                                    'exp'   => $this->request->getPost('exp')
                                ];
                                $req = [
                                    'aa10'      => json_encode($aa10),
                                    'acid'      => $this->request->getPost('acid'),
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.10 Aa11-un':
                    case '3.10 Aa11-ad':
                        $s = explode('-', $code);
                        switch ($save) {
                            case 'saveaa11un' :
                                $req = [
                                    'reference'     => $this->request->getPost('reference'),
                                    'desc'          => $this->request->getPost('desc'),
                                    'drps'          => $this->request->getPost('drps'),
                                    'crps'          => $this->request->getPost('crps'),
                                    'drfp'          => $this->request->getPost('drfp'),
                                    'crfp'          => $this->request->getPost('crfp'),
                                    'yesno'         => $this->request->getPost('yesno'),
                                    'code'          => $s[0],
                                    'part'          => $this->request->getPost('part'),
                                    'c3tID'         => $param['mtID'],
                                ];
                            break;
                            case 'saveaa11ad' :
                                $req = [
                                    'reference'     => $this->request->getPost('reference'),
                                    'desc'          => $this->request->getPost('desc'),
                                    'drps'          => $this->request->getPost('drps'),
                                    'crps'          => $this->request->getPost('crps'),
                                    'drfp'          => $this->request->getPost('drfp'),
                                    'crfp'          => $this->request->getPost('crfp'),
                                    'code'          => $s[0],
                                    'part'          => 'ad',
                                    'c3tID'         => $param['mtID'],
                                ];
                            break;
                            case 'saveaa11ue' :
                                $aa11 = [
                                    'cta'   => $this->request->getPost('cta'),
                                    'fpm'   => $this->request->getPost('fpm'),
                                    'fma'   => $this->request->getPost('fma')
                                ];
                                $req = [
                                    'aa11'      => json_encode($aa11),
                                    'acid'      => $this->request->getPost('acid'),
                                    'c3tID'     => $param['mtID'],
                                ];
                                
                            break;
                            case 'saveaa11con' :
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
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                            case 'saveaa11uead' :
                                $aa11 = [
                                    'pl'    => $this->request->getPost('pl'),
                                    'na'    => $this->request->getPost('na'),
                                    'pl2'   => $this->request->getPost('pl2')
                                ];
                                $req = [
                                    'aa11'      => json_encode($aa11),
                                    'acid'      => $this->request->getPost('acid'),
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.11':
                        switch ($save) {
                            case 'save311' :
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
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.13 Ab1':
                        switch ($save) {
                            case 'saveab1' :
                                $req = [
                                    'yesno'     => $this->request->getPost('yesno'),
                                    'comment'   => $this->request->getPost('comment'),
                                    'acid'      => $this->request->getPost('acid'),
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.14 Ab3':
                        switch ($save) {
                            case 'saveab3' :
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
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.15 Ab4-checklist':
                    case '3.15 Ab4-section1':
                    case '3.15 Ab4-section2':
                    case '3.15 Ab4-section3':
                    case '3.15 Ab4-section4':
                    case '3.15 Ab4-section5':
                    case '3.15 Ab4-section6':
                    case '3.15 Ab4-section7':
                    case '3.15 Ab4-section8':
                    case '3.15 Ab4-section9':
                        switch ($save) {
                            case 'saveab4' :
                                $req = [
                                    'yesno'     => $this->request->getPost('yesno'),
                                    'comment'   => $this->request->getPost('comment'),
                                    'acid'      => $this->request->getPost('acid'),
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                            case 'saveab4checklist' :
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
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                    case '3.15.1 Ab4a':
                    case '3.15.2 Ab4b':
                    case '3.15.3 Ab4c':
                    case '3.15.4 Ab4d':
                    case '3.15.5 Ab4e':
                    case '3.15.6 Ab4f':
                    case '3.15.7 Ab4g':
                    case '3.15.8 Ab4h':
                        switch ($save) {
                            case 'saveab4a' :
                                $req = [
                                    'yesno'     => $this->request->getPost('yesno'),
                                    'comment'   => $this->request->getPost('comment'),
                                    'acid'      => $this->request->getPost('acid'),
                                    'c3tID'     => $param['mtID'],
                                ];
                            break;
                        }
                        $res = $this->cvmodel->savevalues($param,$req);
                        return $this->resultpage($chapter,$res,$code,$mtID,$cID,$name);
                    break;
                }
            break;
            
        }

    }


}