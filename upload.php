<?php
include ("functions.php");
include ("functionsDB.php");
head("Pixel4You-rp1");
print_header("index");
?>




<section>
	<div class="container">
		<div class="ressult container"><?php if (isset($_GET['u'])) {
			echo "Súbor s názvom '". $_GET['u'] . "' bol uložený.";
			}?>
		</div>


		<form action="upload_file.php" id="form" method="POST" enctype="multipart/form-data">

			<div id="img_cont" class="left">
				<img id="img_preview" src="./img/default_profile_image.png" class="shaddow bg4" alt="1.jpg">
				
				<label class="label bg4 color1 shaddow" for="input_f"><i class="fa fa-image"></i></label>
			
				<input id="input_f" name="input_f" type="file" accept="image/*" required/>
				<label class="input button shaddow bg1" for="input_f">Vyber fotku</label>



			</div>


			<div id="info_cont" class="right">
				<label class="label bg4 color1 shaddow" for="name"><i class="fa fa-tags"></i>&nbsp Názov</label>
				<input class="input shaddow" type="text" name="name" id="name" placeholder="Zadaj názov..." required>
				
				
				<label class="label bg4 color1 shaddow" for="describtion" style="height: 100px; line-height:100px;"><i class="fa fa-info"></i>&nbsp Popis</label>
				<textarea class="input shaddow" name="describtion" id="describtion" placeholder="Popis fotky..." ></textarea>
				
				<label class="label bg4 color1 shaddow" for="albumSelect"><i class="fa fa-toggle-down"></i>&nbsp Album</label>
				<select class="select shaddow" id="albumSelect" required>
					<option id="selectAlbum_def" selected></option>
					<?php
					printAlbumsOptions($_SESSION["userId"]);
					?>
				</select>

				<label class="label bg4 color1 shaddow" for="album"><i class="fa fa-plus"></i>&nbsp Album</label>
				<input class="input shaddow" type="text" name="album" id="album" placeholder="Zadaj názov nového albumu...">
				


				<label class="label bg4 color1 shaddow" for="selectCategory"><i class="fa fa-toggle-down"></i>&nbsp Kategória</label>
				<select class="select shaddow" id="selectCategory" name="category" required>
					<?php
					printCategoryOptions($_SESSION["userId"]);
					?>
				</select>



				<script type="text/javascript">
				$("#album").keyup(function(){$("#selectAlbum_def").html($(this).val());});
				</script>



				<script type="text/javascript">


				function readURL(input) {
				    if (input.files && input.files[0]) {
				        var reader = new FileReader();
				        reader.onload = function (e) {
				            $('#img_preview').attr('src', e.target.result);
				        	$("#name").attr('value', input["value"].replace(/^.*[\\\/]/, '').split(".")[0]);
				        }
				        reader.readAsDataURL(input.files[0]);
				    }
				}
				$("#input_f").change(function(){
				    readURL(this);
				});
				</script>
				




				<input name="submit" type="submit" class="button bg4 color1 shaddow" value="Nahrať" style="float:right">	
				
				<script type="text/javascript" src="./validations.js"></script>




			</div>
		</form>


	</div>
</section>

<?php
print_footer();
?>