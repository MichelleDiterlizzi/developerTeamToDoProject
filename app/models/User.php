<?php

class User {
    protected $_jsonFile = "users.json";
    protected $_data = array();
    
    public function __construct(){
        $this->_loadData();
    }

    protected function _loadData(){
        
        $content = file_get_contents(ROOT_PATH . '/database/' . $this->_jsonFile);
        $this->_data = json_decode($content,true);
        
        if (!is_array($this->_data)) {
            $this->_data = array();
        }
    }

    
}