<?php
session_start();
if (isset($_SESSION["username"]) ){
  header( "Location: http://localhost:8888/SeekInspire/home.php");
}
?>

<!DOCTYPE html>
<html ng-app="UserApp">
  <head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/index.css"></link>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
    <script src="http://localhost:8888/SeekInspire/Controllers/UserController.js"></script>
  </head>
  <body>
    <div id="login-box">
      <div id="colors-box">
        <div class="color-elem" id="color-1"></div>
        <div class="color-elem" id="color-2"></div>
        <div class="color-elem" id="color-3"></div>
        <div class="color-elem" id="color-4"></div>
        <div class="color-elem" id="color-5"></div>
        <div class="color-elem" id="color-6"></div>
        <div class="color-elem" id="color-7"></div>
        <div class="color-elem" id="color-8"></div>
      </div>
      <img id="logo-seekinspire" src="img/SeekInspire.svg" alt="">
      <form ng-controller="UserAppController">
        <input ng-model="username" class="input-field" type="text" name="user" placeholder="Username">
        <input ng-model="password" class="input-field" type="password" name="password" placeholder="Password">
        <button ng-click="login()" id="login-button">Sign in</button>
      </form>

      <div id="or-label">
        <div id="dotted-line"></div>
        <p>OR</p>
      </div>
      <div id="facebook-button">
        <img src="img/Facebook-Logo.svg" alt="">
        <p>Sign in with Facebook</p>
      </div>
    </div>
  </body>
</html>
