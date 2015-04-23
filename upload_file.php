<?php





session_start();
include("./functionsDB.php");
include_once "./connect.inc.php";
$image = $_FILES["input_f"];
$name = $_POST["name"];
$describtion = $_POST["describtion"];
$category = $_POST["category"];
/*
$album = mysql_real_escape_string(trim($_POST["album"]));
*/
if($file = imageUpload($db, $image, $name, "./uploads/", 8000000, $_SESSION["user"]["id"], $_SESSION["user"]["login"], /*$album,*/ $describtion, $category)){
	header("Location:./upload.php?u=". $name . "");
}



?>