<?php
	include("db.php");

	$email = $_SESSION["email"];
if(isset($_POST["title"]) && isset($_POST["mode"])){	
	$title = $_POST["title"];
	$mode = $_POST["mode"];
	if($mode == "All")
		echo remove_all_this_item($email, $title);
	else if($mode == "One")
		echo remove_one_this_item($email, $title);
}

?>