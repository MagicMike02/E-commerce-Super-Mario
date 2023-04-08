<?php 
/* Controlla che le credenziali inserite nel login dal cliente sono corrette */
include("db.php");


if(isset($_POST['data'])){
	$data = $_POST['data'];    

	$email= $data['email'];
	$password= $data['password'];

	if (is_password_correct($email, $password)) { 
		$_SESSION['email'] = $email;
		$userData = getUserInfo($email);
		$_SESSION['nome'] = $userData[0]["Nome"];
		$_SESSION['cognome'] = $userData[0]["Cognome"];
		
		$data["correctData"] = true;
	// 	$data["email"] = $_SESSION['email'];
	}
	else {
		$data["correctData"] = false;
	}
echo json_encode($data);
}












?>

