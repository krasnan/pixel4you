<?php





session_start();
include("./functionsDB.php");
$image = $_FILES["input_f"];
$name = mysql_real_escape_string(trim($_POST["name"]));
$describtion = mysql_real_escape_string($_POST["describtion"]);
$category = mysql_real_escape_string(trim($_POST["category"]));
/*
$album = mysql_real_escape_string(trim($_POST["album"]));
*/
if($file = imageUpload($image, $name, "./uploads/", 8000000, $_SESSION["user"]["id"], $_SESSION["user"]["login"], /*$album,*/ $describtion, $category)){
	header("Location:./upload.php?u=". $name . "");
}



?>