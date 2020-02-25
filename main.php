<?php
declare(ticks = 1);

require_once "vendor/autoload.php";

$b = 0;

$bootstrap = new \Siarko\bootstrap\Bootstrap();
$bootstrap->setProcess(function() use (&$b){
    echo (".");
    usleep(10000);
}, \Siarko\bootstrap\events\Events::IDLE);
$bootstrap->setProcess(function($keyCode, $key) use (&$b){
    $b = 0;
    echo "\nKey ".$key."\n";
    if($key == "q"){
        exit(0);
    }
}, \Siarko\bootstrap\events\Events::KEYUP);
$bootstrap->addEventProvider(\Siarko\io\Keyboard::init());
//$bootstrap->run();
//\Siarko\io\Console::get()->updateScreenSize();
\Siarko\io\Console::get();
\Siarko\io\Console::setPosition(0,0);
echo("Hello world");
\Siarko\io\Console::setPosition(10,10);
echo "Hello 2";
sleep(2);



