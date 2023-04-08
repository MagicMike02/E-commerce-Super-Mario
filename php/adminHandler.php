<?php 
/*Gestisce le funzionalità dell'admin */
include("db.php");


if(isset($_POST['data'])){
	$db = db_connect();

	$data = $_POST['data']; 

	$action = $data['action'];

	switch ($action) {
		case "addAdmin":
			$nome = $data["nome"];
			$cognome = $data["cognome"];
			$email = $data["email"];
			$password = $data["password"];

			//controllo se gia esiste 
			if(check_admin($email, $password)){
				echo true; //"Admin gia presente";
			}
			else{
				$password = md5($password);

				$nome = $db->quote($nome);
				$cognome = $db->quote($cognome);
				$email = $db->quote($email);
				$password = $db->quote($password);

				$query = "
				INSERT INTO dipendente(Nome, Cognome, Email, Password)
				VALUES ($nome , $cognome , $email, $password)
				";

				$check = $db->prepare($query);
				$check->execute();

				$res = false;
				if ($check->rowCount() > 0) { // Aggiunto 
					$res = $res && true;
				} 
				else {
					$res = $res && false;
				}

				$query = "
				INSERT INTO cliente(Nome, Cognome, Email, Password)
				VALUES ($nome , $cognome , $email, $password)
				";

				$check = $db->prepare($query);
				$check->execute();

				
				if ($check->rowCount() > 0) { // Aggiunto 
					$res = $res && true;
					echo true;
				} 
				else {
					
					echo  false;
				}


			}
					
			break;


		case "addProduct":
			$titolo = $data["titolo"];
			$categoria = $data["categoria"];
			$url_foto = $data["url_foto"];
			$descrizione = $data["descrizione"];
			$prezzo = $data["prezzo"];

			$titolo = $db->quote($titolo);
			$categoria = $db->quote($categoria);
			$url_foto = $db->quote($url_foto);
			$descrizione = $db->quote($descrizione);
			$prezzo = $db->quote($prezzo);


			//controllo se gia esiste 
			$check = $db->query("SELECT Titolo FROM prodotti WHERE Titolo = $titolo");
			$check = $check->fetchAll(PDO::FETCH_ASSOC);

			if (count($check) > 0)
				echo true; // gia aggiunto
			else {

				$query = "
				INSERT INTO prodotti(Titolo, Categoria, Url_foto, Descrizione, Prezzo)
				VALUES ($titolo , $categoria , $url_foto, $descrizione, $prezzo)
				";
	
				$check = $db->prepare($query);
				$check->execute();
	
				if ($check->rowCount() > 0) { // Aggiunto 
					echo true;
				} 
				else {
					echo false;
				}
			}

			break;


		case "deleteProduct":
			$titolo = $data["titolo"];
			$titolo = $db->quote($titolo);

			$check = $db->query("SELECT Titolo FROM prodotti WHERE Titolo = $titolo");
			$check = $check->fetchAll(PDO::FETCH_ASSOC);

			// il prodotto esiste e poss eliminarlo
			if (count($check) > 0){
					$query = "DELETE FROM prodotti WHERE Titolo = $titolo";

					$check = $db->prepare($query);
					$check->execute();
		
					$check = $db->query("SELECT Titolo FROM prodotti WHERE Titolo = $titolo");
					$check = $check->fetchAll(PDO::FETCH_ASSOC);

					if (count($check) <= 0) { // eliminato s eil count è <=0
						echo true;
					} 
					else {
						echo false;
					}
			}
			else {//prodotto non esiste 
				echo true ; // true perche "è stato eliminato"
			}
			 
			break;


		case "modifyProduct":
			$titolo = $data["titolo"];
			$categoria = $data["categoria"];
			$url_foto = $data["url_foto"];
			$descrizione = $data["descrizione"];
			$prezzo = $data["prezzo"];

			$titolo = $db->quote($titolo);
			$categoria = $db->quote($categoria);
			$url_foto = $db->quote($url_foto);
			$descrizione = $db->quote($descrizione);
			$prezzo = $db->quote($prezzo);

			$check = $db->query("SELECT Titolo FROM prodotti WHERE Titolo = $titolo");
			$check = $check->fetchAll(PDO::FETCH_ASSOC);

			if (count($check) > 0){//esiste e posos modificarlo
				
				$query = 
				"UPDATE prodotti
				SET Categoria = $categoria, Url_foto = $url_foto, Descrizione = $descrizione, 
				Prezzo = $prezzo WHERE Titolo = $titolo";

				$check = $db->prepare($query);
				$check->execute();
	
				echo true;
			}
			else {//NOn esiste 
				echo false;
			}
			break;
		}
  }
  
else{
	echo "error";
}



?>