<?php


namespace Siarko\io\stream;


class Input
{

    private $stream = null;

    /* @var $buffer mixed */
    private $buffer = false;

    public function __construct()
    {
        system(
            'stty cbreak -echo'
        );
        stream_set_blocking(STDIN, 0);
        $this->stream = STDIN;
    }

    public function isBufferEmpty()
    {
        $this->readString();
        return ($this->buffer === false);
    }

    public function getBufferContent()
    {
        $c = $this->buffer;
        $this->buffer = false;
        return $c;
    }

    private function readString()
    {
        $read = array($this->stream);
        $write = array();
        $except = array();
        $result = stream_select($read, $write, $except, 0);
        if ($result === false) throw new Exception('stream_select failed');
        if ($result === 0) {
            $this->buffer = false;
            return;
        }
        $this->buffer = fgets($this->stream);
    }

    public function close()
    {
        system(
            'stty -cbreak echo'
        );
        fclose($this->stream);
    }

}