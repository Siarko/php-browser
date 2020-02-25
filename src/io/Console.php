<?php


namespace Siarko\io;


use Siarko\paradigm\Singleton;
use Siarko\util\math\Vec;

/**
 * @method static self get()
 * */
class Console
{

    use Singleton;

    private $screenSize = null;

    private function __construct()
    {
        $this->initScreen();
    }

    public function getPosition(){
        return new Vec();
    }

    public function setPosition($x, $y = 0){
        if($x instanceof Vec){
            $y = $x->getX();
            $x = $x->getX();
        }
        echo "\033[".((int)$y).";".((int)$x)."f";
    }

    /**
     * @return Vec
     */
    public function getScreenSize() {
        if($this->screenSize === null){
            $this->updateScreenSize();
        }
        return $this->screenSize;
    }

    private function updateScreenSize(){
        $this->screenSize = new Vec(
            exec('tput cols'),
            exec('tput lines')
        );
    }

    private function initScreen(){
        system('clear');
        //system('tput smcup');
        register_shutdown_function(function(){
        //    $this->cleanup();
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