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

    public function moveAction(){
        
    $id = $this->_getParam('id');
    $status = $this->_getParam('status');

    $task = $this->_taskModel->fetchOne($id);
    
    $data = array(
        'id' => $id,
        'status' => $status
    );
    
    $currentTime = date('Y-m-d H:i:s');
    
    if ($status === 'in_progress' && $task['status'] === 'pending') {
        $data['created_at'] = $currentTime;
    }
    else if ($status === 'done' && $task['status'] === 'in_progress') {
        $data['finished_at'] = $currentTime;
    }
    
    $result = $this->_taskModel->save($data);
    
    header('Location: ' . $this->_baseUrl() . '/tasks');
    exit;
    }

}