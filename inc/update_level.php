<?php
session_start();
require_once 'connect.php';

if (isset($_COOKIE['user_level'])) {
    $level = $_COOKIE['user_level'];

    $id = $_SESSION['user']['id'];
    echo "Уровень пользователя: " . $level;
    echo $_SESSION['user']['id'];
    echo $_COOKIE['user_level'];
    $query = "UPDATE registered_users SET level='$level' WHERE id=$id";
    if (mysqli_query($connect, $query)) {
        echo "Данные успешно обновлены в базе данных.";
        $level_query = "SELECT level FROM registered_users WHERE id=$id";
        $result = mysqli_query($connect, $level_query);
        $row = mysqli_fetch_assoc($result);
        $new_level = $row['level'];

        $_SESSION['user']['level'] = $new_level;
        header('Location: ../registered_profile.php');
    } else {
        echo "Ошибка при обновлении данных в базе данных: " . mysqli_error($connect);
    }
} else {
    echo "Уровень не найден в cookie.";
}
