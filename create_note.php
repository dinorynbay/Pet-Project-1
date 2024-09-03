<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbname = "diploma";
$conn = mysqli_connect($host, $user, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST["title"]) && !empty($_POST["content"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $id = $_SESSION['user']['id'];
    $sql = "INSERT INTO notes (title, content, posted_date, registered_users_id) VALUES ('$title', '$content', NOW(), '$id')";
    if (mysqli_query($conn, $sql)) {
      header("Location: my_notes.php");
      exit();
    } else {
      $_SESSION['message'] = "Заполните оба поля";
      header('location: create_note.php');
      exit();
    }
  } else {
    $_SESSION['message'] = "Заполните оба поля";
    header('location: create_note.php');

    exit();
  }
}

?>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create a Note</title>
  <link rel="stylesheet" href="css/registered_styles.css">

</head>
<body>
<?php require_once 'layout/registered_header.php' ?>

<section class="grammar">
  <form class="create" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="title">Заголовок:</label><br>
    <input type="text" name="title"><br>
    <label for="content">Содержание:</label><br>
    <textarea name="content" id="textInput" rows="4" cols="50"></textarea><br>
    <input type="submit" value="Создать">

  </form>

  <textarea name="" id="output" cols="30" rows="10" class="correction"></textarea>
  <textarea name="" id="output2" cols="30" rows="10" class="correction"></textarea>

</section>
<button class="abs" onclick="checkGrammar()">Исправить текст</button><br>
<button class="abn" onclick="checkGrammar2()">Предложения</button><br>


<?php
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
  echo '<p class="msg">' . $_SESSION['message'] . '</p>';
  unset($_SESSION['message']);
}
?>
<script>
  async function checkGrammar() {
    const url = 'https://grammarbot-neural.p.rapidapi.com/v1/check';
    const options = {
      method: 'POST',
      headers: {
        'content-type': 'application/json',
        'X-RapidAPI-Key': '92f1e76985msh212aefb4eec43a6p1d45d3jsn8d3c285be976',
        'X-RapidAPI-Host': 'grammarbot-neural.p.rapidapi.com'
      },
      body: JSON.stringify({
        text: document.getElementById('textInput').value,
        lang: 'en'
      })
    };

    try {
      const response = await fetch(url, options);
      const result = await response.json();
      document.getElementById('output').value = result.correction;
    } catch (error) {
      console.error(error);
    }
  }
  async function checkGrammar2() {
  const url = 'https://grammarbot.p.rapidapi.com/check';
  const options = {
    method: 'POST',
    headers: {
      'content-type': 'application/x-www-form-urlencoded',
      'X-RapidAPI-Key': '92f1e76985msh212aefb4eec43a6p1d45d3jsn8d3c285be976',
      'X-RapidAPI-Host': 'grammarbot.p.rapidapi.com'
    },
    body: new URLSearchParams({
      text: document.getElementById('textInput').value,
      language: 'en-US'
    })
  };

  try {
    const response = await fetch(url, options);
    const result = await response.json();
    
    if (result.matches && result.matches.length > 0) {
      const messages = result.matches.map((match, index) => `${index + 1}. ${match.message}`);
      const output = messages.join('\n');
      document.getElementById('output2').value = output;
    } else {
      document.getElementById('output2').value = 'Нету предложений по грамматике.';
    }
  } catch (error) {
    console.error(error);
  }
}



  

</script>
</body>
</html>
