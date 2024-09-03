<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbname = "diploma";
$conn = mysqli_connect($host, $user, $password, $dbname);

$id = $_SESSION['user']['id'];
$sql = "SELECT * FROM notes WHERE `registered_users_id` = '$id' ORDER BY `posted_date` DESC";
$result = mysqli_query($conn, $sql);

?>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Notes</title>
  <link rel="stylesheet" href="css/registered_styles.css">
</head>
<body>
<?php require_once 'layout/registered_header.php' ?>

<?php
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
  echo '<p class="msg">' . $_SESSION['message'] . '</p>';
  unset($_SESSION['message']);
}
?>
  <table>
    <thead>
      <tr>
        <th>Заголовок</th>
        <th>Содержание</th>
        <th>Дата</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row["title"]; ?></td>
          <td><?php echo $row["content"]; ?></td>
          <td><?php echo $row["posted_date"]; ?></td>
          <td>
            <a href="edit_note.php?id=<?php echo $row["id"]; ?>">Редактировать</a>
            <a href="delete_note.php?id=<?php echo $row["id"]; ?>">Удалить</
            </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>