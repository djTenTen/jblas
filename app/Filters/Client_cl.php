<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Config\Services;

class Client_cl implements FilterInterface{

    protected $authmodel;

    public function __construct(){
        $this->authmodel = new \App\Models\AuthModel; // to access the login_model
    }


    public function before(RequestInterface $request, $arguments = null)
    {
        // Check session validation here
        \Config\Services::session();
        $this->authmodel->getUserAccess();
        if(!empty(session()->get('allowed'))){
            if (session()->get('allowed')->clm != 'Yes') {
                return redirect()->to(site_url('403'));
            }else{
                if (session()->get('allowed')->cl != "Yes") {
                    return redirect()->to(site_url('403'));
                }
            }
        }else{
            return redirect()->to(site_url('401'));
        }

        


    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something after controller execution
    }

}