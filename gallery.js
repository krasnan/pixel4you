var _timeo;

function showMaximized(index){
	_index = index;
    document.getElementById("image_max_container").style.display = 'block'; 
    document.getElementById('image_container').innerHTML = ('<img id="img_actual" src="'+ myImages[_index].path + '">' ); 
    $('#image_info').replaceWith('<div id="image_info"><a href="">@ ' + myImages[_index].author + ' </a> | <a href=""> ' + myImages[_index].imgName + ' </a> <p>' + myImages[_index].imgDescription + ' </p></div>');
    $('#image_max_download').attr("href", myImages[_index].path);
    $("#image_max_like").attr("onclick", "likeImage("+myImages[_index].id+")");

  }

  function showFullscreen(){
  	$("#image_max").addClass("image_max_fullscreenMode");
  	$("#image_max").removeClass("image_max");
  	$("#image_max_fullscreen").replaceWith('<a id="image_max_fullscreen" title="Normal Mode" onclick="exitFullscreen()"><i class="fa fa-compress"></i></a>');
  	$("#image_info").css("display","none");

  }
  function exitFullscreen(){
  	$("#image_max").removeClass("image_max_fullscreenMode");
  	$("#image_max").addClass("image_max");
  	$("#image_max_fullscreen").replaceWith('<a id="image_max_fullscreen" title="Fulscreen Mode" onclick="showFullscreen()"><i class="fa fa-arrows-alt"></i></a>');
  	$("#image_info").css("display","block");

  }

function galeryExit(){
	document.getElementById("image_max_container").style.display = 'none';
	galerySlideshowStop();
	exitFullscreen();
}


 function galeryNext(){
 	if (_index < myImages.length-1) {
		_index++;
	}
	else{
		_index = 0;
	}
	$("#img_actual").animate({opacity: '0',maxHeight: '130%',maxWidth: '120%', marginTop: "-5%"},200,function(){
   		$('#img_actual').replaceWith('<img id="img_actual" style="display:none" src="'+ myImages[_index].path + '">' );
		$('#image_max_download').attr("href", myImages[_index].path);
		$('#image_info').replaceWith('<div id="image_info"><a href="">@ ' + myImages[_index].author + ' </a> | <a href=""> ' + myImages[_index].imgName + ' </a> <p>' + myImages[_index].imgDescription + ' </p></div>');
    	$("#img_actual").fadeIn(500);
    	$("#image_max_like").attr("onclick", "likeImage("+myImages[_index].id+")");
    });
}

function galeryBack(){
	if (_index>0) {
		_index--;
	}
	else{
		_index = myImages.length-1;
	}
    $("#img_actual").animate({opacity: '0',maxHeight: '70%',maxWidth: '70%'},200,function(){
   		$('#img_actual').replaceWith('<img id="img_actual" style="display:none" src="'+ myImages[_index].path + '">' );
		$('#image_max_download').attr("href", myImages[_index].path);
		$('#image_info').replaceWith('<div id="image_info"><a href="">@ ' + myImages[_index].author + ' </a> | <a href=""> ' + myImages[_index].imgName + ' </a> <p>' + myImages[_index].imgDescription + ' </p></div>');
    	$("#img_actual").fadeIn(500);
    	$("#image_max_like").attr("onclick", "likeImage("+myImages[_index].id+")");
    });
}

function galerySlideshowPlay(){
	$('#image_max_slideshow').replaceWith('<a id="image_max_slideshow" title="Pause Slideshow" onclick="galerySlideshowStop();"><i class="fa fa-pause"></i></a>');
	_timeo=setInterval(function(){galeryNext()},3000);
}

function galerySlideshowStop(){
	$('#image_max_slideshow').replaceWith('<a id="image_max_slideshow" title="Play Slideshow" onclick="galerySlideshowPlay();"><i class="fa fa-play"></i></a>');
	if (_timeo) {
		clearTimeout(_timeo);
		_timeo = false;
	}
}	


