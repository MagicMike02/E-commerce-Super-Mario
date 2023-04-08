<?php 
//Inizia la sessione se non esiste 
if (!isset($_SESSION)) { 
	session_start(); 
	// print_r($_SESSION);
}     


// funzione che gestisce la connessione al db
function db_connect() {   
	//creo variabili per la connessione al DB
	$dbconnstring = 'mysql:dbname=progetto_tweb;host=localhost:3306';
	$dbuser = 'root';
	$dbpasswd = '';

	try {
		$db = new PDO ($dbconnstring, $dbuser, $dbpasswd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $ex) {
	?>	
		<p> Sorry, database error occurred. pleasy try again</p>	
		<p> Error details: <?= ex->getMessage() ?></p>	
	<?php
	}
	return $db;
}

//FUNZIONE CHE DATO L'USERNAME CONTROLLA CHE LA PW ASSOCIATA SIA CORRETTA
function is_password_correct($email, $password) {
	$db = db_connect();

	$email = $db->quote($email);//quote: codifica un valore da utilizzare nella query
	
	$query = "
		SELECT * 
		FROM cliente 
		WHERE email = $email
	";

	$check = $db->prepare($query);
	$check->execute();
	$user = $check->fetchAll(PDO::FETCH_ASSOC);

	//print_r($user); // vedo cosa ottengo dalla query

	//echo ($password . " -> " . md5($password) . " = ". $user[0]["Password"]);

	if((count($user)>0 && md5($password) == $user[0]["Password"])){
		// echo(" verify-true "); COMMENTA SEMPRE PER VERIFICARE CHE FUNZIONI -> DEVE RICEVERE SOLO ECHO(0)
		return true;
	}
	else {
		// echo(" verify-false"); COMMENTA SEMPRE PER VERIFICARE CHE FUNZIONI -> DEVE RICEVERE SOLO ECHO(0)
		return false;
	}
 }

 function is_admin_password_correct($email, $password){
	$db = db_connect();
	$email = $db->quote($email);//quote: codifica un valore da utilizzare nella query
	
	$query = "
		SELECT * 
		FROM dipendente 
		WHERE Email = $email
	";

	$check = $db->prepare($query);
	$check->execute();

	$admin = $check->fetchAll(PDO::FETCH_ASSOC);

	if((count($admin)>0 && md5($password) == $admin[0]["Password"])){
		// echo(" verify-true "); COMMENTA SEMPRE PER VERIFICARE CHE FUNZIONI -> DEVE RICEVERE SOLO ECHO(0)
		return true;
	}
	else {
		// echo(" verify-false"); COMMENTA SEMPRE PER VERIFICARE CHE FUNZIONI -> DEVE RICEVERE SOLO ECHO(0)
		return false;
	}


 }


//FUNZIONE CHE CONTROLLA CHE UN USERNAME NON ESISTA GIA E IN CASO POSITIVO INSERISCE NEL DB IL NUOVO UTENTE REGISTRATO
function check_and_insert($name, $surname ,$email ,$password){
		$db = db_connect();

		$name = $db->quote($name);
		$surname = $db->quote($surname);
		$email = $db->quote($email);
		$password = $db->quote($password);

		//controllo che lo username non esista gia
		// $query = "
		// 	SELECT email
		// 	FROM cliente
		// 	WHERE email = :email
		// ";
		// $check = $db->prepare($query);

		// $check->bindParam("email", $email, PDO::PARAM_STR);
		// $check->execute();

		$check = $db->query("SELECT email FROM cliente WHERE email = $email");

		$user = $check->fetchAll(PDO::FETCH_ASSOC);
		
		if (count($user) > 0) {
			echo ("db.php > Check_and_insert > Email gia in uso");
			return false;
		} 
		else {
			//altrimenti posso procedere con l'inserimento dell utente
			$query = "
				INSERT INTO cliente(nome, cognome, email, password)
				VALUES ( $name , $surname , $email , $password )
			";

			$check = $db->prepare($query);
			$check->execute();

			if ($check->rowCount() > 0) { // Aggiunto 
				return TRUE;
			} 
			else {
				//se lo username non esiste
				return FALSE;
			}
		}
}

//Funzione che restituisce i dati dell'utente specificato
function getUserInfo($email){
	$db = db_connect();

	$userData = $db->query("SELECT * FROM cliente WHERE Email = '$email'");
	$userData = $userData->fetchAll(PDO::FETCH_ASSOC);

	return $userData;
}

//Funzione che ritrorna i dati del dipendente specificato
function getAdminInfo($email){
	$db = db_connect();
	
	$userData = $db->query("SELECT * FROM dipendente WHERE Email = '$email'");
	$userData = $userData->fetchAll(PDO::FETCH_ASSOC);

	return $userData;
}

function check_admin($email, $password){
	$db = db_connect();
	$checkAdmin = $db->query("SELECT * FROM dipendente WHERE Email = '$email' AND  Password = '$password'");
	$checkAdmin = $checkAdmin->fetchAll(PDO::FETCH_ASSOC);

	if(count($checkAdmin) > 0){
		return true;
	}
	else{
		return false;
	}
	return $userData;
}

//ritorna tute le categorie nel db
function get_all_categories(){
	$db = db_connect();
	
	$query = "SELECT DISTINCT Categoria FROM prodotti";
	
	$categories = $db->prepare($query);
	$categories->execute();
	// print_r($categories);
	$categories =	$categories->fetchAll(PDO::FETCH_ASSOC);

	// $filename = '../query.txt'; 
	// $scrivi = fopen($filename, 'a'); 
	// fwrite($scrivi, "\n\nCat\n".json_encode($categories)); 
	// fclose($scrivi);


	return $categories;

}

//ritorna tutti i rpodotti nel db ma mischiati
function get_all_products(){ 
	$db = db_connect();

	$products = $db->query("SELECT * FROM prodotti");
	$products = $products->fetchAll(PDO::FETCH_ASSOC);
	shuffle($products);
  
	return $products;
}

//Ritorna tutti i rpodotti di quella determinata categoria
function get_all_category_products($category){ 
	
	$db = db_connect();

	$products = $db->query("SELECT * FROM prodotti WHERE Categoria = '$category'");
	
	// print_r($products);
	$products =	$products->fetchAll(PDO::FETCH_ASSOC);

	// $filename = '../query.txt'; 
	// $scrivi = fopen($filename, 'a'); 
	// fwrite($scrivi, "\n\nProd\n".json_encode($products)); 
	// fclose($scrivi);

	return $products;
}

//ritorna tutti i dati diel prodotto pasasto come parametro
function get_all_product_data($product_title){
	$db = db_connect();

	$product = $db->query("SELECT * FROM prodotti WHERE Titolo = '$product_title'");
	
	$product =	$product->fetchAll(PDO::FETCH_ASSOC);

	return $product;
}

//ritorna un array di url foto presi dal db per il carosello nella homepage
function get_random_carousel_data($category, $url_foto){
	$db = db_connect();

	$array_of_url = $db->query("SELECT * FROM prodotti WHERE (Categoria = '$category') AND (NOT Url_foto = '$url_foto' )");

	//PRENOD SOLO I PRIM 6 RISULTATI
	$array_of_url =$array_of_url->fetchAll(PDO::FETCH_ASSOC);
	
	$array_of_url = array_slice($array_of_url, 0, 6);
	shuffle($array_of_url);

	//ritorno un array di url randomicamete scelti
	return $array_of_url;
}

//ritorna la lista dei prodotti di un determinato utente
function get_cart_list($email){
	$db = db_connect();

	$cart = $db->query(
		"SELECT prodotti.Url_foto, prodotti.Categoria, prodotti.Titolo, prodotti.Prezzo, carrello.Quantita 
		FROM carrello 
		INNER JOIN prodotti ON carrello.Titolo = prodotti.Titolo
		WHERE carrello.Cliente = '$email' ");

	$cart =	$cart->fetchAll(PDO::FETCH_ASSOC);
	
	return $cart;
}

//inserisce il prodotto nel carrello gestendo se nil prodotto gia presente oppure no
function insert_product_into_cart($email, $titolo, $quantita){

	$db = db_connect();

	$email = $db->quote($email);
	$titolo = $db->quote($titolo);

	$prezzo = $db->query("SELECT Prezzo From prodotti WHERE Titolo = $titolo ");
	$prezzo = $prezzo->fetchAll();
	$prezzo = $prezzo[0]["Prezzo"]; // prezzo del prodotto

	$somma_totale = $prezzo * $quantita; //importo totale della quantità che aggiungo
	

	if(check_item_in_cart($email, $titolo)){ // GIA NEL CARRELLO
		//modifico quello che esiste in quantita + 1
		
		//prendo somma e quantità gia esistenti nel carrello
		$find_quantity_sum = $db->query("SELECT Quantita, Somma FROM carrello WHERE Cliente = $email AND Titolo = $titolo");
		$find_quantity_sum = $find_quantity_sum->fetchAll();

		//somma gia nel carrello AGGIORNATA
		$somma = $find_quantity_sum[0]["Somma"] + $somma_totale;

		// $somma = $somma * $quantita; // calcolo somma che devo aggiungere ()

		//quantita gia nel carrello AGGIORNATA
		$quantity = $find_quantity_sum[0]["Quantita"] + $quantita;

		$query = "
			UPDATE carrello SET Quantita = $quantity, Somma = $somma 
			WHERE Cliente = $email AND Titolo = $titolo 
			";

		$check = $db->prepare($query);
		$check->execute();

		if ($check->rowCount() > 0) { //Aggiunto 
			return true;
		}
		else{
			return false;
		}

	}
	else{ // NON NEL CARRELLO

		$find_somma = $db->query("SELECT Prezzo FROM prodotti WHERE Titolo = $titolo");
		$find_somma = $find_somma->fetchAll();
		$somma = $find_somma[0]["Prezzo"]; // PREZZO DEL PRODOTTO 
		
		$somma_totale = $somma * $quantita; // somma totale prezzo*quantita comprata
		
		//faccio la insert normalmente
		$query = "
					INSERT INTO carrello(Cliente, Titolo, Quantita, Somma)
					VALUES ( $email , $titolo , $quantita, $somma_totale)
				";

		$check = $db->prepare($query);
		$check->execute();

		if ($check->rowCount() > 0) { //Aggiunto 
			return true;
		}
		else{
			return false;
		}
	}
}

//ritorna true se il prodotto è presente gia nel carrello di quell'utente, false altrimenti
function check_item_in_cart($email, $titolo){
	$db = db_connect();

	$check = $db->query("SELECT * FROM carrello WHERE Cliente = $email AND Titolo = $titolo");

	$item = $check->fetchAll(PDO::FETCH_ASSOC);
	
	if (count($item) > 0)
		return true;
	else 
		return false;
}

//ritorna i dati di somma totale e quantità totale presenti nel db di ogni prodotot nel carrello
function get_checkout_data($email){
	$db = db_connect();

	$check = $db->query("SELECT sum(Quantita) as qnt , sum(Somma) as sum FROM carrello WHERE Cliente = '$email'");

	$data = $check->fetchAll(PDO::FETCH_ASSOC);	

	return $data;
}

//rimuovi tutti gli oggetti dal carrello
function remove_all_items($email){
	$db = db_connect();

	if(isset($_POST["checkout"]) and $_POST["checkout"] == true){ // li elimino per il checkout
		if(empty(get_cart_list($email))){
			return "Il carrello è vuoto!";
		}
		else{
			$sql = "
				DELETE FROM carrello
				WHERE Cliente = '$email'";
	
			$run = $db->query($sql);
			return "Ordine andato a buon fine!";
		}
	}
	else{
		//controllo se ci sono oggetti da eliminare
		if(empty(get_cart_list($email))){
				return "Non ci sono elementi da eliminare";
			}
			else{
				$sql = "
					DELETE FROM carrello
					WHERE Cliente = '$email'";

				$run = $db->query($sql);
				return "Eliminati!";
			}
	}
	
}

//rimuove tutta la quantità di un determinato oggetto 
//-> rimuove l'oggetto dal carrello
function remove_all_this_item($email, $title){
	$db = db_connect();

	$sql = "
	DELETE FROM carrello
	WHERE Cliente = '$email' AND Titolo = '$title'";

	$run = $db->query($sql);

	return $title ." è stato eliminato!";
}

//rimuove solo 1 quantità di quel prodotto dal carrello
function remove_one_this_item($email, $title){
	$db = db_connect();
	
	//controllo la quantità nel carrello
	// --> SE >1 --> UPDATE quantià e somma carrello
	// --> ELSE (=1) DELETE
	// --> ELSE (=0) NULLA 
	// --> ELSE ERRORE 

	//ottengo dati dal CARRELLO
	$find_title_quantity_sum = $db->query("SELECT Titolo, Quantita, Somma FROM carrello WHERE Cliente = '$email' AND Titolo = '$title'");
	$find_title_quantity_sum = $find_title_quantity_sum->fetchAll();

	$quantity = $find_title_quantity_sum[0]["Quantita"];
	$somma_tot = $find_title_quantity_sum[0]["Somma"];
	$titolo = $find_title_quantity_sum[0]["Titolo"] ; // titolo nel db

	//trovoprezzo unitario
	$prezzo_unitario = $db->query("SELECT Prezzo FROM prodotti WHERE Titolo = '$titolo'");
	$prezzo_unitario = $prezzo_unitario->fetchAll();
	$prezzo_unitario = $prezzo_unitario[0]["Prezzo"];

	if($quantity > 1){
		//UPDATE
		$quantity = $quantity -1;
		$somma = $somma_tot - $prezzo_unitario; // calcolo prezzo carrello aggiornato
		$query = "
			UPDATE carrello SET Quantita = $quantity, Somma = $somma
			WHERE Cliente = '$email' AND Titolo = '$title '
		";

		$check = $db->prepare($query);
		$check->execute();

		// check row??
		return "Quantità di " . $title . " ridotta di 1";
		
	}
	else if($quantity == 1){
		//DELETE
		$sql = "
			DELETE FROM carrello
			WHERE Cliente = '$email' AND Titolo = '$title'
		";
		$check = $db->query($sql);
		return $title ." è stato eliminato!";
	}
	else if($quantity == 0){
		//NUlla
		// return "Quantità ia 0 NON DOVRESTI VEDERMI";
	}
	else{
		//ERRORE
		// return "ERRORE NELLA QUANTITà NON DOVRESTI VEDERMI";
	}
}

?>