<?php

class AuthController extends Controller{

    protected $_userModel;
    
    public function init()
    {
        parent::init();
        $this->_userModel = new User();
    }
    
    public function loginAction(){
        
        if (isset($_SESSION['user'])) {
            header('Location: ' . $this->_baseUrl() . '/tasks');
            exit;
        }
        
        if ($this->getRequest()->isPost()) {
            $email = $this->_getParam('email');
            $password = $this->_getParam('password');
            
            $user = $this->_userModel->authenticate($email, $password);
            
            if ($user) {

                $_SESSION['user'] = $user;
                
                header('Location: ' . $this->_baseUrl() . '/tasks');
                exit;
                
            } else {
                $this->view->error = 'Email o password incorrectas';
            }
        }
    }


}