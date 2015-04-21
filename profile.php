<?php
include_once "./connect.inc.php";
include ("functions.php");
include ("functionsDB.php");
head("Profil Pixel4You");
print_header($db,"profile");

?>

<script>var myImages = 	<?php getUploads($db);	?>;</script>

<section>
	<div class="container">
		<?php

		


		if (isset($_GET["user"])) {
			$userInfo = getUserData($db,$_GET["user"]);
		}
		elseif (isset($_SESSION["user"])) {
			$userInfo = $_SESSION["user"];
		}
		if(isset($userInfo)){
		?>

		<div class="user_info_container bg4 color1 shaddow">
			<div class="user_info  ">
				<div class="user_info_image">
					<img src="<?php echo $userInfo["image"]?>">
				</div>
				<div class="user_info_nick  padding bg5 color3">
					#<?php echo $userInfo["login"];?>
				</div>
				<div class="user_info_name_surname padding">
					<?php echo $userInfo["name"] . " " . $userInfo["surname"];?>	
				</div>
				<div class="user_info_focus padding">
					zameranie autora
				</div>
				<div class="user_info_bio_header bg5 color3">
					bio:
				</div>
				<div class="user_info_bio padding">
					<?php echo $userInfo["bio"];?>
				</div>
				<div class="user_info_websites padding color1">
					<a href="" class="color1" target="blank">www.nazov.stranky.com</a>
				</div>
				<div class="user_info_email padding color1">
					<?php echo $userInfo["email"];?>
				</div>
			</div>
		</div>



		<script>

			printImageMaxContainer();
			printMiniatures("20%", "180px");
		</script>
		

		<?php
		}
		else printNotSigned();
		?>


	</div>
</section>

<?php
print_footer();
?>


