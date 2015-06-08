<?php
session_start();
if(isset($_SESSION["user"])){

    if(isset($_POST['comment_text'])){
        include_once "./connect.inc.php";
        include ("./functionsDB.php");

        $res = setComment($db, $_SESSION['user']['login'], $_POST['image_id'],$_POST['comment_text']);
        if($res){
            $row = getComment($db, $res);
            echo '<div class="comment_cont"><div class="avatar"><img class="bg4" src="./img/default_profile_image.png" alt="image"></div>';
            echo '<div class="comment bg5"><div class="comment_header">';
            echo '<a href="./profile.php?user='.$row["author"].'">@'.$row["author"].'</a><div class="date_time">'.date("d.m.Y H:i:s", strtotime($row["date"])).'</div></div>';
            echo '<div class="comment_body bg4">'.$row["text"].'</div></div></div>';


            /*foreach ($res as $key => $row) {
                    echo '<div class="comment_cont"><div class="avatar"><img class="bg4" src="./img/default_profile_image.png" alt="image"></div>';
                    echo '<div class="comment bg5"><div class="comment_header">';
                    echo '<a href="./profile.php?user='.$row["author"].'">'.$row["author"].'</a><div class="date_time">'.date("d.m.Y H:i:s", strtotime($row["date"])).'</div></div>';
                    echo '<div class="comment_body bg4">'.$row["text"].'</div></div></div>';
            }*/
        }
        else{
            echo "<div class='error right'>CHYBA: Neznáma chyba pri pridávaní komentára.</div>";
        }
    }
    else{
        echo "<div class='error right'>CHYBA: Nezadaný text komentára.</div>";
    }
}
else{
    echo "<div class='error right'>CHYBA: Na pridávanie kometnárov musíte byť prihlásený.</div>";
}

    

?>

