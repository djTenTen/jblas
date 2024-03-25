<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C331Aa1Model;

class C331Aa1Controller extends BaseController{

    protected $c331aa1model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->c331aa1model = new C331Aa1Model();
        $this->crypt = \Config\Services::encrypter();

    }

   




    







    





}
