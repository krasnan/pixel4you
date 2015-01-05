<?php

date_default_timezone_set("UTC");
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "pixel4you";

function spoj_s_db() {
	if ($link = mysqli_connect('localhost', 'root', 'usbw', 'pixel4you')) {
		mysqli_query($link,"SET CHARACTER SET 'utf8'"); 
		return $link;
	} 
	else {
		// NEpodarilo sa spojiť s databázovým serverom!
		return false;
	}
}


function imageUpload($image, $name, $dir, $maxSize, $owner, $album, $describtion, $category)
{
	if ($image["size"] > $maxSize) {
		echo "Obrázok je príliš veľký, maximálna veľkosť obrázka je " . $maxSize . "B.";
		return false;
	}
	$imageFileType = pathinfo($image["name"],PATHINFO_EXTENSION);

	$targetFile = $dir . uniqid() . "." . $imageFileType;

	// pokial taky subor uz existuje tak generuj ine meno suboru 
	while(file_exists($targetFile)) {
		$targetFile = $dir . uniqid() . "." . $imageFileType;
	}
	// ak sa ulozenie podari tak vrat cestu k suboru na serveri
	if (move_uploaded_file($image["tmp_name"], $targetFile)) {
		imageToDB($name, $targetFile, $owner, $imageFileType, $image["size"], $album, $describtion, $category);
		return $name;
	}
	else{
		return false;
	}

}

function userToDB ($login, $passwd, $email, $name, $surname, $bio, $websites, $birthdate, $regdate){
	if ($conn = spoj_s_db()) {
		
		$sql = "INSERT INTO `users` 
			(`id`, `login`, `passwd`, `email`, `name`, `surname`, `bio`, `websites`, `birthdate`, `regdate`, `image`) 
			VALUES (NULL, '$login', MD5('$passwd'), '$email', '$name', '$surname', '$bio', '$websites', '$birthdate', '$regdate', 0)";

		if (mysqli_query($conn, $sql)) {
		    $last_id = mysqli_insert_id($conn);
		    mysqli_close($conn);
		    return $last_id;
		} 
		else {
		    mysqli_close($conn);
		    return false;
		}
	}

	else{
		die("Connection failed: " . mysqli_connect_error());
		return false;
	}
}

function imageToDB($name, $path, $owner, $type, $size, $album, $describtion, $category)
{
	if ($conn = spoj_s_db()) {

		$sql = "INSERT INTO `uploads` 
		(`id`, `name`, `path`, `owner`, `type`, `size`, `album`, `describtion`, `category`, `likes`, `downloads`, `comments`) 
		VALUES (NULL, '$name', '$path', '$owner','$type', '$size', '$album', '$describtion', '$category', '0', '0', '0')";
		
		if (mysqli_query($conn, $sql)) {
		    $last_id = mysqli_insert_id($conn);
		    mysqli_close($conn);
		    return $last_id;
		} 
		else {
		    mysqli_close($conn);
		    return false;
		}
	}

	else{
		die("Connection failed: " . mysqli_connect_error());
		return false;
	}
}

function albumToDb($author, $name, $public, $describtion){
	if ($conn = spoj_s_db()) {
		$date = date("Y-m-d");
		$sql = "INSERT INTO `albums`
		(`id`, `author`, `name`, `date`, `public`, `describtion`, `likes`) 
		VALUES (NULL,'$author','$name','$date','$public','$describtion','0')";

		if (mysqli_query($conn, $sql)) {
		    $last_id = mysqli_insert_id($conn);
		    mysqli_close($conn);
		    return $last_id;
		} 
		else {
		    mysqli_close($conn);
		    return false;
		}
	}
	else{
		die("Connection failed: " . mysqli_connect_error());
		return false;
	}
}


function userProfileImageChange($userId, $image){
	if ($conn = spoj_s_db()) {
		$sql = "UPDATE  `pixel4you`.`users` SET  `image` =  '$image' WHERE  `users`.`id` = '$userId'";

		if (mysqli_query($conn, $sql)) {
		    $last_id = mysqli_insert_id($conn);
		    mysqli_close($conn);
		    return $last_id;
		} 
		else {
		    mysqli_close($conn);
		    return false;
		}
	}

	else{
		die("Connection failed: " . mysqli_connect_error());
		return false;
	}
}

function printAlbumsOptions($userId)
{
	if ($conn = spoj_s_db()) {
		$sql = "SELECT * FROM `albums` WHERE `author` = '$userId'";

		$result = mysqli_query($conn, $sql);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<option value='" . $row['id'] . "'";
				echo '>' . $row['name'] . "</option>\n";
			}
			mysqli_free_result($result);
		}
	}
	else{
		die("Connection failed: " . mysqli_connect_error());
		return false;
	}
}

function printCategoryOptions($userId)
{
	if ($conn = spoj_s_db()) {
		$sql = "SELECT * FROM `category` WHERE 1";

		$result = mysqli_query($conn, $sql);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {

				echo "<option value='" . $row['id'] . "'";
				if ($row['id'] == 1) { echo "selected";}
				echo '>' . $row['name'] . "</option>\n";
			}
			mysqli_free_result($result);
		}
	}
	else{
		die("Connection failed: " . mysqli_connect_error());
		return false;
	}
}


?>