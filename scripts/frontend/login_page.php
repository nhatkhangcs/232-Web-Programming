<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Smart</title>
  <link rel="icon" href="../src/logo.png" type="image/png">
  <link rel="stylesheet" type="text/css" href="../styles/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="position-absolute top-10 start-15 pt-3">
        <a href="./guest_dashboard.php">
            <img src="../src/home_icon.png" width="40px" class="mx-auto d-block mt-1">
        </a>
    </div>
    <p class="fw-bold fs-2 mx-auto text-center pt-3 mb-5">Login into your account</p>  
    <div class="login-container mx-auto">
        <div class="card mb-5" style="border: 2px solid blue; border-radius: 15px;">
            <div class="mx-auto mt-5">
                <img src="../src/logo.png" width="150px">
            </div>
            <div class="card-body px-md-5">
                <form action="../process/process_login.php" method="post">
                    <div class="mb-2">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                            <label class="form-check-label text-primary" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                        <a href="#!">Forgot password?</a>
                    </div>
                    <?php
                        // Check if login failed error is present
                        if (isset($_GET['error'])) {
                            if ($_GET['error'] == 'invalid') {
                                echo '<p style="color: red; margin-top:10px;">Invalid username or password!</p>';
                            }
                        }
                    ?>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <div class="mx-auto mt-2 mb-5">
                <p class="mb-3">Don't have an account? <a href="signup_page.php">Sign up</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
