<?php

namespace application\controllers;

use application\core\Controller;
use application\core\Cookie;

use application\lib\Validation;
use application\lib\Hash;


class AccountController extends Controller
{
    public function loginAction()
    {
        if (!empty($_POST)) {
            $result = Validation::checkPost("auth");

            if ($result != '')
                $this->view->message($result, " qq");

            else {
                if (!$this->authen()) {           
                    $this->view->message("Ошибка переадресации, извините за временные неудобства", " q");
                }
            }   

            exit;
        }
        

        $this->view->render('Страница авторизации');
    }


    public function registerAction()
    {
 
        if (!empty($_POST)) {
            $result = Validation::checkPost("regist");
            
            if ($result != '')
                $this->view->message($result, " qq");

            else {
                $check   = $this->model->addNewUser();
                
                if (!$this->authen()) {           
                    $this->view->message("Ошибка переадресации, извините за временные неудобства", " q");
                }
            }            
            exit;
        }
        
        $this->view->render('Страница регистрации');
    }

    
    public function authen() {
        if ($_POST['login']) {    
            
            $_SESSION['login_user']  = $_POST['login'];
            $_SESSION['authorize']   = true;

            $this->view->location('/user');
            exit;
        }

        else return false;
    }

}