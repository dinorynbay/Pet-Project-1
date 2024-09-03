<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['admin']);
setcookie('user_level', '', time() - 3600, '/'); 
header('Location: ../index.php');
