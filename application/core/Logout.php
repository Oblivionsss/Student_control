<?php           // Страница сброса сессии
    session_start();

    destroy_session_and_data();     // Сброс сессии
    
    header("Location: ../../account/login");

    function destroy_session_and_data(){
        $_SESSION = array();
        if (session_id() != "" || isset($_COOKIE)) {
            setcookie('key', '', time() - 3600, '/');
            setcookie('id', '', time() - 3600, '/');
            unset ($_COOKIE['key']);
            unset ($_COOKIE['id']);
            session_destroy();

        }
    }
    exit;
?>