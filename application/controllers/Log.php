<?php
class Log extends CI_Controller{

    private $logPath;
    public function __construct()
    {
        parent::__construct();        
        $this->logPath = APPPATH.'logs\log-'.date("Y-m-d").".php";
    }

    public function index(){
        if(!isCloudServer()){
            if (@is_file($this->logPath)) {
                echo nl2br(@file_get_contents($this->logPath));
            } else {
                echo 'No se encontraron logs '.$this->logPath;
            }
        }
        exit;
    }

    public function delete(){
      if(!isCloudServer()){
        if (@is_file($this->logPath)) {
            if (@unlink($this->logPath)) {
                echo 'PHP Error Log deleted';
            } else {
                echo 'There has been an error trying to delete the PHP Error log '.$this->logPath;
            }
        } else {
            echo 'The log cannot be found in the specified route  '.$this->logPath.'.';
        }
    }
    exit;
}
}
/*Error.log*/