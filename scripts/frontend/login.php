<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="../styles/login.css">
  <style>
    /* Custom CSS for Role Selection Box */
    .role-selection {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 15px;
    }

    .role-selection label {
      margin-right: 10px;
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <h1>Login</h1>
    </div>
  </header>
  <div class="container">
    <div id="login-form">
      <form action="login_process.php" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <div class="role-selection">
          <label><input type="radio" id="teacher" name="role" value="teacher" required> Teacher</label>
          <label><input type="radio" id="student" name="role" value="student" required> Student</label>
        </div>

        <input type="submit" value="Login">
      </form>
    </div>
  </div>
</body>
</html>
