<?php
namespace App\Libraries;

use CodeIgniter\Files\File;

class Logs{

    protected $logPath;
    protected $logFile;
    protected $time,$date;
    protected $crypt;

    public function __construct(){

        date_default_timezone_set("Asia/Singapore"); 
        $this->time     = date("h:i A");
        $this->date     = date("F d, Y");
        $this->crypt    = \Config\Services::encrypter();
        $this->logPath = WRITEPATH . 'applaudlogs/';
        $this->logFile = $this->logPath. $this->crypt->decrypt(session()->get('firmID')).'-systems-log-'.date("F d, Y").'.log';
        if (!is_dir($this->logPath)) {
            mkdir($this->logPath, 0644, true);
        }

    }

    public function log($msg){

        //$file = new File($this->logFile, true);
        //$timestamp = $this->time;
        $logMessage = "[{$this->time}]: {$msg}" . PHP_EOL;
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);

    }

}