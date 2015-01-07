<?php
include ("functions.php");
include ("functionsDB.php");
head("Pixel4You-rp1");
print_header("index");
?>

<section>
	<div class="container">

		<script>
			var myImages = 	<?php getUserUploads();	?>;
			printImageMaxContainer();
			printMiniatures();
		</script>
		
	</div>
</section>

<?php
print_footer();
?>