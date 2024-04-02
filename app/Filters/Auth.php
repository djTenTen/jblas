<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Config\Services;

class Auth implements FilterInterface{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check session validation here
        \Config\Services::session();

        if (!session()->get('authentication')) {
            // Redirect to login page or perform any action
            return redirect()->to(site_url('login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something after controller execution
    }

}