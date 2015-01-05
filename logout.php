<?php
session_start();
if (isset($_SESSION["userLogin"])) {
	session_unset();
	session_destroy();
}
header( "Location: ./" ); 


?>