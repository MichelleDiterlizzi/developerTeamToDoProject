<?php

class Task {
    protected $_jsonFile = "tasks.json";
    protected $_data = array();
    
    public function __construct(){
        $this->_loadData();
    }
    
    protected function _loadData(){
        $content = file_get_contents(ROOT_PATH . '/database/' . $this->_jsonFile);
        $this->_data = json_decode($content, true); // Esto lo convierte en array
        
        if (!is_array($this->_data)) {
            $this->_data = array();
        }
    }

    public function fetchByStatus($status)
    {
        return array_filter($this->_data, function($task) use ($status) {
            return $task['status'] === $status;
        });
    }

    protected function _saveData()
    {
        file_put_contents(
            ROOT_PATH . '/database/' . $this->_jsonFile,
            json_encode($this->_data, JSON_PRETTY_PRINT)
        );
    }
    
    public function save($data = array()){

        $data['id'] = uniqid();
            
        $this->_data[] = $data;
            
        $this->_saveData();
        return $data['id'];
        
    }

}