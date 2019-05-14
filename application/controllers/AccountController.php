<?php

namespace application\controllers;
use application\core\Controller;
use application\lib\Validation;

class AccountController extends Controller
{
    public function loginAction()
    {
        if (!empty($_POST)) {
            $result = Validation::checkPost("auth");
            // require_once "application/lib/Validation.php";
            // $this->view->message("Привет", "Добро ");
            // echo "qq";
 
        }
        
        $this->view->render('Страница авторизации');
    }


    public function registerAction()
    {
        // При передаче ajaxom второй метод обязателен!!
        if (!empty($_POST)) {
            $result = Validation::checkPost("regist");
            
            if ($result != '')
                $this->view->message("Успешно зарегестрированы!", " у");
            
            else {
                $check   = $this->model->addNewUser();

                $this->view->message("Добавлен новый пользователь с id", $check);
            }
            
            
            // $this->view->message("Успешно зарегестрированы!", "");
            exit;
        }
        $this->view->render('Страница регистрации');
    }

}