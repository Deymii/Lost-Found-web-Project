<?php
session_start();

session_unset();

session_destroy();

if (isset($_COOKIE['email'])) {
    setcookie('email', '', time() - 1);  
}
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 1);  
}
if (isset($_COOKIE['name'])) {
    setcookie('name', '', time() - 1);  
}


header("Location: index.php");
exit;
?>
