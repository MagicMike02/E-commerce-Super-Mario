<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["email"])) {
    header("Location: php/homepage.php");
} else if(isset($_SESSION["admin"]) && $_SESSION["admin"] == true){
	header("Location: php/homepageAdmin.php");

}

else{
    header("Location: php/login.php");
}
?>
