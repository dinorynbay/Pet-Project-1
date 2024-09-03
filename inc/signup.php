<?php
session_start();
require_once 'connect.php';

$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$profile_photo = $_POST['profile_photo'];
$user_type = $_POST['user_type'];

if (empty($surname) || empty($name) || 
    empty($patronymic) || empty($login) || 
    empty($email) || empty($password) || 
    empty($password_confirm) || 
    empty($user_type)) {
    $_SESSION['message'] = 'Заполните все поля';
    header('Location: ../registration.php');
    exit(); 
}

if (empty($_FILES['profile_photo']['name']) || !is_uploaded_file($_FILES['profile_photo']['tmp_name'])) {
    $_SESSION['message'] = 'Файл профиля не загружен';
    header('Location: ../registration.php');
    exit();
}

$select = " SELECT * FROM registered_users WHERE `login` = '$login' ";
$result = mysqli_query($connect, $select);
if (mysqli_num_rows($result) > 0) { 
    $_SESSION['message'] = 'Такой логин существует';
    header('Location: ../registration.php');
}
else{
    if ($password === $password_confirm) {
        $path = 'uploads/' . time() . $_FILES['profile_photo']['name'];
    
        if (!move_uploaded_file($_FILES['profile_photo']['tmp_name'], '../' . $path)) {
            $_SESSION['message'] = 'Ошибка при загрузке картинки';
            header('Location: ../registration.php');
        }
    
        $password = md5($password);

        mysqli_query($connect, "INSERT INTO `registered_users` 
        (`id`, `surname`, `name`, `patronymic`, `login`, `email`, `password`,
         `profile_photo`,`user_type`) VALUES (NULL, '$surname', '$name', '$patronymic', '$login',
          '$email', '$password', '$path','$user_type')");
          $_SESSION["id"] = "$id";
        // mysqli_query($connect,"INSERT INTO `test` (`level`,`registered_users_id`) VALUES ('',)");
        $_SESSION['message'] = 'Успешная регистрация!';
        header('Location: ../authorization.php');
    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../registration.php');
    }
}

