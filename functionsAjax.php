<?php
include("./functionsDB.php");
include_once "./connect.inc.php";
$func = $_POST["func"];

switch ($func) {
	case 'addLike':
		echo addLikes($db,$_POST["id"]);
		break;
	
	case 'addDownload':
		echo addDownloads($db,$_POST["id"]);
		break;


	case 'printComments':
		$comments = getComments($db, $_POST['image_id']);
		foreach ($comments as $key => $row) {
            echo '<div class="comment_cont"><div class="avatar"><img class="bg4" src="./img/default_profile_image.png" alt="image"></div>';
            echo '<div class="comment bg5"><div class="comment_header">';
            echo '<a href="./profile.php?user='.$row["author"].'">@'.$row["author"].'</a><div class="date_time">'.date("d.m.Y H:i:s", strtotime($row["date"])).'</div></div>';
            echo '<div class="comment_body bg4">'.$row["text"].'</div></div></div>';  
		}
		break;

	default:
		echo "ziadna funkcia";
		break;
}
?>