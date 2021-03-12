<?php
session_start();
include("config.php");

if ((!isset($_SESSION['logged_in']))) {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Brooklyn College Course Planner</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Menu</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="./dashboard.php">Home <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="./profile.html">Profile</a>
        <a class="nav-item nav-link" href="./Courses.html">Courses</a>
        <a class="nav-item nav-link" href="./Planner.html">Planner</a>
      </div>
    </div>
  </nav>
  <h1 id = "welcome-msg">Welcome! <?php echo $_SESSION['username']?></h1>
  <button type="button" onclick="location.href='logout.php';">LOGOUT</button>

</body>
</html>
