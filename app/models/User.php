<?php

class User {
    protected $_jsonFile = "users.json";
    protected $_data = array();
    
    public function __construct(){
        $this->_loadData();
    }

    protected function _loadData(){

        $content = file_get_contents(ROOT_PATH . '/database/' . $this->_jsonFile);
        $this->_data = json_decode($content);
        
        if (!is_array($this->_data)) {
            $this->_data = array();
        }
    }

    protected function _saveData(){
        file_put_contents(
            ROOT_PATH . '/database/' . $this->_jsonFile,
            json_encode($this->_data, JSON_PRETTY_PRINT)
        );
    }

    public function save($data = array()){
        
        $data = (object) $data;
        
        $data->id = uniqid();
            
        $this->_data[] = $data;
            
        $this->_saveData();
        return $data->id;
        
    }

    public function findByEmail($email){

        foreach ($this->_data as $user) {
            if ($user->email === $email) {
                return $user;
            }
        }
        
    }

    public function authenticate($email, $password)
    {
        $user = $this->findByEmail($email);
        
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        
    }

    
}