<?php
if(isset($_POST['register'])) {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';
  $password2 = $_POST['password2'] ?? '';
  $emplid = $_POST['emplid'] ?? '';

  if($password == $password2) {
    $sql = "SELECT username FROM users WHERE username = '$username'";

    if($result = mysqli_query($link,$sql)) {
      if(!mysqli_num_rows($result)) {
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["emplid"] = $emplid;

        $sql = ("INSERT INTO users(username, password, emplid) VALUES ('$username', '$password', '$emplid')");
        $result = mysqli_query($link, $sql);

        $sql = ("SELECT id FROM users WHERE username = '$username'");
        $result = mysqli_query($link, $sql);
        $_SESSION['userID'] = mysqli_fetch_assoc($result)['id'];
        echo "<script>successfully_registered_notification(); </script>";
      } else {
        echo "<script>username_taken_notification(); </script>";
      }
    }
  } else {
    echo "<script>passwords_dont_match_notification(); </script>";
  }
}