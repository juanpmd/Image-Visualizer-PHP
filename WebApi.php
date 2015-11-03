<?php
  require_once 'Controllers/RestApi.php';
  require_once 'Models/Users.php';
  require_once 'Models/Files.php';

  class WebAPI extends REST {
    //-------------------------->>>
    public function processApi() {
      $func = strtolower (trim (str_replace ( "/", "", $_REQUEST ['val'])));
      if (( int ) method_exists ($this, $func) > 0)
        $this->$func ();
      else
        $this->response ( '', 404 );
    }
    //---------FUNCION PARA DESTRUIR SESION AL DAR LOGOUT----------------->>>
    private function Logout(){
        session_start();
        session_unset();
        session_destroy();
    }
    //--------FUNCION PARA VALIDAR UN USUARIO PARA LOGIN------------------>>>
    private function ValidacionUsuario(){
      if ($this->get_request_method () != "POST") {
  			$this->response ( '', 406 );
  		}
  		$usuario = new Users();
  		$data = json_decode(file_get_contents('php://input'),true);
      $result=$usuario->getUserState($data["username"],$data["password"]);
      if ($result == "yes"){
        session_start();
        $_SESSION["username"] = $data["username"];
        $this->response('', 200 );
      } else {
        $this->response('', 404 );
      }
    }
    //-------------------------->>>
    /*private function UploadFile(){
      if ($this->get_request_method () != "POST") {
  			$this->response ( '', 406 );
  		}
  		$usuario = new Files();
  		$data = json_decode(file_get_contents('php://input'),true);
      $result=$usuario->addNewImages($data["username"],$data["password"]);
      if ($result == "yes"){
        session_start();
        $_SESSION["username"] = $data["username"];
        $this->response('', 200 );
      } else {
        $this->response('', 404 );
      }
    }*/
    //-------------------------->>>
    private function allFiles() {
  		if ($this->get_request_method () != "GET") {
  			$this->response ( '', 406 );
  		}
  		$phonebook = new Files();
  		$result = $phonebook->showAllImages();

  		if($result->num_rows > 0){
  			$array=$result->fetch_all(MYSQLI_ASSOC);
  			$jsonVar = $this->json($array);
  			$this->response($jsonVar, 200 );
  		}else {
  			$this->response('', 204 );
  		}
  	}
    //-------------------------->>>
    //-------------------------->>>
  }
  $api = new WebAPI();
  $api->processApi();
?>
