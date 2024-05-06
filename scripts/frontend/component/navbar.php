<div class="logo-sidebar" onclick="window.location.href='index.php?page=home-page'">
    <img src="../src/logo.png" width="120px">
</div>

<!-- dashboard -->
<div class="dashboard-item" onclick="window.location.href='index.php?page=dashboard'">
    <i class="material-icons dashboard-item-icon fs-2">space_dashboard</i>
    Dashboard
</div>

<!-- course -->
<div class="dashboard-item" onclick="window.location.href='index.php?page=my-course'">
    <i class="material-icons dashboard-item-icon fs-2">school</i>
    My course
</div>

<!-- explore -->
<div class="dashboard-item" onclick="window.location.href='explore course.php'">
    <i class="material-icons dashboard-item-icon fs-2">travel_explore</i>
    Explore
</div>

<!-- history -->
<div class="dashboard-item">
    <i class="material-icons dashboard-item-icon-2 fs-2">history</i>
    History
</div>

<!-- account -->
<div class="dashboard-item">
    <i class="material-icons dashboard-item-icon-2 fs-2">person</i>
    Account
</div>

<!-- log out -->
<?php
if (isset($_SESSION['role'])) {
    echo '<div class="dashboard-item" onclick="window.location.href=\'../../process/logout.php\'">
            <i class="material-icons dashboard-item-icon-2 fs-2">logout</i>
            Log out
        </div>';
}
else {
    echo '<div class="dashboard-item" onclick="window.location.href=\'login_page.php\'">
            <i class="material-icons dashboard-item-icon-2 fs-2">login</i>
            Log in
        </div>';
}
?>
<!-- <div class="dashboard-item">
    <i class="material-icons dashboard-item-icon-2 fs-2">logout</i>
    Log out
</div> -->