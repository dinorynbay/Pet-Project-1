<header>
    <div class="container">
        <div class="logo">
            <a href="">
                <img src="img/logo.png" alt="Логотип">
            </a>
        </div>
        <div class="center-link">
            <a href="test.php">Тест</a>
            <a href="Grammar_course.php">Уроки</a>
            <a href="dictionary.php">Словарь</a>
        </div>
        <div class="auth">
            <a href="registration.php">Регистрация</a>
            <a href="authorization.php">Авторизация</a>
        </div>
    </div>
</header>
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