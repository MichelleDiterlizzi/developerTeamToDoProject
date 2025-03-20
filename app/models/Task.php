<?php

class Task {
    protected $_jsonFile = "tasks.json";
    protected $_data = array();
    
    public function __construct(){
        $this->_loadData();
    }
    
    protected function _loadData(){
        $content = file_get_contents(ROOT_PATH . '/database/' . $this->_jsonFile);
        $this->_data = json_decode($content, true); 
        
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
        if (isset($data['id'])) {
            foreach ($this->_data as $key => $item) {
                if ($item['id'] == $data['id']) {
                    foreach ($data as $prop => $value) {
                        $this->_data[$key][$prop] = $value;
                    }
                    
                    $this->_saveData();
                    return $data['id'];
                }
            }
            return false;
        } 
        else {
            $data['id'] = uniqid();
            
            $this->_data[] = $data;
            
            $this->_saveData();
            return $data['id'];
        }
    }

    public function fetchOne($id)
    {
        foreach ($this->_data as $item) {
            if ($item['id'] == $id) { 
                return $item;
            }
        }
        
    }

    public function delete($id){
        
        foreach ($this->_data as $key => $item) {
            if ($item['id'] == $id) {

                unset($this->_data[$key]);
                
                $this->_data = array_values($this->_data);
                
                $this->_saveData();
                return true;
            }
        }
        
        return false;
    }

    public function fetchByTaskTitle($taskTitle){

        return array_filter($this->_data, function($task) use ($taskTitle) {
            return $task['title'] === $taskTitle;
        });
    }

}