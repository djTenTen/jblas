<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
    
class DashController extends BaseController{

    public function dashboard(){

        $data['title'] = 'Dashboard';

        echo view('dashboard/Dashboard', $data);

    
    }

}
