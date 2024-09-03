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

    <form action="inc/signin.php" method="post" class="authorization">
        <label for="">Логин</label>
        <input type="text" name="login">
        <label for="">Пароль</label>
        <input type="password" name="password">
        <button type="submit">Войти</button>
        <p>
            Если у вас нету аккаунта - <a href="registration.php">зарегестрируйтесь.</a>
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