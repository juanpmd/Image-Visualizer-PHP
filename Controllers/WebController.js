
var app = angular.module('WebApp', ['angularFileUpload']);

app.controller("WebAppController", ['$scope', '$http', 'FileUploader',
  function($scope, $http, FileUploader){

    $scope.imagenes = [];
    $scope.select = false;
    $scope.estado = 0;

    $scope.imagendetalle = "";
    $scope.imagenid = 0;
    $scope.categories = [];
    $scope.carpets = [];


    //--------FUNCIONES PARA METODO ELIMINAR CON CHECKBOXS----------->>>
    $scope.deleteCheckValue = function(data) {
  		if(data.select){
        $scope.deleteImage(data.id);
      }
  	};
    $scope.CheckDelete = function() {
      angular.forEach($scope.imagenes, $scope.deleteCheckValue);
  	};
    $scope.deleteImage = function(id) {
		$http.post('WebApi.php?val=removeImage',{
			id: id
			}).success(function(data) {
				$scope.imagenes = data;
        $scope.getImages();
			}).error(function(data) {
				console.log('Error: ' + data);
			});
	  }
    //--------FUNCION PARA HACER LOGOUT DE USUARIO----------->>>
    $scope.UserLogout = function(){
      $http.post('WebApi.php?val=Logout').success(function(data) {
        window.location.replace("http://localhost:8888/SeekInspire/index.php");
			}).error(function(data) {
				console.log('Error: ' + data);
			});
    }
    //--------FUNCION PARA EL LOGIN DE UN USUARIO----------->>>
    $scope.login = function(){
      $http.post('WebApi.php?val=ValidacionUsuario',{
        username: $scope.username,
        password: $scope.password

      }).success(function(data) {
				window.location.replace("http://localhost:8888/SeekInspire/home.php");
			}).error(function(data) {
				console.log('Error: ' + data);
        $scope.username="";
        $scope.password="";
			});
    }
    //--------FUNCION PARA REGISTRAR UN USUARIO----------->>>
    $scope.Registrarse = function(){
      $http.post('WebApi.php?val=addNewUser',{
        username: $scope.username2,
        name: $scope.nombre2,
        password: $scope.password2,
        email: $scope.email2
      }).success(function(data) {
        window.location.replace("http://localhost:8888/SeekInspire/index.php");
				console.log(data);
			}).error(function(data) {
				console.log('Error: ' + data);
			});
    }
    //-------FUNCION PARA DESPLEGAR IMAGENES EN PANTALLA------------>>>
    $scope.getImages = function(){
      $http.get('WebApi.php?val=allFiles').success(function(data) {
    		$scope.imagenes = data;
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------CLICK EN IMAGEN PARA ABRIR PANEL DE SU INFORMACION------------->>>
    $scope.Sacar_Info = function(data){
      $scope.imagendetalle = ""
      $scope.imagenid = data.id;
      $scope.imagendetalle = data.name;
      $("#image_info_page").fadeIn(200).removeClass("hidden");
      $("#image-categories").animate({width:'toggle'},100).removeClass("hidden");

      $scope.Actualizar_Categorias();
    }
    //------------------->>>
    $scope.Actualizar_Categorias = function(){
      $scope.categories = [];
      $http.post('WebApi.php?val=allCategories',{
        id: $scope.imagenid
      }).success(function(data) {
    		$scope.categories = data;
        //console.log(data);
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------FUNCION PARA AGREGAR CATEGORIAS A UNA IMAGEN------------->>>
    $scope.AddCategory = function(){

      $http.post('WebApi.php?val=addCategorybyName',{
        id: $scope.imagenid,
        name: $scope.categoryname
      }).success(function(data) {
        $scope.categoryname = "";
        $scope.Actualizar_Categorias();
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------------------->>>
    $scope.DeleteCategory = function(data){
      console.log(data.ID);
      $http.post('WebApi.php?val=DeleteCategorybyID',{
        id: data.ID
      }).success(function(data) {
        $scope.Actualizar_Categorias();
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------------------->>>
    $scope.Actualizar_Carpetas = function(){
      $scope.carpets = [];
      $http.post('WebApi.php?val=allCarpets').success(function(data) {
    		$scope.carpets = data;
        //console.log(data);
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------------------->>>
    $scope.AddCarpet = function(){

      $http.post('WebApi.php?val=addCarpetbyName',{
        name: $scope.carpetname
      }).success(function(data) {
        $scope.carpetname = "";
        $scope.Actualizar_Carpetas();
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------------------->>>
    $scope.getImages();
    $scope.Actualizar_Carpetas();

    //#############################----->>>>
    var uploader = $scope.uploader = new FileUploader({
      url: 'UploadApi.php'
    });
    //#############################----->>>>
  }
]);
