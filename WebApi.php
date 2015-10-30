<?php
  require_once 'Controllers/RestApi.php';
  require_once 'Models/Users.php';

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
  }
  $api = new WebAPI();
  $api->processApi();
?>
