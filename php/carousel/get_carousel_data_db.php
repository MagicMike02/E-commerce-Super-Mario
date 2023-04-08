<?php 
include("../db.php");
if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only GET requests.");
}
else if(!isset($_SESSION["product_title"])){
	header("Location: homepage.php"); 
	exit;
}

//RITORNA MASSIMO 6 FOTO DELLA STESA CATEGORIA 
	header("Content-type: application/json");
	$json_alldata = json_decode($_SESSION["json_all_product_data"]);
	$category = $json_alldata[0]->Categoria;
	$url_foto = $json_alldata[0]->Url_foto;
	
	$carousel_data = get_random_carousel_data($category, $url_foto);
	
	echo json_encode($carousel_data);

?>