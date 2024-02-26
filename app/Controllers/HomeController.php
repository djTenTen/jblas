<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use \App\Models\HomeModel;


class HomeController extends BaseController{

    use ResponseTrait;

    protected $homeModel;
    protected $crypt;

    public function __construct(){

        $this->homeModel = new HomeModel();
        $this->crypt = \Config\Services::encrypter();

    }

    public function homepage(){
        
        $res = $this->homeModel->getuser();
        $arr = [];
        foreach($res as $row){
            $data = [
                'id' => $row['id'],
                'name' => $row['name']
            ];

            array_push($arr, $data);
        }

        return json_encode($arr);

    }

    public function posthome(){


        $rawData = $this->request->getBody();
        $reqdata = json_decode($rawData);

        $req = [
            'name' => $reqdata->un,
            'password' => $reqdata->pss
        ];

        $dd = 'data from codeigniter';

        $edd = $this->crypt->encrypt($dd);


        // $res = $this->homeModel->getuser();
        // $arr = [];
        // foreach($res as $row){
        //     $data = [
        //         'id' => $row['id'],
        //         'name' => $row['name']
        //     ];

        //     array_push($arr, $data);
        // }



        if($this->homeModel->auth($req)){
            return $this->respond(['message' =>$edd], 201);
        }else{
            return $this->respond(['message' =>'Error'], 404);
        }

    }


}
