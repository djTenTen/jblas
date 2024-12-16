<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\PositionModel;

class PositionController extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL // 
        THIS FILE IS USED FOR POSITION MANAGEMENT
        Properties being used on this file
        * @property pmodel to include the file position model
        * @property crypt to load the encryption file
    */
    protected $pmodel;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->pmodel   = new PositionModel();
        $this->crypt    = \Config\Services::encrypter();

    }


    public function decr($ecr){
        return $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ecr));
    }

    public function encr($ecr){
        return str_ireplace(['/','+'],['~','$'],$this->crypt->encrypt($ecr));
    }


    /**
        * @method editposition() used to load the data of position for editing
        * @param pID encrypted data of position id
        * @var dpID decrypted data of position id
        * @return json
    */
    public function editposition($pID){

        $dpID = $this->decr($pID);
        return $this->pmodel->editposition($dpID);

    }


    /**
        * @method viewposition() view the position page
        * @var array-data consist of data and display it on the page
        * @return view
    */
    public function viewposition(){

        $data['title'] = 'Position Management';
        $data['pos'] = $this->pmodel->getposition();
        echo view('includes/Header', $data);
        echo view('position/Position', $data);
        echo view('includes/Footer');

    }


    /**
        * @method addposition() add the position information to the database
        * @var validationRules set to validate the data before saving to database
        * @var array-dpt consist of access information of a position
        * @var array-req consist of position information
        * @var res a return response from the position model
        * @return redirect-to-page
    */
    public function addposition(){

        $validationRules = [
            'pos' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/position'));
        }
        $dpt = [
            'add'           => $this->request->getPost('add'),
            'edit'          => $this->request->getPost('edit'),
            'acin'          => $this->request->getPost('acin'),
            'clm'           => $this->request->getPost('clm'),
            'cl'            => $this->request->getPost('cl'),
            'sd'            => $this->request->getPost('sd'),
            'audm'          => $this->request->getPost('audm'),
            'aud'           => $this->request->getPost('aud'),
            'frm'           => $this->request->getPost('frm'),
            'sett'          => $this->request->getPost('sett'),
            'dash'          => $this->request->getPost('dash'),
            'workp'         => $this->request->getPost('workp'),
            'preparer'      => $this->request->getPost('preparer'),
            'reviewer'      => $this->request->getPost('reviewer'),
            'audmanager'    => $this->request->getPost('audmanager'),
            'position'      => $this->request->getPost('position'),
            'hat'           => $this->request->getPost('hat'),
            'user'          => $this->request->getPost('user'),
        ];
        $req = [
            'dpt'       => json_encode($dpt),
            'pos'       => ucfirst("{$this->request->getPost('pos')}"),
            'status'    => 'Active'
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


    /**
        * @method updateposition() update the position information to the database
        * @param pID encrypted data of position id
        * @var dpID decrypted data of position id
        * @var validationRules set to validate the data before saving to database
        * @var array-dpt consist of access information of a position
        * @var array-req consist of position information
        * @var res a return response from the position model
        * @return redirect-to-page
    */
    public function updateposition($pID){

        $dpID = $this->decr($pID);
        $validationRules = [
            'pos' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('invalid_input','invalid_input');
            return redirect()->to(site_url('auditsystem/position'));
        }
        $dpt = [
            'add'           => $this->request->getPost('add'),
            'edit'          => $this->request->getPost('edit'),
            'acin'          => $this->request->getPost('acin'),
            'clm'           => $this->request->getPost('clm'),
            'cl'            => $this->request->getPost('cl'),
            'sd'            => $this->request->getPost('sd'),
            'audm'          => $this->request->getPost('audm'),
            'aud'           => $this->request->getPost('aud'),
            'frm'           => $this->request->getPost('frm'),
            'sett'          => $this->request->getPost('sett'),
            'dash'          => $this->request->getPost('dash'),
            'workp'         => $this->request->getPost('workp'),
            'preparer'      => $this->request->getPost('preparer'),
            'reviewer'      => $this->request->getPost('reviewer'),
            'audmanager'    => $this->request->getPost('audmanager'),
            'position'      => $this->request->getPost('position'),
            'hat'           => $this->request->getPost('hat'),
            'user'          => $this->request->getPost('user'),
        ];
        $req = [
            'dpt'   => json_encode($dpt),
            'pos'   => ucfirst("{$this->request->getPost('pos')}"),
            'pID'   => $dpID
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


    /**
        * @method acin() used to set inactive and active the position
        * @param pID encrypted data of position id
        * @var dpID decrypted data of position id
        * @var res a return response from the position model
        * @return redirect-to-page
    */
    public function acin($pID){

        $dpID   = $this->decr($pID);
        $res    = $this->pmodel->acin($dpID);
        if($res){
            session()->setFlashdata('updated','updated');
            return redirect()->to(site_url('auditsystem/position'));
        }else{
            session()->setFlashdata('failed','failed');
            return redirect()->to(site_url('auditsystem/position'));
        }

    }


}