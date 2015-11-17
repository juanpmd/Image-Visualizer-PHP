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
    //---------FUNCION PARA AGREGAR UN USUARIO----------------->>>
    private function addNewUser() {
      if ($this->get_request_method () != "POST") {
  			$this->response ( '', 406 );
  		}
  		$users = new Users();
  		$data = json_decode(file_get_contents('php://input'),true);
  		$users->addNewUser($data);
  		$this->response('', 200 );
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
    //--------DEVUELVE TODAS LAS IMAGENES DE UN USUARIO------------------>>>
    private function allFiles() {
      session_start();
  		if ($this->get_request_method () != "GET") {
  			$this->response ( '', 406 );
  		}
  		$phonebook = new Files();
  		$result = $phonebook->showAllImages($_SESSION["username"]);

  		if($result->num_rows > 0){
  			$array=$result->fetch_all(MYSQLI_ASSOC);
  			$jsonVar = $this->json($array);
  			$this->response($jsonVar, 200 );
  		}else {
        echo "no llego";
  			$this->response('', 204 );
  		}
  	}
    //---------PARA FUNCION ALLFILES()------------->>>
    private function json($data) {
  		if (is_array ( $data )) {
  			return json_encode ( $data );
  		}
  	}
    //----------------------------->>>
    private function removeImage() {
  		if ($this->get_request_method () != "POST") {
  			$this->response ( '', 406 );
  		}
  		$file = new Files();
  		$data = json_decode(file_get_contents('php://input'),true);
      $file->deleteImageCategoriesById($data["id"]);
  		$file->deleteImageById($data["id"]);
  		$this->response('', 200 );
  	}
    //----------------------------->>>
    private function allCategories() {
      if ($this->get_request_method () != "POST") {
  			$this->response ( '', 406 );
  		}
  		$usuario = new Files();
  		$data = json_decode(file_get_contents('php://input'),true);
      $result=$usuario->getCategoriesbyID($data["id"]);
      if($result->num_rows > 0){
  			$array=$result->fetch_all(MYSQLI_ASSOC);
  			$jsonVar = $this->json($array);
  			$this->response($jsonVar, 200 );
  		}else {
        echo "no llego";
  			$this->response('', 204 );
  		}
  	}
    //----------------------------->>>
    private function addCategorybyName() {
      if ($this->get_request_method () != "POST") {
  			$this->response ( '', 406 );
  		}
  		$usuario = new Files();
  		$data = json_decode(file_get_contents('php://input'),true);
      $valor = ["name"=>$data["name"]];
      $result=$usuario->addCategory($valor);

      $finales=$usuario->getCategorybyName($data["name"]);
    	$contactArray=$finales->fetch_all(MYSQLI_ASSOC);
      $usuario->addImageCategoryRelation($contactArray[0]['ID'], $data["id"]);

  	}
    //----------------------------->>>
    private function DeleteCategorybyID() {
      if ($this->get_request_method () != "POST") {
  			$this->response ( '', 406 );
  		}
  		$usuario = new Files();
  		$data = json_decode(file_get_contents('php://input'),true);
      $result=$usuario->deleteImageCategoryRelation($data["id"]);
      $this->response('', 200 );

  	}
    //----------------------------->>>
    private function allCarpets() {
      session_start();
      if ($this->get_request_method () != "POST") {
  			$this->response ( '', 406 );
  		}
  		$usuario = new Files();
  		$data = json_decode(file_get_contents('php://input'),true);
      $result=$usuario->getCarpetsbyID($_SESSION["username"]);
      if($result->num_rows > 0){
  			$array=$result->fetch_all(MYSQLI_ASSOC);
  			$jsonVar = $this->json($array);
  			$this->response($jsonVar, 200 );
  		}else {
        echo "no llego";
  			$this->response('', 204 );
  		}
  	}
    //----------------------------->>>
    private function addCarpetbyName() {
      session_start();
      if ($this->get_request_method () != "POST") {
  			$this->response ( '', 406 );
  		}
  		$usuario = new Files();
  		$data = json_decode(file_get_contents('php://input'),true);
      $result=$usuario->addCarpet($data["name"]);

      $finales=$usuario->getCarpetbyName($data["name"]);
    	$contactArray=$finales->fetch_all(MYSQLI_ASSOC);
      $usuario->addCarpetUserRelation($contactArray[0]['ID'], $_SESSION["username"]);

  	}
    //----------------------------->>>
    private function DeleteCarpetID() {
      if ($this->get_request_method () != "POST") {
  			$this->response ( '', 406 );
  		}
  		$usuario = new Files();
  		$data = json_decode(file_get_contents('php://input'),true);
      $result=$usuario->deleteCarpetUserRelation($data["id"]);
      $this->response('', 200 );

  	}
    //----------------------------->>>
  }
  $api = new WebAPI();
  $api->processApi();
?>
