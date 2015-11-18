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
  const GET_CARPET = "select Carpetas.ID,Carpetas.nombre,CarpetaxUser.ID AS IDRelacion from Carpetas join CarpetaxUser on Carpetas.ID = CarpetaxUser.Carpeta_ID WHERE User_ID=? ";
  const INSERT_CARPET = "insert into Carpetas(nombre) values (?)";
  const GET_CARPET_NAME = "select * from Carpetas where nombre=?";
  const INSERT_CARPETUSER = "insert into CarpetaxUser(Carpeta_ID,User_ID) values (?,?)";
  const DELETE_CARPETUSER ="delete from CarpetaxUser where ID=?";
  const DELETE_CARPETBYID = "delete FROM Carpetas where ID=?";
  const IMAGES_CARPET = "select CarpetaxImage.ID_Image, images.name, images.datatype, images.username_id, CarpetaxImage.ID_Carpeta, CarpetaxImage.ID AS IDRelacion from images JOIN CarpetaxImage on images.id = CarpetaxImage.ID_Image WHERE CarpetaxImage.ID_Carpeta = ?";
  const DELETE_CARPETIMAGE = "delete from CarpetaxImage where ID_Carpeta=?";
  const INSERT_IMAGECARPET = "insert into CarpetaxImage(ID_Carpeta,ID_Image) values (?,?)";
  const DELETE_IMAGE_CARPET_RELATION = "delete from CarpetaxImage where ID=?";

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
  //--------------AGREGAR RELACION ENTRE IMAGEN Y CATEGORIA-------------------->>>
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
  //-------------ELIMINA UNA RELACION DE CATEGORIA CON IMAGEN--------------------->>>
  public function deleteImageCategoryRelation($id){
    $arguments = ["ID"=>$id];
		$result=$this->query(self::DELETE_IMAGECATEGORY,$arguments);
  }
  //---------------------------------->>>
  public function getCarpetsbyID($id){
    $arguments = ["id"=>$id];
    $result=$this->query(self::GET_CARPET,$arguments);
    if ($result != false) {
      return $result;
    }else{
      die("algo salio mal");
    }
  }
  //---------------------------------->>>
  public function addCarpet($contact){
    $result = ["nombre"=>$contact];
    $this->open_connection();
    $statement = $this->conn->prepare(self::INSERT_CARPET);
    if($statement){
      if (!is_null($contact) && count($contact)>0) {
        $statement->bind_param ("s", $result["nombre"]);
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
  public function getCarpetbyName($name){
    $arguments = ["nombre"=>$name];
    $result=$this->query(self::GET_CARPET_NAME,$arguments);
    if ($result != false) {
      return $result;
    }else{
      die("algo salio mal");
    }
  }
  //---------------------------------->>>
  public function addCarpetUserRelation($category, $temp){
    $contact = ["Carpeta_ID"=>$category, "User_ID"=>$temp];
    $this->open_connection();
    $statement = $this->conn->prepare(self::INSERT_CARPETUSER);
    if($statement){
      if (!is_null($contact) && count($contact)>0) {
        $statement->bind_param ("ss", $contact['Carpeta_ID'],$contact['User_ID']);
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
  public function deleteCarpetUserRelation($id){
    $arguments = ["ID"=>$id];
		$result=$this->query(self::DELETE_CARPETUSER,$arguments);
  }
  //---------------------------------->>>
  public function deleteCarpetbyID($id){
    $arguments = ["ID"=>$id];
		$result=$this->query(self::DELETE_CARPETBYID,$arguments);
  }
  //---------------------------------->>>
  public function getImagesCarpetbyID($name){
    $arguments = ["id"=>$name];
    $result=$this->query(self::IMAGES_CARPET,$arguments);
    if ($result != false) {
      return $result;
    }else{
      die("algo salio mal");
    }
  }
  public function deleteCarpetImageRelation($id){
    $arguments = ["ID"=>$id];
		$result=$this->query(self::DELETE_CARPETIMAGE,$arguments);
  }
  //---------------------------------->>>
  public function addImageCarpetRelation($category, $temp){
    $contact = ["ID_Carpeta"=>$category, "ID_Image"=>$temp];
    $this->open_connection();
    $statement = $this->conn->prepare(self::INSERT_IMAGECARPET);
    if($statement){
      if (!is_null($contact) && count($contact)>0) {
        $statement->bind_param ("ss", $contact['ID_Carpeta'],$contact['ID_Image']);
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
  public function deleteImageCarpetById($id){
    $arguments = ["id"=>$id];
    $result=$this->query(self::DELETE_IMAGE_CARPET_RELATION,$arguments);
  }
  //---------------------------------->>>
  //---------------------------------->>>
  //---------------------------------->>>
}
?>
