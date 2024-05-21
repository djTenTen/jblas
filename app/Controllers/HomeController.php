<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\HomeModel;
use \App\Models\AuthModel;

class HomeController extends BaseController{

    protected $homeModel;
    protected $userdata;
    protected $scheme = 'information_schema.SCHEMATA';
    protected $schemename = 'SCHEMA_NAME';
    protected $dbname = 'as';

    public function __construct(){

        \Config\Services::session();
        $this->homeModel = new HomeModel();

    }

    public function homepage(){

        $db = \Config\Database::connect('default'); 
        try { $db->connect('default'); } catch (\Throwable $th) { return view("errors/error500"); }
        $res = $db->table($this->scheme)->select($this->schemename)->where($this->schemename, $this->dbname)->get();
        if($res->getNumRows() > 0){
            if(session()->get('authentication')){
                return redirect()->to(site_url('dashboard')); 
            }else{
                $page = 'Login';
                $data['title'] = 'Login';
                return view('index/'.$page, $data);
            }
        }else{
            return redirect()->to(site_url('error500'));
        }

    }

    public function auth(){

    }

    public function getpost(){

        return $this->userdata;

    }


}
