<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\SystemModel;

class SystemController extends BaseController{
    

    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES BEFORE GOING TO MODEL // 
        THIS FILE IS USED FOR POSITION MANAGEMENT
        Properties being used on this file
        * @property sm to include the file system model
        * @property crypt to load the encryption file
    */
    protected $sm;
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->sm    = new SystemModel();
        $this->crypt = \Config\Services::encrypter();

    }

    
    public function crontask(){

        $res = $this->sm->crontask();
        return $res;

    }

    
    


}