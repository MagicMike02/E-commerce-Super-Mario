<?php
include("db.php");
header("Content-type: application/json");

if(!isset($_SESSION["product_title"])){ // in set_product_data è settata, cosi evito di accedere a questa pagina senza un prodsotto specifico
	header("Location: homepage.php"); 
	exit;
}

else if(!isset($_SESSION["json_all_product_data"])){ // in set_product_data è settata, cosi evito di accedere a questa pagina senza un prodsotto specifico
	header("Location: homepage.php"); 
	exit;
}

// RITORNO I DATI IN JSON DEL PRODOTO CHE è STATO IMPOSTATO NELLA VARIABILE DI SESISONE
// --> Quesa variabile è stata modificata poco prima nel file "set_product_data.php"
// --> dunque avrò semrep i dati del prodotto appena cliccato
echo $_SESSION["json_all_product_data"];

?>