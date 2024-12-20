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
        * @property
    */
    protected $crypt;


    /**
        * Load the methods on the @property
    */
    public function __construct(){

        \Config\Services::session();
        $this->crypt    = \Config\Services::encrypter();

    }


    /**
        * Replacing characters then Decrypting a Data @param ecr
    */
    public function decr($ecr){
        return $this->crypt->decrypt(str_ireplace(['~','$'],['/','+'],$ecr));
    }


    /**
        * Encypting a Data @param ecr then Replacing the characters
    */
    public function encr($ecr){
        return str_ireplace(['/','+'],['~','$'],$this->crypt->encrypt($ecr));
    }


    /**
        * view the System Logs
        * @return view
    */
    public function logs(){

        $data['title'] = session()->get('firm'). ' - Logs';
        $logs = $this->viewlogs();
        if($logs == 'no logs'){
            $data['logs'] = 'No Logs';
        }else{
            $data['logs'] = $logs;
        }
        echo view('includes/Header', $data);
        echo view('logs/Logs', $data);
        echo view('includes/Footer');

    }


    /**
        * @param lines
        * get the Logs and display it based on the number of lines
        * @return logs
    */
    public function viewlogs($lines = 0){
    
        $fID = $this->decr(session()->get('firmID'));
        $logFile = WRITEPATH . 'applaudlogs/'. $fID.'-systems-log.log';
        if (!file_exists($logFile)) {
            return 'no logs';
        }

        $logsArray = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lines == 0 || $lines > count($logsArray)) {
            $logsToDisplay = $logsArray;
        } else {
            // Get only the last $lines number of lines
            $logsToDisplay = array_slice($logsArray, -$lines);
        }

        $logs = implode(PHP_EOL, $logsToDisplay);
        return nl2br($logs);

    }
    


}
