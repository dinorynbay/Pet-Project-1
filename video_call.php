<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Document</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/video_call.css'>
    <link rel="stylesheet" href="css/registered_styles.css">
</head>

<body>
   <?php require_once 'layout/registered_header.php' ?>
    <button id="join-btn">Присоединиться</button>

    <div id="stream-wrapper">
        <div id="video-streams"></div>

        <div id="stream-controls">
            <button id="leave-btn">Выйти</button>
            <button id="mic-btn">Включен микрофон</button>
            <button id="camera-btn">Включена камера</button>
        </div>
    </div>

</body>
<script src="js/AgoraRTC_N-4.20.2.js"></script>
<script src='js/video_call.js'></script>

</html>