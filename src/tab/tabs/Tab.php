<?php


namespace Siarko\tab\tabs;


use Siarko\io\inputMethods\InputField;

class Tab
{

    private $title = 'New tab';

    private $pageUrlInput = null;

    public function __construct()
    {
        $this->pageUrlInput = new InputField();
    }

    public function update(){
        echo "Tab update";

    }

    public function keyUp($keyCode, $key){
        $this->pageUrlInput->handleInput($keyCode, $key);
        if($key == 'g'){
            $this->pageUrlInput->setActive();
        }
    }
}