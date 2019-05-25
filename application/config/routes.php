<?php
    return  [
        
        // Группа маршрутов авторизации
        'account/login#'     => [ 
            'controller'    => 'account',
            'action'        => 'login'
        ],
        
        'account/register#'  => [
            'controller'    => 'account',
            'action'        => 'register'
        ],



        
        // Группа маршрутов для личной страницы
        'user$#'  => [
            'controller'    => 'user',
            'action'        => 'index'
        ],
        
        'user/student#'  => [
            'controller'    => 'user',
            'action'        => 'student'
        ],
        
        'user/create#'     => [
            'controller'    => 'user',      //??
            'action'        => 'create'
        ],
        
        'user/setting#'      => [
            'controller'    => 'user',
            'action'        => 'setting'
        ],
        
        
        // Главная страница
        '$#'      => [
            'controller'    => 'main',
            'action'        => 'index'
        ],
    ];