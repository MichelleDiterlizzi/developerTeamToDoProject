<?php

$routes = array(

    '/login' => 'auth#login',
    '/register' => 'auth#register',
    '/logout' => 'auth#logout',
    
    '/task/show' => 'task#show',
    '/tasks' => 'task#index', 
    '/task/findTasks' => 'task#findTasks',
    '/task/add' => 'task#add',
    '/task/delete' => 'task#delete',
    '/task/move' => 'task#move', 
    '/task/edit' => 'task#editTask',

    '/' => 'auth#login'
);
