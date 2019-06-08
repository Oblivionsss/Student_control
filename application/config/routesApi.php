<?php
    return  [

        // Группа маршрутов API-Модуля
        'api/disc#'     => [
            'controller'    => 'DisciplyneApi',
            'model'         => 'Disciplyne'
        ],

        'api/groups_disc_info#'    => [
            'controller'    => 'GroupsDiscInfoApi',
            'model'         => 'GroupsDiscInfo'
        ],
        
        'api/groups_disc#'    => [
            'controller'    => 'GroupsDiscApi',
            'model'         => 'GroupsDisc'
        ],

        'api/groups#'   => [
            'controller'    => 'GroupsApi',
            'model'         => 'Groups'
        ],


            
        
        'api/studentControl#'   => [
            'controller'    => 'StudentControlApi',
            'model'         => 'StudentControl'
        ],

        'api/student#'  => [
            'controller'    => 'StudentApi',
            'model'         => 'Student'
        ],
        

        'api/users_info#'   => [
            'controller'    => 'UsersInfoApi',
            'model'         => 'UsersInfo'
        ]

    ];