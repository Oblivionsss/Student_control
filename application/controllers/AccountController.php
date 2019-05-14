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

            if ($result != '')
                $this->view->message($result, " q");

            else {
                // здесь нужно записать куки
                // записать сессию
                // редирект на личную страницу:
                // $this->view->location("!!");
                $this->view->message("Успешно авторизированы!", " q");
            }    

            exit;
        }
        
        $this->view->render('Страница авторизации');
    }


    public function registerAction()
    {
        // // При передаче ajaxom второй метод обязателен!!
        if (!empty($_POST)) {
            $result = Validation::checkPost("regist");
            
            if ($result != '')
                $this->view->message("$result", " q");

            else {
                $check   = $this->model->addNewUser();
                // здесь нужно записать куки
                // записать сессию
                // редирект на личную страницу:
                // $this->view->location("!!");
                $this->view->message("Успешно зарегестрированы!", " q");
            }            
            // $this->view->message("Успешно зарегестрированы!", "");
            exit;
        }

        $this->view->render('Страница регистрации');
    }

}