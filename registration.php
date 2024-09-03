<?php
session_start();
if ($_SESSION['user']) {
    header('Location: registered_profile.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index_styles.css">
</head>

<body>
    <?php require_once 'layout/header.php' ?>


    <form action="inc/signup.php" method="post" class="registration" enctype="multipart/form-data">
        <label for="">Фамилия</label>
        <input type="text" name="surname">
        <label for="">Имя</label>
        <input type="text" name="name">
        <label for="">Отчество</label>
        <input type="text" name="patronymic">
        <label for="">Логин</label>
        <input type="text" name="login" id="">
        <label for="">Электронный адрес</label>
        <input type="email" name="email">
        <label for="">Изображение вашего профиля</label>
        <input type="file" name="profile_photo" id="">
        <select name="user_type" id="user_type">
            <option value="user">Ученик</option>
            <option value="admin">Преподаватель</option>
            </select>
        <label for="">Пароль</label>
        <input type="password" name="password">
        <label for="">Подтверждение пароля</label>
        <input type="password" name="password_confirm">
        <button type="submit">Зарегистрироваться</button>
        <p>
            Если у вас уже есть аккаунт - <a href="authorization.php">авторизируйтесь.</a>
        </p>
        <?php
        if ($_SESSION['message']) {
            echo '<p class="msg">' . $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message'])
        ?>
    </form>
</body>

</html>