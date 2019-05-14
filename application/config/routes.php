<?php
    return  [
        
        'account/login' => [ 
            'controller'    => 'account',
            'action'        => 'login'
        ],
        
        'account/register' => [
            'controller'    => 'account',
            'action'        => 'register'
        ],

        '' => [
            'controller'    => 'main',
            'action'        => 'index'
        ],

        'user' => [
            'controller'    => 'user',
            'action'        => 'index'
        ]
    ];