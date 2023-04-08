<?php
	include("db.php");

	$email = $_SESSION["email"];

	echo remove_all_items($email);



?>