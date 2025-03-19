<?php

class TaskController extends Controller{
    protected $_taskModel;

    public function init()
    {
        parent::init();
        $this->_taskModel = new Task();
        
        // Verificar si el usuario está logueado
        if (!isset($_SESSION['user'])) {
            header('Location: ' . $this->_baseUrl() . '/login');
            exit;
        }
        
        // Pasar datos del usuario a la vista
        $this->view->user = $_SESSION['user'];
    }
    

    public function indexAction(){
    }

}