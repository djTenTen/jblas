<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Config\Services;

class Setting_hat implements FilterInterface{

    protected $authmodel;

    public function __construct(){
        $this->authmodel = new \App\Models\AuthModel; // to access the login_model
    }


    public function before(RequestInterface $request, $arguments = null)
    {
        // Check session validation here
        \Config\Services::session();
        if(!empty(session()->get('allowed'))){
            if (session()->get('allowed')->hat != "Yes") {
                return redirect()->to(site_url('403'));
            }
        }else{
            return redirect()->to(site_url('401'));
        }
        $this->authmodel->getUserAccess();


    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something after controller execution
    }

}