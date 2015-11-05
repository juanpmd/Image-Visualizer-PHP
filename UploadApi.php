<?php

require_once 'Models/Files.php';

function insertNewImage($user, $contact){
	$result = $user->addNewImages($contact);
	return $result;
}

if ( !empty( $_FILES ) ) {

    session_start();
    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    move_uploaded_file( $tempPath, $uploadPath );

    $file = new Files ();
    $name = "uploads/" . basename($_FILES["file"]["name"]);
    $type = str_replace("uploads/","", $name);
    $whatIWant = substr(strrchr($type, "."), 1);
    $nuevaimg = ["username_id"=>$_SESSION["username"],"name"=> $name,"datatype"=>$whatIWant];
    insertNewImage($file, $nuevaimg);

} else {}
//--------------------------------------------->>>
/*
$target_file = "uploads/" . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
$nomarchivo = str_replace(" ", "", $_SESSION["username"] . "-" . date("m.d.y") . "-" . date("H:i:s") . "." . str_replace("image/", "", $check["mime"]));
$target_file2 = "uploads/" . $nomarchivo;
*/
//--------------------------------------------->>>
?>
