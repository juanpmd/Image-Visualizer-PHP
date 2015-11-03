
var app = angular.module('WebApp', []);

app.controller("WebAppController", ['$scope', '$http',
  function($scope, $http){

    $scope.imagenes = [];

    //------------------->>>
    $scope.UserLogout = function(){
      $http.post('WebApi.php?val=Logout').success(function(data) {
        window.location.replace("http://localhost:8888/SeekInspire/index.php");
			}).error(function(data) {
				console.log('Error: ' + data);
			});
    }
    //------------------->>>
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
    //------------------->>>
    $scope.getImages = function(){
      $http.get('WebApi.php?val=allFiles').success(function(data) {
    		$scope.imagenes = data;
    		//console.log(data);
    	}).error(function(data) {
    		console.log('Error: ' + data);
    	});
    }
    //------------------->>>
    $scope.getImages();
  }
]);
