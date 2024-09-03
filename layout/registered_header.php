<?php
session_start();
?>
<?php if(isset($_SESSION['admin'])): ?>
    <!-- Admin Header -->
    <header>
        <div class="container">
            <div class="logo">
                <a href="">
                    <img src="img/logo.png" alt="Логотип">
                </a>
            </div>
            <div class="center-link">
                <a href="registered_admin.php">Результаты</a>
            </div>
            <div class="right-content">
                <img src="<?php echo isset($_SESSION['admin']) ? $_SESSION['admin']['profile_photo'] : $_SESSION['user']['profile_photo']; ?>" alt="">
            </div>
            <a href="inc/logout.php" class="logout">Выход</a>
        </div>
    </header>
<?php elseif(isset($_SESSION['user'])): ?>
    <!-- User Header -->
    <header>
        <div class="container">
            <div class="logo">
                <a href="">
                    <img src="img/logo.png" alt="Логотип">
                </a>
            </div>
            <div class="center-link">
                <a href="test.php">Тест</a>
                <a href="grammar_course.php">Уроки</a>
                <a href="dictionary.php">Словарь</a>
                <a href="video_call.php">Видеозвонок</a>
                <a href="news.php">Новости</a>
                <div class="dropdown">
                    <a href="my_notes.php">Заметки</a>
                    <div class="dropdown-content">
                        <a href="create_note.php">Создать заметку</a>
                        <a href="my_notes.php">Мои заметки</a>
                    </div>
                </div>
                <a href="flashcards.php">Карточки</a>
                <a href="to_do.php">Список дел</a>
            </div>
            <div class="right-content">
                <img src="<?php echo isset($_SESSION['admin']) ? $_SESSION['admin']['profile_photo'] : $_SESSION['user']['profile_photo']; ?>" alt="">
            </div>
            <a href="inc/logout.php" class="logout">Выход</a>
        </div>
    </header>
<?php endif; ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var logoLink = document.querySelector(".logo a");

    logoLink.addEventListener("click", function(event) {
        event.preventDefault();

        if (!<?php echo isset($_SESSION['admin']) || isset($_SESSION['user']) ? 'true' : 'false'; ?>) {
            window.location.href = "index.php"; 
        } else if (<?php echo isset($_SESSION['admin']) ? 'true' : 'false'; ?>) {
            window.location.href = "registered_admin.php"; 
        } else if (<?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>) {
            window.location.href = "registered_profile.php"; 
        }
    });
});
</script>