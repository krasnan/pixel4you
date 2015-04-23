<?php
include ("functionsDB.php");
include_once "./connect.inc.php";
session_start();

$name = $_POST['name'];
$surname = $_POST['surname'];
$bio = $_POST['bio'];
$image = $_FILES["input_f"];
$userId = $_SESSION["user"]["id"];
$userLogin = $_SESSION["user"]["login"];
$resultImage = false;

// ulozi zmeny do databazy
$resultInfo = userBasicUpdateDB($db,$userId, $name,$surname, $bio);

// ak sa nieco zmeni vypise spravu
if($resultInfo){
	echo "<div class='success'>Údaje o používateľovi boli zmenené.</div>";
}
// uploadne obrazok a nahra ho do databazy
// ked uspesne uploadne tak zmeni pouzivatelovi profilovy obrazok
if(!empty($image["name"])){

	$img = imageUpload($db, $image, "Obrázok profilu", "./uploads/", 5000000, $userId, $userLogin, "Obrázok profilu", 1);

	if($img!=false){
		// ak sa podari ulozit obrazok tak zmeni informaciu o profilovom obrazku v DB
		$resultImage = userProfileImageChange($db,$_SESSION["user"]["id"], $img);
		if($resultImage){
			echo "<div class='success'>Profilový obrázok zmenený.</div>";
		}
	}
}



if ($resultInfo || $resultImage) {
	$_SESSION["user"] = getUserData($db, $userLogin);
}
else{
	echo "<div class='error'>Nevykonali sa žiadne zmeny! </div>";
}
?>