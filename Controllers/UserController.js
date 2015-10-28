
var app = angular.module('UserApp', []);

app.controller("UserAppController", ['$scope', '$http',
  function($scope, $http){

    //------------------->>>
    $scope.UserLogout = function(){
      $http.post('UserApi.php?val=Logout').success(function(data) {
        window.location.replace("http://localhost:8888/SeekInspire/index.php");
			}).error(function(data) {
				console.log('Error: ' + data);
			});
    }
    //------------------->>>
    $scope.login = function(){
      $http.post('UserApi.php?val=ValidacionUsuario',{
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

  }
]);
