<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function homepage(){
        
        echo view('index/Login');

    }
}
