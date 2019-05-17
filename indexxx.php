<?php
session_start();

if (empty($_SESSION)) {
    echo "Сессия пуста";
    $_SESSION['count'] = 0;
}
else {
    echo $_SESSION['goo'];
    $_SESSION['goo']++;
}