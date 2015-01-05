<?php
include ("functions.php");
head("Pixel4You-rp1");
print_header("profile");
?>

<section>
	<div class="container">


		<div class="user_info_container bg4 color1 shaddow">
			<div class="user_info  ">
				<div class="user_info_image">
					<img src="<?php echo $_SESSION["userImage"]?>">
				</div>
				<div class="user_info_nick  padding bg5 color3">
					#<?php echo $_SESSION["userLogin"];?>
				</div>
				<div class="user_info_name_surname padding">
					<?php echo $_SESSION["userName"] . " " . $_SESSION["userSurname"];?>	
				</div>
				<div class="user_info_focus padding">
					zameranie autora
				</div>
				<div class="user_info_bio_header bg5 color3">
					bio:
				</div>
				<div class="user_info_bio padding">
					<?php echo $_SESSION["userBio"];?>
				</div>
				<div class="user_info_websites padding color1">
					<a href="" class="color1" target="blank">www.nazov.stranky.com</a>
				</div>
			</div>
		</div>



		<script>
			printImageMaxContainer();
			printMiniatures("20%", "180px");
		</script>
		
	</div>
</section>

<?php
print_footer();
?>


