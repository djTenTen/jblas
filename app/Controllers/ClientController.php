<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\ClientModel;

class ClientController extends BaseController{

    protected $clientModel;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->clientModel = new ClientModel();
        $this->crypt = \Config\Services::encrypter();

    }
    
    /**
        ----------------------------------------------------------
        Chapter 1 area
        ----------------------------------------------------------
    */
    public function viewclient(){

        // main content
        $data['title'] = 'Client Management';

        $data['client'] = $this->clientModel->getclients();

        echo view('includes/Header', $data);
        echo view('client/Client', $data);
        echo view('includes/Footer');
    
    }

    public function clientdefaults($cID){

        $data['title'] = 'Client Default Management';
        $res = $this->clientModel->getclientname($this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID)));
        $data['header'] = $res['name'];
        $data['c1'] = $this->clientModel->getc1();

        echo view('includes/Header', $data);
        echo view('client/ClientDefaults', $data);
        echo view('includes/Footer');

    }




}
