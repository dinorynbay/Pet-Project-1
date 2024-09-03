<?php
include ('../conn/conn.php');

if (isset($_GET['card'])) {
    $card = $_GET['card'];

    try {

        $query = "DELETE FROM flashcards WHERE id = '$card'";

        $stmt = $conn->prepare($query);

        $query_execute = $stmt->execute();

        if ($query_execute) {
            echo "
                <script>
                    alert('Карточка удалена!');
                    window.location.href = 'http://localhost/flashcards.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Ошибка удаления!');
                    window.location.href = 'http://localhost/flashcards.php';
                </script>
            ";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>