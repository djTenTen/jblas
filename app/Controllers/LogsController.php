<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\HomeModel;
use \App\Models\AuthModel;
use App\Libraries\Logs;

class LogsController extends BaseController{


    /**
        // THIS CONTROLLER ONLY ACCESSED ON THE MODEL// 
        THIS FILE IS USED FOR FIRM MANAGEMENT
        Properties being used on this file
        * @property crypt to load the encryption file
    */
    protected $crypt;


    /**
        * @method __construct() to assign and load the method on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->crypt    = \Config\Services::encrypter();

    }


    /**
        * @method viewlogs() view the system logs
        * @var fID decrypted data of firm id
        * @var logFile path of the log file
        * @var log contains log information
        * @return @var logs
    */
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
