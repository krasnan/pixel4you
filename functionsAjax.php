<?php
include("functionsDB.php");

$func = $_POST["func"];

switch ($func) {
	case 'addLike':
		echo addLikes($_POST["id"]);
		break;
	
	case 'addDownload':
		echo addDownloads($_POST["id"]);
		break;

	default:
		echo "ziadna funkcia";
		break;
}
?>