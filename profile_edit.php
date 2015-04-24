<?php
include_once "./connect.inc.php";
include ("./functions.php");
include ("./functionsDB.php");
head("Pixel4You-rp1");
header('Content-type: charset=utf-8');
print_header($db,"register");
?>

<script type="text/javascript" src="./validations.js"></script>



<section>
	<div class="container">
	<?php if(isset($_SESSION["user"])){ ?>
		<form action="profile_save.php" id="ajaxForm" class="form" method="POST" enctype="multipart/form-data">

			<div id="info_cont" class="left">
				<label class="label bg4 color1 shaddow" for="name"><i class="fa fa-user"></i>&nbsp Meno</label>
				<input onKeyUp="isName('name')" class="input shaddow" type="text" name="name"  id="name" placeholder="*Meno (viac ako 2 znaky)" required value="<?php echo $_SESSION['user']["name"]?>">
							

				<label class="label bg4 color1 shaddow" for="surname"><i class="fa fa-user"></i>&nbsp Priezvisko</label>
				<input onKeyUp="isName('surname')" class="input shaddow" type="text"  name="surname" id="surname" placeholder="*Priezvisko (viac ako 2 znaky)" required value="<?php echo $_SESSION['user']["surname"]?>">		
			
				<label class="label bg4 color1 shaddow" for="bio" style="height: 100px; line-height:100px;"><i class="fa fa-info"></i>&nbsp Bio</label>
				<textarea class="input shaddow" name="bio" id="bio" placeholder="bio-detaily o používateľovi..." ><?php echo $_SESSION['user']['bio']?></textarea>
			</div>

			<div id="img_cont" class="right">
				<label for="input_f"><img id="img_preview" src="<?php echo $_SESSION['user']["image"]?>" class="shaddow bg4" alt="1.jpg"></label>
				
				<label class="label bg4 color1 shaddow" for="input_f"><i class="fa fa-image"></i></label>
			
				<input id="input_f" name="input_f" type="file" accept="image/*" />
				<label class="input button shaddow bg1" for="input_f">Change profile picture</label>



				<script type="text/javascript">
				$("#input_f").change(function(){
				    changeImagePreview(this);
				});
				</script>
				

				<div id="reg_user_errors" class="error"></div>
				<div id="ajaxResult"></div>	
				<input type="submit" class="button bg4 buttonOk color1 shaddow right" value="Uložiť" >
				<a href="./profile.php" class="button buttonCancel left bg4 color1 shaddow">Zrušiť</a>


			<script type="text/javascript" src="./validations.js"></script>


			</div>

		</form>
	<?php
	}
	else{
		printNotLoggedError();
	}
	?>




	</div>
</section>

<?php
print_footer();
?>