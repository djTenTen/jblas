<?php
namespace App\Libraries;

use CodeIgniter\Files\File;

class Logs{

    protected $time,$date;
    protected $crypt;

    public function __construct(){

        date_default_timezone_set("Asia/Singapore"); 
        $this->time     = date("h:i A");
        $this->date     = date("F d, Y");
        $this->crypt    = \Config\Services::encrypter();

    }

    public function log($msg){

        $logPath = WRITEPATH . 'applaudlogs/';
        if(!empty(session()->get('firmID'))){
            $logFile = $logPath. $this->crypt->decrypt(session()->get('firmID')).'-systems-log.log';
        }
        if (!is_dir($logPath)) {
            mkdir($logPath, 0755, true);
        }
        $logMessage = "[".$this->date."-".$this->time."]: {$msg}".PHP_EOL;
        file_put_contents($logFile, $logMessage, FILE_APPEND);

    }

    public function authlog($msg){

        $logPath = WRITEPATH . 'authlogs/';
        $logFile = $logPath.'auth.log';
        if (!is_dir($logPath)) {
            mkdir($logPath, 0755, true);
        }
        $logMessage = "[".$this->date."-".$this->time."]: {$msg}".PHP_EOL;
        file_put_contents($logFile, $logMessage, FILE_APPEND);

    }

    public function cronlogs($msg){

        $logPath = WRITEPATH . 'cronlogs/';
        $logFile = $logPath. 'cron-log.log';
        if (!is_dir($logPath)) {
            mkdir($logPath, 0755, true);
        }
        $logMessage = "[{$this->time} - {$this->date}]: {$msg}" . PHP_EOL;
        file_put_contents($logFile, $logMessage, FILE_APPEND);

    }

}