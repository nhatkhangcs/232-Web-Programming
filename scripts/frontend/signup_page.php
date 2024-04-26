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
<body style="height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center; ">
<!-- <div class="container" style="border: 5px solid red;">
    <p class="fw-bold fs-2 mx-auto text-center">Login into your account</p>    
</div> -->
<!-- <img src="../src/home_icon.png" width="15px" class="mx-auto d-block mt-5"> -->
<div class="container">
    <div class="position-absolute top-15 start-10">
        <a href="./home page.php">
            <img src="../src/home_icon.png" width="40px" class="mx-auto d-block mt-1">
        </a>
    </div>
    <p class="fw-bold fs-2 mx-auto text-center mb-3">Sign up for a new account</p>  
    <div class="login-container w-50 mx-auto">
        <div class="card mb-4" style="border: 2px solid blue; border-radius: 15px;">
            <div class="mx-auto mt-3">
                <img src="../src/logo.png" width="150px">
            </div>
            <div class="card-body px-5">
            <form action="signup.php" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="Student">Student</option>
                        <option value="Teacher">Teacher</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>

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