<?php
session_start(); // Start the session

// Connect to MySQL database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'task090323';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check if connection succeeded
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Retrieve user input from the signup form
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Hash the password using bcrypt algorithm
  $hash = password_hash($password, PASSWORD_DEFAULT);

  // Check if username and email are not empty
  if (empty($username) || empty($email)) {
    $error_msg = 'Please fill in all required fields';
    $_SESSION['error'] = $error_msg;
    header("Location: signup.php");
  } else {
    // Check if username and email meet required format
    if (!preg_match('/^[a-zA-Z0-9]{4,20}$/', $username)) {
      $error_msg = 'Username should be alphanumeric and between 4-20 characters';
      $_SESSION['error'] = $error_msg;
      header("Location: signup.php");
    } else 
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_msg = 'Please enter a valid email address';
      $_SESSION['error'] = $error_msg;
      header("Location: signup.php");
    } else {
      // Check if username and email are already taken
      $query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Username or email already taken, please choose a different one';
        header("Location: signup.php");
      } else {
        // Insert user data into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hash')";
        if (mysqli_query($conn, $sql)) {
          // Redirect to login page after successful signup
          header("Location: login.php");
          exit;
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        // Close database connection
        mysqli_close($conn);
      }
    }
  }
}
