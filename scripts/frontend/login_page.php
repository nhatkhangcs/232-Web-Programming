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
    <p class="fw-bold fs-2 mx-auto text-center mb-5">Login into your account</p>  
    <div class="login-container w-50 mx-auto">
        <div class="card mb-5" style="border: 2px solid blue; border-radius: 15px;">
            <div class="mx-auto mt-5">
                <img src="../src/logo.png" width="150px">
            </div>
            <div class="card-body px-5">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                          <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                          <label class="form-check-label text-primary" for="form2Example3">
                            Remember me
                          </label>
                        </div>
                        <a href="#!">Forgot password?</a>
                    </div>
                    <div class="d-grid gap-2 mt-3">
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