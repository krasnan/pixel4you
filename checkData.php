<?php
include("functionsDB.php");
if ($conn = spoj_s_db()) {
	$data = mysql_real_escape_string(trim(strtolower($_POST['data'])));
	$table = trim($_POST["table"]);
	$where = trim($_POST["where"]);

	$sql = "SELECT * FROM  `$table` WHERE  `$where` =  '$data'";
	$result = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($result);
	/*echo mysql_num_rows($result);*/
	if($result[$where] == $data){
		echo 1;
	}
	else {
		echo 0;
	}
}
else {
	echo 0;
}