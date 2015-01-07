<?php
include ("functions.php");
head("Pixel4You-rp1");
header('Content-type: charset=utf-8');
print_header("register");
?>

<script type="text/javascript" src="./validations.js"></script>


<section>
	<div class="container">

		<?php
		if (isset($_POST["submit"])) {
			include("./functionsDB.php");

			$login = mysql_real_escape_string(trim(strtolower($_POST['reg_login'])));
		    $passwd = mysql_real_escape_string(trim($_POST['password']));
			$passwd2 = mysql_real_escape_string(trim($_POST['password2']));
			$email = mysql_real_escape_string(trim(strtolower($_POST['email'])));
			$name = mysql_real_escape_string(trim($_POST['name']));
			$surname = mysql_real_escape_string(trim($_POST['surname']));
			$bio = mysql_real_escape_string(trim($_POST['bio']));
			$image = $_FILES["input_f"];
			$regdate = date("Y-m-d");

			$birthdate = date("Y-m-d");
			$websites = "www.pixel4ypu.sk";


			
			$userId = userToDB ($login, $passwd, $email, $name, $surname, $bio, $websites, $birthdate, $regdate);
			echo $userId . "<br>";
			$albumId = albumToDb($userId, $name, true, "Obrzky profilu");
			echo $albumId . "<br>";
			echo $image["name"];
			if (! empty($image["name"])) {

				$img = imageUpload($image, "", "./uploads/", 5000000, 1, $login,/* $album,*/ "Obrázok profilu", 1);
				echo "image " . $img . "<br>";
				if ($img != false) {

					userProfileImageChange($userId, $img);
					echo "profilova foto zmenena";
				}
				else{
					userProfileImageChange($userId, "./img/default_profile_image.png");
					echo "profilova foto nezmenena";
				}
			}
			else{
				userProfileImageChange($userId, "./img/default_profile_image.png");
				echo "profilova foto nezmenena, chyba2";
			}
			


			echo "<p>registracia uspesna</p>";
			?>
			<a href="./index.php" class="button bg4 color1">návrat na hlavnú stránku</a>
			<?php
			/*header('Location: '. $_SERVER['PHP_SELF']);*/
		}
		else{
			printRegistrationForm();
		}
		
		?>




	</div>
</section>

<?php
print_footer();
?>