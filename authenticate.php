<?php
session_start(); // Start the session

if (isset($_POST['submit'])) { // Check if the form has been submitted
    // Define variables and sanitize user input
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    // Check if either field is empty
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Please enter both a username and password.";
        header("Location: login.html");
        exit();
    }

    // Attempt to authenticate user
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "task090323";
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Successful login
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['userLogin'] = "Loggedin";
            header("Location: dashboard.php");
            exit();
        } else {
            // Incorrect password
            $_SESSION['error'] = "Incorrect password. Please try again.";
            header("Location: login.php");
            exit();
        }
    } else {
        // Username not found
        $_SESSION['error'] = "Username not found. Please try again.";
        header("Location: login.php");
        exit();
    }

    mysqli_close($conn); // Close the database connection
} else {
    header("Location: login.php"); // Redirect to login page
    exit();
}
