<?php 
include("../html/top.html");
include("db.php");

if (!isset($_SESSION['email'])) { //se esiste (isset) salvo le info nell array $_SESSION(sessione iniziata nel top)
	header("Location: login.php"); //se esiste la sessione reindirizzo nella pagina dell utente
	exit;
} if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
	?>

<!-- SESSIONE =
<?= $_SESSION['email'] ?>
<br /><br />
ADMIN =
<?= $_SESSION['admin'] ?>
<br /><br /> -->

<main>
   <article id="dashboard-wrapper">
		<h3>DASHBOARD</h3>
      <ul>
         <li>
            <button id="addAdminBtn">Aggiungi Admin</button>
         </li>
         <li>
            <button id="addProductBtn">Aggiungi Prodotto</button>
         </li>
         <li>
            <button id="deleteProductBtn">Rimuovi Prodotto</button>
         </li>
         <li>
            <button id="modifyProductBtn">Modifica Prodotto</button>
         </li>
      </ul>


	<section id="adminForms">
		<!-- form con input text e un tasto finale di invio -->
		<div class="error"></div>
		<form class="container" id="addAdmin">
			<h2>Aggiungi Amministratore</h2>
			Nome: <input type="text" name="nameAdmin"><br>
			Cognome: <input type="text" name="cognomeAdmin"><br>
			Email: <input type="text" name="emailAdmin"><br>
			Password: <input type="text" name="passwordAdmin"><br>
			<input type="submit" id="submitAddAdmin">
		</form>

		<form class="container" id="addProduct">
			<h2>Aggiungi Prodotto</h2>

			Titolo: <input type="text" name="titoloProdotto"><br>
			Categoria: <input type="text" name="categoriaProdotto"><br>
			Url foto: <input type="text" name="url_fotoProdotto"><br>
			Descrizione: <input type="text" name="descrizioneProdotto"><br>
			Prezzo: <input type="text" name="prezzoProdotto"><br>
			<input type="submit" id="submitAddProduct">
		</form>

		<form class="container" id="deleteProduct">
			<h2>Elimina Prodotto</h2>

			Titolo prodotto da eliminare: 
			<input type="text" name="titoloProdottoDelete"><br>
			<input type="submit" id="submitDeleteProduct">
		</form>

		<form class="container" id="modifyProduct">
			<h2>Modifica Prodotto</h2>

			Titolo prodotto da modificare: 
			<input type="text" name="titoloModify">

			Catgeoria: <input type="text" name="categoriaModify"><br>
			Url foto: <input type="text" name="url_fotoModify"><br>
			Descrizione: <input type="text" name="descrizioneModify"><br>
			Prezzo: <input type="text" name="prezzoModify"><br>

			<input type="submit" id="submitModifyProduct">
		</form>
	
	</section>


   </article>
</main>
<?php
}
else{
?>

<main>
	<!-- SESSIONE = <?= $_SESSION['email'] ?> <br><br> -->
	<!-- SESSIONE = <?= $_SESSION['nome'] ?> <br><br> -->
	<!-- SESSIONE = <?= $_SESSION['cognome'] ?> <br><br> -->



	Ciao <?= $_SESSION['email'] ?>  <br>
	<?= $_SESSION['nome'] ?> 
	<?= $_SESSION['cognome'] ?>

	<p>Questo è la tua area privata</p>

	<!-- 
		Visualizza ordini del cliente che ha effettuatO
		CON UN BOTTONE CHE CREA SOTTOUNA LISTA/TABELLA CON I DATI DEI SUOI ORDINI
		LISTA FLEX ROW


	-->




</main>

<?php 

}
include("../html/bottom.html")

?>

