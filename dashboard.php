<?php
session_start();
if (empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == '') {
    header("Location: login.php");
    die();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dash</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        div {
            max-width: 500px;
            margin: 50px auto;

            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        p {

            text-align: center;
            margin-bottom: 20px;
            margin: 100px 0px
        }

        h1 {

            text-align: center;
            margin-bottom: 20px;
            margin: 100px 0px
        }
    </style>
</head>

<body>
    <div>

        <h1 style="font-family: Arial, sans-serif; color: #333; text-align: center;">Welcome to Website.</h1>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>

</html>