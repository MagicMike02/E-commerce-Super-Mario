<?php 
/*controlla se le credenziali dell'admin sono presenti nel db */
include("db.php");


if(isset($_POST['data'])){
	$data = $_POST['data'];    

	$email= $data['email'];
	$password= $data['password'];

	if (is_admin_password_correct($email, $password)) { 
		$_SESSION['email'] = $email;
		$adminData = getAdminInfo($email);
		$_SESSION['nome'] = $adminData[0]["Nome"];
		$_SESSION['cognome'] = $adminData[0]["Cognome"];
		
		$_SESSION["admin"] = true;

		$data["correctData"] = true;
	// 	$data["email"] = $_SESSION['email'];
	}
	else {
		$_SESSION["admin"] = false;
		$data["correctData"] = false;
	}
echo json_encode($data);
}

?>