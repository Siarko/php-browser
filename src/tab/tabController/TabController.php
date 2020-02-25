<?php


namespace Siarko\tab\tabController;


use Siarko\tab\tabs\Tab;

class TabController
{
    private $tabs = [];
    private $activeTabId = null;

    private $firstUpdate = true;
    private $valid = false;

    public function newTab(Tab $tab){
        $this->tabs[] = $tab;
    }

    public function update(){
        if($this->firstUpdate){
            $this->initialize();
            $this->firstUpdate = false;
        }
        if(!$this->valid){
            $this->valid = true;
            $this->revalidate();
        }
    }

    public function onKeyUp($keyCode, $key){
        $activeTab = $this->getActiveTab();
        if($activeTab){
            $activeTab->keyUp($keyCode, $key);
        }
    }

    public function invalidate(){
        $this->valid = false;
    }

    private function revalidate(){
        $activeTab = $this->getActiveTab();
        if($activeTab){
            $activeTab->update();
        }
    }

    /**
     * @return Tab
     */
    public function getActiveTab(){
        return $this->tabs[$this->activeTabId];
    }

    private function initialize(){
        $tab = new Tab();
        $this->newTab($tab);
        $this->activeTabId = 0;
    }

}