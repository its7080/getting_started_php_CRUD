<!DOCTYPE html>
<html>

<head>
  <title>Signup</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <form action="register.php" method="post">
    <h2>Signup</h2>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" required>
      <?php if (!empty($username_error)) { ?>
        <div class="error"><?php echo $username_error; ?></div>
      <?php } ?>

    </div>
    <div class="input-group">
      <label>Email</label>
      <input type="email" name="email" required>
    </div>
    <div class="input-group">
      <label>Password</label>

      <input type="password" name="password" required>
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
      <button type="submit" class="btn" name="register">Register</button>
    </div>
    <p>Already have an account? <a href="login.php">Login</a></p>
  </form>
</body>

</html>