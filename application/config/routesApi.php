<?php
    return  [

        // Группа маршрутов API-Модуля
        'api/disc#'     => [
            'controller'    => 'DisciplyneApi',
            'model'         => 'Disciplyne'
        ],

        'api/users/#'    => [
            'controller'    => 'UsersApi'
        ],

        'api/groups#'   => [
            'controller'    => 'GroupsApi'
        ],

        'api/student#'  => [
            'controller'    => 'StudentApi'
        ],
        
        'api/studentControl#'   => [
            'controller'    => 'StudentControlApi'
        ],

        'api/users_info#'   => [
            'controller'    => 'UsersInfoApi',
            'model'         => 'UsersInfo'
        ]

    ];