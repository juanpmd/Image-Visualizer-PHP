<?php
require_once 'DB/DB.php';

class Users extends DB {
	const ALL_USERS = "select * from user";
	const INSERT_USER = "insert into user(username,name,password,email) values (?,?,?,?)";
	const LOOK_USER = "select username, name, password, email from user where username=?";
	const LOOK_PASSWORD = "select password from user where username=?";
	const INFO_USER = "select * from user where username=?";

  //---------AGREGAR UN USUSARIO NUEVO----------------->>>
	public function addNewUser($contact) {
		$this->open_connection();
		$statement = $this->conn->prepare(self::INSERT_USER);
		if($statement){
			if (!is_null($contact) && count($contact)>0) {
				$statement->bind_param ("ssss", $contact['username'], $contact['name'], md5($contact['password']), $contact['email']);
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
  //--------MOSTRAR TODOS LOS USUARIOS------------------>>>
  public function showAllUsers(){
    $result = $this->query(self::ALL_USERS);
    if ($result != false) {
      return $result;
    }else{
      die("algo salio mal");
    }
  }
  //--------REVISA SI USUARIO ESTA EN BD------------------>>>
	public function getUser($username){
		$arguments = ["username"=>$username];
		$result=$this->query(self::LOOK_USER,$arguments);
		if ($result != false) {
				return $result;
			}else{
				die("algo salio mal en getUser");
			}
	}
	//--------RETORNA SI DATOS INPUT LOGIN IGUALES A BD------------------>>>
	public function getUserState($username,$password){
		$arguments = ["username"=>$username];
		$result=$this->query(self::LOOK_USER,$arguments);
		$contact=$result->fetch_array(MYSQLI_ASSOC);
		if (!empty($contact)){
			$pass = $contact["password"];
			$userpassword = md5($password);
			if ($pass === $userpassword){
				return "yes";
			} else {
				return "no";
			}
		} else {
			return "no";
		}
	}
  //---------------------------------->>>
	public function infoUserbyUserName($username){
		$arguments = ["username"=>$username];
		$result=$this->query(self::INFO_USER,$arguments);
		if ($result != false) {
				return $result;
			}else{
				die("algo salio mal en getUser");
			}
	}
	//---------------------------------->>>
	public function UpdateUserInfo($category, $temp){
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
}
?>
