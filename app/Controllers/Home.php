<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){
        $page = 'dashboard';

        echo view('includes/Header');
        echo view('dashboard/Dashboard');
        echo view('includes/Footer');

    }
}
