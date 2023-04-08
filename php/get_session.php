<?php
	include("db.php");
	
if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only GET requests.");
}

if(isset($_SESSION["email"])){
	echo $_SESSION["email"];
}
else{
	echo "";
}

?>