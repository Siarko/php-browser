<?php


namespace Siarko\mainContext;


use Siarko\io\Console;
use Siarko\paradigm\Singleton;
use Siarko\tab\tabController\TabController;

/**
 * @method static self get()
 * */
class MainContext
{

    use Singleton;

    private $tabController = null;

    private function __construct()
    {
        Console::get()->setPosition(0,0);
        $this->tabController = new TabController();
    }

    public function update(){
        $this->tabController->update();
    }

    public function receiveKeyUp($keyCode, $key){
        if($key == 'q'){
            exit();
        }
        $this->tabController->onKeyUp($keyCode, $key);
    }

}