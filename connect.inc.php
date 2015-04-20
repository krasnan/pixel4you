<?php
include "./notorm/NotOrm.php";
$user = "root";
$pass = "usbw";
$pdo = new PDO('mysql:host=localhost:3307;dbname=pixel4you', $user, $pass);
$pdo->exec("set names utf8");
$db = new NotOrm($pdo);
date_default_timezone_set("UTC");

?>