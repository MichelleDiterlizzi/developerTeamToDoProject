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
    
    public function save($data){

            $data['id'] = uniqid();
            $this->_data[] = $data;
            $this->_saveData();
            return $data['id'];
    }

    public function fetchOne($id){

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

    public function update($id, $updateData){
        $taskUpdated = false;
        foreach ($this->_data as $key => $item) {
            if ($item['id'] == $id) { 
                
                foreach ($updateData as $field => $value) {
                    
                    if ($field !== 'id') { 
                        $this->_data[$key][$field] = $value;
                    }
                }
                $taskUpdated = true;
                break; 
            }
        }

        if ($taskUpdated) {
            $this->_saveData();
        }
        
        return $taskUpdated; 
    }

}

