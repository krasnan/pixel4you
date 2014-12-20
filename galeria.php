<!DOCTYPE html>
<html>
<head>
<script>
/*function zobraz(str) {
     if (str.length == 0) { 
         document.getElementById("obrazok").innerHTML = "";
         return;
     } else {
         var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                 document.getElementById("obrazok").innerHTML = xmlhttp.responseText;
             }
         }
         xmlhttp.open("GET", "info.php?q=" + str, true);
         xmlhttp.send();
     }
}*/
</script>

<script>
var myImages= [
    {"path":"./img/1.jpg",  "thumbnail":"./img/1.jpg", "description":"dajaky ten popis"},
    {"path":"./img/2.jpg",  "thumbnail":"./img/2.jpg", "description":"dajaky ten popis"},
    {"path":"./img/3.jpg",  "thumbnail":"./img/3.jpg", "description":"dajaky ten popis"},
    {"path":"./img/4.jpg",  "thumbnail":"./img/4.jpg", "description":"dajaky ten popis"}       
];

function show_details(actual){
    document.getElementById("img").innerHTML = " \
    <div id='image_max_container'> \
        <div id='image_max'> \
            <a href='#'' onclick='next();''><img src='./img/next.png'/></a> \
        </div> \
    </div> \
    ";
    document.getElementById("img").style.zIndex = 1;

  }
 function next(){

    document.getElementById("image_max").style.background = "red";
 }







</script>

<style type="text/css">

#img{
    z-index: 1;
    position:fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
#image_max_container{

    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,.5);
}
#image_max{
    /*background: black;*/
    position: relative;
    background: #000 url("./img/1.jpg") no-repeat fixed center;
    background-size: auto 100%; 
    margin: auto auto;
    width: 90%;
    height: 100%;
}
#image_max:hover > .next_area {
    display: block;
}
#image_max:hover > .back_area {
    display: block;
}
.thumbnail{
    height: 300px;
    width: 300px;
    overflow: hidden;
}

.back_area{
    display: none;
    float: left;
    /*background: rgba(255,255,255,0.2);*/
    position: absolute;
    width: 10%;
    left: 0%;
    height: 100%;
}

.next_area{
    display: none;
    /*background: rgba(255,255,255,0.2);*/
    position: absolute;
    width: 10%;
    right: 0%;
    height: 100%;
}

a:link,
a:visited
{
    color: white;
    text-decoration: none;
}

.back_buttons{
    opacity: .5;
    position: absolute;
    bottom: 50%;
    left: 30px;
}
.back_area:hover > .back_buttons{
    opacity: 1;
    color: #00baff;
}
.next_buttons{
    opacity: .5;
    position: absolute;
    bottom: 50%;
    right: 30px;
}
.next_area:hover > .next_buttons{
    opacity: 1;
    color: #00baff;
}
.info_container{
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 10%;
    color: white;
    background: rgba(255,255,255,0.2);

}


</style>


</head>
<body>












    <a  onclick="show_details('./img/1.jpg');"><img class="thumbnail" src="./img/1.jpg"/></a>
    <div id="img">
        <div id='image_max_container'> 
            <div id='image_max'> 

                    <a class="back_area" href='#'' onclick='next();''><i class="back_buttons">back</i></a> 
                    <a class="next_area" href='#'' onclick='next();''><i class="next_buttons">next</i></a> 

                    <div class="info_container">
                        volajake to info
                    </div>  

            </div> 
            
        </div> 
    </div>




</body>
</html>


