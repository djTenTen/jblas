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


    public function auditsystem(){

        $data['title'] = 'Auditing System - Dashboard';

        echo view('includes/Header', $data);
        echo view('dashboard/DashboardAudit', $data);
        echo view('includes/Footer');

    }
}
