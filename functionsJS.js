
$(document).ready(function() {
	$("#loginOpen").click(function(){
		$("#login").css('display','block');
	});
});



function loginUser(){
	if (($("#login_name").val().length > 0) && ($("#login_passwd").val().length > 0)) {
		$.ajax({
			url: "./login.php",
			type: "post",
			data: {login_name: $("#login_name").val(), login_passwd: $("#login_passwd").val()},
			dataType: "json",
			success:function(data){
				if (data.success) {
					$("#loginResult").css("color", "#09CD09");
					$("#loginResult").hide().html(data.msg).fadeIn(200);
					window.setTimeout("location=('./');",2000);
				}
				else {
					$("#loginResult").hide().html(data.msg).fadeIn(200);
				}
			}
		});
	} 
	else{
		$("#loginResult").hide().html("Nezadali ste prihlasovacie údaje!").fadeIn(200);
	}
}

function mySearch(){
	var value = $("#search_box").val();
	if (value.length>0) {
		location.replace(urlAdd("search", value));
	}
}

function urlAdd(key, value){
	var uri = window.location.href;
	var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
	var separator = uri.indexOf('?') !== -1 ? "&" : "?";
	if (uri.match(re)) {
	    return uri.replace(re, '$1' + key + "=" + value + '$2');
	}
	else {
	    return uri + separator + key + "=" + value;
	}
}

function setCategory(cat){
	location.replace(urlAdd("category", cat));
}
function setUser(user){
	location.replace(urlAdd("user", user));
}



$("#ajaxForm").submit(function(event){
 
  	//vypne defaultne spravanie submitu
	event.preventDefault();	 
	//zoberie vsetky data z formulara
	var formData = new FormData($(this)[0]);

	$.ajax({
    	url: $(this).attr("action"),
	    type: $(this).attr("method"),
	    data: formData,
	    async: false,
	    cache: false,
	    contentType: false,
	    processData: false,
	    success: function (returndata) {
      		$("#ajaxResult").hide().html(returndata).fadeIn(200);
      	},
    	error: function(returndata){
    		$("#ajaxResult").hide().html(returndata).fadeIn(200);
    	}
  });
 
  return false;
});
$("#ajaxFormReset").submit(function(event){
 
  	//vypne defaultne spravanie submitu
	event.preventDefault();	 
	//zoberie vsetky data z formulara
	var formData = new FormData($(this)[0]);

	$.ajax({
    	url: $(this).attr("action"),
	    type: $(this).attr("method"),
	    data: formData,
	    async: false,
	    cache: false,
	    contentType: false,
	    processData: false,
	    success: function (returndata) {
      		$("#ajaxResult").hide().html(returndata).fadeIn(200);
      		window.setTimeout("location=('./upload.php');",1000);
      	},
    	error: function(returndata){
    		$("#ajaxResult").hide().html(returndata).fadeIn(200);
    	}
  });
 
  return false;
});

function changeImagePreview(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#img_preview').attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}