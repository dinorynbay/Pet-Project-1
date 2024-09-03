<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "diploma";
$conn = mysqli_connect($host, $user, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];

    if (!empty($title) && !empty($content)) {
        $sql = "UPDATE notes SET title='$title', content='$content' WHERE id=$id";
        mysqli_query($conn, $sql);

        header("Location: my_notes.php");
        exit();
    } else {
        header("Location: my_notes.php");
        $_SESSION['message'] = "Оба поля должны быть заполнены";
    }
}

$id = $_GET["id"];
$sql = "SELECT * FROM notes WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="css/registered_styles.css">
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
    <label for="title">Заголовок:</label><br>
    <input type="text" name="title" value="<?php echo $row["title"]; ?>"><br>
    <label for="content">Содержание:</label><br>
    <textarea name="content"><?php echo $row["content"]; ?></textarea><br>
    <input type="submit" value="Сохранить">
</form>
<?php
if (isset($error_message)) {
    echo "<p style='margin-left: 470px; margin-top: -80px; font-weight: bold;'>$error_message</p>";
}
?>
</body>
</html>
