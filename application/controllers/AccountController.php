<?php

namespace application\controllers;
use application\core\Controller;

class AccountController extends Controller
{
    public function loginAction()
    {
        // if (!empty($_POST)) {
            // $this->view->message("Добро Пожаловать!", "..");
        // }
        $this->view->render('Страница авторизации');
    }

    public function registerAction()
    {
        $this->view->render('Страница регистрации');
    }
}