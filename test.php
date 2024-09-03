<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/registered_styles.css">
</head>

<body>
    <?php require_once 'layout/registered_header.php' ?>

    <div class="application">
        <h1>Тест на определение уровня. 20 вопросов.</h1>
        <div class="questionnaire">
            <h2 id="question"></h2>
            <div id="answer-options">
                <button class="response"></button>
                <button class="response"></button>
                <button class="response"></button>
                <button class="response"></button>
            </div>
            <button id="next-question-btn"></button>
            <button id="finish-quiz-btn">Закончить</button>
        </div>
    </div>
    <script src="js/test_script.js"></script>

</body>

</html>