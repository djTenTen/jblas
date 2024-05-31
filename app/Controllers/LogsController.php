<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\HomeModel;
use \App\Models\AuthModel;
use App\Libraries\Logs;

class LogsController extends BaseController{

    protected $crypt;

    public function __construct(){

        \Config\Services::session();
        $this->crypt    = \Config\Services::encrypter();

    }

    public function viewlogs(){

        $fID = $this->crypt->decrypt(session()->get('firmID'));
        $logFile = WRITEPATH . 'applaudlogs/'. $fID.'-systems-log-'.date("F d, Y").'.log';
        if (!file_exists($logFile)) {
            return 'no logs';
        }
        $logs = file_get_contents($logFile);
        $logs = nl2br($logs);

        return $logs;

    }
    


}
