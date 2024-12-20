<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class ErrorController extends BaseController{


    /**
        // ALL CONTROLLERS ARE ACCESSED THROUGH ROUTES // 
        THIS FILE IS USED FOR ERROR VIEWS
    */

    /**
        * displays unauthorized error
    */
    public function error401(){

        echo view('errors/html/error_401');

    }


    /**
        * displays forbidden error
    */
    public function error403(){

        echo view('errors/html/error_403');

    }


    /**
        * displays internal server error
    */
    public function error500(){

        echo view('errors/html/error_500');

    }


}
