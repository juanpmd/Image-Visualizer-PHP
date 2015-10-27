<?php
  require_once 'Controllers/RestApi.php';
  require_once 'Models/Users.php';

  class UserAPI extends REST {
    //------------------->>>
    public function processApi() {
      $func = strtolower (trim (str_replace ( "/", "", $_REQUEST ['val'])));
      if (( int ) method_exists ($this, $func) > 0)
        $this->$func ();
      else
        $this->response ( '', 404 );
    }
    //------------------->>>
    private function Logout(){
        session_start();
        session_unset();
        session_destroy();
    }
    //------------------->>>
  }
  $api = new UserAPI();
  $api->processApi();
?>
