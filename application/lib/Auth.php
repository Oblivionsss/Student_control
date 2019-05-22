<?php

namespace application\lib;

use application\lib\Hash;
use application\lib\Db;

use application\core\Cookie;


// АС - авторизированная сессия
// ПД - есть права доступа на текущую страницу
// К  - есть куки

class Auth
{
    public static $ar;         // Массив с правами доступа
    public static $route;      // Текущий URI  
    
    public static function checkAuth($route) 
    {
        self::$route    = $route;
        $rules          = self::checkAr();      

        // Дополнительная проверка с куками
        // Сперва проверяем на ошибки
        if (!$rules) {
            return '404';
        }
        

        // Если АС, ПД, ?К
        else if ($rules === 'auth') {
            self::setCookie();
            return true;
        }
        

        // !АС, ПД, ?К 
        else if ($rules === 'guest') {
            
            if (self::checkCookie()) {
                echo header("location: /user");
                exit;
            }

            else {
                return true;
            } 
        }
        

        // !АС, !ПД, ?К
        else if ($rules === 'guestNA') {            
            
            if (self::checkCookie()) {
                return true;
            }

            else {
                echo header("Location: /account/login");
            }
        } 
        
        
        else if ($rules == true)
            return true;
    }
    
    
    // Проверка групп пользователей
    public static function checkAr()
    {
        self::$ar   = require 'application/ar/' . self::$route['controller'] . '.php';
        

        if (self::Ar('all')) {
            return true;
        }
        

        if ( !(empty($_SESSION['authorize'])) and 
        (self::Ar('authorize')) ) {    
            return 'auth';
        }
        

        elseif ( !(empty($_SESSION['authorize'])) and 
        !(self::Ar('authorize')) ) {
            header("location: /user");
            exit;
        }
        

        elseif ( empty($_SESSION['authorize']) and self::Ar('guest') ) {
            return 'guest';
        }
        

        elseif ( empty($_SESSION['authorize']) and !(self::Ar('guest')) ) {
            return 'guestNA';
        } 
          
        
        // elseif (isset($_SESSION['admin']) and $this->Ar('admin')) {
        // 	return true;
        // }
        

        return false;
    }


    // Проверка прав доступа
    // для текущей страницы
    public static function Ar($str)
    {
        return in_array(self::$route['action'], self::$ar[$str]);
    }  


    // Установка кук для текущей страницы
    public static function setCookie()
    {
        if ( !(empty($_SESSION['authorize'])) ) {
            Cookie::setCookie(Hash::hash(Cookie::generateSalt()), $_SESSION['login_user']);
            return true;
        }
        else return false;
    }


    // Проверка кук для текущей страницы
    public static function checkCookie()
    {
        if ( isset($_COOKIE['id']) and isset($_COOKIE['key']) ) {
            
            // Если куки сходятся
            // Прописываем сессию и возвращаем true
            if (Cookie::setCookie(Hash::hash(Cookie::generateSalt()), $_COOKIE['id'])) {
                // $result = $this->db->query("SELECT ID FROM teach_id 
                // WHERE login=:login",
                // array('login' => $_SESSION['login_user']));
                $_SESSION['login_user'] = $_COOKIE['id'];
                $_SESSION['authorize']  = true;
                // $_SESSION['id']         = $_result;
                return true;
            }

            // Иначе возврат false
            else return false;
        
        }
        else return false;
    }


    public static function getId()
    {
        $db = new Db;

        return $db->row("SELECT ID FROM teach_id WHERE login=:login",
        array('login'   => $_SESSION['login_user']));
    }
 
}