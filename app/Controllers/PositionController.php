<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\PositionModel;

class PositionController extends BaseController{

    protected $pmodel;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->pmodel = new PositionModel();
        $this->crypt = \Config\Services::encrypter();

    }

    public function editposition($pID){

        $dpID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$pID));
        return $this->pmodel->editposition($dpID);

    }

    public function viewposition(){

        $data['title'] = 'Position Management';

        $data['pos'] = $this->pmodel->getposition();

        echo view('includes/Header', $data);
        echo view('position/Position', $data);
        echo view('includes/Footer');

    }


    public function addposition(){

        $validationRules = [
            'pos' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/position'));
        }

        $dpt = [
            'add' => $this->request->getPost('add'),
            'edit' => $this->request->getPost('edit'),
            'acin' => $this->request->getPost('acin'),
            'clm' => $this->request->getPost('clm'),
            'cl' => $this->request->getPost('cl'),
            'sd' => $this->request->getPost('sd'),
            'audm' => $this->request->getPost('audm'),
            'aud' => $this->request->getPost('aud'),
            'frm' => $this->request->getPost('frm'),
            'sett' => $this->request->getPost('sett'),
            'dash' => $this->request->getPost('dash'),
            'workp' => $this->request->getPost('workp'),
            'preparer' => $this->request->getPost('preparer'),
            'reviewer' => $this->request->getPost('reviewer'),
            'audmanager' => $this->request->getPost('audmanager'),
            'user' => $this->request->getPost('user'),
        ];

        $req = [
            'dpt' => json_encode($dpt),
            'pos' => ucfirst("{$this->request->getPost('pos')}"),
            'status' => 'Active'
        ];

        $res = $this->pmodel->saveposition($req);

        if($res){
            session()->setFlashdata('added','added');
            return redirect()->to(site_url('auditsystem/position'));
        }else{
            session()->setFlashdata('failed','failed');
            return redirect()->to(site_url('auditsystem/position'));
        }

    }

    public function updateposition($pID){

        $dpID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$pID));

        $validationRules = [
            'pos' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/position'));
        }

        $dpt = [
            'add' => $this->request->getPost('add'),
            'edit' => $this->request->getPost('edit'),
            'acin' => $this->request->getPost('acin'),
            'clm' => $this->request->getPost('clm'),
            'cl' => $this->request->getPost('cl'),
            'sd' => $this->request->getPost('sd'),
            'audm' => $this->request->getPost('audm'),
            'aud' => $this->request->getPost('aud'),
            'frm' => $this->request->getPost('frm'),
            'sett' => $this->request->getPost('sett'),
            'dash' => $this->request->getPost('dash'),
            'workp' => $this->request->getPost('workp'),
            'preparer' => $this->request->getPost('preparer'),
            'reviewer' => $this->request->getPost('reviewer'),
            'audmanager' => $this->request->getPost('audmanager'),
            'user' => $this->request->getPost('user'),
        ];

        $req = [
            'dpt' => json_encode($dpt),
            'pos' => ucfirst("{$this->request->getPost('pos')}"),
            'pID' => $dpID
        ];

        $res = $this->pmodel->updateposition($req);

        if($res){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/position'));
        }else{
            session()->setFlashdata('failed','failed');
            return redirect()->to(site_url('auditsystem/position'));
        }

    }

    public function acin($pID){

        $dpID = $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$pID));

        $res = $this->pmodel->acin($dpID);

        if($res){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/position'));
        }else{
            session()->setFlashdata('failed','failed');
            return redirect()->to(site_url('auditsystem/position'));
        }



    }


}