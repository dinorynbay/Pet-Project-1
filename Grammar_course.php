<?php

session_start();

if (!isset($_SESSION['user']['level']) || empty($_SESSION['user']['level'])) {
    header("Location: test.php");
    exit();
} else {
    $level = $_SESSION['user']['level'];
    switch ($level) {
        case 'A1':
            header("Location: A1.php");
            exit();
        case 'A2':
            header("Location: A2.php");
            exit();
        case 'B1':
            header("Location: B1.php");
            exit();
        case 'B2':
            header("Location: B2.php");
            exit();
        default:
            header("Location: test.php");
            exit();
    }
}
