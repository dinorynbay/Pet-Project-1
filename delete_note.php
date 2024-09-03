<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "diploma";
$conn = mysqli_connect($host, $user, $password, $dbname);

$id = $_GET["id"];
$sql = "DELETE FROM notes WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: my_notes.php");
exit();
?>