<?php
session_start();
if (!isset($_SESSION["username"]) ){
  header( "Location: http://localhost:8888/SeekInspire/index.php");
}
?>

<!DOCTYPE html>
<html ng-app="WebApp">
  <head>
    <meta charset="utf-8">
    <title>Seek Inspire</title>
    <link rel="stylesheet" href="css/home.css"></link>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
    <script src="http://localhost:8888/SeekInspire/Controllers/WebController.js"></script>
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

      <form id="upload-prueba" action="upload.php" method="post" enctype="multipart/form-data">
          Select image to upload:
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload Image" name="submit">
      </form>

    </nav>
    <!-- ################################### -->
    <main>
      <div id="setting-button">
        <div id="menu-option">
          <img src="img/MenuOptions.svg"/>
        </div>
      </div>
    </main>
    <!-- ################################### -->
    <div id="settings-box" class="hidden" ng-controller="WebAppController">
      <button ng-click="" class="settings-item">
        <img src="img/Settings.svg">
        <p>Settings</p>
      </button>
      <button ng-click="UserLogout()" class="settings-item" name="logout">
        <img src="img/Logout.svg">
        <p>Log out</p>
      </button>
    </div>
    <!-- ################################### -->
    <div id="images-section">
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/9ef7cccc69a41dc0e71b0c681d4f7120.jpg"/>
        </div>
        <div class="image-info-box">

        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/oneloveyo!_poster.png"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/c0c3fd29324129.55edea46f1ecc.jpg"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/89b44e15c8d527fd731949d198c75fb2.png"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/ScreenShot2015-10-15at2.00.01PM.png"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/87c74bb2081cb42a92683d189523b3a1.jpg"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/tumblr_nqptrsNv5O1t7cmmpo1_1280.png"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/ScreenShot2015-10-15at2.00.01PM.png"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/87c74bb2081cb42a92683d189523b3a1.jpg"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/tumblr_nqptrsNv5O1t7cmmpo1_1280.png"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/c0c3fd29324129.55edea46f1ecc.jpg"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/9ef7cccc69a41dc0e71b0c681d4f7120.jpg"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/oneloveyo!_poster.png"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/c0c3fd29324129.55edea46f1ecc.jpg"/>
        </div>
      </div>
      <div class="image-box">
        <div class="image-fill">
          <img src="uploads/Pruebas/tumblr_nqptrsNv5O1t7cmmpo1_1280.png"/>
        </div>
      </div>
    </div>
    <!-- ################################### -->
    <!-- ################################### -->
    <script src="js/jQuery.js"></script>
    <script type="text/javascript" src="js/home.js"></script>
  </body>
</html>
