<?php
declare(ticks = 1);

use Siarko\bootstrap\Bootstrap;
use Siarko\bootstrap\events\Events;
use Siarko\io\Keyboard;
use Siarko\tab\tabController\TabController;

if(!file_exists('vendor')){
    echo "No vendor directory detected! Run 'composer install'.";
    exit(1);
}

require_once "vendor/autoload.php";

$bootstrap = new Bootstrap();
$bootstrap->setProcess(function() {
    \Siarko\mainContext\MainContext::get()->update();
}, Events::IDLE);
$bootstrap->setProcess(function($keyCode, $key) {
    \Siarko\mainContext\MainContext::get()->receiveKeyUp($keyCode, $key);
}, Events::KEYUP);
$bootstrap->addEventProvider(Keyboard::init());
$bootstrap->run();
