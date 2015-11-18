
var app = angular.module('WebApp', ['angularFileUpload']);

app.controller("WebAppController", ['$scope', '$http', 'FileUploader',
  function($scope, $http, FileUploader){

    $scope.imagenes = [];
    $scope.select = false;
    $scope.estado = 0;
    $scope.tempid = 0;
    $scope.tempname = "";

    $scope.imagendetalle = "";
    $scope.imagenid = 0;
    $scope.categories = [];
    $scope.carpets = [];
    $scope.carpet_title = "";
    $scope.imagescarpet = [];

    $scope.userscarpet = [];
    $scope.carpet_id = 0;


    //--------FUNCIONES PARA METODO ELIMINAR CON CHECKBOXS----------->>>
    $scope.deleteCheckValue = function(data) {
  		if(data.select){
        $scope.deleteImage(data.id);
      }
  	}
    $scope.CheckDelete = function() {
      angular.forEach($scope.imagenes, $scope.deleteCheckValue);
  	}
    $scope.deleteImage = function(id) {
  		$http.post('WebApi.php?val=removeImage',{
			id: id
			}).success(function(data) {
				$scope.imagenes = data;
			}).error(function(data) {
				console.log('Error: ' + data);
			});
	  }
    //------------------------>>>
    $scope.deleteCheckValue2 = function(data) {
  		if(data.select){
        console.log(data.IDRelacion);
        $scope.deleteImage2(data.IDRelacion);
      }
  	}
    $scope.CheckDeleteInCarpet = function() {
      angular.forEach($scope.imagescarpet, $scope.deleteCheckValue2);
  	}
    $scope.deleteImage2 = function(id) {
  		$http.post('WebApi.php?val=removeImage2',{
			id: id
			}).success(function(data) {
        window.location.replace("http://localhost:8888/SeekInspire/index.php");
			}).error(function(data) {
				console.log('Error: ' + data);
			});
	  }
    //------------------------>>>


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
    //------------------------>>>
    $scope.DeleteCategory = function(data){
      //console.log(data.ID);
      $http.post('WebApi.php?val=DeleteCategorybyID',{
        id: data.ID
      }).success(function(data) {
        $scope.Actualizar_Categorias();
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------------------------>>>
    $scope.Actualizar_Carpetas = function(){
      $scope.carpets = [];
      $http.post('WebApi.php?val=allCarpets').success(function(data) {
    		$scope.carpets = data;
        //console.log(data);
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------------------------>>>
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
    //------------------------>>>
    $scope.DeleteCarpet = function(data){
      $http.post('WebApi.php?val=DeleteCarpetID',{
        id: data.IDRelacion,
        idCarpeta: data.ID
      }).success(function(data) {
        $scope.Actualizar_Carpetas();
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------------------------>>>
    $scope.OpenCarpet = function(data){
      $("#carpet_image_page").fadeIn(200).removeClass("hidden");
      $("#carpet-box-page").animate({width:'toggle'},100).removeClass("hidden");

      //console.log(data.ID);
      $scope.Actualizar_Usuarios_Carpetas();
      $scope.carpet_id = data.ID;
      $scope.carpet_title = data.nombre;
      $scope.getImagesCarpet(data);
    }
    //------------------------>>>
    $scope.getImagesCarpet = function(data){
      $scope.imagescarpet = [];
      $http.post('WebApi.php?val=getImagesofCarpet',{
        IDRelacion: data.ID
      }).success(function(data) {
        $scope.imagescarpet = data;
        console.log(data);
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------------------------>>>
    $scope.AddtoCarpetCheckValue = function(data) {
      if(data["nombre"] == $scope.tempname){
        $scope.tempid = data["ID"];
      } else {}
    }
    $scope.AddCheckedtoCarpet = function() {
      $scope.tempname = $scope.SelCarpet;
      angular.forEach($scope.carpets, $scope.AddtoCarpetCheckValue); //Saca id de la carpeta
      angular.forEach($scope.imagenes, $scope.addImageCarpet); //Mete imagen a id carpeta
    }

    $scope.addImageCarpet = function(data) {
      if(data.select){
        //console.log(data.id);
        $scope.deleteImageCarpet(data.id);
      }
    }

    $scope.deleteImageCarpet = function(id) {
      $http.post('WebApi.php?val=addImageCarpetRel',{
      categoryid: $scope.tempid,
      imageid: id
      }).success(function(data) {
        window.location.replace("http://localhost:8888/SeekInspire/index.php");
      }).error(function(data) {
        console.log('Error: ' + data);
      });
    }
    //------------------------>>>
    $scope.Actualizar_Usuarios_Carpetas = function(){
      $scope.userscarpet = [];
      $http.post('WebApi.php?val=allUsersCarpets',{
        id: $scope.carpet_id
      }).success(function(data) {
    		$scope.userscarpet = data;
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------------------------>>>
    //------------------------>>>
    //------------------------>>>
    $scope.getImages();
    $scope.Actualizar_Carpetas();

    //#############################----->>>>
    var uploader = $scope.uploader = new FileUploader({
      url: 'UploadApi.php'
    });
    //#############################----->>>>
  }
]);
