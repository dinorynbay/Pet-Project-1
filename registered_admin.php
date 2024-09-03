<?php
require_once 'inc/connect.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/admin_styles.css">
</head>

<body>
    <?php require_once 'layout/admin_header.php' ?>
    <article>
    <?php
$sql = "SELECT ru.surname, ru.name, ru.patronymic, ru.email, ru.level, r.grade, r.completed_date, r.lesson
    FROM registered_users ru
    INNER JOIN results r ON r.registered_users_id = ru.id
    ORDER BY r.completed_date DESC
    LIMIT 10";
        $result = $connect->query($sql);
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Email</th><th>Уровень</th><th>Оценка</th><th>Урок</th><th>Дата и время окончания теста</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["surname"] . "</td><td>" . $row["name"] . "</td><td>" . $row["patronymic"] . "</td><td>" . $row["email"] . "</td><td>" . $row["level"] . "</td><td>" . $row["grade"] . "</td><td>" . $row["lesson"] . "</td><td>" . $row["completed_date"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $connect->close();
        ?>
    </article>
</body>

</html>
