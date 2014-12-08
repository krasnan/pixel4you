<?php
include ("functions.php");
head("Pixel4You");
print_header();
?>


<div class="section">
<section class="container">

<form id="register" method="POST">
	<div class="">
	<label for="nickname"><i class="fa fa-users"></i></label>
	<input type="text" name="nickname" id="nickname" placeholder="Prezývka" required>
	
	<label for="name"><i class="fa fa-user"></i></label>
	<input type="text" name="name" id="name" placeholder="Meno" required>
	
	<label for="surname"><i class="fa fa-user"></i></label>
	<input type="text" name="surname" id="surname" placeholder="Priezvisko" required>
	
	<label for="email"><i class="fa fa-envelope"></i></label>
	<input type="text" name="email" id="email" placeholder="Email" required>
	
	<label for="password"><i class="fa fa-shield"></i></label>
	<input type="password" name="password" id="password" placeholder="Heslo" required>
	
	<label for="password2"><i class="fa fa-shield"></i></label>
	<input type="password" name="password2" id="password2" placeholder="Overenie hesla" required> 	

	<input type="submit" class="button" value="Zaregistrovať">	
	</div>
</form>






</section>
</div>
<?php
footer();
?>
