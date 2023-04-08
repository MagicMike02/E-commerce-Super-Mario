<?php
	include("db.php");
	
if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only GET requests.");
}
//needed for categoryClick function
$category = "";

if (isset($_REQUEST["category"])) {
	$category = $_REQUEST["category"];
}

header("Content-type: application/json");

echo json_encode(get_all_categories()); //ritorno json dell'array associativo
?>