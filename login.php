<?php
include("functionsDB.php");

$login = mysql_real_escape_string(trim($_POST['login_name']));
$passwd = mysql_real_escape_string(trim($_POST["login_passwd"]));

include_once "./connect.inc.php";
$row = $db->users("login", $login)->and("passwd",hash("sha512",$passwd))->fetch();
if ($row) {
		session_start();
		$_SESSION["user"] = iterator_to_array($row);
		echo json_encode(array("success"=> true, "msg"=>"Prihlásenie používateľa " . $_SESSION["user"]["login"] . " úspešné.  "));
}
else{
	echo json_encode(array("success" => false , "msg" => "Prihlasovacie meno/heslo nieje správne!"));
}
?>