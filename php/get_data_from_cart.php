<?php
	include("db.php");
	
if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only GET requests.");
}

header("Content-type: application/json");

$email = $_SESSION["email"];

$cart_checkout_data= get_checkout_data($email);

print_r(json_encode($cart_checkout_data)); //ritorno json dell'array associativo
// echo json_encode($cart_checkout_data);

?>
