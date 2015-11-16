<?php
require_once 'DB/DB.php';

class Files extends DB {
  const INSERT_IMAGE = "insert into images(username_id,name,datatype) values (?,?,?)";
  const ALL_IMAGES = "select * from images where username_id=?";
  const DELETE_IMAGE = "delete from images where id=?";
  const GET_IMAGE = "select * from images where id=?";
  const DELETE_IMAGE_CATEGORIES = "delete from ImagexCategories where Image_ID=?";
  const GET_CATEGORIES_USER = "select Categories.ID AS IDCategoria, Categories.name, ImagexCategories.ID from Categories JOIN ImagexCategories on Categories.ID = ImagexCategories.Category_ID where ImagexCategories.Image_ID = ?";
  const INSERT_CATEGORY = "insert into Categories(name) values (?)";
  const GET_CATEGORY_NAME = "select * from Categories where name=?";
  const INSERT_IMAGECATEGORY = "insert into ImagexCategories(Category_ID,Image_ID) values (?,?)";
  const DELETE_IMAGECATEGORY = "delete from ImagexCategories where ID=?";

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
  public function getImagebyID($id){
    $arguments = ["id"=>$id];
    $result = $this->query(self::GET_IMAGE, $arguments);
    if ($result != false) {
      return $result;
    }else{
      die("algo salio mal");
    }
  }
  //-------------ELIMINAR CATEGORIAS RELACIONADAS A UNA IMAGEN----------------->>>
  public function deleteImageCategoriesById($id){
		$arguments = ["id"=>$id];
		$result=$this->query(self::DELETE_IMAGE_CATEGORIES,$arguments);
	}
  //----------COGE INFO IMAGEXCATEGORIES PARA IMPRIMIR CATEGORIAS DE IMAGEN-------------->>>
  public function getCategoriesbyID($id){
    $arguments = ["id"=>$id];
    $result=$this->query(self::GET_CATEGORIES_USER,$arguments);
    if ($result != false) {
      return $result;
    }else{
      die("algo salio mal");
    }
  }
  //---------------------------------->>>
  public function addCategory($contact){
    $this->open_connection();
    $statement = $this->conn->prepare(self::INSERT_CATEGORY);
    if($statement){
      if (!is_null($contact) && count($contact)>0) {
        $statement->bind_param ("s", $contact['name']);
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
  //------------IMPRIME INFO DE UNA SOLA CATEGORIA---------------------->>>
  public function getCategorybyName($name){
    $arguments = ["name"=>$name];
    $result=$this->query(self::GET_CATEGORY_NAME,$arguments);
    if ($result != false) {
      return $result;
    }else{
      die("algo salio mal");
    }
  }
  //---------------------------------->>>
  public function addImageCategoryRelation($category, $temp){
    $contact = ["Category_ID"=>$category, "Image_ID"=>$temp];
    $this->open_connection();
    $statement = $this->conn->prepare(self::INSERT_IMAGECATEGORY);
    if($statement){
      if (!is_null($contact) && count($contact)>0) {
        $statement->bind_param ("ss", $contact['Category_ID'],$contact['Image_ID']);
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
  public function deleteImageCategoryRelation($id){
    //$arguments = ["Category_ID"=>45, "Image_ID"=>22];
    $arguments = ["ID"=>$id];
		$result=$this->query(self::DELETE_IMAGECATEGORY,$arguments);
  }
  //---------------------------------->>>
}
?>
