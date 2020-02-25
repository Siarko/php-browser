<?php


namespace Siarko\io;


use Siarko\bootstrap\events\EventData;
use Siarko\bootstrap\events\EventProvider;
use Siarko\bootstrap\events\Events;
use Siarko\io\stream\Input;

class Keyboard implements EventProvider
{

    private static $instance = null;
    private $inputStream = null;

    private function __construct()
    {
        $this->inputStream = new Input();
        register_shutdown_function(function(){
            $this->inputStream->close();
        });
    }

    private function eventKeyUp($arguments){
        return new EventData(Events::KEYUP, $arguments);
    }

    private function dataIdle(){
        return new EventData(Events::IDLE, []);
    }

    public static function init(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @inheritDoc
     */
    function getDataObject()
    {
        if($this->inputStream->isBufferEmpty()){
            return $this->dataIdle();
        }else{
            $key = $this->inputStream->getBufferContent();
            return $this->eventKeyUp([
                ord($key),
                $key
            ]);
        }
    }
}