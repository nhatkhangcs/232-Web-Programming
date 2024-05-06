<img src="../src/avatar.png" class="avatar-image shadow">
<div class="user-avatar-text">
    <div class="user-avatar-name">
        <?php
        if (isset($_SESSION['teachername'])) {
            echo $_SESSION['teachername'];
        } elseif (isset($_SESSION['studentname'])) {
            echo $_SESSION['studentname'];
        } else {
            echo 'Guest user';
        }
        ?>
    </div>
    <div class="user-avatar-role">
        <?php
        if (isset($_SESSION['role'])) {
            echo $_SESSION['role'];
        } else {
            echo 'Guest';
        }
        ?>
    </div>
</div>