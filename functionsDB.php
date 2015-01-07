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

function actualDate()
{
	return date("Y-m-d");
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

function imageUpload($image, $name, $dir, $maxSize, $owner, $author,/* $album,*/ $describtion, $category)
{
	if ($image["size"] > $maxSize) {
		echo "Obrázok je príliš veľký, maximálna veľkosť obrázka je " . $maxSize . "B.";
		return false;
	}
	$imageFileType = pathinfo($image["name"],PATHINFO_EXTENSION);

	$filename = uniqid() . "." . $imageFileType;
	$targetFile = $dir . $filename;

	// pokial taky subor uz existuje tak generuj ine meno suboru 
	while(file_exists($targetFile)) {
		$filename = uniqid() . "." . $imageFileType;
		$targetFile = $dir . $filename;
	}
	// ak sa ulozenie podari tak vrat cestu k suboru na serveri
	if (move_uploaded_file($image["tmp_name"], $targetFile)) {
		$thumb = createThumbnail($dir, $filename, $imageFileType, 300);
		imageToDB($name, $targetFile, $owner, $author, $imageFileType, $thumb, $image["size"], /*$album, */$describtion, $category);


		return $targetFile;
	}
	else{
		return false;
	}

}


function imageToDB($name, $path, $owner, $author, $type, $thumb, $size,  /*$album,*/ $describtion, $category)
{
	if ($conn = spoj_s_db()) {
		$date = actualDate();

		$sql = "INSERT INTO `uploads`
		(`id`, `name`, `path`, `thumb`, `owner`, `author`, `date`, `type`, `size`, `describtion`, `category`, `likes`, `downloads`, `comments`)
		VALUES (NULL, '$name', '$path', '$thumb', '$owner', '$author', '$date', '$type', '$size', '$describtion', '$category', '0', '0', '0')";
		
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

function createThumbnail($img_dir, $filename, $filetype, $final_width_of_image) {
	$thumbs_dir = $img_dir . 'thumbs/';
	     
    if($filetype == "jpg") {
        $im = imagecreatefromjpeg($img_dir . $filename);
    } else if ($filetype == "gif") {
        $im = imagecreatefromgif($img_dir . $filename);
    } else if ($filetype == "png") {
        $im = imagecreatefrompng($img_dir . $filename);
    }
    else{
    	return false;
    }
     
    $ox = imagesx($im);
    $oy = imagesy($im);
     
    $nx = $final_width_of_image;
    $ny = floor($oy * ($final_width_of_image / $ox));
     
    $nm = imagecreatetruecolor($nx, $ny);
     
    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
     
    if(!file_exists($thumbs_dir)) {
      if(!mkdir($thumbs_dir)) {
           die("There was a problem. Please try again!");
           return false;
      } 
       }
 
    imagejpeg($nm, $thumbs_dir . $filename);
    $tn = '<img src="' . $thumbs_dir . $filename . '" alt="image" />';
    $tn .= '<br />Congratulations. Your file has been successfully uploaded, and a      thumbnail has been created.';
    echo $tn;
    return  $thumbs_dir . $filename ;

}
function albumToDb($author, $name, $public, $describtion){
	if ($conn = spoj_s_db()) {
		$date = actualDate();
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

function printCategoryOptions()
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


function getUserUploads($userId = NULL)
{
	if ($conn = spoj_s_db()) {
		if ($userId != NULL) {
			$sql = "SELECT * FROM `uploads` WHERE `owner` = '$userId'";
		}
		else{
			$sql = "SELECT * FROM `uploads` WHERE 1";
		}
		

		$result = mysqli_query($conn, $sql);
		if ($result) {
			$rows = array();
			while ($row = mysqli_fetch_assoc($result)) {
				$rows[] = $row;
			}
			mysqli_free_result($result);
			print json_encode($rows);
		}
	}
	else{
		die("Connection failed: " . mysqli_connect_error());
		return false;
	}
}



?>