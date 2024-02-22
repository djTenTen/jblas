<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashController extends BaseController{

    public function dashboard(){

        echo view('includes/Header');
        echo view('dashboard/Dashboard');
        echo view('includes/Footer');
        
    }

}
