<?php
session_start();
include("config.php");

if ((!isset($_SESSION['logged_in']))) {
    header("Location: index.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BK College Course Planner</title>
</head>
<body>
<h1 id = "welcome-msg">Welcome! <?php echo $_SESSION['username']?></h1>
<button type="button" onclick="location.href='logout.php';">LOGOUT</button>

</body>
</html>

