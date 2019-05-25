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
        var_dump($result_1);        
    }   


    public function createAction() {

        if (isset($_POST['disc'])) {
            $this->view->message($this->model->addDisc('disc'), " q");
            exit;
        }

        if (isset($_POST['group'])) {
            // echo $this->model->addGroup('group');
            $this->view->message($this->model->addGroup('group'), " q");
            exit;
        }

        if (isset($_POST['stud'])) {
            // echo $this->model->addStud();
            $this->view->message($this->model->addStud(), " q");
            exit;
        }

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


    public function settingAction() {
        $result     = $this->model->getUserInfo($_SESSION['login_user']);

        $vars       = [
            'user'  => $result
        ];
        $this->view->render('Настройки', $vars);
    }
    
    
    public function studentAction() {

        if ( isset($_GET['group_id']) ) {
            // echo header("Location: /user/setting");
            $this->view->selectUpdate($this->model->getUniqDiscInfo($_GET['group_id']));
            // echo $this->model->getUniqDiscInfo($_POST['group_id']);
            // echo "qq";
            // $this->view->selectUpdate(array());
            // echo'qq';
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