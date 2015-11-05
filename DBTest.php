<?php
require_once 'DB/DB.php';
require_once 'Models/Users.php';
require_once 'Models/Files.php';

$user = new Users ();
$file = new Files ();

$nuevaimg = ["username_id"=>"juanpmd","name"=>"uploads/parrilla_15.jpg","datatype"=>"jpg"];
insertNewImage($file, $nuevaimg);
printAllImages($file,"juanpmd");

//-------FUNCION PARA INGRESAR USUARIO NUEVO------------------->>>
function insertNewUser($user, $contact){
	$result = $user->addNewUser($contact);
	return $result;
}
//-------IMPRIMIR TODOS LOS USUARIOS EN BD------------------->>>
function printAllUsers($user) {
	$result=$user->showAllUsers();
	$contactArray=$result->fetch_all(MYSQLI_ASSOC);
	foreach ($contactArray as $contact) {
		echo "Username: ", $contact['username'],"<br>";
    echo "Name: ", $contact['name'],"<br>";
		echo "Password: ", $contact['password'],"<br>";
    echo "Email: ", $contact['email'],"<br>";
    echo "------------------------------------------->>><br>";
	}
}
//---------BUSCA DATOS USUARIO POR USERNAME----------------->>>
function getUserbyID($user,$username){
	$result=$user->getUser($username);
	$contact=$result->fetch_array(MYSQLI_ASSOC);
	echo "Username:".$contact['username']."<br>";
	echo "Password:", $contact['password'],"<br>";
	echo "Name:", $contact['name'],"<br>";
	echo "Email:", $contact['email'],"<br>";
}
//-------------------------->>>
function UserState($user,$username,$password){
	#$pass = md5($password);
	$result=$user->getUserState($username,$password);
	echo $result;
}
//--------IMPRIMIR IMAGENES DE UN USUARIO------------------------------->>>
function printAllImages($user,$id) {
	$result=$user->showAllImages($id);
	$contactArray=$result->fetch_all(MYSQLI_ASSOC);
	foreach ($contactArray as $contact) {
		echo "ID: ", $contact['id'],"<br>";
    echo "username_id: ", $contact['username_id'],"<br>";
		echo "name: ", $contact['name'],"<br>";
    echo "creationdate: ", $contact['creationdate'],"<br>";
    echo "------------------------------------------->>><br>";
	}
}
//------------------------------------------------------------->>>
function insertNewImage($user, $contact){
	$result = $user->addNewImages($contact);
	return $result;
}
//-------------------------->>>
//-------------------------->>>

?>
