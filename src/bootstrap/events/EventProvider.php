<?php


namespace Siarko\bootstrap\events;


interface EventProvider
{
    /**
     * @return EventData
     */
    function getDataObject();


}