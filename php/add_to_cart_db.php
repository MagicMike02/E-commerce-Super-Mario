<?php
include("db.php");

header("Content-type: application/json");

$array_data = json_decode($_SESSION["json_all_product_data"]);
// print_r($array_data);
// print_r($_SESSION["product_title"]);

if(isset($_POST["quantity"])){
	$quantity = $_POST["quantity"];		

	$result_insert=insert_product_into_cart(
		$_SESSION["email"], 
		$array_data[0]->Titolo,
		$quantity
		);
	
	print_r($result_insert);
	
	// echo $result_insert;
}
else{
	echo false;
}





?>