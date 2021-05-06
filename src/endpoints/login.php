<?php
if(isset($_POST['login'])) {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  $sql = "SELECT * FROM users WHERE (username = '$username' OR emplid = '$username') AND password = '$password'";
  $result = mysqli_query($link, $sql);

  if(mysqli_num_rows($result)) {
    $_SESSION["logged_in"] = true;
    $arr = mysqli_fetch_assoc($result);
    $_SESSION["username"] = $arr['username'];
    $_SESSION["userID"] = $arr['id'];
    $_SESSION["emplid"] = $arr['emplid'];
    $_SESSION["majorID"] = $arr['majorID'];
    $_SESSION["minorID"] = $arr['minorID'];

    echo "<script>logged_in_notification(); </script>";
  } else {
    echo "<script>wrong_log_in_notification(); </script>";
  }
}