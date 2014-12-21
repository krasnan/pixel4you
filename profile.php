<?php
include ("functions.php");
head("Pixel4You");
print_header();
?>

<script src="jquery-2.1.3.min.js" ></script>
<script src="./gallery.js"></script>


<div class="section">
<section class="container">
<div class="user_info_container">
	<div class="user_info  shaddow">
		<div class="user_image">
			<img src="./img/default_profile_image.png" alt="1.jpg">
		</div>
		<div class="user_nick bg_dark padding">
			#Prezyvka
		</div>
		<div class="user_name_surname padding">
			Meno Priezvisko		
		</div>
		<div class="user_focus padding">
			zameranie autora
		</div>
		<div class="user_bio_header bg_dark">
			bio:
		</div>
		<div class="user_bio padding">
			Bio Autora- detaily o autorovi a jeho zaujmy, zaluby, popis jeho profilovych vlastnosti...
		</div>
		<div class="user_websites padding">
			<a href="" target="blank">www.nazov.stranky.com</a>
		</div>
	</div>
</div>




<script>
	printMiniatures();
</script>

    <div id="img">
        <div id='image_max_container'> 
            <div id='image_max' class="shaddow"> 
           			<div id="image_container">

           			</div>	
            		
            		<a class="exit_area hidden" onclick='galeryExit();galerySlideshowStop();clearTimeout(timeo);'><i id="button_exit" class="fa fa-close"></i></a>
                    <a class="back_area hidden" onclick='galeryBack();'><i id="button_back" class="fa fa-chevron-left fa-2x"></i></a> 
                    <a class="next_area hidden" onclick='galeryNext();'><i id="button_next" class="fa fa-chevron-right fa-2x"></i></a> 

                    <div class="image_info_container hidden">
                  		<div id='image_info'>

                  		</div>
                    	<div id="button_slideshow">
                    		<a onclick="galerySlideshowPlay();timeo=setInterval(function(){galeryNext()},3000);"><i class="fa fa-play"></i></a>
                        	
                        </div>
                    </div> 


            </div> 
            
        </div> 
    </div>





</section>
</div>

<?php
footer();
?>

