<?php
session_start();
require_once 'connect.php';

if (isset($_COOKIE['user_grade'])) {
    $lessonString = $_COOKIE['user_lesson'];
    setcookie('user_lesson', '', time() - 3600, '/'); 
    $grade = $_COOKIE['user_grade'];

    $id = $_SESSION['user']['id'];
    echo "Оценка: " . $grade;
    echo $_SESSION['user']['id'];
    $query = "INSERT INTO `results`(`grade`, `completed_date`, `lesson`, `registered_users_id`) VALUES ('$grade', NOW(), '$lessonString', '$id')";
    if (mysqli_query($connect, $query)) {
        echo "Данные успешно обновлены в базе данных.";

        header('Location: ../Grammar_course.php');
    } else {
        echo "Ошибка при обновлении данных в базе данных: " . mysqli_error($connect);
    }
    // Здесь можно выполнить дополнительные действия с полученным уровнем
} else {
    echo "Уровень не найден в cookie.";
}
