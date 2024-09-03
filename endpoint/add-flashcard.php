<?php
session_start();
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['question'], $_POST['answer'])) {
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $id = $_SESSION['user']['id'];
        
        try {
            $stmt = $conn->prepare("INSERT INTO flashcards (question, answer,posted_date,registered_users_id) VALUES (:question, :answer,NOW(),:id)");
            
            $stmt->bindParam(":question", $question, PDO::PARAM_STR);
            $stmt->bindParam(":answer", $answer, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: http://localhost/flashcards.php");

            exit();
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }

    } else {
        echo "
            <script>
                alert('Please fill in all fields!');
                window.location.href = 'http://localhost/flashcards.php';
            </script>
        ";
    }
}
?>
