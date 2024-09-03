<?php
session_start();
require_once 'connect.php';




$login = $_POST['login'];
$password = md5($_POST['password']);
$user_type = $_POST['user_type'];
// $check_user_query = "SELECT ru.*, t.level 
//                      FROM registered_users ru 
//                      JOIN test t ON ru.id = t.registered_users_id 
//                      WHERE ru.login = '$login' AND ru.password = '$password' 
//                      ORDER BY t.test_completed_date DESC 
//                      LIMIT 1";

//$check_user_query = "SELECT * FROM `registered_users` AS ru JOIN test AS t ON ru.id = t.registered_users_id WHERE ru.login = '$login' AND ru.password = '$password'  OR t.level IS NULL ";
$check_user = mysqli_query($connect, "SELECT * FROM `registered_users` WHERE `login` = '$login' AND `password` = '$password'");
               
// $check_user = mysqli_query($connect, $check_user_query);

// $check_user = mysqli_query($connect, "SELECT * FROM `registered_users` WHERE `login` = '$login' AND `password` = '$password'");

if (mysqli_num_rows($check_user) > 0) {

    $user = mysqli_fetch_assoc($check_user);
    if($user['user_type'] == 'admin'){

        $_SESSION['admin'] = [
            "id" => $user['id'],
            "surname" => $user['surname'],
            "name" => $user['name'],
            "patronymic" => $user['patronymic'],
            "profile_photo" => $user['profile_photo'],
            "email" => $user['email'],
            "level" => $user['level']
        ];
        header('location: ../registered_admin.php');

     }elseif($user['user_type'] == 'user'){

        $_SESSION['user'] = [
            "id" => $user['id'],
            "surname" => $user['surname'],
            "name" => $user['name'],
            "patronymic" => $user['patronymic'],
            "profile_photo" => $user['profile_photo'],
            "email" => $user['email'],
            "level" => $user['level']
        ];
        header('Location: ../registered_profile.php');

     }
    
} else {
    $_SESSION['message'] = 'Неверный логин или пароль';
    header('Location: ../authorization.php');
}
