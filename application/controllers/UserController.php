<?php

namespace application\controllers;
use application\core\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        // test consctruct for view-user-info
        $result = $this->model->getUserInfo();
        $vars   = [
            'user'  => $result,
        ];

        $this->view->render('Страница пользователя', $vars);
    }
    
}