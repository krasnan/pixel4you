<?php
date_default_timezone_set("UTC");
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "pixel4you";

function spoj_s_db() {
	/*
	* Funkcia sluzi na pripojenie k databaze
	* pri uspesnom pripojeni k databaze funkcia vracia vysledok mysqli_connect
	* pri neuspesnom pripojeni vracia funkcia false
	*/
	if ($link = mysqli_connect('localhost', 'root', 'usbw', 'pixel4you')) {
		mysqli_query($link,"SET CHARACTER SET 'utf8'"); 
		return $link;
	} 
	else {
		// NEpodarilo sa spojiť s databázovým serverom!
		return false;
	}
}

function actualDate(){
	/*
	* Vrati aktualny datum vo formate pre SQL databazu yyyy-mm-dd
	*/
	return date("Y-m-d");
}

function userToDB ($login, $passwd, $email, $name, $surname, $bio, $websites, $birthdate, $regdate){
	/*
	* funkcia na pridanie pouzivatela do DB pri registracii
	* pri neuspesnom pripojeni k DB vrati false
	* pri neuspesnom vlozeni do DB vrati false 
	* pri uspesnom vlozeni pouzivatela vrati funkcia id tohto pouzivatela
	*/
/*
	$result = $db->users()->insert((array(
		"login"     => $login, 
		"passwd"    => MD5('$passwd'), 
		"email"     => $email, 
		"name"      => $name, 
		"surname"   => $surname, 
		"bio"       => $bio, 
		"websites"  => $websites, 
		"birthdate" => $birthdate, 
		"regdate"   => $regdate, 
		"image"     => 0
		)));
	return true;

*/

	if ($conn = spoj_s_db()) {
		
		$sql = "INSERT INTO `users` 
			(`id`, `login`, `passwd`, `email`, `name`, `surname`, `bio`, `websites`, `birthdate`, `regdate`, `image`) 
			VALUES (NULL, '$login', MD5('$passwd'), '$email', '$name', '$surname', '$bio', 
			'$websites', '$birthdate', '$regdate', 0)";

		if (mysqli_query($conn, $sql)) {
		    $last_id = mysqli_insert_id($conn); // nacitaj posledne id dopytu
		    mysqli_close($conn); // ukonci pripojenie k DB
		    return $last_id; // vrat id prave pridaneho pouzivatela 
		} 
		else {
			// ak sa nepodari vlozenie do DB
		    mysqli_close($conn); 
		    return false;
		}
	}

	else{
		// ak sa nepodari connect na DB
		die("Connection failed: " . mysqli_connect_error());
		return false;
	}
} 

function imageUpload($image, $name, $dir, $maxSize, $owner, $author,/* $album,*/ $describtion, $category){
	/*
	* funkcia sluzi na ulozenie obrazka na server a vlozenie informacii o nom do DB
	* ak sa nepodari vlozit obrazok do DB vrat false
	* inak vrat cestu k obrazku
	* 
	*/
	

	// over ci obrazok nieje prilis velky
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

		// vloz do DB
		imageToDB($name, $targetFile, $owner, $author, $imageFileType, $thumb, $image["size"], /*$album, */$describtion, $category);

		// vrat cestu k suboru na serveri 
		return $targetFile;
	}
	else{
		// ak sa nepodari vlozit vrat false
		return false;
	}

}


function imageToDB($name, $path, $owner, $author, $type, $thumb, $size,  /*$album,*/ $describtion, $category){
	/*
	* funkcia na vlozenie informacii o obrazku do DB 
	* ak sa nepodari connect vrat false
	* ak sa nepodari vykonat dopyt vrat false
	* ak sa podari vlozit vrat id prave nahratej polozky
	* 
	*/
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
	/*
	* funkcia na vytvorenie miniatur nahravanych obrazkov
	* ak je obrazok zleho typu tak vrat false
	* ak sa podari vytvorit miniaturu, vloz ju do priecinka $img_dir a vrat cestu k tejto miniature
	*/
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

function printCategoryOptions(){
	/*
	* vypise zoznam kategorii ako options
	*/
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


function getUserUploads($userId = NULL){
	/*
	* vrati JSON 
	* 
	*/
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

function deleteUserUpload($id, $ownerId){
	if ($conn = spoj_s_db()) {
		$sql = "SELECT * FROM  `uploads` WHERE  `id` =1 LIMIT 1";

		$result = mysqli_query($conn, $sql);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$owner = $row['owner'];
				$path = $row['path'];
				$thumb = $row['thumb'];
			}
			mysqli_free_result($result);
		}
		if($owner == $ownerId){
			$sql = "DELETE * FROM  `uploads` WHERE  `id` = 1 LIMIT 1";
			$result = mysqli_query($conn, $sql);
			if($result){
				unlink($path);
				unlink($thumb);
				echo "Obrazok bol vymazany";
			}
			else{
				echo "Obrazok sa nepodarlo vymazat";
			}
		}
	}
	else{
		die("Connection failed: " . mysqli_connect_error());
		return false;
	}

}

function addLikes($id){
	include_once "./connect.inc.php";
	$image = $db->uploads[$id];
	$image["likes"] = $image["likes"] + 1;
	return $image->update();
}
function addDownloads($id){
	include_once "./connect.inc.php";
	$image = $db->uploads[$id];
	$image["downloads"] = $image["downloads"] + 1;
	return $image->update();
}


?>