<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\C332Aa2Model;

class C332Aa2Controller extends BaseController{

    protected $c332aa2model;
    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->c332aa2model = new C332Aa2Model();
        $this->crypt = \Config\Services::encrypter();

    }

    /**
        ----------------------------------------------------------
        Chapter 3 AC9 POST FUNCTIONS
        ----------------------------------------------------------
    */
   
    





    







    





}
