<?php


namespace Siarko\io\inputMethods;


use Siarko\io\Console;
use Siarko\io\Keyboard;
use Siarko\io\KeyCodes;

class InputField
{
    private $active = false;
    private $text = '';
    private $cursorPosition = 0;

    public function isActive(){
        return $this->active;
    }

    public function setActive($flag = true){
        $this->active = $flag;
    }

    public function handleInput($keyCode, $key){
        if(!$this->isActive()){ return; }
        if($keyCode == KeyCodes::BACKSPACE){
            $this->splice($this->cursorPosition-1, 1);
            $this->cursorPosition--;
        }else{
            $this->addChar($key);

        }

        Console::get()->setPosition(0,2);
        echo $this->text.'                                       ';
    }

    private function splice($start, $num){
        if($num == 0){ return; }
        $b = substr($this->text, 0, $start);
        $e = substr($this->text, $start+$num);
        $this->text = $b.$e;
    }

    private function addChar($char){
        $this->text .= $char;
        $this->cursorPosition++;
    }
}