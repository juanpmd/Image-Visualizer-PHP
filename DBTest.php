<?php
require_once 'DB/DB.php';
require_once 'Models/Users.php';


$user = new Users ();

$contact = ["username"=>"juanpmd","name"=>"Juan Pablo Mejia","password"=>"1234","email"=>"juanpmd@hotmail.com"];
#insertNewUser($user, $contact);
#printAllUsers($user);

//getUserbyID($user,"juanpmd");
UserState($user,"juanpmd","12345");

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


?>
