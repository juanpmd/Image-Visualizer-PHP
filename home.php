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

      <div id="delete-box">
        <p>Delete Selected</p>
        <button id="image-delete-click" ng-click="CheckDelete()" type="button">Delete</button>
        <p>Add to Carpet</p>
        <div id="addto-carpet-box">
          <select ng-model="SelCarpet">
            <option ng-repeat="info in carpets">{{info.nombre}}</option>
          </select>
          <button id="image-addcarpet-click" ng-click="AddCheckedtoCarpet()" type="button">Add</button>
        </div>
      </div>

      <div id="carpets-box">
        <p id="carpets-title">Carpets</p>
        <div class="carpet-fill" ng-repeat="info in carpets" >
          <p ng-click="OpenCarpet(info)">{{info.nombre}}</p>
          <img ng-click="DeleteCarpet(info)" src="img/Delete2.svg"/>
        </div>
        <form id="carpet-add-box">
            <img ng-click="AddCarpet()" src="img/Add.svg"/>
            <input ng-model="carpetname" type="text" placeholder=" Add New Carpet">
        </form>
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
      <div ng-repeat="data in imagenes" class="image-box" id="image-box-size">
        <button class="image-fill" ng-click="Sacar_Info(data)">
          <img ng-src="{{ data.name }}"/>
        </button>
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

          <div id="upload-cancel-button" ng-click="uploader.clearQueue()">Close</div>
        </div>
      </div>
    </div>
    <!-- ################################### -->
    <div id="image_info_page" class="hidden">
      <div id="image_info">
        <div id="image_info_title">
          <p>Imagen</p>
          <button type="button" id="image-info-page-close">Close</button>
        </div>
        <div id="image_info_body">
          <img ng-src="{{ imagendetalle }}" alt="" />
        </div>
      </div>
    </div>
    <!-- ################################### -->
    <div id="carpet_image_page" class="hidden">
      <div ng-repeat="data in imagescarpet" class="image-box" id="image-box-size">
        <button class="image-fill" ng-click="Sacar_Info(data)">
          <img ng-src="{{ data.name }}"/>
        </button>
        <div class="image-info-box">
        <input ng-model="data.select" type="checkbox" class="checkbox-image">
        <p class="image-info-datatype">{{ data.datatype | uppercase}}</p></div>
      </div>
    </div>

    <div id="carpet-box-page" class="hidden">
      <div id="search-box">
        <p id="carpet-info-title">{{carpet_title}}</p>
      </div>

      <div id="carpet-info-position">
        <div id="carpet-cancel-button">Close</div>
      </div>
    </div>

    <!-- ################################### -->
    <div id="image-categories" class="hidden">
      <div id="search-box">
        <form id="form-search">
          <img ng-click="AddCategory()" src="img/Add.svg"/>
          <input ng-model="categoryname" type="text" name="name" placeholder="Add New Category">
        </form>
      </div>

      <p id="category-title">Categories</p>
      <div id="image-categories-box" >
        <div class="category" ng-repeat="data in categories">
          <p>{{data.name}}</p>
          <img ng-click="DeleteCategory(data)" src="img/Delete.svg"/>
        </div>
      </div>

    </div>
    <!-- ################################### -->
    <script src="js/jQuery.js"></script>
    <script type="text/javascript" src="js/home.js"></script>
  </body>
</html>
