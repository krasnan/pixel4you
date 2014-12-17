<?php
function head($title){
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=1">

<link type="text/css" href="css.css" rel="stylesheet" >
<link type="text/css" href="css_mobile.css" rel="stylesheet" media="screen and (max-width: 1099px)">
<link type="text/css" href="font-awesome.min.css" rel="stylesheet">

<!--<link type="text/css" href="css.css" rel="stylesheet">
-->


<title><?php echo $title ?></title>
</head>

<body>

<script>
function changeClass() {
   $('#referNav a').removeClass('active');
   $(this).addClass('active');
}

function show_dropdown() {
   var x = document.getElementById("dropdown_top");
   if (x.style.opacity != "1") {
      x.style.top = "80px";           
      x.style.opacity = "1"; 
   }
   else {
      x.style.top = "-80%";           
      x.style.opacity = "0"; 
   }
    
}
</script>
<?php
}




function print_header() {
	?>
<div class="header">
<header class="shaddow">
<div class="container">
	<div class="logo"><a href="./"><img src="./img/header.png" alt="logo"></a></div>
		<nav>
			<a href="./index.php">home</a>
			<a href="./profile.php">my profile</a>
			<a href="#footer">contact</a>
			<a onclick=show_dropdown() id="hamburger_icon"><i class="fa fa-reorder "></i></a>
		</nav>
	</div>
</header>
<?php 
dropdown();
?>

</div>
<?php
}

function dropdown(){
?>
<div id="dropdown_top" class="shaddow">
   <div class="dropdown_container">		
      <div class="search">
         <div class="container-4">
            <input type="search" id="search" placeholder="search..." />
            <button class="icon"><i class="fa fa-search"></i></button>
         </div>
      </div>
      <div class="hr"></div>
      <div class="filter">
         <div class="subcategory">
            Podkategória 1
            <br>
            <a href="" class="category">kategoria 1</a><br>
            <a href="" class="category">kategoria 2</a><br>
            <a href="" class="category">kategoria 3</a><br>
            <a href="" class="category">kategoria 4</a><br>
            <a href="" class="category">kategoria 5</a><br><br>

         </div>
         <div class="subcategory">
            Podkategória 2
            <br>
            <a href="" class="category">kategoria 1</a><br>
            <a href="" class="category">kategoria 2</a><br>
            <a href="" class="category">kategoria 3</a><br>
            <a href="" class="category">kategoria 4</a><br>
            <a href="" class="category">kategoria 5</a><br><br>

         </div>
      </div>
      <div class="hr"></div>
      <div class="login">
         <form id="login" method="POST">
            <label for="login_name" >Prihlasovacie meno:</label>
            <input id="login_name" type="text" placeholder="login" required>
            <label for="login_passwd" >Prihlasovacie heslo:</label>
            <input id="login_passwd" type="password" required placeholder="password">
            <a href="./register.php" class="button">Registrovať</a>
            <input type="submit" class="button" value="Prihlásiť">
         </form>
      </div>
   </div>
</div>  
<?php
}




function footer() {?>
<div class="wrapper"></div>
<footer class="shaddow">
<div class="container">

<div id="footer-about">
   <h1>about</h1>
   <p>
      volajake tie textiky o tom aky som strasne super a ake pekne stranky robim a bla bla bla bla bla lba 	
   </p>
</div>

<div id="footer-contact">
   <h1>contact</h1>
	<a href="" name="footer"></a>
   <form method="POST">
      <textarea name="text" id="contact_textarea" placeholder="Sem napíšte svoju správu..." required rows="5"></textarea>
      <input type="text" name="email" id="contact_email" required placeholder="Zadajte svoju emailovú schránku..." />  		
      <input type="submit" class="button" name="button" id="contact_button" value="Send" />
   </form>
</div>

<div id="footer-follow">
   <h1>follow</h1>
   <div class="follow_links">
   	<a href="https://www.facebook.com/krasnan1" target="blank"><img src="./img/facebook.png" alt="facebook"></a>
  	 	<a class="qr" href="https://www.facebook.com/krasnan1" target="blak"><img src="./img/qr.png" alt="facebook"></a>	
   </div>
</div>

<div class="copyright">
© 2014 Martin Krasňan. All Rights Reserved.
</div>
</div>

</footer>

</body>

</html>
<?php
}

?>