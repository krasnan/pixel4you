<?php
include ("functions.php");
include ("functionsDB.php");
head("Pixel4You");
print_header("index");
?>

<section>
	<div class="container">

		<script>
			var myImages = 	<?php getUploads();	?>;
			printImageMaxContainer();
			printMiniatures();
		</script>
		
	</div>
</section>

<?php
print_footer();
?>