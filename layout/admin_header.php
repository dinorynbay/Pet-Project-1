<?php
session_start();
?>
<header>
    <div class="container">
        <div class="logo">
            <a href="">
                <img src="img/logo.png" alt="Логотип">
            </a>
        </div>
        <div class="center-link">
            <a href="video_call.php">Видеозвонок</a>
        </div>
        <div class="right-content">
            <img src="<?php echo isset($_SESSION['admin']) ? $_SESSION['admin']['profile_photo'] : $_SESSION['user']['profile_photo']; ?>" alt="">
        </div>
        <a href="inc/logout.php" class="logout">
                Выход
        </a>

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