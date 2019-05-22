<?php

namespace application\controllers;
use application\core\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        // test consctruct for view-user-info
        $result = $this->model->getUserInfo($_SESSION['login_user']);
        $vars   = [
            'user'  => $result,
        ];
        $this->view->render('Расписание', $vars);
    }   


    public function createAction() {

        if (isset($_POST['disc'])) {
            $this->view->message($this->model->addDisc('disc'), " q");
            exit;
        }

        if (isset($_POST['group'])) {
            echo $this->model->addGroup('group');
            // $this->view->message($this->model->addGroup('group'), " q");
            exit;
        }



        $result = $this->model->getUserInfo($_SESSION['login_user']);
        $vars   = [
            'user'  => $result,
        ];

        $this->view->render('Редактор', $vars);
    }


    public function settingAction() {
        $result = $this->model->getUserInfo($_SESSION['login_user']);
        $vars   = [
            'user'  => $result,
        ];
        $this->view->render('Настройки', $vars);
    }
    
    
    public function studentAction() {
        $result = $this->model->getUserInfo($_SESSION['login_user']);
        $vars   = [
            'user'  => $result,
        ];
        $this->view->render('Студенты', $vars);
    }
}