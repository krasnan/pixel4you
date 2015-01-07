<?php
include("functionsDB.php");

$login = mysql_real_escape_string(trim($_POST['login_name']));
$passwd = mysql_real_escape_string(trim($_POST["login_passwd"]));
if ($conn = spoj_s_db()) {
	$sql="SELECT * FROM `users` WHERE login='$login' and passwd= MD5('$passwd')";
	$result = mysqli_query($conn, $sql);

	

	if ($result && (mysqli_num_rows($result) > 0)) {
		$row = mysqli_fetch_assoc($result);
		session_start();
		$_SESSION["userId"] = $row["id"];
		$_SESSION["userLogin"] = $row["login"];
		$_SESSION["userName"] = $row["name"];
		$_SESSION["userSurname"] = $row["surname"];
		$_SESSION["userBio"] = $row["bio"];
		$_SESSION["userWebsites"] = $row["websites"];
		$_SESSION["userBirthdate"] = $row["birthdate"];
		$_SESSION["userRegdate"] = $row["regdate"];
		$_SESSION["userImage"] = $row["image"];
		echo "prihlasenie uspesne " . $_SESSION["userLogin"];
		mysqli_close($conn);
		header( "Location: ./" ); 

	} 
	else {
	    mysqli_close($conn);
	    header( "Location: ./" ); 
	    return false;
	}
}

else{
	die("Connection failed: " . mysqli_connect_error());
	return false;
}

?>