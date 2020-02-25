<?php


namespace Siarko\bootstrap;


use Siarko\bootstrap\events\EventProvider;
use Siarko\bootstrap\events\Events;
use Siarko\bootstrap\exceptions\NoEventProvidersException;

class Bootstrap
{

    private $processes = [];
    private $eventProviders = [];
    private $run = true;

    public function __construct()
    {

    }

    public function setProcess(\Closure $param, $eventType = Events::IDLE)
    {
        $this->processes[$eventType] = $param;
    }

    public function addEventProvider(EventProvider $eventProvider)
    {
        $this->eventProviders[] = $eventProvider;
    }

    public function run()
    {
        if(count($this->eventProviders) == 0){
            throw new NoEventProvidersException("No event providers registered");
        }
        while ($this->run) {
            /* @var $eventProvider EventProvider */
            foreach ($this->eventProviders as $eventProvider) {
                $eventData = $eventProvider->getDataObject();
                $process = $this->processes[$eventData->getState()];
                $process(...$eventData->getProcessorArguments());
            }
        }
    }
}