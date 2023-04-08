<?php
include("db.php");
	
if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only POST requests.");
}

header("Content-type: application/json");

// Libero le variabili di SESSIONE di eventuali dati precedenti
// --> dovrebbero essere inizializzate qui insieme, dunqu epotrei anche controllarne solo 1
if(isset($_SESSION["product_title"]) || isset($_SESSION["json_all_product_data"]) ){
	unset($_SESSION["product_title"]);
	unset($_SESSION["json_all_product_data"]);
}

if(isset($_POST['product_title'])){
	
	$titolo =  $_POST['product_title'];
	$_SESSION["product_title"] = $titolo;

	$all_product_data = get_all_product_data($titolo);
	// print_r($all_product_data);
	
	
	$json_all_product_data = json_encode($all_product_data);

	$_SESSION["json_all_product_data"] = $json_all_product_data;
	$data["correctData"] = true;
	echo json_encode($data);
}
else{
	$data["correctData"] = false;
	echo json_encode($data);
}





?>