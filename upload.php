<?php
session_start();

$target_file = "uploads/" . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
$nomarchivo = str_replace(" ", "", $_SESSION["username"] . "-" . date("m.d.y") . "-" . date("H:i:s") . "." . str_replace("image/", "", $check["mime"]));
$target_file2 = "uploads/" . $nomarchivo;

//------------SUBE ARCHIVO A CARPETA UPLOADS----------->>>
if(isset($_POST["submit"])) {
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
//------------PERMITE MAXIMO IMAGENES DE 5MB----------->>>
if ($_FILES["fileToUpload"]["size"] > 5242880) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
//------------PERMITE ESTOS FORMATOS DE IMAGEN----------->>>
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
//------------SUBE ARCHIVO A CARPETA UPLOADS----------->>>
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file2)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
//--------------------------------------------->>>
?>
