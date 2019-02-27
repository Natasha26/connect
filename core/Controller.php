<?php
class Controller 
{   
    protected $controllerID;
    protected $actionID;
    protected $view;
    protected $content;
    protected $messages = [];
    protected $flashMessages = [];
    protected $breadcrumbs = [];
    protected $admin;
    
    public function __construct($controllerID, $actionID, $admin) 
    {
        $this->controllerID = $controllerID;
        $this->actionID = $actionID;
        $this->admin = $admin;
        $this->admin = (isset($_SESSION['admin'])) ? $_SESSION['admin'] : false;
        $this->flashMessages = (!empty($_SESSION['flash'])) ? $_SESSION['flash'] : [];
        $_SESSION['flash'] = [];

    }
    
    public function render($template, $params = [])
    {
        $this->view = new View('index');
        $this->content = (new View($this->controllerID . '/' . $template, $params))->getHTML(); 
        $this->view->setParam('content', $this->content);
        $this->view->setParam('admin', $this->admin);
        $this->view->setParam('title', $this->title);
        $this->view->setParam('messages', $this->messages);
        $this->view->setParam('flashMessages', $this->flashMessages);
        $this->view->setParam('breadcrumbs', $this->breadcrumbs);
        $this->view->render();
    }
}
