<?php
include ("functions.php");
head("Pixel4You");
print_header();

?>

<script src="jquery-2.1.3.min.js" ></script>
<script type="text/javascript">

var myImages= [
    {"author": "autor1", "imgName":"3d stlce", "path":"./img/1.jpg",  "thumbnail":"./img/1.jpg", "imgDescription":"dajaky ten popis" , "downloads":"420", "likes":"420", "comments":"10"},
    {"author": "autor1", "imgName":"mountains", "path":"./img/2.jpg",  "thumbnail":"./img/2.jpg", "imgDescription":"dajaky ten popis", "downloads":"420", "likes":"420", "comments":"10"},
    {"author": "autor3", "imgName":"girl", "path":"./img/3.jpg",  "thumbnail":"./img/3.jpg", "imgDescription":"dajaky ten popis", "downloads":"420", "likes":"420", "comments":"10"},
    {"author": "autor4", "imgName":"abstract", "path":"./img/4.jpg",  "thumbnail":"./img/4.jpg", "imgDescription":"dajaky ten popis", "downloads":"420", "likes":"420", "comments":"10"}       
];
var id;
var myImagesLength = myImages.length;
var _exit=true;


function showFullscreen(index){
	_exit = false;
    document.getElementById("img").style.display = 'block'; 
    document.getElementById('image_container').innerHTML = ('<img id="img_actual" src="'+ myImages[index].path + '">' ); 
    $('#image_info').replaceWith('<div id="image_info"><a href="">@ ' + myImages[index].author + ' </a> | <a href=""> ' + myImages[index].imgName + ' </a> <p>' + myImages[index].imgDescription + ' </p></div>');

    _index = index;
  }

function galeryExit(){
	_exit = true;
	document.getElementById("img").style.display = 'none';

}


 function galeryNext(){
 	if (_index < myImagesLength-1) {
		_index++;
	}
	else{
		_index = 0;
	};
	$("#img_actual").fadeOut(300,function(){
   		$('#img_actual').replaceWith('<img id="img_actual" style="display:none" src="'+ myImages[_index].path + '">' );
		$('#image_info').replaceWith('<div id="image_info"><a href="">@ ' + myImages[_index].author + ' </a> | <a href=""> ' + myImages[_index].imgName + ' </a> <p>' + myImages[_index].imgDescription + ' </p></div>');
    	$("#img_actual").fadeIn(500);
    });

}
function galeryBack(){
	if (_index>0) {
		_index--;
	}
	else{
		_index = myImagesLength-1;
	};
    $("#img_actual").fadeOut(300,function(){
   		$('#img_actual').replaceWith('<img id="img_actual" style="display:none" src="'+ myImages[_index].path + '">' );
		$('#image_info').replaceWith('<div id="image_info"><a href="">@ ' + myImages[_index].author + ' </a> | <a href=""> ' + myImages[_index].imgName + ' </a> <p>' + myImages[_index].imgDescription + ' </p></div>');
    	$("#img_actual").fadeIn(500);
    });

}

function galerySlideshowPlay(){
	document.getElementById("button_slideshow").innerHTML = '<a class="button_slideshow" onclick="galerySlideshowStop();clearTimeout(timeo);"><i class="fa fa-pause"></i></a>';
}
function galerySlideshowStop(){
	document.getElementById("button_slideshow").innerHTML = '<a class="button_slideshow" onclick="galerySlideshowPlay();timeo=setInterval(function(){galeryNext()},3000);"><i class="fa fa-play"></i></a>';
}


function printMiniatures(){

	// toto bude lepsie spravit cez... document.write("<p>Inside our anonymous function foo means '" + foo + '".</p>');
	for (var i = 0; i < myImages.length; i++) {
		document.write(' \
		<div class="image-container">\
			<div class="image">\
					<img src="'+ myImages[i].thumbnail +'" alt="'+ myImages[i].imgName +'">\
				</div> \
				<div class="image-details"> \
					<a onclick="showFullscreen('+ i +')" class="image-name">'+ myImages[i].imgName +'</a> \
					<a href="" class="image-autor">@ '+ myImages[i].author +'</a> \
					<a  onclick="showFullscreen('+ i +')"><div class="fullscreen"></div></a> \
					<div class="image-icons"> \
						<a href="" ><i class="fa fa-comment fa-2x"></i><br>'+ myImages[i].comments +'</a> \
						<a href="'+ myImages[i].path +'" ><i class="fa fa-cloud-download fa-2x"></i><br>'+ myImages[i].downloads +'</a> \
						<a href="" ><i class="fa fa-heart fa-2x"></i><br>'+ myImages[i].likes +'</a> \
					</div> \
				</div> \
			</div> ');
	};

}



</script>




<div class="section">
<section id="section" class="container">

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

