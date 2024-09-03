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
    <article class="card-container">
        <div class="card">
            <h2>1. Регистрация</h2>
            <hr>
            <p>Зарегестрируйте пользователя.</p>
        </div>
        <div class="card">
            <h2>2. Авторизация</h2>
            <hr>
            <p>Авторизация для дальнейшего использования.</p>
        </div>
        <div class="card">
            <h2>3. Тест</h2>
            <hr>
            <p>Для определения уровня английского.</p>
        </div>
        <div class="card">
            <h2>4. Уроки</h2>
            <hr>
            <p>Уроки для изучения английского языка.</p>
        </div>
        <div class="card">
            <h2>5. Словарь</h2>
            <hr>
            <p>Словарь для поиска слов.</p>
        </div>
        <div class="card">
            <h2>6. Видеоролики</h2>
            <hr>
            <p>Видеоролики под определенный уровень</p>
        </div>
    </article>

    

</body>

</html>