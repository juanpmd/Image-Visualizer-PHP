<?php
session_start();

if (!isset($_SESSION["username"]) ){
  header( "Location: http://localhost:8888/SeekInspire/index.php");
}

if(isset($_POST["logout"])){
  session_unset();
  session_destroy();
  header( "Location: http://localhost:8888/SeekInspire/index.php");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Seek Inspire</title>
    <link rel="stylesheet" href="css/home.css"></link>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <!-- ################################### -->
    <nav>
      <div id="search-box">
        <form id="form-search">
          <img src="img/Search.svg"/>
          <input type="text" name="name" placeholder="Search for tags">
        </form>
      </div>
    </nav>
    <!-- ################################### -->
    <main>
      <div id="upload-button">
        <img src="img/Upload.svg"/>
      </div>
      <div id="setting-button">
        <div id="user-image"></div>
        <div id="user-name-box">
          <p>Hello, <span><?php echo $_SESSION["username"] ?></span></p>
        </div>
        <div id="more-arrow">
          <img src="img/MoreArrow.svg" alt="">
        </div>
        <!--<img src="img/Settings.svg"/>-->
      </div>
    </main>
    <!-- ################################### -->
    <div id="settings-box" class="hidden">
      <button class="settings-item">
        <img src="img/Settings.svg">
        <p>Settings</p>
      </button>

      <form action="home.php" method="post">
        <button class="settings-item" type="submit" name="logout">
          <img src="img/Logout.svg">
          <p>Log out</p>
        </button>
      </form>

    </div>
    <!-- ################################### -->
    <script src="js/jQuery.js"></script>
    <script type="text/javascript" src="js/home.js"></script>
  </body>
</html>
