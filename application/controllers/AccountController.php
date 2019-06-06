<?php

namespace application\controllers;

use application\core\Controller;

use application\lib\Validation;
use application\lib\Auth;

class AccountController extends Controller
{
    // Авторизация
    public function loginAction()
    {
        // Проерка входящих данных на наличие
        if (!empty($_POST)) {
            // Проверка входящих данных на валидацю
            $result = Validation::checkPost("auth");

            // Если проверка непустая
            if ($result != '')
                $this->view->message($result, 400);
            // Проверка прошла
            else {
                // Аутнетификация сессии
                if (!$this->authen()) {           
                    $this->view->message("Ошибка переадресации, извините за временные неудобства", 404);
                }
            }   
            exit;
        }
        
        // Шаблон страницы
        $this->view->render('Страница авторизации');
    }


    // Регистрация
    public function registerAction()
    {
        // Проверка на пустоту входящих данных 
        if (!empty($_POST)) {
            // Проверка на валидацию
            $result = Validation::checkPost("regist");
            
            // Если проверка непустая
            if ($result != '')
                $this->view->message($result, 400);
            
            // Проверка пустая
            else {
                $check   = $this->model->addNewUser();
                
                // Аутентификация сессии
                if (!$this->authen()) {           
                    $this->view->message("Ошибка переадресации, извините за временные неудобства", " q");
                }
            }            
            exit;
        }
        
        $this->view->render('Страница регистрации');
    }


    // Атуентификацмя сессии 
    public function authen() {
        if ($_POST['login']) {    
            
            $_SESSION['login_user']  = $_POST['login'];
            $_SESSION['authorize']   = true;
            $_SESSION['id']          = Auth::getId();
                    
            // Переадресация на личную страницу
            $this->view->location('/user/rasp');
            exit;
        }

        else return false;
    }

}