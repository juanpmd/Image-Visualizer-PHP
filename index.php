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
    <title>Log in</title>
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
    <div id="login-box">
      <p id="title-login" >Log in to your account</p>
      <form ng-controller="WebAppController">
        <div class="form-group">
          <div class="form-image">
            <img src="img/UserLogin.svg" alt="">
          </div>
          <input ng-model="username" autofocus="true" class="input-field" type="text" name="user" placeholder="Username">

        </div>
        <div class="form-group">
          <div class="form-image">
            <img src="img/KeyCHain.svg" alt="">
          </div>
          <input ng-model="password" autofocus="true" class="input-field" type="password" name="password" placeholder="Password">
        </div>
        <button ng-click="login()" id="login-button">Log in</button>
      </form>
      <div id="new-user-box">
        <p>Dont have an account yes? <a href="">Sign up</a></p>
      </div>
    </div>
  </body>
</html>
