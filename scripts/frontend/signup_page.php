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
  <script src="validate_signup.js" ></script>

</head>
<body>
<!-- <div class="container" style="border: 5px solid red;">
    <p class="fw-bold fs-2 mx-auto text-center">Login into your account</p>    
</div> -->
<!-- <img src="../src/home_icon.png" width="15px" class="mx-auto d-block mt-5"> -->
<div class="container">
    <div class="position-absolute top-15 start-10 pt-3">
        <a href="./guest_dashboard.php">
            <img src="../src/home_icon.png" width="40px" class="mx-auto d-block mt-1">
        </a>
    </div>
    <p class="fw-bold fs-2 mx-auto text-center pt-3 mb-3">Sign up for a new account</p>  
    <div class="login-container mx-auto">
        <div class="card mb-4" style="border: 2px solid blue; border-radius: 15px;">
            <div class="mx-auto mt-3">
                <img src="../src/logo.png" width="150px">
            </div>
            <div class="card-body px-5">
            <form action="../backend/login/register.php" method="post" onsubmit="return validateForm()">
                <div class="mb-2">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-2">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-2">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    <small id="passwordError" class="text-danger d-none">Passwords do not match.</small>
                </div>
                <?php
                    // Check if login failed error is present
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == 'taken') {
                            echo '<p style="color: red; margin-top:10px;">This username is already taken!</p>';
                        }
                        if ($_GET['error'] == 'emailtaken') {
                            echo '<p style="color: red; margin-top:10px;">This email is already taken!</p>';
                        }
                    }
                ?>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </div>
                </form>
            </div>
            <div class="mx-auto mt-2 mb-3">
                <p class="mb-3">Already have an account? <a href="login_page.php">Login</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>