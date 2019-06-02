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

        // Определяем группу пользователей
        $rules          = self::checkAr();      


        // Проверка на ошибки (отсутствие такой группы пользователец)
        // @return string;
        if (!$rules) {
            return '404';
        }
        

        // Если АС, ПД, ?К
        // существует авторизированная сессия
        // права доступа - true
        // уставнавливаем cookie
        // @return bool
        else if ($rules === 'auth') {
            self::setCookie();
            return "A";
        }
        

        // !АС, ПД, ?К 
        // отсутствует авторизированная сессия
        // права доступа - true
        else if ($rules === 'guest') {            
            // проверка cookie 
            // @return Location
            if (self::checkCookie()) {
                echo header("location: /user/rasp");
                exit;
            }

            // @return string
            else {
                return "NA";
            } 
        }
        

        // !АС, !ПД, ?К
        // отсутствует авторизированная сессия
        // права доступа - false 
        else if ($rules === 'guestNA') {            
            // проверка cookie
            // @return bool
            if (self::checkCookie()) {
                return "NA";
            }

            // @return location
            else {
                echo header("Location: /account/login");
            }
        } 
        
        
        // для группы пользователей "All"
        // @return bool
        else if ($rules == true)
            return "all";
    }
    
    
    // Проверка групп пользователей
    // на текущую страницу
    public static function checkAr()
    {
        self::$ar   = require 'application/ar/' . self::$route['controller'] . '.php';
        
        // Права для "всех"
        // @return bool
        if (self::Ar('all')) {
            return true;
        }
        
        // Права для атворизированных 
        // на "своей" странице
        // @return string
        if ( !(empty($_SESSION['authorize'])) and 
        (self::Ar('authorize')) ) {    
            return 'auth';
        }
        
        // Права для авторизированных
        // но находящихся не на "своей" странице 
        elseif ( !(empty($_SESSION['authorize'])) and 
        !(self::Ar('authorize')) ) {
            header("location: /user/rasp");
            exit;
        }
        
        // Права доступа для неавторизованных
        // на "своей" странице
        // @return string
        elseif ( empty($_SESSION['authorize']) and self::Ar('guest') ) {
            return 'guest';
        }
        
        // Права доступа для неавторизованных
        // не на "своей" странице
        // @return string
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


    // Установка cookie для текущей страницы
    public static function setCookie()
    {
        // Проверка на наличие авторизации
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
                
                $_SESSION['login_user'] = $_COOKIE['id'];
                $_SESSION['authorize']  = true;

                return true;
            }
            // Иначе возврат false
            else return false;
        }
        else return false;
    }

    // ??
    // Получение id // 
    public static function getId()
    {
        $db = new Db;

        return $db->row("SELECT ID FROM teach_id WHERE login=:login",
        array('login'   => $_SESSION['login_user']));
    }
 
}