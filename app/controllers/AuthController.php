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

    public function registerAction(){

       
        if (isset($_SESSION['user'])) {
            header('Location: ' . $this->_baseUrl() . '/tasks');
            exit;
        }
        
        
        if ($this->getRequest()->isPost()) {
            $data = array(
                'name' => $this->_getParam('user_name'),
                'email' => $this->_getParam('email'),
                'password' => password_hash($this->_getParam('password'), PASSWORD_DEFAULT),
            );
            
            
            if ($this->_userModel->findByEmail($data['email'])) {
                $this->view->error = 'El correo ya está registrado';
            } 
            else if ($this->_getParam('password') !== $this->_getParam('confirm_password')){
                $this->view->error = 'Las dos passwords no coinciden';
            }
            else if (empty($data['name']) || empty($data['email']) || empty($this->_getParam('password'))) {
                $this->view->error = 'Todos los campos son obligatorios';
            } else {
                
                $userId = $this->_userModel->save($data);
                
                header('Location: ' . $this->_baseUrl() . '/login');
            }
        }
    }

    public function logoutAction(){
        session_destroy();
        
        header('Location: ' . $this->_baseUrl() . '/login');
        exit;
    }

}