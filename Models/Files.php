<?php
require_once 'DB/DB.php';

class Files extends DB {
  const INSERT_IMAGE = "insert into images(username_id,name,datatype) values (?,?,?)";
  const ALL_IMAGES = "select * from images where username_id=?";
  const DELETE_IMAGE = "delete from images where id=?";
  //----------FUNCION PARA AGREGAR UNA IMAGEN NUEVA------------------------>>>
  public function addNewImages($contact) {
    $this->open_connection();
    $statement = $this->conn->prepare(self::INSERT_IMAGE);
    if($statement){
      if (!is_null($contact) && count($contact)>0) {
        $statement->bind_param ("sss", $contact['username_id'], $contact['name'],$contact['datatype']);
      }
      $statement->execute();
      $result=$statement->get_result();
      $statement->close();
    }else{
      $log->error("Error preparing statement of query ".$query );
    }
    $this->close_connection();
    return $result;
  }
  //---------FUNCION PARA MOSTRAR TODAS LAS IMAGENES DE UN USUARIO------------------->>>
  public function showAllImages($id){
    $arguments = ["username_id"=>$id];
    $result = $this->query(self::ALL_IMAGES, $arguments);
    if ($result != false) {
      return $result;
    }else{
      die("algo salio mal");
    }
  }
  //---------------------------------->>>
  public function deleteImageById($id){
		$arguments = ["id"=>$id];
		$result=$this->query(self::DELETE_IMAGE,$arguments);
	}
  //---------------------------------->>>
}
?>
