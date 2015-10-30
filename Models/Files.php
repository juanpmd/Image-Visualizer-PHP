<?php
require_once 'DB/DB.php';

class Files extends DB {
  const ALL_IMAGES = "select * from images";
  const INSERT_IMAGE = "insert into images(username_id,name) values (?,?)";
  //---------------------------------->>>
  public function showAllImages(){
    $result = $this->query(self::ALL_IMAGES);
    if ($result != false) {
      return $result;
    }else{
      die("algo salio mal");
    }
  }
  //---------------------------------->>>
  public function addNewImages($contact) {
    $this->open_connection();
    $statement = $this->conn->prepare(self::INSERT_IMAGE);
    if($statement){
      if (!is_null($contact) && count($contact)>0) {
        $statement->bind_param ("ss", $contact['username_id'], $contact['name']);
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
  //---------------------------------->>>
  //---------------------------------->>>
}
?>
