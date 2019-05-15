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
                
                $currentLogin = Validation::$currentLogin;
                
                if (Cookie::setCookie(Hash::hash(Cookie::generateSalt()), $currentLogin)) {
                    //
                
                    session_start();
                    $_SESSION['login']  = $currentLogin;
                    $_SESSION['auth']   = true;

                    $this->view->location('/user');
                    exit;
                }

                $this->view->message("Ошибка переадресации, извините за временные неудобства", " q");
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
                // здесь нужно записать куки
                // записать сессию
                // редирект на личную страницу:
                // $this->view->location("!!");
                $this->view->message("Успешно зарегестрированы!", " qq");
            }            
            // $this->view->message("Успешно зарегестрированы!", "");
            exit;
        }

        $this->view->render('Страница регистрации');
    }

}