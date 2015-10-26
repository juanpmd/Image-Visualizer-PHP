<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/index.css"></link>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300' rel='stylesheet' type='text/css'>
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
      <form action="index.php" method="post">
        <input class="input-field" type="text" name="user" placeholder="Username">
        <input class="input-field" type="password" name="password" placeholder="Password">
        <button id="login-button" type="submit" name="login">Sign in</button>
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
