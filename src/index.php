<?php
session_start();
include("config.php");
if ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')) {
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Brooklyn College Registration Helper</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" type="text/css" rel="stylesheet">
  <!-- sweet alert js -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
  <!-- custom sweet alert notifications -->
  <script src="js/notifications.js"></script>
  <!-- custom main -->
  <script src="js/main.js"></script>
</head>

<body>
  <div class="container">
    <!-- Login Form -->
    <form action="index.php" class="form" id="login" method="post">
      <h1 class="form__title">Login</h1>
      <div class="form__message form__message--error"></div>
      <div class="form__input-group">
        <input type="text" aria-label="Enter your username" class="form__input" name="username" autofocus placeholder="Username or EMPLID" id="loginUser" required>
        <div class="form__input-error-message"></div>
      </div>
      <div class="form__input-group">
        <input type="password" aria-label="Enter your password" class="form__input" name="password" placeholder="Password" id="loginCredentials" required>
        <div class="form__input-error-message"></div>
      </div>
      <button class="form__button" type="submit" name="login">Login</button>
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
        <input type="text" aria-label="Enter your emplid" id="emplid" name = "emplid" class="form__input" autofocus placeholder="EMPLID" maxlength="8" required>
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
  </div>
</body>
</html>

<?php
include('endpoints/login.php');
include('endpoints/register.php');
?>
