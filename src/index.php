<?php
session_start();
include("config.php");
if ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')) {
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Brooklyn College Registration Helper</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="main.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" type="text/css" rel="stylesheet">
</head>
<body>
  <script src="main.js"></script>
  <div class="container">
    <!-- Login Form -->
    <form action="index.php" class="form" id="login" method="post">
      <h1 class="form__title">Login</h1>
      <div class="form__message form__message--error"></div>
      <div class="form__input-group">
        <input type="text" aria-label="Enter your username" class="form__input" name="username" autofocus placeholder="Username or Email" id="loginUser" required>
        <div class="form__input-error-message"></div>
      </div>
      <div class="form__input-group">
        <input type="password" aria-label="Enter your password" class="form__input" name="password" placeholder="Password" id="loginCredentials" required>
        <div class="form__input-error-message"></div>
      </div>
      <button class="form__button" type="submit" name="login">Login</button>
      <p class="form__text">
        <a href="#" class="form__link" onclick="formVisibilityToggle(login, forgot)">Forgot your password?</a>
      </p>
      <p class="form__text">
        <a class="form__link" onclick="formVisibilityToggle(login, createAccount)">Don't have an account? Create Account</a>
      </p>
    </form>
    <!-- Register Form -->
    <form action="index.php" class="form form--hidden" id="createAccount" method="post">
      <h1 class="form__title">Create Account</h1>
      <div class="form__message form__message--error"></div>
      <div class="form__input-group">
        <input type="text" aria-label="Set up your username" id="usernameSetUp" name = "username" class="form__input" placeholder="Username" required>
        <div class="form__input-error-message"></div>
      </div>
      <div class="form__input-group">
        <input type="text" aria-label="Enter your email" id="emailSetUp" name = "email" class="form__input" placeholder="Email Address" required>
        <div class="form__input-error-message"></div>
      </div>
      <div class="form__input-group">
        <input type="password" aria-label="Set up your password" id="passwordSetUp" name = "password" class="form__input" placeholder="Password" required>
        <div class="form__input-error-message"></div>
      </div>
      <div class="form__input-group">
        <input type="password" aria-label="Confirm your password" id="passwordConfirmedSetUp" name = "password2" class="form__input" placeholder="Confirm Password" required>
        <div class="form__input-error-message"></div>
      </div>
      <button class="form__button" type="submit" name="register">Create</button>
      <p class="form__text">
        <a class="form__link" onclick="formVisibilityToggle(createAccount, login)">Already have an account? Sign in</a>
      </p>
    </form>
    <!-- Password Reset Form -->
    <form class="form form--hidden" id="forgot">
      <h1 class="form__title">Password Reset</h1>
      <div class="form__message form__message--error"></div>
      <div class="form__input-group">
        <input type="text" aria-label="Enter your email" class="form__input" placeholder="Email" required>
        <div class="form__input-error-message"></div>
      </div>
      <div class="form__input-group">
        <input type="password" aria-label="Enter new password" class="form__input" placeholder="Enter New Password" required>
        <div class="form__input-error-message"></div>
      </div>
      <div class="form__input-group">
        <input type="password" aria-label="Re-enter your password" class="form__input" placeholder="Re-enter Password" required>
        <div class="form__input-error-message"></div>
      </div>
      <button class="form__button" type="submit">Submit</button>
      <p class="form__text">
        <a class="form__link" onclick="formVisibilityToggle(forgot, login)">Back to login</a>
      </p>
    </form>
  </div>
</body>
</html>

<?php

if(isset($_POST['login'])) {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  $sql = "SELECT username FROM users WHERE (username = '$username' OR email = '$username') AND password = '$password'";
  $result = mysqli_query($link, $sql);

  if(mysqli_num_rows($result) == 1) {
    $_SESSION["logged_in"] = true;
    $_SESSION["username"] = mysqli_fetch_assoc($result)['username'];

    print '<script>window.location.href = "dashboard.php"</script>';
  } else {
    print '<script>alert("Invalid username/password...");</script>';
  }
}

if(isset($_POST['register'])) {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';
  $password2 = $_POST['password2'] ?? '';
  $email = $_POST['email'] ?? '';

  if($password == $password2) {
    $sql = "SELECT username FROM users WHERE username = '$username'";

    if($result = mysqli_query($link,$sql)) {
      if(!mysqli_num_rows($result)) {
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $username;

        $sql = ("INSERT INTO users(username, password, email) VALUES ('$username', '$password', '$email')");
        $result = mysqli_query($link, $sql);
        print '<script>alert("Successfully registered!"); window.location.href = "dashboard.php"</script>';
      } else {
        print '<script>alert("Username is taken...");</script>';
      }
    }
  } else {
    print '<script>alert("Passwords dont match...");</script>';
  }
}
?>
