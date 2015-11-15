
var app = angular.module('WebApp', ['angularFileUpload']);

app.controller("WebAppController", ['$scope', '$http', 'FileUploader',
  function($scope, $http, FileUploader){

    $scope.imagenes = [];
    $scope.select = false;
    $scope.estado = 0;
    $scope.imagendetalle = "";

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
    //-------FUNCION PARA DESPLEGAR IMAGENES EN PANTALLA------------>>>
    $scope.getImages = function(){
      $http.get('WebApi.php?val=allFiles').success(function(data) {
    		$scope.imagenes = data;
    		//console.log(data);
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------CLICK EN IMAGEN PARA ABRIR PANEL DE SU INFORMACION------------->>>
    $scope.Sacar_Info = function(data){
      console.log(data.id);
      $scope.imagendetalle = ""
      $scope.imagendetalle = data.name;
      $("#image_info_page").fadeIn(200).removeClass("hidden");
      $("#image-categories").animate({width:'toggle'},100).removeClass("hidden");
    }
    //------------------->>>
    $scope.getImages();




    //#############################----->>>>
    var uploader = $scope.uploader = new FileUploader({
      url: 'UploadApi.php'
    });
    //#############################----->>>>
  }
]);
