<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <form action="authenticate.php" method="post">
    <h2>Login</h2>
    <div class="input-group">
      <label>Username</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" id="password" name="password" required>
    </div>
    <?php
    session_start();

    // Check if an error message is set in the session
    if (isset($_SESSION['error'])) {
      // Display the error message
      echo "<p style='color: red; margin-bottom: 14px;'>{$_SESSION['error']}</p>";

      // Unset the error message in the session so that it doesn't show up again
      unset($_SESSION['error']);
    }
    ?>
    <div class="input-group">
      <button type="submit" class="btn" name="submit">Login</button>
    </div>
    <p>Don't have an account yet? <a href="signup.php">Signup</a></p>
  </form>
</body>

</html>