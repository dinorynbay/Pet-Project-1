<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/flashcards_styles.css">

</head>
<body>
<?php require_once 'layout/flashcards.php' ?>
<div class="main">
        <div class="title-container row">
            <button class="btn correct" onclick="showAllActionButtons()">Редактировать карточки</button>
            <button class="btn" data-toggle="modal" data-target="#addFlashcardModal">Добавить карточку</button>

            <!-- Add Flashcard Modal -->
            <div class="modal fade" id="addFlashcardModal" tabindex="-1" aria-labelledby="addFlashcard" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addFlashcard">Добавить карточку</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="./endpoint/add-flashcard.php" method="POST">
                                <div class="form-group">
                                    <label for="question">Слово:</label>
                                    <input type="text" class="form-control" id="question" name="question">
                                </div>
                                <div class="form-group">
                                    <label for="answer">Ответ:</label>
                                    <input type="text" class="form-control" id="answer" name="answer">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn " data-dismiss="modal">Закрыть</button>
                                    <button type="submit" class="btn ">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Flashcard Modal -->
            <div class="modal fade" id="updateFlashcardModal" tabindex="-1" aria-labelledby="updateFlashcard" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateFlashcard">Обновить карточку</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="./endpoint/update-flashcard.php" method="POST">
                                <input type="text" class="form-control" id="updateCardID" name="tbl_card_id">
                                <div class="form-group">
                                    <label for="question">Слово:</label>
                                    <input type="text" class="form-control" id="updateQuestion" name="question">
                                </div>
                                <div class="form-group">
                                    <label for="answer">Ответ:</label>
                                    <input type="text" class="form-control" id="updateAnswer" name="answer">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-dismiss="modal">Закрыть</button>
                                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-container">
            <?php 
                include("./conn/conn.php");
                $id = $_SESSION['user']['id'];
                $stmt = $conn->prepare("SELECT * FROM flashcards WHERE registered_users_id = $id ORDER BY posted_date DESC");
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $questionNumber = 0;    

                foreach($result as $row) {
                    $cardID = $row['id'];
                    $question = $row['question'];
                    $answer = $row['answer'];
                    $questionNumber++;
                    ?>

                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <h5 class="card-title">Слово <?= $questionNumber ?></h5>
                            <h4 class="card-subtitle mt-2 mb-2" id="question-<?= $cardID ?>"><?= $question ?></h4>
                            <div class="action-button" style="display: none;">
                                <button class="btn btn-sm " onclick="updateFlashcard(<?= $cardID ?>)"><span>Редактировать</span></button>
                                <button class="btn btn-sm " onclick="deleteFlashcard(<?= $cardID?>)"><span>Удалить</span></button>
                            </div>
                            <button class="btn btn-sm btn-secondary" onclick="showAnswer(<?= $cardID ?>);">Показать/Скрыть карточку</button>
                            <div class="answer-con">
                                <p class="card-text m-3" id="answer-<?= $cardID ?>" style="visibility: hidden;"><?= $answer ?></p>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            ?>
        </div>

    </div>


    <!-- Script JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

        
    <script>
        function showAnswer(id) {
            let answerElement = document.getElementById('answer-' + id);

            if (answerElement.style.visibility === 'hidden' || answerElement.style.visibility === '') {
                answerElement.style.visibility = 'visible';
            } else {
                answerElement.style.visibility = 'hidden';
            }
        }

        function updateFlashcard(id) {
            $("#updateFlashcardModal").modal("show");

            let updateQuestion = $("#question-" + id).html();
            let updateAnswer = $("#answer-" + id).html();

            $("#updateCardID").val(id);
            $("#updateQuestion").val(updateQuestion);
            $("#updateAnswer").val(updateAnswer);
        }

        function showAllActionButtons() {
            let actionButtons = document.querySelectorAll('.action-button');

            actionButtons.forEach(button => {
                if (button.style.display === 'none' || button.style.display === '') {
                    button.style.display = 'block';
                } else {
                    button.style.display = 'none';
                }
            });
        }

        function deleteFlashcard(id) {
            if (confirm("Вы хотите удалить карточку?")) {
                window.location = "./endpoint/delete-flashcard.php?card=" + id;
            }
        }
    </script>
</body>
</html>