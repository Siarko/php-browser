<?php


namespace Siarko\io;


use Siarko\paradigm\Singleton;
use Siarko\util\math\Vec;

class Console
{

    use Singleton;

    private $screenSize = null;

    private function __construct()
    {
        $this->initScreen();
    }

    public static function setPosition($x, $y){
        echo "\033[".$x.";".$y."f";
    }

    public function updateScreenSize() {
        preg_match_all("/rows.([0-9]+);.columns.([0-9]+);/", strtolower(exec('stty -a |grep columns')), $output);
        if(sizeof($output) == 3) {
            $this->screenSize = new Vec($output[1][0], $output[2][0]);
        }
        return $this->screenSize;
    }

    private function initScreen(){
        system('tput smcup');
        register_shutdown_function(function(){
            $this->cleanup();
        });
        pcntl_signal(SIGINT, function(){$this->cleanup();});
        pcntl_signal(SIGUSR1, function(){$this->cleanup();});
    }

    public function cleanup(){
        $this->exitScreen();
    }

    private function exitScreen(){
        system('tput rmcup');
    }


}