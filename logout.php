<?php

session_start();
if ($_SESSION["status"] == "1"){
    session_destroy();
    // header("Location: index.php ");	
}else if($_SESSION["status"] == "2"){
    session_destroy();
    // header("Location: ../index.php ");	
}
    session_destroy();
    header("Location: index.php ");

?>