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
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css"></link>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
    <script src="Controllers/WebController.js"></script>
    <script src="js/angular-file-upload.min.js"></script>
  </head>
  <body ng-controller="WebAppController">
    <!-- ################################### -->
    <nav>
      <div id="search-box">
        <form id="form-search">
          <img src="img/Search.svg"/>
          <input type="text" name="name" placeholder="Search for tags">
        </form>
      </div>

      <div>
        <button ng-click="CheckDelete()" type="button">Delete</button>
      </div>
    </nav>
    <!-- ################################### -->
    <main>
      <div id="setting-button">
        <div id="menu-option">
          <img src="img/MenuOptions.svg"/>
        </div>
      </div>
      <div id="upload-open-main">
        <img src="img/Upload.svg" />
      </div>

    </main>
    <!-- ################################### -->
    <div id="settings-box" class="hidden">
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
      <!-- ng-hide="imagenes.length" -->
      <div ng-repeat="data in imagenes" class="image-box" id="image-box-size">
        <div class="image-fill" >
          <img ng-src="{{ data.name }}"/>
        </div>
        <div class="image-info-box">
        <input ng-model="data.select" type="checkbox" class="checkbox-image">
        <p class="image-info-datatype">{{ data.datatype | uppercase}}</p></div>
      </div>

    </div>
    <!-- ################################### -->
    <div id="upload-page" class="hidden">
      <div id="upload-block">
        <table id="upload-block-data">

          <button id="info-upload-beforeimage" ng-disabled="uploader.queue.length">
            <img src="img/UploadImage.svg"/>
            <p>Upload image here</p>
          </button>

          <tbody>

            <tr id="upload-table-block" ng-repeat="item in uploader.queue">
              <td class="upload-image-name">{{ item.file.name }}</td>
              <td class="upload-image-size" ng-show="uploader.isHTML5" nowrap>{{ item.file.size/1024/1024|number:2 }} MB</td>
            </tr>

          </tbody>
        </table>

        <div id="upload-block-menu">
          <input id="upload-chosefiles-button" type="file" nv-file-select="" uploader="uploader" multiple/>

          <button type="button" id="upload-allfiles-button" ng-click="uploader.uploadAll()" ng-disabled="!uploader.getNotUploadedItems().length">Upload all</button>

          <div id="upload-cancel-button" ng-click="uploader.clearQueue()">Cancel</div>
        </div>
      </div>
    </div>
    <!-- ################################### -->
    <script src="js/jQuery.js"></script>
    <script type="text/javascript" src="js/home.js"></script>
  </body>
</html>
