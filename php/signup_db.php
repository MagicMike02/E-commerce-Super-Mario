<?php

include("db.php");

if(isset($_POST['data'])){
	$data = $_POST['data'];  

	$name = $data['name'];
	$surname = $data['surname'];
	$email = $data['email'];
	$password = md5($data['password']);

	
	if(check_and_insert($name, $surname, $email, $password)){
		//richiesta ok
		$data["result"] = "Accepted";
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		//errore email
		$data["result"] = "Email Not Valid";
	}
	else{
		//errore generico
		$data["result"] = "Generic Error";
	}
	echo json_encode($data);
}


?>
