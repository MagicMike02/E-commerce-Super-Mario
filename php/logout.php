<?php
if (!isset($_SESSION)) {         //se non esiste una sessione la inizio
   session_start();
	if (isset($_SESSION['email'])) {
	   unset($_SESSION['email']);
  	 // unset($_SESSION["password"]);
	}
}
session_destroy(); 
echo 'You have cleaned session';

header('Refresh: 1; URL = login.php');
?>