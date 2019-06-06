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
            'user'  => $result
        ];
        $this->view->render('Расписание', $vars);
        
    }   


    public function createAction() 
    {
        $result     = $this->model->getUserInfo($_SESSION['login_user']);

        $vars   = [
            'user'  => $result
        ];

        $this->view->render('Редактор', $vars);
    }


    // Редактор личных данных 
    public function settingAction() {
        $result     = $this->model->getUserInfo($_SESSION['login_user']);

        $vars       = [
            'user'  => $result
        ];
        $this->view->render('Настройки', $vars);
    }
    
    
    public function studentAction() {
        
        // if (isset($_GET['updateDate'])) {
        //     $date   = $this->model->getData();
        //     $allDate= $this->model->getAllData($date);
        //     $this->view->updateDateTableStudent($allDate);
        // }

        // if ( isset($_GET['group_id']) && isset($_GET['disc_id']) ) {
        //     // $data = $this->model->getData();
            
        //     // if ($data === false) {
        //     //     $this->view->message("Отсутствуют данные, пожалуйста, добавьте расписание!", 'qq');
        //     // }

        //     $list_student = $this->model->getListStud($_GET['group_id'], $_GET['disc_id'] );
  
        //     $this->view->updateTableStudentList($list_student);
        // }

        // if ( isset($_GET['group_id']) ) {
        //     $this->view->selectUpdate($this->model->getUniqDiscInfo($_GET['group_id']));
        // }
        
        
        $result = $this->model->getUserInfo($_SESSION['login_user']);

        $vars   = [
            'user'  => $result
        ];

        $this->view->render('Студенты', $vars);
    }
}