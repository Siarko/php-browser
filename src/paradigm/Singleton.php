<?php


namespace Siarko\paradigm;


trait Singleton
{
    /* @var static */
    protected static $instance = null;

    public static function get(){
        if(static::$instance === null){
            static::$instance = new static();
        }
        return static::$instance;
    }

    public static function _initialized(){
        return (static::$instance != null);
    }

}