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
        $taskModel = new Task();
        
        $pendingTasks = $taskModel->fetchByStatus("pending");
    
        $inProgressTasks = $taskModel->fetchByStatus("in_progress");
        $doneTasks = $taskModel->fetchByStatus("done");
    
        $this->view->pendingTasks = $pendingTasks;
        $this->view->inProgressTasks = $inProgressTasks;
        $this->view->doneTasks = $doneTasks;
    }

    public function addAction(){
        if ($this->getRequest()->isPost()) {
            $data = array(
                'title' => $this->_getParam('new_task'),
                'user_id' => $_SESSION['user']->id,
                'user_name' => $_SESSION['user']->name,
                'status' => 'pending' 
            );
            
            $taskId = $this->_taskModel->save($data);
                
            header('Location: ' . $this->_baseUrl() . '/tasks');
                exit;
            
        }
    }

}