function printMiniatures(width, height){
  height = typeof height !== 'undefined' ? height : "";
  width = typeof width !== 'undefined' ? width : "";

	for (var i = 0; i < myImages.length; i++) {
		document.write(' \
		<div class="image_min_container shaddow" style="width: ' + width + '; height:' + height + '"> \
			<img src="'+ myImages[i].thumb +'" alt="'+ myImages[i].name +'"> \
			<div class="image_min_info overlay" > \
				<a onclick="" title="Show user profile" class="image_min_author color1"><i class="fa fa-user"></i> '+ myImages[i].author +'</a> \
				<a onclick="" title="Open image" class="image_min_name color1"><i class="fa fa-tag"></i> '+ myImages[i].name +'</a> \
				<div title="Maximize image" class="image_min_fullscreen color1" onclick="showMaximized('+ i +')"></div> \
				<div class="image_min_buttons"> \
					<a onclick="" title="Comment" class="color1"><i class="fa fa-comment fa-2x"></i><br><div class="image_min_buttons_descr">'+ myImages[i].comments +'</div></a> \
					<a id="download'+ myImages[i].id +'" onclick="downloadImage(' +  myImages[i].id + ')" href="'+ myImages[i].path +'" download title="Download" class="color1"><i class="fa fa-cloud-download fa-2x"></i><br> <div class="image_min_buttons_descr">'+ myImages[i].downloads +'</div></a> \
					<a id="like'+ myImages[i].id +'" onclick="likeImage(' +  myImages[i].id + ')" title="Like" class="color1"><i class="fa fa-heart fa-2x"></i><br><div class="image_min_buttons_descr">'+ myImages[i].likes +'</div></a> \
				</div>	\
			</div> \
		</div>');
	};
}

function printImageMaxContainer() {
	document.write(' \
		<div id="image_max_container"> \
            <div id="image_max" class="shaddow image_max"> \
                <div id="image_container">\
                </div>  \
                <div id="image_max_top_bar" class="hidden"> \
                        <a id="image_max_fullscreen" title="Fulscreen Mode" onclick="showFullscreen()"><i class="fa fa-arrows-alt fa"></i></a> \
                        <a id="image_max_like" title="Like" ><i class="fa fa-heart fa"></i></a> \
                        <a id="image_max_download" download title="Download" href="" target="_blank"><i class="fa fa-cloud-download fa"></i></a> \
                        <a id="image_max_slideshow" title="Play Slideshow" onclick="galerySlideshowPlay();"><i class="fa fa-play"></i></a> \
                        <a id="image_max_exit" title="Exit" onclick="galeryExit();"><i id="button_exit" class="fa fa-close"></i></a> \
                </div>\
                <a class="back_area hidden" title="Previsious Photo"  onclick="galeryBack();"><i id="button_back" class="fa fa-chevron-left fa-2x"></i></a> \
                <a class="next_area hidden" title="Next Photo" onclick="galeryNext();"><i id="button_next" class="fa fa-chevron-right fa-2x"></i></a> \
                <div class="image_info_container hidden"> \
                    <div id="image_info"> \
                    </div> \
                </div>  \
            </div> \
        </div>');
}


function likeImage(id){
	$.ajax({
		url: "./functionsAjax.php",
		type: "post",
		data: {func : "addLike", id : id},
		success: function(result){
			var akt = $("#like"+id+" .image_min_buttons_descr").text();
			$("#like"+id+" .image_min_buttons_descr").html(parseInt(akt)+parseInt(result));
		},
		error: function (){alert("error");}
		
	});
}

function downloadImage(id){
	$.ajax({
		url: "./functionsAjax.php",
		type: "post",
		data: {func : "addDownload", id : id},
		success: function(result){
			var akt = $("#download"+id+" .image_min_buttons_descr").text();
			$("#download"+id+" .image_min_buttons_descr").html(parseInt(akt)+parseInt(result));
		},
		error: function (){alert("error");}
		
	});
}
