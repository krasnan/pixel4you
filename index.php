<?php
include_once "./connect.inc.php";
include ("functions.php");
include ("functionsDB.php");

head("Pixel4You");
print_header($db,"index");

?>

<section>
	<div class="container">

		<script>
			var myImages = 	<?php getUploads($db);	?>;
			printImageMaxContainer();
			printMiniatures();
		</script>
		
	</div>
</section>

<?php
print_footer();
?>