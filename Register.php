<?php
session_start();
if (isset($_SESSION["username"]) ){
  header( "Location: http://localhost:8888/SeekInspire/home.php");
}
?>

<!DOCTYPE html>
<html ng-app="WebApp">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/index.css"></link>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
    <script src="Controllers/WebController.js"></script>
    <script src="js/angular-file-upload.min.js"></script>
  </head>
  <body>
    <div id="login-logo">
      <img src="img/SeekInspireLogin.svg">
    </div>
    <div id="login-box2">
      <p id="title-login" >Create new account</p>
      <form ng-controller="WebAppController">

        <div class="form-group2">
          <div class="form-image">
            <img src="img/Username.svg" alt="">
          </div>
          <input ng-model="nombre2" autofocus="true" class="input-field" type="text" placeholder="Name">
        </div>

        <div class="form-group2">
          <div class="form-image">
            <img src="img/UserLogin.svg" alt="">
          </div>
          <input ng-model="username2" autofocus="true" class="input-field" type="text" placeholder="Username">
        </div>

        <div class="form-group2">
          <div class="form-image">
            <img src="img/Email.svg" alt="">
          </div>
          <input ng-model="email2" autofocus="true" class="input-field" type="text"placeholder="Email">
        </div>

        <div class="form-group2">
          <div class="form-image">
            <img src="img/KeyCHain.svg" alt="">
          </div>
          <input ng-model="password2" autofocus="true" class="input-field" type="password" placeholder="Password">
        </div>
        <button ng-click="Registrarse()" id="login-button">Register</button>
      </form>
      <div id="new-user-box">
        <p>Already have an account? <a href="index.php">Log in</a></p>
      </div>
    </div>
  </body>
</html>
