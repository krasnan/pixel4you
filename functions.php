<?php

function head($title){
	/*
	* funkcia sluzi na vypisanie hlavicky html suboru s volaniami kaskadovych stylov, inicializaciou jQuery, ...
	*/
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<link type="text/css" href="./css.css" rel="stylesheet" >
<link type="text/css" href="font-awesome.min.css" rel="stylesheet">



<title><?php echo $title;?></title>
</head>

<body class="bg6">

<script src="jquery-2.1.3.min.js" ></script>
<script src="./functionsJS.js"></script>
<script src="./gallery.js"></script>

<?php
session_start();
}





function print_header($db,$active) {
	/*
	* funkcia vytlaci header stranky s navigaciou 
	*/
?>
<header class="shaddow bg5">
	<div class="container padding">
	
		<div class="logo">
			<a href="./"><img src="./img/header.png" alt="logo"></a>
		</div>
		<div class="search">
         	<div class="search_box_container">
            	<input class="input bg7a color1" type="search" id="search_box" placeholder="search..." <?php if(isset($_GET["search"])) echo "value='".$_GET["search"]."'";?>/>
            	<a class="button bg2"  onclick="mySearch()"><i class="fa fa-search"></i></a>
         	</div>
      	</div>

		<nav>
			<?php 
	    	if (isset($_SESSION["user"]["login"])) {?>
				<a <?php if($active == "upload"){echo 'class="active"';} ?> href="upload.php" title="Upload" class="color1"><i class="fa fa-upload fa-2x"></i></a>
				<a <?php if($active == "profile"){echo 'class="active"';} ?> href="profile.php?user=<?php echo $_SESSION["user"]["login"];?>" title="My Profile" class="color1"><i class="fa fa-user fa-2x"></i></a>
			
			<?php
			}
			?>
			<a <?php if($active == "index"){echo 'class="active"';} ?> href="index.php" title="Home" class="color1"><i class="fa fa-home fa-2x"></i></a>
			

			
		</nav>
	</div>
</header>

<?php
printDropdown($db);
}



function print_footer() {
	/*
	* funkcia vytlaci patu stranky
	*/
?>

<div class="wrapper"></div>
<footer class="shaddow bg5">
	<div class="container ">
		<div class="copyright color3">© 2014 Martin Krasňan. All Rights Reserved.</div>
	</div>
</footer>
</body>
</html>

<?php

}





function printDropdown($db){
	/*
	* funkcia vytlaci dropdown menu
	*/
?>
<div id="dropdown_container" class="shaddow container color1 bg4">
	<div id="dropdown">
		<div class="filter">
		<?php

			printCategories($db,3);
		?>
	    </div>
	    <div class="login">
	    	<?php 
	    	if (isset($_SESSION["user"]["login"])) {
	    		echo  "<div class='right'>" .$_SESSION["user"]["name"] . " " . $_SESSION["user"]["surname"] . "</div>";
	    		echo '<a id="logout" href="./logout.php" class="button bg1 color2 right login_button">Odhlásiť</a>';
	    	}
	    	else{
	    	?>
		    <form id="login" method="POST">
		        <label for="login_name" >Prihlasovacie meno:</label>
		        <input id="login_name" name="login_name" class="input" type="text" placeholder="login" required>
		        <label for="login_passwd" >Prihlasovacie heslo:</label>
		        <input id="login_passwd" name="login_passwd" class="input" type="password" required placeholder="password">
		        <div id="loginResult" class="error"></div>
		        <a href="./register.php" class="button bg1 color2 login_button">Registrovať</a>
		        <a onclick="loginUser()" class="button bg1 color2 right login_button">Prihlásiť</a>
		    </form>
		    <?php 
			
			}
			?>

      	</div>
   	</div>
</div>  
<?php
}


function printRegistrationForm(){
	/*
	* registracny formular 
	*/
?>
		<form action="register.php" id="reg" class="form" method="POST" enctype="multipart/form-data">

			<div id="info_cont" class="left">
				<label class="label bg4 color1 shaddow" for="reg_login"><i class="fa fa-users"></i>&nbsp Prezývka</label>
				<input onKeyUp=" checkLogin('reg_login')" class="input shaddow" type="text" required name="reg_login" id="reg_login" placeholder="*Prezývka (len znaky: a-z, A-Z, _, -)" >
				
				
				<label class="label bg4 color1 shaddow" for="name"><i class="fa fa-user"></i>&nbsp Meno</label>
				<input onKeyUp="isName('name')" class="input shaddow" type="text" name="name"  id="name" placeholder="*Meno (viac ako 2 znaky)" required>
				

				<label class="label bg4 color1 shaddow" for="surname"><i class="fa fa-user"></i>&nbsp Priezvisko</label>
				<input onKeyUp="isName('surname')" class="input shaddow" type="text"  name="surname" id="surname" placeholder="*Priezvisko (viac ako 2 znaky)" required>
			

				<label class="label bg4 color1 shaddow" for="email"><i class="fa fa-envelope"></i>&nbsp Email</label>
				<input onKeyUp="checkEmail('email')" class="input shaddow" type="email" name="email" id="email" placeholder="*Email (aaa@aaa.sk)" required >
				

				<label class="label bg4 color1 shaddow" for="password"><i class="fa fa-shield"></i>&nbsp Heslo</label>
				<input onKeyUp="isPasswd('password')" class="input shaddow" type="password" name="password" id="password" placeholder="*Heslo (viac ako 6 znakov)" required>

				
				<label class="label bg4 color1 shaddow" for="password2"><i class="fa fa-shield"></i>&nbsp Heslo</label>
				<input onKeyUp="evalPasswd('password', 'password2')" class="input shaddow" type="password" name="password2" id="password2" placeholder="*Overenie hesla" required> 	

				
				<label class="label bg4 color1 shaddow" for="bio" style="height: 100px; line-height:100px;"><i class="fa fa-info"></i>&nbsp Bio</label>
				<textarea class="input shaddow" name="bio" id="bio" placeholder="bio-detaily o používateľovi..." ></textarea>
				
			</div>

			<div id="img_cont" class="right">
				<img id="img_preview" src="./img/default_profile_image.png" class="shaddow bg4" alt="1.jpg">
				
				<label class="label bg4 color1 shaddow" for="input_f"><i class="fa fa-image"></i></label>
			
				<input id="input_f" name="input_f" type="file" accept="image/*" />
				<label class="input button shaddow bg1" for="input_f">Add profile picture</label>



				<script type="text/javascript">


				function readURL(input) {
				    if (input.files && input.files[0]) {
				        var reader = new FileReader();
				        reader.onload = function (e) {
				            $('#img_preview').attr('src', e.target.result);
				        }
				        reader.readAsDataURL(input.files[0]);
				    }
				}
				$("#input_f").change(function(){
				    readURL(this);
				});
				</script>
				<div id="reg_user_errors" class="error"></div>
				<input name="submit" type="submit" class="button bg4 color1 shaddow" value="Zaregistrovať" style="float:right">	
			

				<script type="text/javascript" src="./validations.js"></script>
			</div>
		</form>
<?php
}

function PrintNotSigned(){
/*
* vypise chybovu hlasku ak nieje pouzivatel prihlaseny
*/

?>
	<div class="error centered">
		Chyba: Pre zobrazenie tejto stránky sa musíte prihlásiť.
	</div>
	
<?php
}