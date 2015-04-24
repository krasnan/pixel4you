<?php
include_once "./connect.inc.php";
include ("./functions.php");
include ("./functionsDB.php");
head("Upload Pixel4You");
print_header($db,"upload");
?>




<section>
	<div class="container">

	<?php
	/*
	* overenie ci je prihlaseny pouzivatel
	* ak je prihlaseny tak vypis formular
	* ak nieje prihlaseny vypis chybu
	*/
	if(isset($_SESSION["user"])){
	?>

		<div id="ajaxResult" class="centered"></div>


		<form action="upload_file.php" id="ajaxFormReset" class="form" method="POST" enctype="multipart/form-data">

			<div id="img_cont" class="left">
				<label for="input_f"><img id="img_preview" src="./img/default_profile_image.png" class="shaddow bg4" name="Klikni pre pridanie fotky"></label>
				
				<label class="label bg4 color1 shaddow" for="input_f"><i class="fa fa-image"></i></label>
			
				<input id="input_f" name="input_f" type="file" accept="image/*" />
				<label class="input button shaddow bg1" for="input_f">Vyberte obrázok</label>
			</div>


			<div id="info_cont" class="right">
				<label class="label bg4 color1 shaddow" for="name"><i class="fa fa-tags"></i>&nbsp Názov</label>
				<input class="input shaddow" type="text" name="name" id="name" placeholder="Zadaj názov..." required>
				
				
				<label class="label bg4 color1 shaddow" for="describtion" style="height: 100px; line-height:100px;"><i class="fa fa-info"></i>&nbsp Popis</label>
				<textarea class="input shaddow" name="describtion" id="describtion" placeholder="Popis fotky..." ></textarea>
				

				<label class="label bg4 color1 shaddow" for="selectCategory"><i class="fa fa-toggle-down"></i>&nbsp Kategória</label>
				<select class="select shaddow" id="selectCategory" name="category" required>
					<?php
					printCategoryOptions($db);
					?>
				</select>



				<script type="text/javascript">
				$("#album").keyup(function(){$("#selectAlbum_def").html($(this).val());});
				</script>

				<script type="text/javascript">
				$("#input_f").change(function(){
				    changeImagePreview(this);
				});
				</script>



				




				<input name="submit" type="submit" class="button bg4 color1 shaddow" value="Nahrať" style="float:right">	
				
				<script type="text/javascript" src="./validations.js"></script>




			</div>
		</form>

	<?php

	}
	/*
	* vypis chybu..
	*/
	else printNotSigned();
	?>

	</div>
</section>

<?php
print_footer();
?>