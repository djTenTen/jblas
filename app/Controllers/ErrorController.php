<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class ErrorController extends BaseController{


    public function error401(){

        echo view('errors/html/error_401');

    }

    public function error403(){

        echo view('errors/html/error_403');

    }

    public function error500(){

        echo view('errors/html/error_500');

    }


    


}
