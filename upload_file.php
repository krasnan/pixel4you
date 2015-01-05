<?php





session_start();
include("./functionsDB.php");
$image = $_FILES["input_f"];
$name = mysql_real_escape_string(trim($_POST["name"]));
$album = mysql_real_escape_string(trim($_POST["album"]));
$describtion = mysql_real_escape_string($_POST["describtion"]);
$category = mysql_real_escape_string(trim($_POST["category"]));

if($file = imageUpload($image, $name, "./uploads/", 8000000, $_SESSION["userId"], $album, $describtion, $category)){
	header("Location:./upload.php?u=". $file . "");
}



?>