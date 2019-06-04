<?php

namespace application\controllers;
use application\core\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        if ( isset($_POST['addRasp']) ) {
            $this->view->message($this->model->addRasp(),'qq');
        }

        // test consctruct for view-user-info
        $result = $this->model->getUserInfo($_SESSION['login_user']);
        
        // $result1    = $this->model->getUniqGroupsInfo();
        
        $vars   = [
            'user'  => $result
        ];
        $this->view->render('Расписание', $vars);
        
    }   


    public function createAction() {

        if (isset($_POST['discgroup'])) {
            // echo $this->model->addDiscGroup();
            $this->view->message($this->model->addDiscGroup(), " q");
            exit;
        }
        

        $result     = $this->model->getUserInfo($_SESSION['login_user']);
        $result_1   = $this->model->getGroupsInfo(); 
        $result_2   = $this->model->getDiscInfo();
        $vars   = [
            'user'  => $result,
            'groups'=> $result_1,
            'disc'  => $result_2
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
        
        if (isset($_GET['updateDate'])) {
            $date   = $this->model->getData();
            $allDate= $this->model->getAllData($date);
            $this->view->updateDateTableStudent($allDate);
        }

        if ( isset($_GET['group_id']) && isset($_GET['disc_id']) ) {
            // $data = $this->model->getData();
            
            // if ($data === false) {
            //     $this->view->message("Отсутствуют данные, пожалуйста, добавьте расписание!", 'qq');
            // }

            $list_student = $this->model->getListStud($_GET['group_id'], $_GET['disc_id'] );
  
            $this->view->updateTableStudentList($list_student);
        }

        if ( isset($_GET['group_id']) ) {
            $this->view->selectUpdate($this->model->getUniqDiscInfo($_GET['group_id']));
        }
        
        
        $result = $this->model->getUserInfo($_SESSION['login_user']);
        $result1    = $this->model->getUniqGroupsInfo();

        $vars   = [
            'user'  => $result,
            'groups'=> $result1
        ];

        $this->view->render('Студенты', $vars);
    }
}