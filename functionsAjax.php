<?php
include("functionsDB.php");
include_once "./connect.inc.php";
$func = $_POST["func"];

switch ($func) {
	case 'addLike':
		echo addLikes($db,$_POST["id"]);
		break;
	
	case 'addDownload':
		echo addDownloads($db,$_POST["id"]);
		break;

	default:
		echo "ziadna funkcia";
		break;
}
?>